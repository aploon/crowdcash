<?php require_once(__DIR__ . '/db.php') ?>
<?php require_once(__DIR__ . '/fonctions.php') ?>
<?php 
    if(connected())
    {
        header("location:tb/tb-admin.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Otika - Admin Dashboard Template</title>
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
    <script src="assets/modules/sweetalert/sweetalert.min.js"></script>
    
    <style>
        body {
            background-image: url("assets/img/posts/img2.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>

</head>

<body class="light light-sidebar theme-white sidebar-gone">

    <div class="loader"></div>
    
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Connexion</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" id="form_login" action="" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required="" autofocus="">
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Mot de passe</label>
                                            <div class="float-right">
                                                <a href="auth-forgot-password.html" class="text-small">
                                                    Mot de passe oublié ?
                                                </a>
                                            </div>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required="">
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                            <label class="custom-control-label" for="remember-me">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button id="sub" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <script src="assets/modules/jquery.min.js"></script>

<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

<script>
    $(document).ready(function() {

        $(document).on('submit', '#form_login', function(event) {
            event.preventDefault();

            var form_data = $(this).serialize();
            $.ajax({
                url: 'connexion.php',
                method: 'POST',
                data: form_data,
                dataType: 'json',
                success: function(data) {
                    // console.log(data);


                    if (data == "Paramètres corrects - Lecteur") {
                        window.location = "tb/tb-admin.php";
                    }

                    if (data == "Paramètres corrects - Editeur") {
                        window.location = "tb/tb-admin.php";
                    }
                    if (data == "Paramètres corrects - Admin") {
                        window.location = "tb/tb-admin.php";
                    }

                    if (data == "Paramètres corrects - SuperAdmin") {
                        window.location = "tb/tb-admin.php";
                    }

                    if (data == "Email invalide") {
                        swal.fire('Erreur de connexion', 'Email incorrect', 'error');
                    }

                    if (data == "Mot de passe erroné") {
                        swal.fire('Erreur de connexion', 'Mot de passe incorrect', 'error');
                    }

                    if (data == "Compte désactivé") {
                        swal.fire('Erreur de connexion', 'Compte désactivé', 'error');
                    }
                }
            });


        });

    });
</script>

<!-- General JS Scripts -->
<script src="assets/js/app.min.js"></script>

<!-- JS Libraies -->
<script src="assets/bundles/apexcharts/apexcharts.min.js"></script>

<!-- Page Specific JS File -->
<script src="assets/js/page/index.js"></script>

<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>

<!-- Custom JS File -->
<script src="assets/js/custom.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>