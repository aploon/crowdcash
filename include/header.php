<?php require_once(__DIR__ . '/../db.php') ?>

<?php require_once(__DIR__ . '/../fonctions.php') ?>

<?php require_once(__DIR__ . '/../fonctions-sql.php') ?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Otika - Admin Dashboard Template</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="/crowdcash/assets/css/app.min.css">
    <link rel="stylesheet" href="/crowdcash/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/crowdcash/assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/crowdcash/assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="/crowdcash/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/crowdcash/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="/crowdcash/assets/css/style.css">
    <link rel="stylesheet" href="/crowdcash/assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="/crowdcash/assets/css/custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel='shortcut icon' type='image/x-icon' href='/crowdcash/assets/img/favicon.ico' />
    <script src="/crowdcash/assets/modules/sweetalert/sweetalert.min.js"></script>
    <style>
        .chat-content {
            overflow: scroll !important;
        }

        .chat-content::-webkit-scrollbar {
            width: 5px;
            height: 10px;
        }

        .chat-content::-webkit-scrollbar-thumb {
            background: #9a9a9a;
            border-radius: 5px;
            border: 1px solid white;
        }

        .chat-item {
            max-width: 75%;
        }

        .chat-right {
            float: right;
        }
    </style>
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li>
                            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a>
                        </li>
                        <li>
                            <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a>
                        </li>
                        <li>
                            <form class="form-inline mr-auto">
                                <div class="search-element">
                                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                                    <button class="btn" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <!------ Messagerie ------>
                    <?php
                    // $id_personne = $_SESSION['id_personne'];
                    // $query = "SELECT * FROM message, personne WHERE message.auteur_message = personne.id_personne AND destinataire_message = $id_personne AND etat_message = 'non_lu'";
                    // $statement = $db->prepare($query);
                    // $statement->execute();

                    // $result = $statement->fetchAll();
                    // $nbr_message = $statement->rowCount();
                    ?>
                    <script>
                        function get_nbr_message() {
                            var action = 'get_nbr_message';
                            $.ajax({
                                url: "../scripts-php/action-get-nbr-message.php",
                                method: "POST",
                                data: {
                                    action: action
                                },
                                success: function(data) {
                                    $('.messageBadge').text(data);
                                }
                            })
                        }

                        function get_user_message() {
                            var action = 'get_user_message';
                            $.ajax({
                                url: "../scripts-php/action-get-nbr-message.php",
                                method: "POST",
                                data: {
                                    action: action
                                },
                                success: function(data) {
                                    const resultat = JSON.parse(data);
                                    const html = resultat.map(function(message) {
                                        return `
                                        <a href="../messagerie/?PNJJ_frBJ930BJ930_ausweis=${message.id_personne}&PNJJ_frBJ930BJ930_projekt=${message.id_projet_fk_message}" class="dropdown-item">
                                            <span class="dropdown-item-avatar text-white">
                                                <img alt="image" src="/crowdcash/assets/img/img-personne/${message.img_personne}" class="rounded-circle">
                                            </span>
                                            <span class="dropdown-item-desc">
                                                <span class="message-user">${message.nom_personne + ' ' + message.prenom_personne}</span>
                                                <span class="time messege-text">${message.contenu_message.substr(0, 25) + '.'}</span>
                                                <span class="time">${message.date_envoi_message}</span>
                                            </span>
                                        </a>
                                                `;
                                    }).join('');
                                    $('.dropdown-list-message').html(html);
                                }
                            })
                        }

                        setInterval(get_nbr_message, 3000);
                        setInterval(get_user_message, 3000);
                    </script>
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle"><i data-feather="mail"></i>
                            <span class="badge headerBadge1 messageBadge">--</span> </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                            <div class="dropdown-header">
                                Messages
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-message">
                                <!-- <a href="#" class="dropdown-item">
                                    <span class="dropdown-item-avatar text-white">
                                        <img alt="image" src="/crowdcash/assets/img/users/user-1.png" class="rounded-circle">
                                    </span>
                                    <span class="dropdown-item-desc">
                                        <span class="message-user">John Deo</span>
                                        <span class="time messege-text">Please check your mail !!</span>
                                        <span class="time">2 Min Ago</span>
                                    </span>
                                </a> -->
                            </div>
                            <!-- <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div> -->
                        </div>
                    </li>
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i>
                        </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                            <div class="dropdown-header">
                                Notifications
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <a href="#" class="dropdown-item dropdown-item-unread"> <span class="dropdown-item-icon bg-primary text-white"> <i class="fas
												fa-code"></i>
                                    </span> <span class="dropdown-item-desc"> Template update is
                                        available now! <span class="time">2 Min
                                            Ago</span>
                                    </span>
                                </a>
                                <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="far
												fa-user"></i>
                                    </span> <span class="dropdown-item-desc"> <b>You</b> and <b>Dedik
                                            Sugiharto</b> are now friends <span class="time">10 Hours
                                            Ago</span>
                                    </span>
                                </a>
                                <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-success text-white"> <i class="fas
												fa-check"></i>
                                    </span> <span class="dropdown-item-desc"> <b>Kusnaedi</b> has
                                        moved task <b>Fix bug header</b> to <b>Done</b> <span class="time">12
                                            Hours
                                            Ago</span>
                                    </span>
                                </a>
                                <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-danger text-white"> <i class="fas fa-exclamation-triangle"></i>
                                    </span> <span class="dropdown-item-desc"> Low disk space. Let's
                                        clean it! <span class="time">17 Hours Ago</span>
                                    </span>
                                </a>
                                <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="fas
												fa-bell"></i>
                                    </span> <span class="dropdown-item-desc"> Welcome to Otika
                                        template! <span class="time">Yesterday</span>
                                    </span>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown dropdown-list-toggle">
                    <script>
                        function update_user_activity() {
                            var action = 'update_last_activity';
                            $.ajax({
                                url: "../scripts-php/update-user-activity.php",
                                method: "POST",
                                data: {
                                    action: action
                                },
                                success: function(data) {

                                }
                            })
                        }

                        setInterval(update_user_activity, 3000);
                    </script>
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="/crowdcash/assets/img/img-personne/<?= $_SESSION['img_personne'] ?>" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title"><?= $_SESSION['pseudo_compte'] ?></div>
                            <a href="profile.html" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
                            </a>
                            <a href="timeline.html" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i> Activities
                            </a>
                            <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/crowdcash/deconnexion.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->