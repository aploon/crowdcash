<?php
require_once(__DIR__ . '/db.php');
require_once(__DIR__ . '/fonctions.php');
require_once(__DIR__ . '/fonctions-sql.php');

//Vérifie si le formulaire a été envoyé
$email = $_POST['email'];
$password = $_POST['password'];

$query = "
        SELECT * 
        FROM compte
        INNER JOIN personne
        ON compte.id_personne_fk_compte = personne.id_personne
        WHERE personne.email_personne = '$email'
        ";
$message = '';

$req = $db->prepare($query);
$req->execute();
$count = $req->rowCount();

if ($count > 0) {

    $data = $req->fetch(PDO::FETCH_ASSOC);
    //Si le compte est Actif
    if ($data['statut_compte'] == 'Actif') {

        //Si le mot de passe de l'admin correspond 
        if ($password == $data['mdp_compte']) {
            
            //update('personne', ['etat_personne' => 'connecte'], "email_personne = '$email'", $db);
            //On créé une session pour stocker l'id de l'admin et son role
            $_SESSION['type_compte'] = $data['id_type_compte_fk_compte'];
            $_SESSION['id_compte'] = $data['id_compte'];
            $_SESSION['id_personne'] = $data['id_personne'];
            $_SESSION['pseudo_compte'] = $data['pseudo_compte'];

            $_SESSION['nom_personne'] = $data['nom_personne'];
            $_SESSION['prenom_personne'] = $data['prenom_personne'];
            $_SESSION['email_personne'] = $data['email_personne'];
            $_SESSION['tel_personne'] = $data['tel_personne'];
            $_SESSION['img_personne'] = $data['img_personne'];

            $query1 = "
            SELECT lib_menu, statut_assoc_menu_and_type_compte 
            FROM compte, type_compte, menu, assoc_menu_and_type_compte  
            WHERE type_compte.id_type_compte = compte.id_type_compte_fk_compte 
            AND assoc_menu_and_type_compte.id_type_compte_fk_assoc_menu_and_type_compte = type_compte.id_type_compte 
            AND assoc_menu_and_type_compte.id_menu_fk_assoc_menu_and_type_compte = menu.id_menu AND id_compte = :id_compte
            ";
            $id_compte = $data['id_compte'];
            $req1 = $db->prepare($query1);
            $req1->bindParam(':id_compte', $id_compte);
            $req1->execute();
            $data1 = $req1->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data1 as $row) {
                # code...
                $_SESSION['menu_' . $row['lib_menu']] = $row['statut_assoc_menu_and_type_compte'];
            }

            if ($data['id_type_compte_fk_compte'] == 1) {
                $message = "Paramètres corrects - Lecteur";
            }

            if ($data['id_type_compte_fk_compte'] == 2) {
                $message = "Paramètres corrects - Editeur";
            }

            if ($data['id_type_compte_fk_compte'] == 3) {
                $message = "Paramètres corrects - Admin";
            }

            if ($data['id_type_compte_fk_compte'] == 4) {
                $message = "Paramètres corrects - SuperAdmin";
            }
        } else {

            $message = "Mot de passe erroné";
        }
    } else {

        $message = "Compte désactivé";
    }
}else{
    $message = "Email invalide";
}

echo json_encode($message);
