<?php require_once(__DIR__ . '/../db.php') ?>

<?php require_once(__DIR__ . '/../fonctions.php') ?>

<?php require_once(__DIR__ . '/../fonctions-sql.php') ?>

<?php require_once(__DIR__ . '/../include/header.php'); ?>

<?php require_once(__DIR__ . '/../include/left-sidebar.php'); ?>






<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Projets</h1>
            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item active"><a href="/crowdcash/tb/tb-admin.php">Tableau de bord</a></div>

                <div class="breadcrumb-item">Promoteurs</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Promoteurs</h2>
            <p class="section-lead">Les promoteurs créent des projets et les soumettent sur crowdcash, et après évaluation, le projet est rejeté ou publié pour récolter des fonds</p>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h4>Tableau de données</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">

                                <!--changer id -->
                                <table id="promoteurs" class="table table-striped table-bordered" cellspacing="0" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <!--changer colonnes-->
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Photo
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Nom
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Prénom
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Téléphone
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Projets Finalisés
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Projets rejetés
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Projets en attente
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Projets en cour
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Montant Total
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Statut
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Action
                                            </th>

                                        </tr>
                                    </thead>

                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Consulter promoteur-->
    <div id="id_consultPromot_modal" class="modal fade">
        <div class="modal-dialog">
            <form method="post" id="id_consultPromot_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title_view">Informations du promoteur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div id="table_consult">
                            <!-- Code comming to ajax-->
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!--Modifier promoteur-->
    <div id="id_updatePromot_modal" class="modal fade">
        <div class="modal-dialog">
            <div id="form_update">
                <!-- Code comming to ajax-->
            </div>
        </div>

    </div>



    <?php require_once(__DIR__ . '/../include/right-sidebar.php') ?>
</div>



<!-- General JS Scripts -->
<script src="/crowdcash/assets/modules/jquery.min.js"></script>

<!-- JS Libraies -->
<script src="/crowdcash/assets/modules/datatables/datatables.min.js"></script>
<script src="/crowdcash/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="/crowdcash/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="/crowdcash/assets/modules/sweetalert/sweetalert.min.js"></script>

<!-- Page Specific JS File -->
<script src="/crowdcash/assets/js/page/modules-datatables.js"></script>


<script type="text/javascript">
    /* Affichage de la liste */ //changer
    var promoteur_dataTable = $('#promoteurs').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "fetch.php", //changer
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0, 4, 5, 6, 7, 8, 10], // changer l'index des colonnes qui ne seront pas triées
            "orderable": false,
        }, ],
        //"bSort" : false,
        "pageLength": 10
    });
</script>

<script>
    // Affichage de la fenêtre pour consulter

    
    $(document).on('click', '.view', function() {
        var id_promoteur = $(this).attr("id");
        var btn_action = 'view';
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                id_promoteur: id_promoteur,
                btn_action: btn_action
            },
            dataType: "json",
            success: function(data) {

                $('#id_consultPromot_modal').modal('show');
                $('#table_consult').html(data);

            }
        })
    });

    // Affichage de la fenêtre pour consulter

    $(document).on('click', '.update', function() {
        var id_promoteur = $(this).attr("id");
        var btn_action = 'update';
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                id_promoteur: id_promoteur,
                btn_action: btn_action
            },
            dataType: "json",
            success: function(data) {

                $('#id_updatePromot_modal').modal('show');
                $('#form_update').html(data);

            }
        })
    });

    //Soumettre le formulaire de modification

    $(document).on('submit', '#id_updatePromot_form', function(event) {
        event.preventDefault();
        //var form_data = $(this).serialize();
        var form_data = new FormData(this);
        $.ajax({
            url: "action.php",
            method: "POST",
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            success: function(data) {
                console.log(data);
                if (data == 'Promoteur modifié') {
                    $('#id_updatePromot_modal').modal('hide');
                    $('#id_updatePromot_form')[0].reset();
                    swal.fire('Effectué', 'Informations modifiés avec succès', 'success');
                }
                promoteur_dataTable.ajax.reload();
            }
        })
    });

    // Changement du statut du promoteur (Actif ou Inactif)

    $(document).on('click', '.activity', function() {
        var id_promoteur = $(this).attr("id");
        var btn_action = 'activity';
        var status = $(this).data("status");

        Swal.fire({
            title: 'Changement du statut !',
            text: "Souhaitez-vous changer le statut du promoteur ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Changer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {
                        id_promoteur: id_promoteur,
                        btn_action: btn_action,
                        status: status
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        if (data == 'Statut modifié') {
                            swal.fire('Effectué', 'Statut modifiés avec succès', 'success');
                        }
                        promoteur_dataTable.ajax.reload();
                    }
                });
            }
        });

    });

    // Changement du statut du promoteur (delete)

    $(document).on('click', '.delete', function() {
        var id_promoteur = $(this).attr("id");
        var btn_action = 'delete';
        var status = $(this).data("status");

        Swal.fire({
            title: 'Supression du promoteur !',
            text: "Souhaitez-vous vraiment supprimer ce promoteur ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {
                        id_promoteur: id_promoteur,
                        btn_action: btn_action,
                        status: status
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        if (data == 'Promoteur supprimé') {
                            swal.fire('Effectué', 'Promoteur supprimé avec succès', 'success');
                        }
                        promoteur_dataTable.ajax.reload();
                    }
                });
            }
        });

    });

    // // Affichage de la fenêtre pour valider un rejet d'un projet

    // $('#updatePromot').click(function() {
    //     $('#id_rejete_projet_modal').modal('show');
    //     $('#id_rejete_projet_form')[0].reset();
    // });

    // // Affichage de la fenêtre pour valider une publication

    // $('#offPromot').click(function() {
    //     $('#id_publie_projet_modal').modal('show');
    //     $('#id_publie_projet_modal')[0].reset();
    // });

    // // Affichage de la fenêtre pour valider une publication

    // $('#deleteContib').click(function() {
    //     $('#id_publie_projet_modal').modal('show');
    //     $('#id_publie_projet_modal')[0].reset();
    // });
</script>





<?php require_once(__DIR__ . '/../include/footer.php') ?>