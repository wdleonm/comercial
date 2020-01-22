<?php if (empty($consulta)) : ?>
    <?php redirect(MANEJADOR_CONFIG . '/menu_controller/index'); ?>
<?php else : ?>
    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-olive disabled color-palette">
                    <h3 class="card-title"><i class="fas fa-eye"></i>&nbsp;Ver Registro de Menú</h3>
                </div><!-- /.box-header -->

                <div class="card-body">
                    <table class="table table-bordered table-striped text-center">
                        <tr>
                            <th>Titulo:</th>
                            <th>Descripcion:</th>
                            <th>Icono:</th>
                        </tr>
                        <tr>
                            <td><?php echo $consulta->titulo; ?></td>
                            <td><?php echo $consulta->descripcion; ?></td>
                            <td><?php echo $consulta->icono; ?>&nbsp;<i class="<?php echo $consulta->icono; ?>"></i></td>
                        </tr>
                        <tr>
                            <th>Area:</th>
                            <th>URL:</th>
                            <th>Padre:</th>
                        </tr>
                        <tr>
                            <td><?php
                                    if (empty($metodo->ruta)) {
                                        echo 'No tiene Ruta';
                                    } else {
                                        echo $metodo->ruta;
                                    }
                                    ?></td>
                            <td><?php echo $consulta->url; ?></td>
                            <td><?php
                                    if (empty($padre->titulo)) {
                                        echo 'No tiene Id Padre';
                                    } else {
                                        echo $padre->titulo;
                                    }
                                    ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/menu_controller/index"><span class="btn btn-default waves-effect btn-sm bg-indigo color-palette float-right" data-toggle="tooltip" data-placement="top" title="Regresar"><i class="fas fa-sign-out-alt"></i>&nbsp; Regresar</span></a>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>