<?php require_once(__DIR__ . '/../../../db.php') ?>
<?php require_once(__DIR__ . '/../../../fonctions.php') ?>

<?php require_once(__DIR__ . '/../../../fonctions-sql.php') ?>

<?php
if ($_GET) {
    $id_projet = $_GET['projet'];
    $query = "SELECT * FROM projet, promoteur, secteur, personne WHERE projet.id_promoteur_fk_projet = promoteur.id_promoteur AND projet.id_secteur_fk_projet = secteur.id_secteur AND promoteur.id_personne_fk_promoteur = personne.id_personne AND id_projet = $id_projet AND etat_projet = 'en_attente'";

    $statement = $db->prepare($query);
    $statement->execute();
    $rowStatement = $statement->rowCount();
    if ($rowStatement <= 0) {
        header("Location:/crowdcash/projet/en-attente");
        exit();
    }

    $result = $statement->fetch();
}

?>

<?php require_once(__DIR__ . '/../../../include/header.php'); ?>

<?php require_once(__DIR__ . '/../../../include/left-sidebar.php'); ?>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Projets</h1>
            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item active"><a href="/crowdcash/tb/tb-admin.php">Tableau de bord</a></div>
                <div class="breadcrumb-item active"><a href="/crowdcash/projet/en-attente/">Projets en attente</a></div>

                <div class="breadcrumb-item">Consulter</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4><?= $result['nom_projet'] ?></h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a style="color: black; font-weight: bold;" class="nav-link active" id="projet-tab" data-toggle="tab" href="#projet" role="tab" aria-controls="projet" aria-selected="true">PROJET</a>
                            </li>
                            <li class="nav-item">
                                <a style="color: black; font-weight: bold;" class="nav-link" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="detail" aria-selected="false">DETAILS</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="projet" role="tabpanel" aria-labelledby="projet-tab">
                                <?= $result['description_projet'] ?>
                            </div>
                            <div class="tab-pane fade" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                                <div class="card-header px-0">
                                    <h3>Document</h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $query1 = "SELECT nom_document FROM projet, document WHERE document.id_projet_fk_document = projet.id_projet AND id_projet = $id_projet";

                                    $statement1 = $db->prepare($query1);
                                    $statement1->execute();

                                    $result1 = $statement1->fetchAll();
                                    ?>
                                    <?php if ($result1) : ?>
                                        <div class="row">
                                            <?php foreach ($result1 as $row1) : ?>
                                                <a href="/crowdcash/projet/document/<?= $row1['nom_document'] ?>" download class="badge badge-light mx-2 mb-3" title="Télecharger"><?= $row1['nom_document'] ?></a>
                                            <?php endforeach ?>
                                        </div>
                                        <div class="text-right m-2"><a class="" href="#">Tout télécharger</a></div>
                                    <?php else : ?>
                                        <i class="bi bi-info-circle-fill mr-1" style="font-size: 25px; color: #5bc0de;"></i>
                                        <span style="font-size: 20px;">Les documents officielles ne sont pas disponible pour ce projet</span>
                                    <?php endif ?>
                                </div>                          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card"><img class="card-img-top" src="/crowdcash/assets/img/image-vide/img1.png" alt="Placeholder">
                    <div class="card-header row">
                        <span>Description du projet</span>
                        <div class="dropdown d-inline" style="margin-left: auto;">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Action
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 27px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a href="#" class="dropdown-item" id="write_promoteur">Ecrire au promoteur</a>
                                <a href="#" class="dropdown-item" id="publie_projet">Publier projet</a>
                                <a href="#" class="dropdown-item" id="rejete_projet">Rejeter projet</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        Projet soumis le <b><?= date("d-m-Y", strtotime($result['date_soumission_projet'])).' à '.date("H:i:s", strtotime($result['date_soumission_projet'])) ?></b>
                        <p class="mb-0"></p>
                    </div>
                    <div class="accordion" id="accordion">
                        <div class="info_projet">
                            <div class="card-header" id="headingOne">
                                <button class="btn collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><i class="icon bi bi-chevron-right" style="margin-right: 10px;"></i>Info Projet</button>
                            </div>
                            <div class="collapse" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-boredered">

                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h6>Secteur du projet</h6>
                                                    </td>
                                                    <td><?= $result['nom_secteur'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>Titre du projet</h6>
                                                    </td>
                                                    <td><?= $result['nom_projet'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>Montant recherché</h6>
                                                    </td>
                                                    <td><?= $result['montant_total_projet'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="buttons mb-1">
                                                            <span style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Don sans contrepartie" style="font-weight: bold;" class="modeContrib">DSC</span>
                                                            <span style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Don avec contrepartie" style="font-weight: bold;" class="modeContrib">DAC</span>
                                                            <span style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Prêt Solidaire" style="font-weight: bold;" class="modeContrib px-1">PS</span>
                                                            <span style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Prêt rémunéré" style="font-weight: bold;" class="modeContrib px-1">PR</span>
                                                        </div>
                                                        <div class="buttons">
                                                            <span style="font-weight: bold;" class="modeContrib"><i class="fas fa-<?= si_funct($result['dac_projet'], 'oui', 'check', 'times') ?>" style="font-size: 25px; color: <?= si_funct($result['dac_projet'], 'oui', 'green', 'red') ?>;"></i></span>
                                                            <span style="font-weight: bold;" class="modeContrib"><i class="fas fa-<?= si_funct($result['dsc_projet'], 'oui', 'check', 'times') ?>" style="font-size: 25px; color: <?= si_funct($result['dsc_projet'], 'oui', 'green', 'red') ?>;"></i></span>
                                                            <span style="font-weight: bold;" class="modeContrib"><i class="fas fa-<?= si_funct($result['ps_projet'], 'oui', 'check', 'times') ?>" style="font-size: 25px; color: <?= si_funct($result['ps_projet'], 'oui', 'green', 'red') ?>;"></i></span>
                                                            <span style="font-weight: bold;" class="modeContrib"><i class="fas fa-<?= si_funct($result['pr_projet'], 'oui', 'check', 'times') ?>" style="font-size: 25px; color: <?= si_funct($result['pr_projet'], 'oui', 'green', 'red') ?>;"></i></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info_promoteur">
                            <div class="card-header" id="headingTwo">
                                <button class="btn collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapsetwo"><i class="icon bi bi-chevron-right" style="margin-right: 10px;"></i>Info Promoteur</button>
                            </div>
                            <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-boredered">

                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h6>Promoteur</h6>
                                                    </td>
                                                    <td><?= $result['nom_personne'] . ' ' . $result['prenom_personne'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>Téléphone</h6>
                                                    </td>
                                                    <td><?= $result['tel_personne'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>Email</h6>
                                                    </td>
                                                    <td><?= $result['email_personne'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Formulaire Message -->
    <div id="id_message_promoteur_modal" class="modal fade">
        <div class="modal-dialog">
            <form method="post" id="id_message_promoteur_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label style="font-size: 15px;">À Promoteur : <?= $result['nom_personne'] . ' ' . $result['prenom_personne'] ?></label>
                        </div>
                        <div class="form-group">
                            <input style="display: none;" type="number" name="id_projet" value="<?= $result['id_projet'] ?>">
                        </div>
                        <div class="form-group">
                            <input style="display: none;" type="number" name="id_promoteur" value="<?= $result['id_promoteur'] ?>">
                        </div>
                        <div class="form-group">
                            <label style="font-size: 15px;">Message</label>
                            <textarea type="text" name="message_promoteur" class="form-control"></textarea>
                        </div>

                    </div>

                    <div class="modal-footer bg-whitesmoke">
                        <button type="submit" class="btn btn-primary btn-shadow save-edit-bouton" name="action" id="action">Envoyer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Formulaire validation rejet -->
    <div id="id_rejete_projet_modal" class="modal fade">
        <div class="modal-dialog">
            <form method="post" id="id_rejete_projet_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label style="font-size: 15px;">Nom du projet : <?= $result['nom_projet'] ?></label>
                        </div>
                        <div class="form-group">
                            <input style="display: none;" type="number" name="id_projet_rejete" value="<?= $result['id_projet'] ?>">
                        </div>
                        <div class="form-group">
                            <label style="font-size: 15px;">Raison du rejet</label>
                            <textarea type="text" name="info_projet" class="form-control" required></textarea>
                        </div>

                    </div>

                    <div class="modal-footer bg-whitesmoke">
                        <button type="submit" class="btn btn-danger btn-shadow save-edit-bouton" name="action" id="action">Rejeter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Formulaire de validation publication -->
    <div id="id_publie_projet_modal" class="modal fade">
        <div class="modal-dialog">
            <form method="post" id="id_publie_projet_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label style="font-size: 15px;">Nom du projet : <?= $result['nom_projet'] ?></label>
                        </div>
                        <div class="form-group">
                            <input style="display: none;" type="number" name="id_projet_publie" value="<?= $result['id_projet'] ?>">
                        </div>
                        <div class="form-group">
                            <label style="font-size: 15px;">Date de fin du projet</label>
                        </div>
                        <div class="form-group">
                            <input type="date" name="date_fin_projet" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer bg-whitesmoke">
                        <button type="submit" class="btn btn-primary btn-shadow save-edit-bouton" name="action" id="action">Publier</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <?php require_once(__DIR__ . '/../../../include/right-sidebar.php') ?>
</div>

<script src="/crowdcash/assets/modules/jquery.min.js"></script>

<script type="text/javascript">
    // Affichage de la fenêtre pour entrer un message

    $('#write_promoteur').click(function() {
        $('#id_message_promoteur_modal').modal('show');
        $('#id_message_promoteur_form')[0].reset();
    });

    // Affichage de la fenêtre pour valider un rejet d'un projet

    $('#rejete_projet').click(function() {
        $('#id_rejete_projet_modal').modal('show');
        $('#id_rejete_projet_form')[0].reset();
    });

    // Affichage de la fenêtre pour valider une publication

    $('#publie_projet').click(function() {
        $('#id_publie_projet_modal').modal('show');
        $('#id_publie_projet_modal')[0].reset();
    });

    // Publié projet 

    $(document).on('submit', '#id_publie_projet_form', function(event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url: "projet-en-attente-view-action.php",
            method: "POST",
            data: form_data,
            dataType: "json",
            success: function(data) {
                console.log(data);
                if (data == 'Projet publie') {
                    $('#id_publie_projet_modal').modal('hide');
                    swal.fire({
                        title: 'Publié',
                        text: 'Le projet à été publié avec success',
                        icon: 'success',
                        showCancelButton: false,
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            window.location = "../../en-cour";
                        } else {}
                    });
                }
            }
        })
    });

    // Rejeté projet

    $(document).on('submit', '#id_rejete_projet_form', function(event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url: "projet-en-attente-view-action.php",
            method: "POST",
            data: form_data,
            dataType: "json",
            success: function(data) {
                console.log(data);
                if (data == 'Projet rejete') {
                    $('#id_rejete_projet_modal').modal('hide');
                    swal.fire({
                        title: 'Rejeté',
                        text: 'Le projet à été rejeté avec success',
                        icon: 'success',
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            window.location = "../../rejete";
                        } else {}
                    });
                }

            }
        })
    });


    //Ecrire au promoteur

    $(document).on('submit', '#id_message_promoteur_form', function(event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url: "projet-en-attente-view-action.php",
            method: "POST",
            data: form_data,
            dataType: "json",
            success: function(data) {
                console.log(data);
                if (data == 'Message envoyé') {
                    $('#id_message_promoteur_modal').modal('hide');
                    swal.fire('Envoyé', 'Le message à été envoyé avec succès', 'success');
                }

            }
        })
    });
</script>

<!--Sweet alert reference https://sweetalert2.github.io/ -->


<?php require_once(__DIR__ . '/../../../include/footer.php') ?>