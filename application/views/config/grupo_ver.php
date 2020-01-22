<?php if (empty($consulta)) : ?>
    <?php redirect(MANEJADOR_CONFIG . '/grupo_controller/index'); ?>
<?php else : ?>
    <link href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-olive disabled color-palette">
                    <h4 class="card-title"><i class="fas fa-eye"></i>&nbsp;Ver Registro de Grupo Asignado a Usuario</h4>
                </div><!-- /.box-header -->
                <div class="card-header">
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center">
                            <tr>
                                <th>Nombre del Usuario:</th>
                                <th>Descripcion:</th>
                            </tr>
                            <tr>
                                <td><?php echo $consulta->nombre ?></td>
                                <td><?php echo $consulta->descripcion ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-olive disabled color-palette">
                    <h4 class="card-title"><i class="fas fa-sitemap"></i>&nbsp;&nbsp;Áreas (permisos) Asignadas:</h4>
                </div>
                <div class="card-body">
                    <table id="areas" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Ruta:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($areas as $item) : ?>
                                <tr>
                                    <td><?php echo $item->rut_ruta; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/grupo_controller/index"><span class="btn btn-default waves-effect bg-indigo color-palette btn-sm float-right" data-toggle="tooltip" data-placement="top" title="Regresar"><i class="fas fa-sign-out-alt"></i>&nbsp; Regresar</span></a>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#areas').DataTable({
            "oPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
            "lengthMenu": [
                [10, 25, 50, 100, 200, -1],
                [10, 25, 50, 100, 200, "All"]
            ],

            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    </script>
<?php endif; ?>