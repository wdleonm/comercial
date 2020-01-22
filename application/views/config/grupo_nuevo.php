<link href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
        <form action="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/grupo_controller/nuevo_guardar" method="post">
            <div class="card">
                <div class="card-header bg-olive disabled color-palette">
                    <h4 class="card-title"><i class="fas fa-fas fa-lock "></i>&nbsp;Nuevo Registro de Grupo</h4>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nombre">Nombre:</label>
                            <input name="nombre" type="text" id="nombre" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="descripcion">Descripcion:</label>
                            <input name="descripcion" id="descripcion" type="text" class="form-control">
                            <br>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="card">
                <div class="card-header bg-olive disabled color-palette">
                    <h4 class="card-title"><i class="fas fa-edit"></i>&nbsp;Seleccione Areas:</h4>
                </div>
                <div class="card-body">
                    <table id="areas" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th width="5%">Marcar:</th>
                                <th>Ruta:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($consulta as $item) : ?>
                                <tr>
                                    <td align="center"><input type="checkbox" name="areas[]" value="<?php echo $item->id; ?>"></td>
                                    <td><?php echo $item->ruta; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><!-- /.box -->
                <div class="card-footer">
                    <button class="btn btn-success waves-effect btn-sm" type="submit" data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fas fa-save"></i>&nbsp;Guardar</button>
                    <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/grupo_controller/index"><span class="btn btn-danger waves-effect float-right btn-sm" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fas fa-window-close"></i>&nbsp;Cancelar</span></a>
                </div>
            </div><!-- /.box-body -->
        </form>
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