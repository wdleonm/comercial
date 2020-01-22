<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<!-- DataTables -->
<link href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />


<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '#thumbnail', function() {
            alert("muestra imagen");
        });
    });
</script>
<!-- Main content -->
<div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
        <div class="card">

            <div class="card-header bg-olive disabled color-palette">
                <h3 class="card-title"><?php echo $titulo; ?></h3>
            </div><!-- /.box-header -->
            <br>
            <div class="tabla-botones">
                <div class="btn-group">&nbsp;&nbsp;
                    <?php
                    if (!empty($header_button)) {
                        for ($i = 0; $i < count($header_button); $i++) :
                            if ($header_button[$i][0] == "marcartodos" or $header_button[$i][0] == "desmarcartodos") {
                                echo anchor($controller . '#', "<button id='" . $header_button[$i][0] . "' name='" . $header_button[$i][0] . "' type='button' class='btn " . $header_button[$i][2] . " waves-effect' data-toggle='tooltip' data-placement='top' title='" . $header_button[$i][1] . "'><i class='" . $header_button[$i][3] . "'></i> " . $header_button[$i][1] . "</button>");
                            } else {
                                echo anchor($controller . '/' . $header_button[$i][0], "<button id='" . $header_button[$i][0] . "' name='" . $header_button[$i][0] . "' type='button' class='btn " . $header_button[$i][2] . " waves-effect' data-toggle='tooltip' data-placement='top' title='" . $header_button[$i][1] . "'><i class='" . $header_button[$i][3] . "'></i> " . $header_button[$i][1] . "</button>");
                            }
                        endfor;
                    } else {
                        echo '<br>';
                    }
                    ?>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <?php $acum = 1; ?>
                    <table id="<?php echo $table_id; ?>" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <?php foreach ($table_headers as $item) : ?>
                                    <th class="text-center">
                                        <?php echo $item[1]; ?>
                                    </th>
                                <?php endforeach; ?>
                                <th class="text-center">
                                    Opciones
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($resultset as $row) : ?>
                                <tr>
                                    <?php for ($i = 0; $i < count($table_headers); $i++) : ?>
                                        <td class="text-center">
                                            <?php
                                                    $prop = $table_headers[$i][0];
                                                    $func = $table_headers[$i][2];

                                                    if (($func == NULL) or empty($func)) {
                                                        echo $row->$prop;
                                                    } else {

                                                        $pos = 0;
                                                        $pos = strpos($func, "&");
                                                        if ($pos > 0) {
                                                            $funcion = substr($func, 0, $pos);
                                                            $ruta = substr($func, $pos + 1, strlen($func));
                                                        } else {
                                                            $funcion = $func;
                                                        }

                                                        for ($w = 0; $w < count($table_function); $w++) :
                                                            if ($funcion == $table_function[$w]) {
                                                                if ($pos > 0) {
                                                                    echo $funcion($ruta, $row->$prop);
                                                                } else {
                                                                    echo $funcion($row->$prop);
                                                                }
                                                            }
                                                        endfor;
                                                    }
                                                    ?>
                                        </td>
                                    <?php endfor; ?>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <?php
                                                for ($i = 0; $i < count($table_button); $i++) :
                                                    if (!isset($table_button[$i][4])) $table_button[$i][4] = '';
                                                    if (!empty($table_button[$i][0])) {


                                                        if ($table_button[$i][0] != "switch_button") {
                                                            echo anchor($controller . '/' . $table_button[$i][0] . '/' . $row->id, "<button id='" . $row->id . "' name='" . $row->id . "' type='button' class='btn " . $table_button[$i][2] . " waves-effect btn-sm' data-toggle='tooltip' data-placement='top' title='" . $table_button[$i][1] . "'><i class='" . $table_button[$i][3] . "'>&nbsp;</i>" . $table_button[$i][4] . "</button>");
                                                        } else {
                                                            if (!isset($table_button[$i][8])) $table_button[$i][8] = '';
                                                            $validacion = explode(' ', $table_button[$i][7]);
                                                        
                                                            $row_arrayss = json_decode(json_encode($row), True);
        
                                                            if ((strcasecmp($row_arrayss[$validacion[0]], $validacion[1])) == 0) {
                                                              
                                                                $opcion  = explode(' ', $table_button[$i][1]);
                                                                $table_button1[$i][0] =  $opcion[0];

                                                                $opcion  = explode(' ', $table_button[$i][2]);
                                                                $table_button1[$i][1] =  $opcion[0];


                                                                $table_button1[$i][2] =    $table_button[$i][3];

                                                                $table_button1[$i][3] = $table_button[$i][5];

                   
                                                                if (!empty($table_button[$i][8])) {
                                                                    $opcion  = explode(' ', $table_button[$i][8]);
                                                                    $table_button1[$i][4] =  $opcion[0];
                                                                } else {

                                                                    $table_button1[$i][4] = '';
                                                                }
                                                                echo anchor($controller . '/' . $table_button1[$i][0] . '/' . $row->id, "<button id='" . $row->id . "' name='" . $row->id . "' type='button' class='btn " . $table_button1[$i][2] . " waves-effect btn-sm' data-toggle='tooltip' data-placement='top' title='" . $table_button1[$i][1] . "'><i class='" . $table_button1[$i][3] . "'>&nbsp;</i>" . $table_button1[$i][4] . "</button>");
                                                            
                                                            } else {
                                                                //posicion 1 en explode
                                                               
                                                               
                                                                $opcion  = explode(' ', $table_button[$i][1]);
                                                                $table_button1[$i][0] =  $opcion[1];

                                                                $opcion  = explode(' ', $table_button[$i][2]);
                                                                $table_button1[$i][1] =  $opcion[1];


                                                                $table_button1[$i][2] =    $table_button[$i][4];

                                                                $table_button1[$i][3] = $table_button[$i][6];

                                                              
                                                                if (!empty($table_button[$i][8])) {
                                                                    $opcion  = explode(' ', $table_button[$i][8]);
                                                                    $table_button1[$i][4] =  $opcion[1];
                                                                } else {

                                                                    $table_button1[$i][4] = '';
                                                                }
                                                                echo anchor($controller . '/' . $table_button1[$i][0] . '/' . $row->id, "<button id='" . $row->id . "' name='" . $row->id . "' type='button' class='btn " . $table_button1[$i][2] . " waves-effect btn-sm' data-toggle='tooltip' data-placement='top' title='" . $table_button1[$i][1] . "'><i class='" . $table_button1[$i][3] . "'>&nbsp;</i>" . $table_button1[$i][4] . "</button>");
                                                            }






                                                            $row;
                                                        }
                                                    } else {
                                                        //                                            Se deja la etiqueta <a> porque sin ella el boton se pone de primero.
                                                        echo "<a><button id='" . $row->id . "' name='" . $row->id . "' type='button' class='btn " . $table_button[$i][2] . " waves-effect btn-sm' data-toggle='tooltip' data-placement='top' title='" . $table_button[$i][1] . "'><i class='" . $table_button[$i][3] . "'>&nbsp;</i>" . $table_button[$i][4] . "</button></a>";
                                                    }

                                                endfor;
                                                ?>
                                        </div>

                                    </td>
                                </tr>
                                <?php $acum++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!--/.box-body -->
            <div class="box-footer">
            </div><!-- /.box-header -->

        </div><!-- /.box -->

        <!-- <div class="col-ms-2">
    </div> -->


    </div>
</div>


<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>


<!-- page script -->

<script type="text/javascript">
    tabla = $('#<?php echo $table_id; ?>').DataTable({
        "oPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "aaSorting": [],
        "bInfo": true,
        "bAutoWidth": true,
        "lengthMenu": [
            [10, 25, 50, 100, 200, -1],
            [10, 25, 50, 100, 200, "All"]
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
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

    <?php if ($delete === 0) : ?>
        $(document).ready(function() {
            $('.tooltipped').tooltip({
                delay: 50
            });
        });

        $('#<?php echo $table_id; ?>').on('click', '.delete_element', function() {

            var id_element = this.id;

            swal({
                    title: "¡Alerta!",
                    text: "¿Está seguro de eliminar este elemento?",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    confirmButtonText: "Eliminar",
                    showLoaderOnConfirm: true
                },
                function() {

                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>index.php/<?php echo $controller; ?>/borrar/' + id_element,
                        dataType: "json",
                        success: function(dato) {

                            if (dato) {
                                swal({
                                        title: "¡Exito!",
                                        text: "Elemento eliminado satisfactoriamente",
                                        type: "success"
                                    },
                                    function() {

                                        tabla.row($("#" + id_element).parents('tr')).remove().draw();
                                    });
                            } else {
                                swal({
                                    title: "¡Alerta!",
                                    text: "Hubo un error al eliminar el elemento, compruebe que otros elementos no tengan dependencias del mismo",
                                    type: "warning",
                                    animation: "slide-from-top",
                                });
                            }
                        },
                        error: function() {
                            swal({
                                title: "¡Alerta!",
                                text: "Hubo un error al eliminar el elemento, quizá no posea los permisos necesarios",
                                html: true,
                                type: "warning",
                                animation: "slide-from-top",
                            });
                        }
                    });

                });

        });
    <?php endif; ?>

    <?php if ($delete === 1) : ?>

        $('#<?php echo $table_id; ?>').on('click', '.delete_element', function() {

            var id_element = this.id;

            swal({
                    title: "¡Alerta!",
                    text: "¿Está seguro de eliminar este elemento?",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    confirmButtonText: "Eliminar"
                },
                function() {

                    swal({
                            title: "¡Atencion!",
                            text: "Para eliminar este elemento debe introducir su contraseña:",
                            type: "input",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            inputType: "password",
                            animation: "slide-from-top",
                            inputPlaceholder: "Introduzca su contraseña",
                            showLoaderOnConfirm: true
                        },
                        function(password) {
                            if (password === false)
                                return false;

                            if (password === "") {
                                swal.showInputError("Debe introducir una contraseña.");
                                return false
                            }

                            $.ajax({
                                type: "POST",
                                url: '<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/usuario_controller/validar_password',
                                dataType: "json",
                                data: {
                                    password: password
                                },
                                success: function(data) {

                                    if (data) {

                                        $.ajax({
                                            type: "POST",
                                            url: '<?php echo base_url(); ?>index.php/<?php echo $controller; ?>/borrar/' + id_element,
                                            dataType: "json",
                                            success: function(dato) {

                                                if (dato) {
                                                    swal({
                                                            title: "¡Exito!",
                                                            text: "Elemento eliminado satisfactoriamente",
                                                            type: "success"
                                                        },
                                                        function() {

                                                            tabla.row($("#" + id_element).parents('tr')).remove().draw();
                                                        });
                                                } else {
                                                    swal({
                                                        title: "¡Alerta!",
                                                        text: "Hubo un error al eliminar el elemento, compruebe que otros elementos no tengan dependencias del mismo",
                                                        type: "warning",
                                                        animation: "slide-from-top",
                                                    });
                                                }
                                            },
                                            error: function() {
                                                swal({
                                                    title: "¡Alerta!",
                                                    text: "Hubo un error al eliminar el elemento, quizá no posea los permisos necesarios",
                                                    html: true,
                                                    type: "warning",
                                                    animation: "slide-from-top",
                                                });
                                            }
                                        });
                                    } else {
                                        swal({
                                            title: "¡Alerta!",
                                            text: "Contraseña Incorrecta",
                                            type: "warning",
                                            animation: "slide-from-top",
                                        });
                                    }
                                },
                                error: function() {
                                    swal({
                                        title: "¡Error!",
                                        text: "Hubo un error al validar la contraseña",
                                        html: true,
                                        type: "error",
                                        animation: "slide-from-top",
                                    });
                                }
                            });
                        });
                });
        });
    <?php endif; ?>
</script>