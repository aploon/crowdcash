<?php require_once(__DIR__ . '/../db.php') ?>

<?php require_once(__DIR__ . '/../fonctions.php') ?>

<?php require_once(__DIR__ . '/../fonctions-sql.php') ?>

<?php

$message = '';

if ($_POST) {

    if($_POST['action'] == 'get_nbr_message'){

        $id_personne = $_SESSION['id_personne'];
        $query = "SELECT * FROM message, personne WHERE message.auteur_message = personne.id_personne AND destinataire_message = $id_personne AND etat_message = 'non_lu'";
        $statement = $db->prepare($query);
        $statement->execute();

        $result = $statement->fetchAll();
        $nbr_message = $statement->rowCount();
        $message = $nbr_message;
    }
    if($_POST['action'] == 'get_user_message'){

        $id_personne = $_SESSION['id_personne'];
        $query = "SELECT DISTINCT id_personne FROM message, personne WHERE message.auteur_message = personne.id_personne AND destinataire_message = $id_personne AND etat_message = 'non_lu'";
        $statement = $db->prepare($query);
        $statement->execute();

        $result = $statement->fetchAll();

        $result1 = array();
        foreach ($result as $row) {

            $auteur_message = $row['id_personne'];
            $query = "SELECT * FROM message, personne WHERE message.auteur_message = personne.id_personne AND destinataire_message = $id_personne AND auteur_message = $auteur_message AND etat_message = 'non_lu' ORDER BY date_envoi_message DESC LIMIT 1";
            $statement = $db->prepare($query);
            $statement->execute();

            $result1[] = $statement->fetch();
        }

        $message = $result1;
    }
}

echo json_encode($message);
