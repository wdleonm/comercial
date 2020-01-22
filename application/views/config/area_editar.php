<?php if (empty($consulta)) : ?>
    <?php redirect(MANEJADOR_CONFIG . '/area_controller/index'); ?>
<?php else : ?>
    <!-- DATA TABLES -->
    <link href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <form action="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/area_controller/editar_guardar" method="post">
                <div class="card">
                    <div class="card-header bg-olive disabled color-palette">
                        <h3 class="card-title"><i class="fas fa-pen"></i>&nbsp;Editar Registro de Area</h3>
                    </div><!-- /.box-header -->
                    <div class="card-body">

                        <div class="row">
                            <div class="input-group mb-3 col-md-12">
                                <label for="nombre">Nombre:&nbsp;&nbsp;</label>
                                <input name="nombre" class="form-control" id="nombre" type="text" value="<?php echo $consulta->espacio; ?>" required>
                            </div>
                            <br>
                        </div>
                        <!-- input adicional-->
                        <div class="row input_fields_wrap">
                        </div>
                        <!-- cierre de input adicional -->
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-olive disabled color-palette">
                        <h3 class="card-title"><i class="fas fa-edit"></i>&nbsp;Seleccione el Id Padre:</h3>
                    </div>
                    <div class="card-body">

                        <table id="padres" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th width="5%">Marcar:</th>
                                    <th>Ruta:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($padres as $item) : ?>
                                    <tr>
                                        <td align="center"><input name="hpadre" type="radio" value="<?php echo $item->id; ?>" <?php if ($item->id == $consulta->id_padre) echo 'checked'; ?>></td>
                                        <td><?php echo $item->ruta; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <input type="hidden" name="id" value="<?php echo $consulta->id; ?>">
                        <input type="hidden" name="hpadre_old" value="<?php echo $consulta->id_padre; ?>">
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success waves-effect btn-sm" type="submit" data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fas fa-save"></i>&nbsp;Guardar</button>
                        <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/area_controller/index"><span class="btn btn-danger waves-effect float-right btn-sm" data-toggle="tooltip" data-placement="top" title="Salir"><i class="fas fa-window-close"></i>&nbsp;Cancelar</span></a>
                    </div>
                </div>
            </form>
        </div><!-- /.col -->
    </div>
    <?php endif ?>
    <script type="text/javascript">
        $('#padres').dataTable({
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
