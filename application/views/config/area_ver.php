<link href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<?php if (empty($consulta)) : ?>
    <?php redirect(MANEJADOR_CONFIG . '/area_controller/index'); ?>
<?php else : ?>
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-olive disabled color-palette">
                    <h4 class="card-title"><i class="fas fa-eye"></i>&nbsp;Ver Registro de Registro de Area</h4>
                    
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>Nombre:</th>
                                <th>Ruta:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td><?php echo $consulta->espacio ?></td>
                                <td><?php echo $consulta->ruta ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="card-footer">
                    <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/area_controller/index"><span class="btn btn-default waves-effect bg-indigo color-palette btn-sm float-right" data-toggle="tooltip" data-placement="top" title="Regresar a listado de registros"><i class="fas fa-sign-out-alt"></i>&nbsp;Regresar</span></a>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-md-1">
        </div>
    </div>
<?php endif; ?>