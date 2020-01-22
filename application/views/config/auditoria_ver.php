<link href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<?php if (empty($consulta)) : ?>
    <?php redirect(MANEJADOR_CONFIG . '/auditoria_controller/index'); ?>
<?php else : ?>
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-olive disabled color-palette">
                    <h4 class="card-title"><i class="fas fa-eye"></i>&nbsp;Ver registro de movimiento de usuario en sistema</h4>
                </div><!-- /.box-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr class="text-center">
                            <th>Tabla:</th>
                            <th>Hora:</th>
                            <th>Fecha:</th>
                            <th>Zona:</th>
                            <th>Acción:</th>
                        </tr>
                        <tr class="text-center">
                            <td><?php echo $consulta->tabla; ?></td>
                            <td><?php echo $consulta->hora; ?></td>
                            <td><?php echo $consulta->fecha; ?></td>
                            <td><?php echo $consulta->zona; ?></td>
                            <td><?php echo $consulta->accion; ?></td>
                        </tr>
                        <tr class="text-center">
                            <th>Usuario:</th>
                            <th>Nombre PC:</th>
                            <th colspan="2">Registro:</th>
                            <th>Ver Elemento:</th>
                        </tr>
                        <tr class="text-center">
                            <td><?php echo $consulta->nombre; ?></td>
                            <td><?php echo $consulta->nombre_pc; ?></td>
                            <td colspan="2"><?php echo $consulta->registro; ?></td>
                            <td align="center"><a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/<?php echo $area[0]; ?>/ver/<?php echo $consulta->id_elemento; ?>" target="_blank"><button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Ver registro de area" data-original-title="Ir Al Elemento"><i class="fas fa-binoculars "></i></button>&nbsp;</a></td>
                        </tr>
                    </table>
                </div><!-- /.box-body -->
                <div class="card-footer">
                    <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/auditoria_controller/index"><span class="btn btn-default waves-effect bg-indigo color-palette btn-sm float-right" data-toggle="tooltip" data-placement="top" title="Regresar a busqueda de registros"><i class="fas fa-sign-out-alt"></i>&nbsp; Regresar</span></a>
                </div>
            </div><!-- /.box -->
        </div>
        <div class="col-md-1">
        </div>
    </div>
<?php endif; ?>