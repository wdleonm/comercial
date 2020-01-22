<!-- DATA TABLES -->
<link href="<?php echo base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES SCRIPT -->
<script src="<?php echo base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
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
        <form action="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/usuario_controller/nuevo_guardar" method="post">
            <div class="card">
                <div class="card-header bg-olive disabled color-palette">
                    <h3 class="card-title"><i class="fas fa-user"></i>&nbsp;Registro de Usuario</h3>
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
                                <input name="usuario" type="text" class="form-control" value="<?php echo set_value('usuario'); ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="correo">Correo Electronico</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input name="correo" type="text" class="form-control" value="<?php echo set_value('correo'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <label for="Nombre">Nombres</label>
                            <div class="input-group mb-3">
                                <input name="nombre" type="text" class="form-control" value="<?php echo set_value('nombre'); ?>" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-check"></i></span>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <label for="Apellido">Apellidos</label>
                            <div class="input-group mb-3">
                                <input name="apellido" type="text" class="form-control" value="<?php echo set_value('apellido'); ?>" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-check"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <label for="clave">Contraseña</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-asterisk"></i></i></span>
                                </div>
                                <input name="password1" type="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="clave2">Repita la Contraseña</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-asterisk"></i></i></span>
                                </div>
                                <input name="password2" type="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type='submit' class='btn btn-success btn-sm'><i class='fas fa-save'></i>&nbsp;Guardar</button>
                    <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/usuario_controller/index"><span  data-toggle="tooltip" data-placement="top" title="Cancelar" class="btn btn-danger waves-effect btn-sm float-right"><i class="fas fa-window-close"></i>&nbsp;Cancelar</span></a>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-olive disabled color-palette">
                    <h3 class="card-title"><i class="fas fa-lock"></i>&nbsp;Seleccione el Grupo</h3>
                </div>
                <div class="card-body">
                    <table id="areas" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th width=5%>Marcar:</th>
                                <th>Nombre:</th>
                                <th>Descripcion:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($grupos as $item) : ?>
                                <tr>
                                    <td align="center"><input type="checkbox" name="grupos[]" value="<?php echo $item->id; ?>" <?php echo set_checkbox('grupos[]', $item->id); ?>></td>
                                    <td><?php echo $item->nombre; ?></td>
                                    <td><?php echo $item->descripcion; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">

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