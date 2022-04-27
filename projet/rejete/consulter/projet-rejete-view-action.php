<?php 
require_once(__DIR__ . '/../../../db.php');

$message = '';
    
if(isset($_POST['id_projet_finalise'])){
    $id_projet = $_POST['id_projet_finalise'];
    $note = $_POST['info_projet'];
    $d = new DateTime();
    $date_finalisation_projet = $d->format('Y-m-d H:i:s');

    $query = "UPDATE projet set etat_projet = 'finalise', info_projet = :note, date_finalisation_projet = :date_finalisation_projet  WHERE id_projet = :id_projet";
    $statement = $db->prepare($query);
    $statement->bindParam(':id_projet', $id_projet);
    $statement->bindParam(':note', $note);
    $statement->bindParam(':date_finalisation_projet', $date_finalisation_projet);
    
    if($statement->execute()){
        $message = 'Projet finalise';
    }

}

if(isset($_POST['id_projet_publie'])){
    $id_projet = $_POST['id_projet_publie'];
    $date_fin_projet = $_POST['date_fin_projet']. ' '. '00:00:00';
    $d = new DateTime();
    $date_publication_projet = $d->format('Y-m-d H:i:s');

    $query = "UPDATE projet set etat_projet = 'en_cour', date_fin_projet = :date_fin_projet, date_publication_projet = :date_publication_projet  WHERE id_projet = :id_projet";
    $statement = $db->prepare($query);
    $statement->bindParam(':id_projet', $id_projet);
    $statement->bindParam(':date_fin_projet', $date_fin_projet);
    $statement->bindParam(':date_publication_projet', $date_publication_projet);
    
    if($statement->execute()){
        $message = 'Projet publie';
    }

}


echo json_encode($message);