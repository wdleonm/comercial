<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo ". . : : " . NOMBRE_SISTEMA . " : : . ." ?></title>
    <script type="text/javascript">
        /**
         * Esta variable nos permite usar la base URL en todos los
         * demás scripts.
         **/
        var base_url = "<?php echo site_url(); ?>";
    </script>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- Bootstrap 4 -->

    <!-- Theme style AdminLTE -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
    <!-- AdminLTE App -->

    <!-- Sweetalert -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/sweetalert/sweetalert.css">
    <script src="<?php echo base_url(); ?>assets/js/sweetalert/sweetalert.min.js"></script>

    <!-- Waves -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/waves.min.css">
    <script src="<?php echo base_url(); ?>assets/js/waves.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote 
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.css">-->
    <!-- AdminLTE App -->
    <!-- <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/app.min.js"></script> -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <!-- Inicio de barra superior-->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <!-- Barra de la decrecha minimizar menuLeft navbar links -->
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <?php $this->load->view('templates/select_system'); ?>
                    <!-- cambio de sistema -->
                </li>
                <li class="nav-item dropdown text-center">
                    <!-- Nombre de usuario -->
                    <a href="#" class="nav-link row justify-content-center" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="hidden-xs badge">
                            <i class="fas fa-user-cog "></i>
                            <?php echo $usr_apellido . ' ' . $usr_nombre; ?>
                            <i class="fas fa-caret-down"></i>
                        </span>
                    </a>
                    <!-- Menu Cierre de sesion y perfil de usuario -->
                    <ul class="dropdown-menu justify-content-center">
                        <!-- <div class="card card-info">
                         /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal">
                            <!-- <div class="card-body"> -->
                            <div class="card-footer">
                                <!-- <div class="form-group row"> 
                                    <div class="col-md-12">-->
                                <div class="btn-group">
                                    <a class="btn btn-info bg-gradient-info btn-sm" href="<?php echo base_url(); ?>index.php/inicio/perfil"><i class="fas fa-user-edit "></i>&nbsp;&nbsp;Perfil</a>
                                    &nbsp;
                                    <a class="btn btn-danger bg-gradient-danger btn-sm" href="<?php echo base_url(); ?>index.php/login/cerrar_sesion"><i class="fas fa-sign-out-alt "></i>&nbsp;Cerrar</a>
                                </div>
                                <!--</div>
                                 </div> -->
                            </div>
                            <!-- </div> -->
                            <!-- /.card-footer -->
                        </form>
                        <!-- </div> -->
                    </ul>
                </li>
                <li class="nav-item">
                    <!-- NO borrar Barra de Cambio de Colores -->
                    <!-- Barra de Cambio de Colores -->
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <aside class="control-sidebar control-sidebar-dark">
            <!-- muestra menu de cambio de colores del menu -->
        </aside>
        <!-- FIN de barra superior-->
        <!-- Inicio de Barra lateral-->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?php echo NOMBRE_SISTEMA; ?></span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
                        <h3> <a href="#" class="d-block"> <?php echo NOMBRE_SISTEMA_CORTO; ?></a></h3>
                    </div>
                    <div class="info">
                        <!-- <a href="#" class="d-block"> <? //php echo NOMBRE_SISTEMA_CORTO; 
                                                            ?></a> -->
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php $this->load->view('templates/side_menu'); ?>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- Fin de Barra lateral -->
        <!-- Contenido central -->
        <div class="content-wrapper">
            <section class="content">
                <!---------------------------MAIN CONTENT------------------------------>
                <div class="row rowmain">
                    <div class="col-md-12">
                        <br>
                        <?php echo $main ?>
                        <br>
                    </div>
                </div>
            </section><!-- /.content -->
        </div><!-- ./wrapper Contenido central -->
        <!-- FIN Contenido central -->
        <!---------------------------FOOTER------------------------------------>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.1
            </div>
            <strong>Copyright &copy; 2014-2019 <a href="">Empresa</a>.</strong> All rights
            reserved.
        </footer>
        <!---------------------------FIN FOOTER------------------------------------>
    </div> <!-- ./wrapper 1 -->
    <script type="text/javascript">
        Waves.init();
    </script>
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url(); ?>assets/js/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Summernote 
    <script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>-->
    <!-- overlayScrollbars -->
    <script src="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE -->
    <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
</body>

</html>