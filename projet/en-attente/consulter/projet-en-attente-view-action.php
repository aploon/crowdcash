<?php
require_once(__DIR__ . '/../../../db.php');

$message = '';
    
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

if (isset($_POST['message_promoteur'])) {
    $id_projet = $_POST['id_projet'];
    $id_personne = $_SESSION['id_personne'];
    $id_promoteur = $_POST['id_promoteur'];
    $message_promoteur = $_POST['message_promoteur'];
    $d = new DateTime();
    $date_envoi_message = $d->format('Y-m-d H:i:s');

    $query1 = "INSERT INTO message (id_message, id_promoteur_fk_assoc_promoteur_and_personnel, id_personnel_fk_assoc_promoteur_and_personnel, id_projet_fk_assoc_promoteur_and_personnel, contenu_message, auteur_message, destinataire_message, date_envoi_message) VALUES (NULL, :id_promoteur, :id_personne, :id_projet, :message, 'personnel', 'promoteur', :date_envoi_message)";
    $statement1 = $db->prepare($query1);
    $statement1->bindParam(':id_promoteur', $id_promoteur);
    $statement1->bindParam(':id_personne', $id_personne);
    $statement1->bindParam(':id_projet', $id_projet);
    $statement1->bindParam(':message', $message_promoteur);
    $statement1->bindParam(':date_envoi_message', $date_envoi_message);

    if ($statement1->execute()) {
        
        $query = "UPDATE projet set en_attente_reponse_projet = 'oui' WHERE id_projet = :id_projet";
        $statement = $db->prepare($query);
        $statement->bindParam(':id_projet', $id_projet);
        $statement->execute();

        $message = 'Message envoyé';
    }
    
}


echo json_encode($message);