<?php if (empty($consulta)) : ?>
    <?php redirect(MANEJADOR_CONFIG . '/sistema_controller/index'); ?>
<?php else : ?>
    <!-- DATA TABLES -->
    <link href="<?php echo base_url(); ?>assets/js/plugins/data-tables/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES SCRIPT -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/data-tables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <form action="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/sistema_controller/editar_guardar" method="post">
                <div class="card">
                    <div class="card-header bg-olive disabled color-palette">
                        <h3 class="card-title"><i class="fas fa-eye"></i>&nbsp;Ver Registro de Sistema</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="nombre">Nombre:</label>
                                <input name="nombre" class="form-control" id="nombre" type="text" value="<?php echo $consulta->nombre; ?>" disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="prefijo">Prefijo:</label>
                                <input name="prefijo" class="form-control" id="prefijo" type="text" value="<?php echo $consulta->prefijo; ?>" disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="controlador">Controlador:</label>
                                <input name="controlador" class="form-control" id="controlador" type="text" value="<?php echo $consulta->controlador; ?>" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="estatus">Estatus:</label>
                                <select name="estatus" id="estatus" class="form-control" disabled>
                                    <option value="1">Activo</option>
                                    <option value="0" <?php if ($consulta->activo == FALSE) echo 'selected'; ?>>Inactivo</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="idsistema">Sistema:</label>
                                <input name="idsistema" class="form-control" id="idsistema" type="text" value="<?php echo $area->ruta; ?>" disabled>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/sistema_controller/index"><span class="btn btn-default waves-effect btn-sm bg-indigo color-palette float-right" data-toggle="tooltip" data-placement="top" title="Ver registros"><i class="fas fa-sign-out-alt"></i>&nbsp; Regresar</span></a>
                    </div>
                </div>
            </form>
        </div><!-- /.col -->
    </div>
<?php endif ?>