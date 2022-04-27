<?php require_once(__DIR__ . '/../db.php') ?>

<?php require_once(__DIR__ . '/../fonctions.php') ?>

<?php require_once(__DIR__ . '/../fonctions-sql.php') ?>

<?php

$message = '';

if ($_POST) {
    $d = new DateTime();
    $date = $d->format('Y-m-d H:i:s');

    if ($_POST['action'] == 'update_last_activity') {

        $id_personne = $_SESSION['id_personne'];
        if (update('login_details', [
            'last_activity_login_details' => $date
        ], "id_personne_fk_login_details = $id_personne", $db)) {
            $message = 'Utilisateur en ligne';
        }
    }

    if ($_POST['action'] == 'get_online_statut') {

        $query = "SELECT id_personne FROM promoteur, personne, login_details WHERE promoteur.id_personne_fk_promoteur = personne.id_personne AND login_details.id_personne_fk_login_details = personne.id_personne AND last_activity_login_details > DATE_SUB(NOW(),  INTERVAL 5 SECOND)";
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();

        $online = array();
        foreach ($result as $row) {
            $online[] = $row['id_personne'];
        }
        $message = $online;
    }
}

echo json_encode($message);
