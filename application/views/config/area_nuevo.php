<link href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- page script -->

<div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
        <form action="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/area_controller/nuevo_guardar" method="post">
        <div class="card">
                <div class="card-header bg-olive disabled color-palette">
                    <h3 class="card-title"><i class="fas fa-sitemap"></i>&nbsp;Registro de Área</h3>
                </div><!-- /.box-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="input-group mb-3 col-md-12">
                            <label for="nombre">Nombre:&nbsp;&nbsp;</label>
                            <input name="nombre[]" class="form-control" id="nombre" type="text" required>
                            <div class="input-group-append">
                                <span type="button" class="btn btn-default waves-effect" id="add_field_button"><i class="fas fa-plus"></i></span>
                            </div>
                        </div>
                        <br>
                    </div>
                    <!-- input adicional-->
                    <div class="row input_fields_wrap">
                    </div>
                    <!-- cierre de input adicional -->
                </div>
                <br>
            </div>
            <div class="card">
                <div class="card-header bg-olive disabled color-palette">
                    <h4 class="card-title"><i class="fas fa-edit"></i>&nbsp;Seleccione el Id Padre:</h4>
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
                            <?php foreach ($consulta as $item) : ?>
                                <tr>
                                    <td>
                                        <input name="hpadre" type="radio" value="<?php echo $item->id; ?>">
                                    </td>
                                    <td>
                                        <?php echo $item->ruta; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success waves-effect btn-sm" type="submit" data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fas fa-save"></i>&nbsp;Guardar</button>
                <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/area_controller/index"><span class="btn btn-danger waves-effect float-right btn-sm" data-toggle="tooltip" data-placement="top" title="Salir"><i class="fas fa-window-close"></i>&nbsp;Cancelar</span></a>
            </div>
        </form>
    </div><!-- /.col -->
</div>

<script type="text/javascript">
    $('#padres').DataTable({
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

    $(document).ready(function() {
        var max_fields = 10; //Maximo de campos a agregar
        var wrapper = $(".input_fields_wrap"); //Div donde se a�adiran los campos
        var add_button = $("#add_field_button"); //Id del boton de agregar

        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //Al darle al boton agregar
            e.preventDefault();
            if (x < max_fields) { //Valida el maximo de campos que se pueden agregar
                x++; //Aumenta los campos agregados actuales
               
                var todo = '<div><div class="input-group mb-3"><label for="nombre&nbsp;&nbsp;">&nbsp;&nbsp;Nombre:&nbsp;&nbsp;</label><input name="nombre[]" class="form-control" id="nombre" type="text"size="120"><div class="input-group-append"><span type="button" class="btn btn-default waves-effect remove_field"><i class="fas fa-minus"></i></span></div></div></div>';
                $(wrapper).append(todo);
            }
        });

        $(wrapper).on("click", ".remove_field", function(e) { //Al darle al boton eliminar
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--; //Disminuye los campos agregados actuales
        });
    });
</script>