<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo NOMBRE_SISTEMA; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">

    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro 
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->


    <!-- Waves -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/waves.min.css">
    <script src="<?php echo base_url(); ?>assets/js/waves.min.js"></script>
    <!-- Sweetalert -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/sweetalert/sweetalert.css">
    <script src="<?php echo base_url(); ?>assets/js/sweetalert/sweetalert.min.js"></script>

    <!-- jQuery 2.1.4 -->
    <!-- <script src="<?php echo base_url(); ?>assets/js/plugins/jQuery/jQuery-2.1.4.min.js"></script> -->
    <!-- Bootstrap 3.3.5 -->
    <!-- <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> -->
    <style>
        .fondo {
            background-image: url(<?php echo base_url(); ?>assets/images/fondo.png) !important;
            background-color: #ffffff !important;
            background-size: cover;
        }
    </style>

</head>

<body class="hold-transition login-page fondo">
    <div class="login-box">
        <div class="login-logo">
            <div class="text-center"><img src="<?php echo base_url(); ?>assets/images/logog.png" width="323" height="71"></div>
        </div><!-- /.login-logo -->
        <div class="card">

            <div class="card-body login-card-body border border-light rounded">

                <h3><p class="login-box-msg"><?php echo NOMBRE_SISTEMA; ?></p></h3>

                <form action="<?php echo base_url(); ?>index.php/login/iniciar_sesion" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="usuario" class="form-control" placeholder="Usuario">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <div class="icheck-primary">
                               
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary btn-block btn-sm">Iniciar sesión</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.social-auth-links -->
                <p class="mb-1">
                    <!-- <a href="#">¿Has Olvidado Tu Contraseña?</a> -->
                </p>
                <p class="mb-0">
                    <!-- <a href="#" class="text-center">Registrarse.</a> -->
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>


    <script>
        Waves.init();
        <?php if ($this->session->flashdata('data')) : ?>
            swal("<?php echo $this->session->flashdata('data'); ?>", '', "error");
        <?php endif; ?>
    </script>

</body>

</html>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>