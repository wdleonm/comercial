<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/jquery.min.js" type="text/javascript"></script>

<div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
        <!-- general form elements disabled -->

        <div class="card">
            <form action="" method="post">
                <div class="card-header bg-olive disabled color-palette">
                    <h3 class="card-title">                         
                    Frecuencia de Ingreso al Sistema por Usuario
                </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <br><br>
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="row">
                                <div class="col-md-1">
                                    <div class="panel-body">

                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="panel-body">
                                        <canvas id="myChart" width="300" height="100"></canvas>
                                    </div>
                                    <div class="panel-body text-center">
                                        <h4 class="box-title">
                                            <font size="3">Meses</font>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="panel-body">

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </form>
            <div class="card-footer">
                <form method="POST" action="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/usuario_controller/pdpgrafico" name="form1" id="form1">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="hidden" name="base64" id="base64" />
                            <input type="hidden" name="id" id="id" value="<? echo $usuario ?>" />
                            <!-- <input type="text" name="id" id="id" value="<? echo $usuario ?>" /> -->
                            <button class="btn btn-success waves-effect bg-primary color-palette btn-sm" type="button" onclick='enviar()' data-toggle="tooltip" data-placement="top" title="Imprimir"><i class="fas fa-print"></i> Imprimir</button>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-success waves-effect bg-info color-palette btn-sm" target="_blank" type="button" onclick='enviar()' data-toggle="tooltip" data-placement="top" title="Descargar"><i class="fas fa-download"></i> Descargar</button>
                        </div>
                        <div class="col-md-3">
                            <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/usuario_controller/index"><span class="btn btn-default waves-effect btn-sm bg-indigo color-palette float-right" data-toggle="tooltip" data-placement="top" title="Regresar"><i class="fas fa-undo-alt">&nbsp; Regresar</i></span></a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <div class="col-md-1">
    </div>
</div>








<!-- <div class="row">
    <div class="col-md-12">
        <form action="" method="post">
            <div class="box primary">
                <br><br>
                <div class="col-md-12 text-center">
                    <h4 class="box-title">
                        <font size="6">Frecuencia de Ingreso al Sistema por Usuario</font>
                    </h4>
                </div>
                 <br><br> <br><br>
                <div class="row">
                    <div class="col-md-1">
                        <div class="panel-body">

                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="panel-body">
                            <canvas id="myChart" width="300" height="100"></canvas>
                        </div>
                        <div class="panel-body text-center">
                            <h4 class="box-title">
                                <font size="3">Meses</font>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="panel-body">

                        </div>
                    </div>
                </div>
                <br>
            </div>
        </form>
        <div class="row">
            <div class="col-md-4 text-center">
                <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/usuario_controller/index"><span class="btn btn-primary waves-effect" data-toggle="tooltip" data-placement="top" title="Regresar"><i class="fa fa-arrow-left"> Regresar</i></span></a>
            </div>
            <div class="col-md-4 text-center">
                <form method="POST" action="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/usuario_controller/pdpgrafico" name="form1" id="form1">
                    <input type="hidden" name="base64" id="base64" />

                    <input type="hidden" name="id" id="id" value="<? echo $usuario ?>" />
                    <button class="btn btn-success waves-effect" type="button" onclick='enviar()' data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fa fa-check"></i> Imprimir o Descargar</button>

                </form>
            </div>
        </div>
        <br>
    </div>
</div> -->



<!--<canvas id="myChart" width="400" height="200"></canvas>-->

<script>
    var parametromeses = [];
    var valoresmeses = [];

    var bgColor = [];
    var bgBorder = [];
    var ctx = $("#myChart");
    // $('#btnBuscar').click(function () {
    $.post("<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/usuario_controller/getpersonas/<?php echo $usuario; ?>",
        function(data) {

            var obj = JSON.parse(data);

            $.each(obj, function(i, item) {

                var r = Math.random() * 255;
                r = Math.round(r);

                var g = Math.random() * 255;
                g = Math.round(g);

                var b = Math.random() * 255;
                b = Math.round(b);
                if (item.mes == "1")
                    parametromeses.push("Enero");
                else if (item.mes == "2")
                    parametromeses.push("Febrero");
                else if (item.mes == "3")
                    parametromeses.push("Marzo");
                else if (item.mes == "4")
                    parametromeses.push("Abril");
                else if (item.mes == "5")
                    parametromeses.push("Mayo");
                else if (item.mes == "6")
                    parametromeses.push("Junio");
                else if (item.mes == "7")
                    parametromeses.push("Julio");
                else if (item.mes == "8")
                    parametromeses.push("Agosto");
                else if (item.mes == "9")
                    parametromeses.push("Septiembre");
                else if (item.mes == "10")
                    parametromeses.push("Octubre");
                else if (item.mes == "11")
                    parametromeses.push("Noviembre");
                else if (item.mes == "12")
                    parametromeses.push("Diciembre");

                // parametromeses.push(item.mes);
                valoresmeses.push(parseInt(item.conteo));
                bgColor.push('rgba(' + r + ',' + g + ',' + b + ', 0.3)');
                bgBorder.push('rgba(' + r + ',' + g + ',' + b + ', 1)');
            });



            var myChart = new Chart(ctx, {
                type: 'line',
                url: '<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/usuario_controller/getPersonas/<?php echo $usuario; ?>',
                dataType: "json",
                data: {
                    labels: parametromeses, //horizontal
                    datasets: [{
                        label: 'Frecuencia',
                        data: valoresmeses, //vertical

                        backgroundColor: bgColor,
                        borderColor: bgBorder,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

        }); //fi post
    // });
</script>

<script>
    function enviar() {
        console.log('console');
        var image = ctx[0].toDataURL('data:image/jpg;base64,'); // data:image/png....
        document.getElementById('base64').value = image;
        console.log(image);
        $("#form1").submit();
    }
</script>

<script>
    function enviarii() {
        console.log('console');
        var image = ctx[0].toDataURL('data:image/png;base64,'); // data:image/png....
        document.getElementById('base64').value = image;
        console.log(image);
        $("#form1").submit();
    }
</script>