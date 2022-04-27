<?php
    session_start();

    //Si la $_SESSION['userId'] n'est pas défini, e.i si un utilisateur n'est pas connecté
    if(!isset($_SESSION['id_compte'])){
        if(
            strpos($_SERVER['REQUEST_URI'], 'assets') || strpos($_SERVER['REQUEST_URI'], 'contributeur') ||
            strpos($_SERVER['REQUEST_URI'], 'depence') || strpos($_SERVER['REQUEST_URI'], 'include') ||
            strpos($_SERVER['REQUEST_URI'], 'journal') || strpos($_SERVER['REQUEST_URI'], 'parametre') ||
            strpos($_SERVER['REQUEST_URI'], 'personnel') || strpos($_SERVER['REQUEST_URI'], 'projet') ||
            strpos($_SERVER['REQUEST_URI'], 'promoteur') || strpos($_SERVER['REQUEST_URI'], 'salaire') ||
            strpos($_SERVER['REQUEST_URI'], 'scripts-js') || strpos($_SERVER['REQUEST_URI'], 'script-php') ||
            strpos($_SERVER['REQUEST_URI'], 'secteur') || strpos($_SERVER['REQUEST_URI'], 'tb') 
        ){
            header("Location:/crowdcash");
            exit();
        }
    
    //Si l'utilisateur connecté est un Lecteur
    }else if($_SESSION['type_compte'] == 1){
        
        //Et on est présent sur un url qui contient 'redacteur',
        // e.i que l'admin essai d'aller sur un url 'redacteur'
        // if(strpos($_SERVER['REQUEST_URI'], 'redacteur')){

        //     //on fait une redirection vers la page de connexion
        //     header("Location:/redacApp");
        //     exit();
        // }

    //Si l'utilisateur connecté est un éditeur
    }else if($_SESSION['type_compte'] == 2){

        //Et on est présent sur un url qui contient 'admin',
        // e.i que le rédacteur essai d'aller sur un url 'admin'
        // if(strpos($_SERVER['REQUEST_URI'], 'admin')){

        //     //on fait une redirection vers la page de connexion
        //     header("Location:/redacApp");
        //     exit();
        // }

    //Si l'utilisateur connecté est un admin
    }else if($_SESSION['type_compte'] == 3){

        //Et on est présent sur un url qui contient 'admin',
        // e.i que le rédacteur essai d'aller sur un url 'admin'
        // if(strpos($_SERVER['REQUEST_URI'], 'admin')){

        //     //on fait une redirection vers la page de connexion
        //     header("Location:/redacApp");
        //     exit();
        // }

    //Si l'utilisateur connecté est un super admin
    }else if($_SESSION['type_compte'] == 4){

        //Et on est présent sur un url qui contient 'admin',
        // e.i que le rédacteur essai d'aller sur un url 'admin'
        // if(strpos($_SERVER['REQUEST_URI'], 'admin')){

        //     //on fait une redirection vers la page de connexion
        //     header("Location:/redacApp");
        //     exit();
        // }
    }

    require_once(__DIR__.'/global.php');

    $dbName = DB_NAME;
    $dbHost = DB_HOST;

    $dsn = "mysql:host=$dbHost; dbname=$dbName";

    
    try {
        $db = new PDO($dsn, DB_USER, DB_PASSWORD);

    } catch (PDOException $e) {
        print 'Erreur'. $e->getMessage();
    }

