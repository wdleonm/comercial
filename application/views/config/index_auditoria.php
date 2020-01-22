<!-- DATA TABLES -->
<link href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES SCRIPT -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '#thumbnail', function() {
            alert("muestra imagen");
        });
    });
</script>
<!-- <section class="content"> -->
<div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
        <div class="card">
            <div class="card-header bg-olive disabled color-palette">
                <h4 class="card-title"><i class="fas fa-chalkboard-teacher"></i>&nbsp;Auditoria</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="tabla">Tabla:</label>
                        <select name="tabla" id="tabla" class="form-control">
                            <option value="">Seleccionar</option>
                            <?php foreach ($tablas as $item) : ?>
                                <option value="<?php echo $item->tabla; ?>"><?php echo $item->tabla; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="usuario">Usuario:</label>
                        <select name="usuario" id="usuario" class="form-control">
                            <option value="">Seleccionar</option>
                            <?php foreach ($usuarios as $item) : ?>
                                <option value="<?php echo $item->id; ?>"><?php echo $item->nombre; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="accion">Acción:</label>
                        <select name="accion" id="accion" class="form-control">
                            <option value="">Seleccionar</option>
                            <option value="INSERT">Insert</option>
                            <option value="UPDATE">Update</option>
                            <option value="DELETE">Delete</option>
                            <option value="SELECT">Select</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <span class="input-group-btn"> <button class="btn btn-default waves-effect btn-sm bg-indigo color-palette float-right" type="button" data-toggle="tooltip" data-placement="top" title="Filtrar" onclick="filtrar()"><i class="fas fa-search-plus"></i>&nbsp;Buscar</button></span>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <br>
                    <table id="org" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="row">
                                    Tabla:
                                </th>
                                <th scope="row">
                                    Hora:
                                </th>
                                <th scope="row">
                                    Fecha:
                                </th>
                                <th scope="row">
                                    Acción:
                                </th>
                                <th scope="row">
                                    Usuario:
                                </th>
                                <th scope="row">
                                    Opciones:
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div><!-- /.box -->
<!-- </section> -->

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>


<script type="text/javascript">
    var auditoria_table = $('#org').DataTable({
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
        columns: [{
                data: 'tabla'
            },
            {
                data: 'hora'
            },
            {
                data: 'fecha'
            },
            {
                data: 'accion'
            },
            {
                data: 'usuario'
            },
            {
                data: 'opciones'
            }
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar  _MENU_  registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Registros del 0 al 0 de un total de 0 registros",
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

    function filtrar() {

        auditoria_table.clear().draw();

        var tabla = $('#tabla').val();
        var usuario = $('#usuario').val();
        var accion = $('#accion').val();
        //console.log(accion);
        $.ajax({
            type: "POST",
            url: base_url + '/<?php echo MANEJADOR_CONFIG; ?>/auditoria_controller/auditoria_ajax/',
            dataType: "json",
            data: {
                tabla: tabla,
                usuario: usuario,
                accion: accion
            },
            success: function(data) {

                data.forEach(function(item) {

                    var fin = item.zona.indexOf(',');
                    var zona = item.zona.substring(1, fin);

                    auditoria_table.rows.add([{
                        "tabla": item.tabla,
                        "hora": item.hora,
                        "fecha": item.fecha,
                        "accion": item.accion,
                        "usuario": item.nombre,
                        "opciones": '<div class="btn-group">\
                            <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/auditoria_controller/ver/' +
                            item.id + '"><button type="button" class="btn btn-primary btn-sm text-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver"><i class="fa fa-eye"></i>&nbsp; Ver</button></a>\
                        </div>'

                    }]);
                });

                auditoria_table.draw();

                if (auditoria_table.data().length == 0) {
                    swal("No se encontraron coincidencias.", '', "error");
                }
            }
        });
    }
</script>