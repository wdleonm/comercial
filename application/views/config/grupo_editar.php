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
                <form action="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/grupo_controller/editar_guardar" method="post">
                    <div class="card-header bg-olive disabled color-palette">
                        <h4 class="card-title"><i class="fas fa-pen"></i>&nbsp;Editar Registro de Grupo</h4>
                    </div><!-- /.box-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nombre">Nombre:</label>
                                <input name="nombre" type="text" id="nombre" class="form-control" value="<?php echo $consulta->nombre; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="descripcion">Descripcion:</label>
                                <input name="descripcion" id="descripcion" type="text" class="form-control" value="<?php echo $consulta->descripcion; ?>">
                            </div>
                        </div>
                        <table class="table table-bordered table-striped">

                        </table>
                        <input type="hidden" name="id" value="<?php echo $consulta->id; ?>">
                    </div><!-- /.box-body -->
                    <div class="card-footer">
                        <button class="btn btn-success waves-effect btn-sm" type="submit" data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fas fa-save"></i>&nbsp;Guardar</button>
                        <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/grupo_controller/index"><span class="btn btn-danger waves-effect btn-sm float-right" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fas fa-window-close"></i>&nbsp;Cancelar</span></a>
                    </div>
                </form>
            </div>

            <div class="card">
                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#tab_1" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Agregar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#tab_2" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Eliminar</a>
                    </li>
                </ul>
                <div class="tab-content" id="custom-content-below-tabContent">
                    <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                        <form action="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/grupo_controller/agregar_area" method="post">
                            <div class="card-body">
                                <div class="card-header bg-olive disabled color-palette">
                                    <h4 class="card-title"><i class="fas fa-sitemap"></i>&nbsp;&nbsp;Seleccione Permiso Agregar</h4>
                                </div>
                                <br>
                                <table id="areas" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th width="5%">Marcar:</th>
                                            <th>Ruta:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($l_areas)) : ?>
                                            <tr>
                                                <td>No existen áreas.</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php foreach ($l_areas as $item) : ?>
                                                <?php
                                                            $existe = 0;
                                                            foreach ($areas as $item2) {
                                                                if ($item->id == $item2->rut_id) {
                                                                    $existe = 1;
                                                                }
                                                            }
                                                            ?>
                                                <?php if ($existe == 0) : ?>
                                                    <tr>
                                                        <td><input type="checkbox" name="areas[]" value="<?php echo $item->id; ?>"></td>
                                                        <td>&nbsp;<?php echo $item->ruta; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $consulta->id; ?>">
                            <div class="card-footer">
                                <button class="btn bg-primary color-palette btn-sm" type="submit" data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fas fa-save"></i>&nbsp;Agregue</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                        <form action="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/grupo_controller/eliminar_area" method="post">
                            <div class="card-body">
                                <div class="card-header bg-olive disabled color-palette">
                                    <h4 class="card-title"><i class="fas fa-sitemap"></i>&nbsp;&nbsp;Seleccione Permiso a Eliminar</h4>
                                </div>
                                <br>
                                <table id="areas1" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th width="5%">Marcar:</th>
                                            <th>Ruta:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($areas)) : ?>
                                            <tr>
                                                <td>No posee áreas.</td>
                                            </tr>
                                        <?php else : ?>

                                            <?php foreach ($areas as $item) : ?>
                                                <tr>
                                                    <td><input type="checkbox" name="areas[]" value="<?php echo $item->ga_id; ?>"></td>
                                                    <td>&nbsp;<?php echo $item->rut_ruta; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </tbody>
                                </table>
                                <input type="hidden" name="id" value="<?php echo $consulta->id; ?>">
                            </div>
                            <div class="card-footer">
                                <button class="btn bg-warning color-palette btn-sm" type="submit" data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fas fa-save"></i>&nbsp;Elimine</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<script type="text/javascript">
    $('#areas, #areas1').DataTable({
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