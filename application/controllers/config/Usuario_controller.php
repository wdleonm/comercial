<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario_controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(MANEJADOR_CONFIG . '/Usuario_model');
        $this->load->model(MANEJADOR_CONFIG . '/Grupo_model');
        $this->load->helper("variables_helper");
        $this->load->library('pdf');
    }

    public function index()
    {

        if (!$this->validate_access())
            return;

        $this->load->library('Template_table');

        // Datos para llenar la tabla basica
        $resultset = $this->Usuario_model->usuarios();
        $controller = MANEJADOR_CONFIG . '/' . get_class();
        $titulo = 'Lista de Usuarios';
        $table_headers = array(
            array("usuario", "Usuario", ""),
            array("nombre", "Nombre", ""),
            array("apellido", "Apellido", ""),
            array("email", "Email", ""),
            array("estatus", "Estatus", "ver_status")
        );

        /* metodo , tooltip , color del boton , icono, contenido del boton */
        //segunda opcion
       
            $table_button = array(
                //    switchar boton,     funcion,          mensaje en la vista,    button 1,                           button 2,                                     icono 1,             icono2,          tipo de opcion, mensaje a mostar al pasar el mouse               
                array("switch_button","desactivar activar", "Desactivar Activar", "btn btn-block btn-success btn-sm", "btn btn-block btn-sm bg-gradient-warning",  "fas fa-user-check", "fas fa-user-times","estatus 1", ""),                
                //    funcion,    mensaje en la vista,    button,                            icono,   ,          tipo de opcion, mensaje a mostar al pasar el mouse
                array("grafica", "Grafica", "btn btn-block bg-indigo color-palette btn-sm", "fas  fa-chart-area", ""),
                array("ver", "", "btn btn-primary btn-sm", "fas fa-eye", "Ver"),
                array("editar", "", "btn btn-info btn-sm", "fas fa-edit", "Editar"),
                array("eliminar", "", "btn-danger delete_element  btn-sm", "fas fa-trash", "Eliminar "),
                
            );
        
     /* metodo , tooltip , color del boton , icono */
        $header_button = array(
            array("nuevo", "Nuevo", "btn-primary  btn-sm", "fas fa-plus")
        );

        /* 1 con contraseña, 0 sin contraseña */
        $delete = 1;

        $function_helper = array('ver_status');


        $this->add_view('mensaje');
        $vista = $this->template_table->basic_table(
            $resultset,
            $table_headers,
            $table_button,
            $header_button,
            $titulo,
            $controller,
            $delete,
            $function_helper
        );
        $this->add_html($vista);
        $this->render();
    }

    public function ver($id = null)
    {

        if (!$this->validate_access())
            return;

        if (is_numeric($id)) {
            $consulta['consulta'] = $this->Usuario_model->usuario_ver($id);
            if (!empty($consulta['consulta'])) {
                $consulta['grupos'] = $this->Grupo_model->grupos_usuario($id);
            } else {
                $consulta['consulta'] = "";
            }
        } else {
            $consulta['consulta'] = "";
        }
        $this->add_view(MANEJADOR_CONFIG . '/usuario_ver', $consulta);
        $this->render();
    }

    public function nuevo()
    {

        if (!$this->validate_access())
            return;

        $this->load->library('form_validation');

        $consulta['grupos'] = $this->Grupo_model->grupos();

        $this->add_view(MANEJADOR_CONFIG . '/usuario_nuevo', $consulta);
        $this->render();
    }

    public function nuevo_guardar()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div>', '</div><br>\\');

        if ($this->form_validation->run('usuario_nuevo') == FALSE) {
            $this->nuevo();
        } else {

            $usuario = $this->input->post('usuario');
            $password = (randomText(4) . md5("scrum" . $this->input->post('password1')) . randomText(4));
            $nombre = $this->input->post('nombre');
            $apellido = $this->input->post('apellido');
            $correo = $this->input->post('correo');
            $grupos = $this->input->post('grupos');

            $this->Usuario_model->nuevo_guardar($usuario, $password, $nombre, $apellido, $correo, $grupos);
            $this->session->set_flashdata('data', $usuario . ' Ha sido añadida a la base de datos.');
            redirect(MANEJADOR_CONFIG . '/usuario_controller/index');
        }
    }

    public function password()
    {

        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');
        // var_dump($password1, $password2);
        // die();
        if (!empty($password1) and !empty($password2)) {
            if ((strlen($password1) < 6) or (strlen($password1) > 12) or (strlen($password2) < 6) or (strlen($password2) > 12)) {

                $this->form_validation->set_message('password', 'La contraseña debe ser mayor a 6 y menor a 12 carácteres.');
                // $this->session->set_flashdata('data', 'La contraseña debe ser mayor a 6 y menor a 12 carácteres.');
                // $this->session->set_flashdata('tipo', 'warning');
                //$this->perfil();
            } else {
                if ($password1 != $password2) {
                    $this->form_validation->set_message('password', 'Las contraseñas no coinciden.');
                    return FALSE;
                } else {
                    return TRUE;
                }
            }
        }
    }

    public function usuario($usuario)
    {

        if ($this->Usuario_model->usuario($usuario)) {
            $this->form_validation->set_message('usuario', 'El nombre de usuario ' . $usuario . ' ya existe en la base de datos.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function correo($correo)
    {

        $id = $this->input->post('id');

        if ($this->Usuario_model->correo($correo, $id)) {
            $this->form_validation->set_message('correo', 'El correo electrónico ' . $correo . ' ya está siendo usado por alguien más.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function editar($id = NULL)
    {

        if (!$this->validate_access())
            return;

        $this->load->library('form_validation');

        if (is_numeric($id)) {
            $consulta['consulta'] = $this->Usuario_model->usuario_ver($id);
            if (!empty($consulta['consulta'])) {
                $consulta['grupos'] = $this->Grupo_model->grupos_usuario($id);
                $consulta['l_grupos'] = $this->Grupo_model->grupos();
            } else {
                $consulta['consulta'] = "";
            }
        } else {
            $consulta['consulta'] = "";
        }
        $this->add_view('mensaje');
        $this->add_view(MANEJADOR_CONFIG . '/usuario_editar', $consulta);
        $this->render();
    }

    public function editar_guardar()
    {

        $this->load->library('form_validation');

        $id = $this->input->post('id');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');

        $this->form_validation->set_error_delimiters('<div>', '</div><br>\\');
        if ($this->form_validation->run('usuario_editar') == FALSE) {

            $this->editar($id);
        } else      if ($password1 != $password2) {
            //$this->form_validation->set_message('password', 'Las contraseñas no coinciden');

            $this->session->set_flashdata('data', 'Las contraseñas no coinciden.');
            $this->session->set_flashdata('tipo', 'warning');
            redirect(MANEJADOR_CONFIG . '/usuario_controller/editar/' . $id);
            //$this->editar($id);
        } else {

            $usuario = $this->input->post('usuario');
            $password = $this->input->post('password1');


            if (!empty($password)) {
                $password = (randomText(4) . md5("scrum" . $password) . randomText(4));
            }

            $nombre = $this->input->post('nombre');
            $apellido = $this->input->post('apellido');
            $correo = $this->input->post('correo');
            $estatus = $this->input->post('estatus');
            $grupos = $this->input->post('grupos');

            $this->Usuario_model->editar_guardar($id, $password, $nombre, $apellido, $correo, $estatus, $grupos);
            $this->session->set_flashdata('data', $usuario . ' Ha sido actualizado.');
            redirect(MANEJADOR_CONFIG . '/usuario_controller/index');
        }
    }

    public function agregar_grupos_usuario()
    {

        $id = $this->input->post('id');
        $grupos = $this->input->post('grupos');

        $this->Usuario_model->agregar_grupos_usuario($id, $grupos);
        redirect(MANEJADOR_CONFIG . '/usuario_controller/editar/' . $id);
    }

    public function eliminar_grupos_usuario()
    {

        $id = $this->input->post('id');
        $grupos = $this->input->post('grupos');

        $this->Usuario_model->eliminar_grupos_usuario($grupos);
        redirect(MANEJADOR_CONFIG . '/usuario_controller/editar/' . $id);
    }

    public function desactivar($id)
    {

         if (!$this->validate_access())
             return;

        // $this->Usuario_model->desactivar_usuario($id);
        // $consulta = $this->Usuario_model->usuario_ver($id);

        $consulta = $this->Usuario_model->usuario_ver($id);
        $this->Usuario_model->desactivar_usuario($id, $consulta->estatus);

        $this->session->set_flashdata('data', $consulta->usuario . ' Ha sido cambiado el estatus a Desactivado.');

        redirect(MANEJADOR_CONFIG . '/usuario_controller/index');
    }

    public function activar($id)
    {
         if (!$this->validate_access())
             return;

        // $this->Usuario_model->desactivar_usuario($id);
        // $consulta = $this->Usuario_model->usuario_ver($id);

        $consulta = $this->Usuario_model->usuario_ver($id);
        $this->Usuario_model->desactivar_usuario($id, $consulta->estatus);

        $this->session->set_flashdata('data', $consulta->usuario . ' Ha sido cambiado el estatus a  Activo.');

        redirect(MANEJADOR_CONFIG . '/usuario_controller/index');
    }


    public function borrar($id)
    {

        if (!$this->validate_access())
            return;

        if (is_numeric($id)) {
            $consulta = $this->Usuario_model->usuario_ver($id);
            if (!empty($consulta)) {
                $registro = $consulta->id . ', ' . $consulta->apellido . ' ' . $consulta->nombre . ', ' . $consulta->usuario;
                if ($this->Usuario_model->eliminar_usuario($id, $registro)) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function validar_password()
    {

        $password = hash('md5', "scrum" . $this->input->post('password'));
        if ($this->Usuario_model->validar_password($this->session->userdata('usr_id'), $password)) {
            echo 1;
        } else {
            echo 0;
        }
    }

    //grafica
    function grafica($usuario)
    {

        $this->Usuario_model->acceso_mes($usuario);

        // $consulta['consulta'] =  $this->Usuario_model->acceso_mes($usuario);
        //        var_dump(['consulta']);die();
        $consulta['usuario'] = $usuario;
        $this->add_view(MANEJADOR_CONFIG . '/usuario_estadistica', $consulta);
        $this->render();
    }

    public function getpersonas($usuario)
    {
        $result = $this->Usuario_model->acceso_mes($usuario);
        echo json_encode($result);
    }

    //convertir grafica en imagen
    public function pdpgraficooriginal()
    {
        $img = $this->input->post('base64'); //envia los datos del grafico tipo texto por el imput oculto
        $id = $this->input->post('id'); //devuelve el id para quedar en la grafica
        $img = str_replace('data:image/png;base64,', '', $img);
        $fileData = base64_decode($img);
        $fileName = MANEJADOR_RUTA_GRAFICAS . uniqid() . '_' . $id . '.png'; //ruta de ubicacion al cuardar mas el nombre e id del usuario
        file_put_contents($fileName, $fileData); //donde se guarda y la ruta temporal
        redirect(MANEJADOR_CONFIG . '/usuario_controller/grafica/' . $id); //redirecciona a la grafica
    }

    public function pdpgrafico()
    {

        $img = $this->input->post('base64'); //envia los datos del grafico tipo texto por el imput oculto
        $id = $this->input->post('id'); //devuelve el id para quedar en la grafica
        $img = str_replace('data:image/png;base64,', '', $img);
        $fileData = base64_decode($img);
        $fileName = MANEJADOR_RUTA_GRAFICAS . uniqid() . '_' . $id . '.png'; //ruta de ubicacion al cuardar mas el nombre e id del usuario
        file_put_contents($fileName, $fileData); //donde se guarda y la ruta temporal
        // redirect(MANEJADOR_CONFIG . '/usuario_controller/grafica/' . $id); //redirecciona a la grafica



        $this->pdf = new Pdf2('L', 'cm', 'Legal'); //pagina horizontal
        $this->pdf->AddPage('L', 'Legal'); //pagina horizontal
        // $this->pdf = new Pdf();//pagina vertical
        // $this->pdf->AddPage();//pagina vertical
        $this->pdf->AliasNbPages();
        $this->pdf->SetLeftMargin(15);
        $this->pdf->SetRightMargin(15);
        $this->pdf->SetFillColor(2, 157, 116);
        //    $this->pdf->SetTextColor(240, 255, 240);    
        $this->pdf->SetFont('Arial', '', 9); // Se define el formato de fuente: Arial, negritas, tamaño 9
        //TITULOS DE COLUMNAS  $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);

        $this->pdf->SetXY(30, 40);
        $this->pdf->SetFont('Arial', '', 7);
        $this->pdf->SetXY(262, 30); //espacio de margen izquierdo
        $id_usuario = $this->session->userdata('usr_usuario');
        //        $this->pdf->Cell(70, 7, $id_usuario . date('d/m/Y'));//usuario y fecha
        $this->pdf->Cell(57, 7, "Usuario: " . $id_usuario, 0, 1, 'C');
        $this->pdf->SetXY(262, 33); //espacio de margen izquierdo
        $this->pdf->Cell(61, 7, "Fecha: " . date('d/m/Y'), 0, 1, 'C');
        $this->pdf->SetXY(262, 36); //espacio de margen izquierdo
        $this->pdf->Cell(57, 7, "Hora: " . date('H:i:s'), 0, 1, 'C');

        $this->pdf->SetXY(10, 50);
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Cell(330, 10, "Frecuencia de Ingreso al Sistema por Usuario", 0, 1, 'C');
        $this->pdf->Ln(20);
        $this->pdf->SetFont('Arial', '', 9);
        $this->pdf->SetXY(50, 164);

        $this->pdf->Image($fileName, 70, 70, 218, 128); //llamado de imagen
        unlink($fileName); //borrar imagen

        $this->pdf->Output('Frecuencia de ingreso de usuario.pdf', 'I');
    }
}
