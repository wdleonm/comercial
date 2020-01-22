<div class="row">
    <!-- <div class="col-lg-3 col-xs-6">
       
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $areas; ?></h3>
                <p>&Aacute;reas</p>
            </div>

            <div class="icon">
                <i class="fas fa-sitemap"></i>
            </div>
            <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/area_controller/index" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div> -->

    <!-- <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php echo $grupos; ?></h3>
                <p>Grupos (Permisos)</p>
            </div>
            <div class="icon">
                <i class="fas fa-lock"></i>
            </div>
            <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/grupo_controller/index" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div> -->

    <!-- <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $menus; ?></h3>
                <p>Menus</p>
            </div>
            <div class="icon">
                <i class="fas fa-tasks"></i>
            </div>
            <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/menu_controller/index" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div> -->

    <!-- <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php echo $usuarios; ?></h3>
                <p>Usuarios</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/usuario_controller/index" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div> -->
</div>


<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info">
                <i class="fas fa-sitemap"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">&Aacute;reas</span>
                <span class="info-box-number">
                    <?php echo $areas; ?>
                    <!-- <small>%</small> -->
                </span>
            </div>
            <!-- /.info-box-content -->
            <span class="info-box-text"><a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/area_controller/index">Ir <i class="fas fa-arrow-circle-right"></i></a></span>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger">
                <i class="fas fa-lock"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Grupos(Permisos)</span>
                <span class="info-box-number"><?php echo $grupos; ?></span>
            </div>
            <!-- /.info-box-content -->
            <span class="info-box-text"><a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/grupo_controller/index" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a></span>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1">
                <i class="fas fa-tasks"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Menus</span>
                <span class="info-box-number"><?php echo $menus; ?></span>
            </div>
            <!-- /.info-box-content -->
            <span class="info-box-text"><a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/menu_controller/index" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a></span>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1">
                <i class="fas fa-user"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Usuarios</span>
                <span class="info-box-number">
                    <?php echo $usuarios; ?>
                </span>
            </div>
            <!-- /.info-box-content -->
            <span>
                <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/usuario_controller/index" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
            </span>

        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->