<link href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css">

<?php if (empty($consulta)) : ?>
    <?php redirect(MANEJADOR_CONFIG . '/usuario_controller/index'); ?>
<?php else : ?>
    <?php if (validation_errors()) : ?>
        <script type="text/javascript">
            swal({
                title: "¡Error!",
                text: "<?php echo validation_errors(); ?>",
                html: true,
                type: "error"
            });
        </script>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <form action="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/usuario_controller/editar_guardar" method="post">
                <div class="card">
                    <div class="card-header bg-olive disabled color-palette">
                        <h3 class="card-title"><i class="fas fa-edit"></i>&nbsp;Editar Registro de Usuario</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <label for="Usuario">Usuario</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input name="usuario" type="text" class="form-control" value="<?php echo $consulta->usuario; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="correo">Correo Electronico</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input name="correo" type="text" class="form-control" value="<?php echo $consulta->email; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <label for="Nombre">Nombres</label>
                                <div class="input-group mb-3">
                                    <input name="nombre" type="text" class="form-control" value="<?php echo $consulta->nombre; ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-check"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="Apellido">Apellidos</label>
                                <div class="input-group mb-3">
                                    <input name="apellido" type="text" class="form-control" value="<?php echo $consulta->apellido; ?>" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-check"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <label for="Contraseña">Contraseña</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-asterisk"></i></i></span>
                                    </div>
                                    <input name="password1" type="password" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="password2">Repita la Contraseña</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-asterisk"></i></i></span>
                                    </div>
                                    <input name="password2" type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="activo">Estado:</label>
                                    <select name="estatus" class="form-control" style="width: 100%;">
                                        <i class="fas fa-user"></i>
                                        <option value="1">Activo</option>
                                        <i class="fas fa-user"></i>
                                        <option value="0" <?php if ($consulta->estatus == 0) echo 'selected'; ?>>Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $consulta->id; ?>">
                    <div class="card-footer">
                        <button class="btn btn-success waves-effect btn-sm" type="submit" data-toggle="tooltip" data-placement="top" title="Guardar"><i class='fas fa-save'></i>&nbsp;Guardar</button>
                        <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/usuario_controller/index"><span class="btn btn-danger waves-effect float-right btn-sm" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fas fa-window-close"></i>&nbsp;Cancelar</span></a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="card card-primary">
                <div class="card-header bg-olive disabled color-palette">
                    <h3 class="card-title"><i class="fas fa-lock"></i>&nbsp;Seleccione el Grupo</h3>
                </div>
                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                    <br>
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#tab_1" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Agregar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#tab_2" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Eliminar</a>
                    </li>
                </ul>

                <div class="row">
                    <div class="card-body">
                        <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                <form action="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/usuario_controller/agregar_grupos_usuario" method="post">
                                    <div class="card-header bg-light color-palette">
                                        <h3 class="card-title"><i class="fas fa-plus"></i>&nbsp;Seleccione Permiso a Agregar</h3>
                                    </div>
                                    <br>
                                    <table id="grupos" class="table table-bordered table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th width="5%">Marcar:</th>
                                                <th>Grupos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($l_grupos)) : ?>
                                                <thead>
                                                    <tr>
                                                    </tr>
                                                </thead>
                                            <?php else : ?>
                                                <?php foreach ($l_grupos as $item) : ?>
                                                    <?php
                                                                $existe = 0;
                                                                foreach ($grupos as $item2) {
                                                                    if ($item->id == $item2->id_grupo) {
                                                                        $existe = 1;
                                                                    }
                                                                }
                                                                ?>
                                                    <?php if ($existe == 0) : ?>
                                                        <tr>
                                                            <td><input type="checkbox" name="grupos[]" value="<?php echo $item->id; ?>"></td>
                                                            <td> &nbsp;<?php echo $item->nombre; ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="id" value="<?php echo $consulta->id; ?>">
                                    <br>
                                    <div class="card-footer">
                                        <button class="btn bg-primary color-palette btn-sm" type="submit" data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fas fa-check"></i>&nbsp;Agregue</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                <form action="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/usuario_controller/eliminar_grupos_usuario" method="post">
                                    <div class="card-header bg-light color-palette">
                                        <h3 class="card-title"><i class="fas fa-trash"></i>&nbsp;Seleccione Permiso a Eliminar</h3>
                                    </div>
                                    <br>
                                    <table id="grupos2" class="table table-bordered table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th width="5%">Marcar:</th>
                                                <th>Grupos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($grupos)) : ?>
                                                <thead>
                                                    <tr>
                                                    </tr>
                                                </thead>
                                            <?php else : ?>
                                                <?php foreach ($grupos as $item) : ?>
                                                    <tr>
                                                        <td><input type="checkbox" name="grupos[]" value="<?php echo $item->id; ?>"></td>
                                                        <td>&nbsp;<?php echo $item->nombre; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="id" value="<?php echo $consulta->id; ?>">
                                    <br>
                                    <div class="card-footer">
                                        <button class="btn bg-warning color-palette btn-sm" type="submit" data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fas fa-check"></i>&nbsp;Elimine</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<script type="text/javascript">
    $('#grupos').DataTable({
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
            "sEmptyTable": "No existen Grupos pendientes por agregar",
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
<script type="text/javascript">
    $('#grupos2').DataTable({
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
            "sEmptyTable": "No existen Grupos pendientes por eliminar",
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