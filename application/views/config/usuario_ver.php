<?php if (empty($consulta)) : ?>
    <?php redirect(MANEJADOR_CONFIG . '/usuario_controller/index'); ?>
<?php else : ?>
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-olive disabled color-palette">
                    <h3 class="card-title"><i class="fas fa-eye"></i>&nbsp;Visualizar Registro de Usuario</h3>
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
                                <input name="usuario" type="text" class="form-control" value="<?php echo $consulta->usuario; ?>">
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
                                <input name="apellido" type="text" class="form-control" value="<?php echo $consulta->apellido; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-check"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-footer">
                    <div align="center">
                    <a href="<?php echo base_url(); ?>index.php/<?php echo MANEJADOR_CONFIG; ?>/usuario_controller/index"><span class="btn btn-default waves-effect bg-indigo color-palette btn-sm float-right" data-toggle="tooltip" data-placement="top" title="Regresar a listado de registros"><i class="fas fa-sign-out-alt"></i>&nbsp; Regresar</span></a>
                       
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php endif; ?>