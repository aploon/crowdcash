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


if(isset($_POST['id_projet_rejete'])){
    $id_projet = $_POST['id_projet_rejete'];
    $raison = $_POST['info_projet'];
    $d = new DateTime();
    $date_rejet_projet = $d->format('Y-m-d H:i:s');

    $query = "UPDATE projet set etat_projet = 'rejete', info_projet = :raison, date_rejet_projet = :date_rejet_projet  WHERE id_projet = :id_projet";
    $statement = $db->prepare($query);
    $statement->bindParam(':id_projet', $id_projet);
    $statement->bindParam(':raison', $raison);
    $statement->bindParam(':date_rejet_projet', $date_rejet_projet);
    
    if($statement->execute()){
        $message = 'Projet rejete';
    }
}


echo json_encode($message);