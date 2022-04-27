<?php require_once(__DIR__ . '/../../db.php') ?>

<?php require_once(__DIR__ . '/../../fonctions.php') ?>

<?php require_once(__DIR__ . '/../../fonctions-sql.php') ?>

<?php require_once(__DIR__ . '/../../include/header.php'); ?>

<?php require_once(__DIR__ . '/../../include/left-sidebar.php'); ?>



<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Projets</h1>
            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item active"><a href="/crowdcash/tb/tb-admin.php">Tableau de bord</a></div>

                <div class="breadcrumb-item">Projets en attente</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Projets en attente</h2>
            <p class="section-lead">Les projets en attente sont des projets qui ont été soumises sur la plateforme et qui n'ont pas encore eu le temps d'être analysé</p>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h4>Tableau de données</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">

                                <!--changer id -->
                                <table id="projet_en_attente_data" class="table table-striped table-bordered" cellspacing="0" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <!--changer colonnes-->
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Secteur
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Titre
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Promoteur
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Montant visé
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Don-AC
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Don-SC
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Prêt solidaire
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Prêt rémunéré
                                            </th>
                                            <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                Attente reponse
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



    <?php require_once(__DIR__ . '/../../include/right-sidebar.php') ?>
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
    var projet_en_attente_dataTable = $('#projet_en_attente_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "fetch.php", //changer
            type: "POST"
        },
        "columnDefs": [{
            "targets": [9], // changer l'index des colonnes qui ne seront pas triées
            "orderable": false,
        }, ],
        //"bSort" : false,
        "pageLength": 10
    });


</script>





<?php require_once(__DIR__ . '/../../include/footer.php') ?>