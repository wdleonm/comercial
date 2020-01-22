<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $areas; ?></h3>
                <p>&Aacute;reas</p>
            </div>

            <div class="icon">
                <i class="fas fa-sitemap"></i>
            </div>
            <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/area_controller/index" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php echo $grupos; ?></h3>
                <p>Grupos (Permisos)</p>
            </div>
            <div class="icon">
                <i class="fas fa-lock"></i>
            </div>
            <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/grupo_controller/index" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $menus; ?></h3>
                <p>Menus</p>
            </div>
            <div class="icon">
                <i class="fas fa-tasks"></i>
            </div>
            <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/menu_controller/index" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php echo $usuarios; ?></h3>
                <p>Usuarios</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/usuario_controller/index" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>