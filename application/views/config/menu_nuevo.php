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
        <div class="card">
            <div class="card-header bg-olive disabled color-palette">
                <h3 class="card-title"><i class="fas fa-tasks"></i>&nbsp;Registro de Menú</h3>
            </div><!-- /.box-header -->
            <form action="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/menu_controller/nuevo" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="sistema">Seleccione Sistema:</label>
                            <div class="input-group input-group-sm">
                                <select name="id_sistema" id="sistema" class="form-control" <?php
                                                                                            if ($bloqueo > 0) {
                                                                                                echo 'disabled';
                                                                                            }
                                                                                            ?>>
                                    <?php
                                    foreach ($areas as $item) :
                                        $ruta = pg_array_parse($item->arr_ruta);
                                        ?>
                                        <optgroup label="<?php echo $item->espacio ?>">

                                            <?php foreach ($sistemas as $item2) : ?>
                                                <?php
                                                        $ruta2 = pg_array_parse($item2->arr_ruta);
                                                        if ($ruta2[0] == $ruta[0]) :
                                                            ?>
                                                    <option value="<?php echo $item2->id; ?>" <?php
                                                                                                            if (isset($id_sistema) && $item2->id == $id_sistema) {
                                                                                                                echo ' selected';
                                                                                                            }
                                                                                                            ?>><?php echo $item2->espacio; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card-footer">
                        <span class="input-group-btn">
                            <button class="btn btn-default waves-effect btn-sm bg-indigo color-palette" type="submit" data-toggle="tooltip" data-placement="top" title="Buscar" <?php
                                                                                                                                                                        if ($bloqueo > 0) {
                                                                                                                                                                            echo 'disabled';
                                                                                                                                                                        }
                                                                                                                                                                        ?>><i class="fas fa-search"></i> Buscar
                            </button>
                        </span>
                        <a class="btn btn-default waves-effect btn-sm bg-warning color-palette float-right" href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/menu_controller/nuevo">
                            <i class="fas fa-broom"></i> Limpiar
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <?php if ($bloqueo > 0) : ?>
            <form action="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/menu_controller/nuevo_guardar" method="post">
                <div class="card">
                    <div class="card-header bg-olive disabled color-palette">
                        <h3 class="card-title"><i class="fas fa-pencil-alt"></i>&nbsp;Registro detalle de Menú</h3>
                    </div><!-- /.box-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="titulo">Titulo:</label><br>
                                <input name="titulo" id="titulo" type="text" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="descripcion">Descripcion:</label><br>
                                <input name="descripcion" id="descripcion" type="text" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="icono">Icono:</label><br>
                                <input name="icono" id="icono" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="url">URL:</label><br>
                                <input name="url" id="url" type="text" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="orden">Orden:</label><br>
                                <input name="orden" id="orden" type="text" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="hpadre">Padre:</label><br>
                                <select name="hpadre" id="hpadre" class="form-control">
                                    <option value="">Sin Id Padre</option>
                                    <?php foreach ($menus_padres as $item) : ?>
                                        <option value="<?php echo $item->id; ?>"><?php echo $item->titulo; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-olive disabled color-palette">
                        <h3 class="card-title"><i class="fas fa-sitemap"></i>&nbsp;Seleccione ruta</h3>
                    </div><!-- /.box-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
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
                                                <td align="center"><input type="radio" name="harea" value="<?php echo $item->id; ?>"></td>
                                                <td><?php echo $item->ruta; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="hidden" name="id_sistema" value="<?php echo $id_sistema ?>">
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success waves-effect btn-sm" type="submit" data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fas fa-save"></i>&nbsp;Guardar</button>
                        <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/menu_controller/index"><span class="btn btn-danger waves-effect btn-sm float-right" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fas fa-window-close"></i>&nbsp;Cancelar</span></a>
                    </div>
                </div>
            </form>
        <?php endif; ?>
        <!-- <div class="row">
            <div class="col-md-2 col-lg-offset-5">
                <a class="btn btn-app" href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/menu_controller/nuevo">
                    <i class="fas fa-repeat"></i> Borrar
                </a>
            </div>
        </div> -->

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