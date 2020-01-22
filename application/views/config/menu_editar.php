<?php if (empty($consulta)) : ?>
    <?php redirect(MANEJADOR_CONFIG . '/menu_controller/index'); ?>
<?php else : ?>
    <link href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>

    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <form action="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/menu_controller/editar_guardar" method="post">
                <div class="card">
                    <div class="card-header bg-olive disabled color-palette">
                        <h3 class="card-title"><i class="fas fa-pen"></i>&nbsp;Editar Registro de Menú</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="titulo">Titulo:</label><br>
                                <input name="titulo" id="titulo" type="text" class="form-control" value="<?php echo $consulta->titulo; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="descripcion">Descripcion:</label><br>
                                <input name="descripcion" id="descripcion" type="text" class="form-control" value="<?php echo $consulta->descripcion; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="icono">Icono:</label><br>
                                <input name="icono" id="icono" type="text" class="form-control" value="<?php echo $consulta->icono; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="url">URL:</label><br>
                                <input name="url" id="url" type="text" class="form-control" value="<?php echo $consulta->url; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="orden">Orden:</label><br>
                                <input name="orden" id="orden" type="text" class="form-control" value="<?php echo $consulta->orden; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="hpadre">Padre:</label><br>
                                <select name="hpadre" id="hpadre" class="form-control">
                                    <option value="">Sin Id Padre</option>
                                    <?php foreach ($menus_padres as $item) : ?>
                                        <option value="<?php echo $item->id; ?>" <?php if ($item->id == $consulta->hpadre) echo 'selected'; ?>><?php echo $item->titulo; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header bg-olive disabled color-palette">
                        <h3 class="card-title"><i class="fas fa-sitemap"></i>&nbsp;Seleccione ruta</h3>
                    </div>
                    <div class="card-body">
                        <table id="areas" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th width=5%>Marcar:</th>
                                    <th>Ruta:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($metodos as $item) : ?>
                                    <tr>
                                        <td align="center"><input type="radio" name="harea" value="<?php echo $item->id; ?>" <?php if ($item->id == $consulta->harea) echo 'checked'; ?>></td>
                                        <td><?php echo $item->ruta; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="id_area" value="<?php echo $consulta->harea; ?>">
                    <input type="hidden" name="id" value="<?php echo $consulta->id; ?>">
                    <div class="card-footer">
                        <button class="btn btn-success btn-sm" type="submit" data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fas fa-save"></i>&nbsp;Guardar</button>
                        <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/menu_controller/index"><span class="btn btn-danger waves-effect float-right btn-sm" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fas fa-window-close"></i>&nbsp;Cancelar</span></a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $('#areas').dataTable({
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
<?php endif ?>