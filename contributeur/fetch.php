<?php

//category_fetch.php
require_once(__DIR__ . '/../db.php');


// noms des colonnes dans l'ordre
$colonne = array("", "nom_personne", "prenom_personne", "tel_personne", "", "", "", "", "", "statut_contributeur");

$query = '';

$output = array();

$query .= "SELECT * FROM contributeur, personne, compte WHERE contributeur.id_personne_fk_contributeur = personne.id_personne AND compte.id_personne_fk_compte = personne.id_personne AND statut_contributeur != 'delete' AND statut_compte = 'Actif' "; // changer

if (isset($_POST["search"]["value"])) {    // changer les colonnes à rechercher
    $query .= 'AND (nom_personne LIKE "%' . $_POST["search"]["value"] . '%" ';
    // $query .= 'OR MessageEvenement LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR prenom_personne LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR tel_personne LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR statut_contributeur LIKE "%' . $_POST["search"]["value"] . '%" ) ';
}


// Filtrage dans le tableau
if (isset($_POST['order'])) {
    $query .= 'ORDER BY ' . $colonne[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= 'ORDER BY id_contributeur DESC ';
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

    $id_contributeur = $row['id_contributeur'];
    $img = $row['img_personne'];
    $sub_array[] = '<img style="border: 0px;" alt="image" src="../assets/img/img-personne/'. $img .'" class="rounded-circle" width="35" data-toggle="title" title="">';
    $sub_array[] = $row['nom_personne'];
    $sub_array[] = $row['prenom_personne'];
    $sub_array[] = $row['tel_personne'];

    //DSC
    $query1 = "SELECT SUM(montant_assoc_projet_and_contributeur) montant FROM assoc_projet_and_contributeur, contributeur WHERE assoc_projet_and_contributeur.id_contributeur_fk_assoc_projet_and_contributeur = contributeur.id_contributeur AND id_contributeur = $id_contributeur AND mode_contribution_assoc_projet_and_contributeur = 'DSC'";
    $statement1 = $db->prepare($query1);
    $statement1->execute();
    $result1 = $statement1->fetch();
    if ($result1['montant']) {
        $sub_array[] = $result1['montant'];
    } else
        $sub_array[] = 0;


    //DAC
    $query2 = "SELECT SUM(montant_assoc_projet_and_contributeur) montant FROM assoc_projet_and_contributeur, contributeur WHERE assoc_projet_and_contributeur.id_contributeur_fk_assoc_projet_and_contributeur = contributeur.id_contributeur AND id_contributeur = $id_contributeur AND mode_contribution_assoc_projet_and_contributeur = 'DAC'";
    $statement2 = $db->prepare($query2);
    $statement2->execute();
    $result2 = $statement2->fetch();
    if ($result2['montant']) {
        $sub_array[] = $result2['montant'];
    } else
        $sub_array[] = 0;

    //PS
    $query3 = "SELECT SUM(montant_assoc_projet_and_contributeur) montant FROM assoc_projet_and_contributeur, contributeur WHERE assoc_projet_and_contributeur.id_contributeur_fk_assoc_projet_and_contributeur = contributeur.id_contributeur AND id_contributeur = $id_contributeur AND mode_contribution_assoc_projet_and_contributeur = 'PS'";
    $statement3 = $db->prepare($query3);
    $statement3->execute();
    $result3 = $statement3->fetch();
    if ($result3['montant']) {
        $sub_array[] = $result3['montant'];
    } else
        $sub_array[] = 0;

    //PR
    $query4 = "SELECT SUM(montant_assoc_projet_and_contributeur) montant FROM assoc_projet_and_contributeur, contributeur WHERE assoc_projet_and_contributeur.id_contributeur_fk_assoc_projet_and_contributeur = contributeur.id_contributeur AND id_contributeur = $id_contributeur AND mode_contribution_assoc_projet_and_contributeur = 'PR'";
    $statement4 = $db->prepare($query4);
    $statement4->execute();
    $result4 = $statement4->fetch();
    if ($result4['montant']) {
        $sub_array[] = $result4['montant'];
    } else
        $sub_array[] = 0;

    //Total
    $sub_array[] = $result1['montant'] + $result2['montant'] + $result3['montant'] + $result4['montant'];

    //Statut contributeur
    $status = '';
    if ($row['statut_contributeur'] == 'Actif') {
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
        <a class="dropdown-item view" id="'.$row['id_contributeur'].'" href="#" >Consulter profil</a>
        <a class="dropdown-item update" id="'.$row['id_contributeur'].'" href="#">Modifier profil</a>
        <a class="dropdown-item activity" id="'.$row['id_contributeur'].'" href="#" data-status="'.$row["statut_contributeur"].'">Changer statut</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item delete text-danger" id="'.$row['id_contributeur'].'" href="#" data-statut="'.$row["statut_contributeur"].'">Supprimer le compte</a>
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
    $statement = $db->prepare("SELECT * FROM contributeur, personne, compte WHERE contributeur.id_personne_fk_contributeur = personne.id_personne AND compte.id_personne_fk_compte = personne.id_personne AND statut_contributeur != 'delete' AND statut_compte = 'Actif' "); // same query as above
    $statement->execute();
    return $statement->rowCount();
}

echo json_encode($output);
