<?php require_once(__DIR__ . '/../db.php') ?>

<?php require_once(__DIR__ . '/../fonctions.php') ?>

<?php require_once(__DIR__ . '/../fonctions-sql.php') ?>

<?php require_once(__DIR__ . '/../include/header.php'); ?>

<?php require_once(__DIR__ . '/../include/left-sidebar.php'); ?>



<div class="main-content" style="min-height: 733px;">

    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="card">
                        <div class="body">
                            <div id="plist" class="people-list">
                                <div class="chat-search">
                                    <input type="text" class="form-control" placeholder="Search..." />
                                </div>
                                <div class="m-b-20">
                                    <div id="chat-scroll">
                                        <script>
                                            function get_online_statut() {
                                                var action = 'get_online_statut';
                                                $.ajax({
                                                    url: "../scripts-php/update-user-activity.php",
                                                    method: "POST",
                                                    data: {
                                                        action: action
                                                    },
                                                    success: function(data) {
                                                        var personne = document.querySelectorAll('.chat-list-item');
                                                        var result = JSON.parse(data);
                                                        for (let i = 0; i < personne.length; i++) {
                                                            var id_personne = personne[i].dataset.id_personne;
                                                            id_personne = id_personne.toString();
                                                            if (result.includes(id_personne)) {
                                                                var online_icons = $('#' + personne[i].id + ' .status .material-icons');
                                                                online_icons.css('color', '#86bb71');
                                                            } else {
                                                                var online_icons = $('#' + personne[i].id + ' .status .material-icons');
                                                                online_icons.css('color', '#e38968');
                                                            }

                                                        }

                                                    }
                                                })
                                            }
                                            setInterval(get_online_statut, 3000);
                                        </script>
                                        <ul class="chat-list list-unstyled m-b-0">


                                            <?php
                                            $query = "SELECT * FROM promoteur, personne WHERE promoteur.id_personne_fk_promoteur = personne.id_personne";
                                            $statement = $db->prepare($query);
                                            $statement->execute();
                                            $result = $statement->fetchAll();

                                            ?>
                                            <!-------- Menu de messagerie -------->
                                            <?php $iChat_list = 0 ?>
                                            <?php foreach ($result as $row) : ?>
                                                <li id="personne<?= $row['id_personne'] ?>" class="chat-list-item clearfix <?= si_funct($iChat_list, 0, 'active', '') ?>" data-id_personne="<?= $row['id_personne'] ?>" data-img_personne="<?= $row['img_personne'] ?>" data-nom_personne="<?= $row['nom_personne'] ?>" data-prenom_personne="<?= $row['prenom_personne'] ?>">
                                                    <img src="../assets/img/img-personne/<?= $row['img_personne'] ?>" alt="avatar">
                                                    <div class="about">
                                                        <div class="name"><?= $row['nom_personne'] . ' ' . $row['prenom_personne'] ?></div>
                                                        <div class="status">
                                                            <i class="material-icons offline" style="font-size: 12px;">fiber_manual_record</i>
                                                            Promoteur
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php $iChat_list++ ?>
                                            <?php endforeach ?>
                                            <?php if (isset($_GET['PNJJ_frBJ930BJ930_ausweis'])) : ?>
                                                <?php
                                                $id_personne_redirect = $_GET['PNJJ_frBJ930BJ930_ausweis'];
                                                $id_projet_redirect = $_GET['PNJJ_frBJ930BJ930_projekt'];

                                                $query1 = "SELECT * FROM personne WHERE id_personne = $id_personne_redirect";
                                                $statement1 = $db->prepare($query1);
                                                $statement1->execute();
                                                $result1 = $statement1->fetch();
                                                ?>

                                                <li id="redirect_message" class="d-none clearfix active" data-id_personne_redirect="<?= $id_personne_redirect ?>" data-id_projet_redirect="<?= $id_projet_redirect ?>" data-img_personne_redirect="<?= $result1['img_personne'] ?>" data-nom_personne_redirect="<?= $result1['nom_personne'] ?>" data-prenom_personne_redirect="<?= $result1['prenom_personne'] ?>">
                                                    <img src="../assets/img/img-personne/user-1.png" alt="avatar">
                                                    <div class="about">
                                                        <div class="name">Adjovi Arnaud</div>
                                                        <div class="status">
                                                            <i class="material-icons offline" style="font-size: 12px; color: rgb(134, 187, 113);">fiber_manual_record</i>
                                                            Promoteur
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <div class="card">
                        <div class="chat">
                            <div class="chat-header clearfix">
                                <img id="chat-with-img" src="../assets/img/users/user-1.png" alt="avatar">
                                <div class="chat-about">
                                    <div class="chat-with">Maria Smith</div>
                                    <div class="chat-num-messages">New messages</div>
                                </div>
                                <div class="chat-about" style="float: right;">
                                    <div class="chat-projet">Projets</div>
                                    <div class="chat-on-projet">
                                        <select name="projet" id="">
                                            <!-- <option value="2">ZA-Sanitaire</option> -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-box" id="mychatbox">
                            <div class="card-body chat-content" tabindex="2" style="overflow: hidden; outline: none;" data-auteur="<?= $_SESSION['id_personne'] ?>" data-img="<?= $_SESSION['img_personne'] ?>">

                                <!------ Messagerie ------->

                            </div>
                            <div class="card-footer chat-form">
                                <form id="chat-form" method="POST">
                                    <input id="content" type="text" name="chat-message" class="form-control" placeholder="Type a message">
                                    <button class="btn btn-primary">
                                        <i class="far fa-paper-plane"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require_once(__DIR__ . '/../include/right-sidebar.php') ?>
</div>

<footer class="main-footer">
    <div class="footer-left">
        <span>Copyright © 2021 Design By </span><a href="apwebstore.tk">AP</a>
    </div>
    <div class="footer-right">
    </div>
</footer>
</div>
</div>


<!-- General JS Scripts -->
<script src="../assets/js/app.min.js"></script>
<!-- JS Libraies -->
<!-- Page Specific JS File -->
<!-- Template JS File -->
<script src="../assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="../assets/js/custom.js"></script>

<script>
    var chat_content = document.querySelector('.chat-content');
    var selectProjet = document.querySelector('select[name="projet"]');
    var id_auteur = chat_content.dataset.auteur;
    var img_auteur = chat_content.dataset.img;
    var chat_contentH = 0;
    var id_projet = 0;
    var i = 0;


    function autor_roll(current_autor) {
        if (current_autor == id_auteur)
            return 'chat-right';
        else
            return 'chat-left';
    }

    function img_autor(img_destinator, current_autor) {
        if (current_autor == id_auteur)
            return img_auteur;
        else
            return img_destinator;
    }

    function getProjet(id_personne, projet = 0) {

        const requeteAjax = new XMLHttpRequest();
        const url = 'action.php?id_promoteur_for_get_projet=' + id_personne;
        requeteAjax.open("GET", url);

        requeteAjax.onload = function() {
            const resultat = JSON.parse(requeteAjax.responseText);

            const html = resultat.map(function(message) {
                return `
                    <option value="${message.id_projet}">${message.nom_projet}</option>
                `;
            }).join('');

            selectProjet.innerHTML = html;
            if (projet == 0) {
                id_projet = selectProjet.value;
            } else {
                id_projet = projet;
                var index = 0;
                for (let i = 0; i < selectProjet.length; i++) {
                    if (selectProjet[i].value == id_projet) {
                        index = i;
                    }

                }
                selectProjet.selectedIndex = index;
            }


        }


        requeteAjax.send();
    }

    function getMessage(destinator, projet, scroll = false) {

        const requeteAjax = new XMLHttpRequest();
        const url = 'action.php?q=' + destinator + '&p=' + projet;

        requeteAjax.open("GET", url);

        requeteAjax.onload = function() {
            const resultat = JSON.parse(requeteAjax.responseText);
            const html = resultat.reverse().map(function(message) {
                return `
                <div class="chat-item ${autor_roll(message.auteur_message)}" ><img src="../assets/img/img-personne/${img_autor(message.img_personne,message.auteur_message)}">
                    <div class="chat-details">
                        <div class="chat-text">${message.contenu_message}</div>
                        <div class="chat-time">${message.date_envoi_message.substring(11, 16)}</div>
                    </div>
                </div>
                `;
            }).join('');

            if (chat_contentH < html.length) {
                scroll = true;
            }

            chat_content.innerHTML = html;
            if (scroll) {
                chat_content.scrollTop = chat_content.scrollHeight;
            }

            chat_contentH = html.length;

        }


        requeteAjax.send();

    }

    window.onload = function() {
        var chat_item_first = document.querySelector('.chat-list-item:first-child');
        var id_personne = chat_item_first.dataset.id_personne;
        getProjet(id_personne);
        var img = $('.chat-list-item:first-child').attr('data-img_personne');
        var nom = $('.chat-list-item:first-child').attr('data-nom_personne');
        var prenom = $('.chat-list-item:first-child').attr('data-prenom_personne');

        $('#chat-with-img').attr('src', '../assets/img/img-personne/' + img);
        $('.chat-with').html(nom + ' ' + prenom);

        <?php if (isset($_GET['PNJJ_frBJ930BJ930_ausweis'])) : ?>

            var redirect_message = document.querySelector('#redirect_message');
            id_personne = redirect_message.dataset.id_personne_redirect;
            var projet = redirect_message.dataset.id_projet_redirect;
            var img1 = redirect_message.dataset.img_personne_redirect;
            var nom1 = redirect_message.dataset.nom_personne_redirect;
            var prenom1 = redirect_message.dataset.prenom_personne_redirect;
            getProjet(id_personne, projet);

            $('#chat-with-img').attr('src', '../assets/img/img-personne/' + img1);
            $('.chat-with').html(nom1 + ' ' + prenom1);

            $('.chat-list-item').removeClass('active');
            $('li[data-id_personne="' + id_personne + '"]').addClass('active');

        <?php endif ?>

        selectProjet.addEventListener('change', function() {
            id_projet = this.value;
            getMessage(id_personne, id_projet, true);
        });

        $(document).on('click', '.chat-list-item', function() {
            $('.chat-list-item').removeClass('active');
            $(this).addClass('active');
            var img = $(this).attr('data-img_personne');
            var nom = $(this).attr('data-nom_personne');
            var prenom = $(this).attr('data-prenom_personne');
            $('#chat-with-img').attr('src', '../assets/img/img-personne/' + img);
            $('.chat-with').html(nom + ' ' + prenom);

            id_personne = this.dataset.id_personne;
            getProjet(id_personne);
            getMessage(id_personne, id_projet, true);
        });

        function postMessage(event) {
            event.preventDefault();

            const content = document.querySelector('#content');

            const data = new FormData();
            data.append('id_projet', id_projet);
            data.append('id_personne', id_personne);
            data.append('contenu_message', content.value);

            const requeteAjax = new XMLHttpRequest();
            requeteAjax.open('POST', 'action.php');
            requeteAjax.onload = function() {
                content.value = '';
                content.focus();
                getMessage(id_personne, id_projet, true);

            }
            requeteAjax.send(data);

        }

        document.querySelector('#chat-form').addEventListener('submit', postMessage);

        if (i == 0) getMessage(id_personne, id_projet, true);

        setInterval(function() {
            getMessage(id_personne, id_projet)
        }, 1000);
        i++;
    }


    // $(document).on('click', '.chat-list-item', function() {
    //     $('.chat-list-item').removeClass('active');
    //     $(this).addClass('active');

    //     var id_personne = this.dataset.id_personne;
    //     var selectProjet = document.querySelector('select[name="projet');
    //     var id_projet = selectProjet.value;

    //     selectProjet.addEventListener('change', function() {
    //         id_projet = this.value;
    //         getMessage(id_personne, id_projet);
    //     });

    //     function postMessage(event) {
    //         event.preventDefault();

    //         const content = document.querySelector('#content');

    //         const data = new FormData();
    //         data.append('id_projet', id_projet);
    //         data.append('id_personne', id_personne);
    //         data.append('contenu_message', content.value);

    //         const requeteAjax = new XMLHttpRequest();
    //         requeteAjax.open('POST', 'action.php');
    //         requeteAjax.onload = function() {
    //             content.value = '';
    //             content.focus();
    //             getMessage(id_personne, id_projet, true);

    //         }
    //         requeteAjax.send(data);

    //     }

    //     document.querySelector('#chat-form').addEventListener('submit', postMessage);
    //     // getMessage(id_personne, id_projet);
    //     setInterval(function() {
    //         getMessage(id_personne, id_projet)
    //     }, 5000);
    // });
</script>


</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->

</html>