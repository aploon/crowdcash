<?php require_once(__DIR__ . '/../db.php') ?>

<?php require_once(__DIR__ . '/../fonctions.php') ?>

<?php require_once(__DIR__ . '/../fonctions-sql.php') ?>

<?php
$message = '';

if (isset($_GET['q'])) {

    $auteur_message = $_GET['q'];
    $destinataire_message = $_SESSION['id_personne'];
    $id_projet = $_GET['p'];

    update('message', [
        'etat_message' => 'lu'
    ], "destinataire_message = $destinataire_message AND auteur_message = $auteur_message AND id_projet_fk_message = $id_projet", $db);
}

//Récupération du id_promoteur et envoi des nom_projet  
if (isset($_GET['id_promoteur_for_get_projet'])) {

    $id_promoteur = $_GET['id_promoteur_for_get_projet'];


    $query = "SELECT * FROM projet, personne, promoteur WHERE promoteur.id_personne_fk_promoteur = personne.id_personne AND projet.id_promoteur_fk_projet = promoteur.id_promoteur AND id_personne = $id_promoteur ORDER BY nom_projet DESC";
    $statement = $db->prepare($query);
    $statement->execute();

    $result = $statement->fetchAll();

    $message = $result;
}

//Récupération des messages depuis la base de donnée  
if (isset($_GET['q'])) {

    $id_projet = $_GET['p'];
    $pers1 = $_GET['q'];
    $pers2 = $_SESSION['id_personne'];

    $query = "SELECT * FROM message, personne WHERE (message.auteur_message = personne.id_personne OR message.destinataire_message = personne.id_personne) AND ((auteur_message = $pers1 AND destinataire_message = $pers2) OR (destinataire_message = $pers1 AND auteur_message = $pers2)) AND id_projet_fk_message = $id_projet AND id_personne != $pers2 ORDER BY date_envoi_message DESC";
    $statement = $db->prepare($query);
    $statement->execute();

    $result = $statement->fetchAll();

    $message = $result;
}

//Récupération et envoi des messages dans la base de donnée
if ($_POST) {
    $id_projet = $_POST['id_projet'];
    $auteur_message = $_SESSION['id_personne'];
    $destinataire_message = $_POST['id_personne'];
    $contenu_message = $_POST['contenu_message'];
    $d = new DateTime();
    $date_envoi_message = $d->format('Y-m-d H:i:s');

    if (insert('message', [
        'id_message' => NULL,
        'contenu_message' => addslashes($contenu_message),
        'date_envoi_message' => $date_envoi_message,
        'etat_message' => 'non_lu',
        'auteur_message' => $auteur_message,
        'destinataire_message' => $destinataire_message,
        'id_projet_fk_message' => $id_projet
    ], $db)) {
        $message = 'insertion éffectuée';
    }
}

echo json_encode($message);
