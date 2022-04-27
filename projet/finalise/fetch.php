<?php

//category_fetch.php

require_once(__DIR__ . '/../../db.php');

// noms des colonnes dans l'ordre
$colonne = array("date_publication_projet", "date_fin_projet", "date_finalisation_projet", "nom_secteur", "nom_projet", "nom_personne", "montant_collecte_projet", "montant_total_projet");

$query = '';

$output = array();

$query .= "SELECT * FROM projet, promoteur, secteur, personne WHERE projet.id_promoteur_fk_projet = promoteur.id_promoteur AND projet.id_secteur_fk_projet = secteur.id_secteur AND promoteur.id_personne_fk_promoteur = personne.id_personne AND etat_projet = 'finalise'"; // changer

if(isset($_POST["search"]["value"]))
{	// changer les colonnes à rechercher
	$query .= 'AND (nom_secteur LIKE "%'.$_POST["search"]["value"].'%" ';
	// $query .= 'OR MessageEvenement LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR nom_projet LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR prenom_personne LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR nom_personne LIKE "%'.$_POST["search"]["value"].'%" ) ';
}


// Filtrage dans le tableau
if(isset($_POST['order']))
{
	$query .= 'ORDER BY '.$colonne[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY date_finalisation_projet DESC ';
}

if($_POST['length'] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $db->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$filtered_rows = $statement->rowCount();


foreach($result as $row)
{
	$sub_array = array(); // tenir compte de l'ordre dansle tableau
	
	$sub_array[] = date("d-m-Y", strtotime($row['date_publication_projet']));
    $sub_array[] = date("d-m-Y", strtotime($row['date_fin_projet']));
    $sub_array[] = date("d-m-Y", strtotime($row['date_finalisation_projet']));
	$sub_array[] = $row['nom_secteur'];
	$sub_array[] = $row['nom_projet'];
	$sub_array[] = $row['nom_personne'].' '.$row['prenom_personne'];
	$sub_array[] = $row['montant_collecte_projet'];
	$sub_array[] = $row['montant_total_projet'];
	$id_projet = $row['id_projet'];
	$actionProjet = "<a href=\"consulter/projet-finalise-view.php?projet=$id_projet\" class=\"btn btn-primary\">Consulter</div>";
	$sub_array[] = $actionProjet;
	
	$data[] = $sub_array;
}

$output = array(
	"draw"			=>	intval($_POST["draw"]),
	"recordsTotal"  	=>  $filtered_rows,
	"recordsFiltered" 	=> 	get_total_all_records($db),
	"data"				=>	$data
);

function get_total_all_records($db)
{
	$statement = $db->prepare("SELECT * FROM projet, promoteur, secteur, personne WHERE projet.id_promoteur_fk_projet = promoteur.id_promoteur AND projet.id_secteur_fk_projet = secteur.id_secteur AND promoteur.id_personne_fk_promoteur = personne.id_personne AND etat_projet = 'finalise'"); // same query as above
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);
