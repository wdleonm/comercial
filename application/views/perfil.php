<div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
        <!-- general form elements disabled -->
        <form action="<?php echo base_url(); ?>index.php/Inicio/perfil_cambiar_clave" method="post">
            <div class="card">
                <div class="card-header bg-olive disabled color-palette">
                    <h3 class="card-title"><i class='fas fa-user'></i>&nbsp;Perfil de Usuario</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <label for="Usuario">Usuario</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="iduser" id="iduser" type="hidden" value="<?php echo $consulta->id; ?>">
                                <input name="usuario" id="usuario" type="text" class="form-control" maxlength="100" value="<?php echo $consulta->usuario; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="correo">Correo Electronico</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input name="correo" id="correo" type="text" class="form-control" maxlength="100" value="<?php echo $consulta->email; ?>" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <label for="Nombre">Nombres</label>
                            <div class="input-group mb-3">
                                <input name="nombre" id="nombre" type="text" class="form-control" maxlength="100" value="<?php echo $consulta->nombre; ?>" disabled>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-check"></i></span>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <label for="Apellido">Apellidos</label>
                            <div class="input-group mb-3">
                                <input name="apellido" id="apellido" type="text" class="form-control" maxlength="100" value="<?php echo $consulta->apellido; ?>" disabled>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-check"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <label for="clave">Clave</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-asterisk"></i></i></span>
                                </div>
                                <input name="clave" id="clave" type="password" class="form-control" maxlength="12">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="clave2">Repetir Clave</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-asterisk"></i></i></span>
                                </div>
                                <input name="clave2" id="clave2" type="password" class="form-control" maxlength="12">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button type='submit' class='btn btn-success btn-sm'><i class='fas fa-save'></i>&nbsp;Guardar</button>
                    <a href="<?php echo base_url(); ?>index.php/inicio/index">
                   <span class="btn btn-danger waves-effect float-right btn-sm" data-toggle="tooltip" data-placement="top" title="Regresar"><i class="fas fa-window-close"></i>&nbsp; Cancelar</span></a>
                </div>
            </div>
        </form>
        <!-- /.card-body -->
    </div>
    <div class="col-md-1">
    </div>
</div>