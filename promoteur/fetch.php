<?php

//category_fetch.php
require_once(__DIR__ . '/../db.php');


// noms des colonnes dans l'ordre
$colonne = array("", "nom_personne", "prenom_personne", "tel_personne", "", "", "", "", "", "statut_promoteur");

$query = '';

$output = array();

$query .= "SELECT * FROM promoteur, personne, compte WHERE promoteur.id_personne_fk_promoteur = personne.id_personne AND compte.id_personne_fk_compte = personne.id_personne AND statut_promoteur != 'delete' AND statut_compte = 'Actif' "; // changer

if (isset($_POST["search"]["value"])) {    // changer les colonnes à rechercher
    $query .= 'AND (nom_personne LIKE "%' . $_POST["search"]["value"] . '%" ';
    // $query .= 'OR MessageEvenement LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR prenom_personne LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR tel_personne LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR statut_promoteur LIKE "%' . $_POST["search"]["value"] . '%" ) ';
}


// Filtrage dans le tableau
if (isset($_POST['order'])) {
    $query .= 'ORDER BY ' . $colonne[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= 'ORDER BY id_promoteur DESC ';
}

if ($_POST['length'] != -1) {
    $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $db->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$filtered_rows = $statement->rowCount();


foreach ($result as $row) {

    $sub_array = array(); // tenir compte de l'ordre dansle tableau

    $id_promoteur = $row['id_promoteur'];
    $img = $row['img_personne'];
    $sub_array[] = '<img style="border: 0px;" alt="image" src="../assets/img/img-personne/'. $img .'" class="rounded-circle" width="35" data-toggle="title" title="">';
    $sub_array[] = $row['nom_personne'];
    $sub_array[] = $row['prenom_personne'];
    $sub_array[] = $row['tel_personne'];

    //Projets finalisés
    $query1 = "SELECT * FROM projet, promoteur WHERE projet.id_promoteur_fk_projet = promoteur.id_promoteur AND id_promoteur_fk_projet = $id_promoteur AND etat_projet = 'finalise'";
    $statement1 = $db->prepare($query1);
    $statement1->execute();
    $result1 = $statement1->rowCount();
    $sub_array[] = $result1;


    //Projets rejetés
    $query2 = "SELECT * FROM projet, promoteur WHERE projet.id_promoteur_fk_projet = promoteur.id_promoteur AND id_promoteur_fk_projet = $id_promoteur AND etat_projet = 'rejete'";
    $statement2 = $db->prepare($query2);
    $statement2->execute();
    $result2 = $statement2->rowCount();
    $sub_array[] = $result2;

    //Projets en_attente
    $query3 = "SELECT * FROM projet, promoteur WHERE projet.id_promoteur_fk_projet = promoteur.id_promoteur AND id_promoteur_fk_projet = $id_promoteur AND etat_projet = 'en_attente'";
    $statement3 = $db->prepare($query3);
    $statement3->execute();
    $result3 = $statement3->rowCount();
    $sub_array[] = $result3;

    //Projets en_cour
    $query4 = "SELECT * FROM projet, promoteur WHERE projet.id_promoteur_fk_projet = promoteur.id_promoteur AND id_promoteur_fk_projet = $id_promoteur AND etat_projet = 'en_cour'";
    $statement4 = $db->prepare($query4);
    $statement4->execute();
    $result4 = $statement4->rowCount();
    $sub_array[] = $result4;

    //Total
    $query5 = "SELECT SUM(montant_collecte_projet) montant FROM projet, promoteur WHERE projet.id_promoteur_fk_projet = promoteur.id_promoteur AND id_promoteur_fk_projet = $id_promoteur AND etat_projet != 'rejete'";
    $statement5 = $db->prepare($query5);
    $statement5->execute();
    $result5 = $statement5->fetch();
    $sub_array[] = $result5['montant'];

    //Statut promoteur
    $status = '';
    if ($row['statut_promoteur'] == 'Actif') {
        $status = '<center><span class="badge badge-primary"> Actif </span></center>';
    } else {
        $status = '<center><span class="badge badge-danger"> Inactif </span></center>';
    }
    $sub_array[] = $status;


    $actionProjet = '
    <center>
	
	<div class="btn-group">
      <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item view" id="'.$row['id_promoteur'].'" href="#" >Consulter profil</a>
        <a class="dropdown-item update" id="'.$row['id_promoteur'].'" href="#">Modifier profil</a>
        <a class="dropdown-item activity" id="'.$row['id_promoteur'].'" href="#" data-status="'.$row["statut_promoteur"].'">Changer statut</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item delete text-danger" id="'.$row['id_promoteur'].'" href="#" data-statut="'.$row["statut_promoteur"].'">Supprimer le compte</a>
      </div>
    </div>
	
	
	</center>
    ';
    $sub_array[] = $actionProjet;

    $data[] = $sub_array;
}

$output = array(
    "draw"            =>    intval($_POST["draw"]),
    "recordsTotal"      =>  $filtered_rows,
    "recordsFiltered"     =>     get_total_all_records($db),
    "data"                =>    $data
);

function get_total_all_records($db)
{
    $statement = $db->prepare("SELECT * FROM promoteur, personne, compte WHERE promoteur.id_personne_fk_promoteur = personne.id_personne AND compte.id_personne_fk_compte = personne.id_personne AND statut_promoteur != 'delete' AND statut_compte = 'Actif' "); // same query as above
    $statement->execute();
    return $statement->rowCount();
}

echo json_encode($output);
