<?php

//category_fetch.php

require_once(__DIR__ . '/../../db.php');

// noms des colonnes dans l'ordre
$colonne = array("nom_secteur", "nom_projet", "nom_personne", "montant_total_projet", "dac_projet", "dsc_projet", "ps_projet", "pr_projet", "en_attente_reponse_projet");

$query = '';

$output = array();

$query .= "SELECT * FROM projet, promoteur, secteur, personne WHERE projet.id_promoteur_fk_projet = promoteur.id_promoteur AND projet.id_secteur_fk_projet = secteur.id_secteur AND promoteur.id_personne_fk_promoteur = personne.id_personne AND etat_projet = 'en_attente'"; // changer

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
	$query .= 'ORDER BY id_projet DESC ';
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

function modeContrib($mode){
	if($mode == 'oui')
		return 'info';
	else
		return 'light';
}


foreach($result as $row)
{
	//"<a href=\"#\" class=\"badge badge-primary\">Primary</a>"
	$sub_array = array(); // tenir compte de l'ordre dans le tableau
	$sub_array[] = $row['nom_secteur'];
	$sub_array[] = $row['nom_projet'];
	$sub_array[] = $row['nom_personne'].' '.$row['prenom_personne'];
	$sub_array[] = $row['montant_total_projet'];

	$dac_projet = $row['dac_projet'];
	$dsc_projet = $row['dsc_projet'];
	$ps_projet = $row['ps_projet'];
	$pr_projet = $row['pr_projet'];



	$sub_array[] = "<a href=\"#\" class=\"badge badge-". modeContrib($dac_projet) ."\">$dac_projet</a>";
	$sub_array[] = "<a href=\"#\" class=\"badge badge-". modeContrib($dsc_projet) ."\">$dsc_projet</a>";
	$sub_array[] = "<a href=\"#\" class=\"badge badge-". modeContrib($ps_projet) ."\">$ps_projet</a>";
	$sub_array[] = "<a href=\"#\" class=\"badge badge-". modeContrib($pr_projet) ."\">$pr_projet</a>";

	$sub_array[] = $row['en_attente_reponse_projet'];
	
	$id_projet = $row['id_projet'];
	$actionProjet = "<a href=\"consulter/projet-en-attente-view.php?projet=$id_projet\" class=\"btn btn-primary\">Consulter</div>";
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
	$statement = $db->prepare("SELECT * FROM projet, promoteur, secteur, personne WHERE projet.id_promoteur_fk_projet = promoteur.id_promoteur AND projet.id_secteur_fk_projet = secteur.id_secteur AND promoteur.id_personne_fk_promoteur = personne.id_personne AND etat_projet = 'en_attente'"); // same query as above
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);
