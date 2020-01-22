<?php

class MY_Controller extends CI_Controller {

    private $content_areas = array();
    protected $menu = array();
    public $area = null;
    public $sistema = null;
    public $usuario = null;
    private $validado = FALSE;

    function __construct() {
       
        parent::__construct();
 
        $this->load->model(MANEJADOR_CONFIG . '/Usuario_model');
        $this->load->model(MANEJADOR_CONFIG . '/Template_model');

        // Usuario
        $login = $this->session->userdata('usr_usuario');
        
       
        if ($login) {
            $this->Template_model->set_usuario($login);
            $this->usuario = $this->Template_model->get_usuario();
            $void = $this->Template_model->usuario_menuvista($this->usuario->id);
        }

        // Sistema
        $sis_id = $this->session->userdata('sis_id');
        if (!$sis_id) {

            $sis_id = 39;
        }
        $this->Template_model->set_sistema($sis_id);
        $this->sistema = $this->Template_model->get_sistema();

        // Area
        $area_id = $this->session->userdata('usr_sistema');
        if (!$area_id) {

            $area_id = 1;
        }
        $this->Template_model->set_area($area_id);
        $this->area = $this->Template_model->get_area();

        // Valida que el usuario haya iniciado sesion
        $this->check_usr_session();

        // Configura el menu y otros detalles de la plantilla
        $this->_build_template();
    }

    function get_session_sistemas() {
        if (!$this->session->userdata('tmplt_sistemas')) {
            $usuario = $this->session->userdata('usr_usuario');
            $var = $this->Template_model->get_user_systems($usuario);
            /* Cambiado por get_all_systems(); el nuevo trae solo los sistemas que tiene acceso el usuario */
            $this->session->set_userdata('tmplt_sistemas', $var);
        }
        return ( $this->session->userdata('tmplt_sistemas'));
    }

    function get_session_menu() {
        if (!$this->session->userdata('tmplt_menu')) {
            $var = $this->Template_model->get_menu($this->sistema->id);

            $this->session->set_userdata('tmplt_menu', $var);
        }

        return $this->session->userdata('tmplt_menu');
    }

    function _build_template() {
        $this->content_areas['usr_nombre'] = $this->usuario->nombre;
        $this->content_areas['usr_apellido'] = $this->usuario->apellido;
        $this->content_areas['usr_id'] = $this->usuario->id;
        $this->content_areas['sys_actual'] = $this->sistema->nombre;
        if ($this->sistema->nombre == "principal") {
            $this->content_areas['sys_name'] = "Página de Inicio";
        } else {
            $namesystem = $this->Template_model->get_system_name($this->sistema->nombre);
            $this->content_areas['sys_name'] = $namesystem->nombre;
        }

        $this->content_areas['sistemas'] = $this->get_session_sistemas();
        $this->content_areas['menus'] = $this->get_session_menu();

        $this->content_areas['msg_valid'] = '';
    }

    function add_view($view, $data = array(), $area = 'main') {
        $this->add_html($this->load->view($view, $data, TRUE), $area);
    }

    function add_html($html, $area = 'main') {

        if (!array_key_exists($area, $this->content_areas)) {
            $this->content_areas[$area] = $html;
        } else {
            $this->content_areas[$area] .= $html;
        }
    }

    function render($layout = "adminlte") {

        if (!$this->validado) {
            $this->content_areas['msg_valid'] = $this->load->view('templates/msg_validar', null, TRUE);
        }

        $this->load->view('templates/' . $layout, $this->content_areas);
    }

    public function validate_access($bypass = FALSE) {

        $this->validado = TRUE;

        // Permite el acceso libre
        if ($bypass) {
            return TRUE;
        }

        $e = new Exception();
        $trace = $e->getTrace();
        $class = $trace[1]['class'];
        $method = $trace[1]['function'];

        $ruta = array(
            $this->area->nombre, $this->sistema->nombre, $class, $method
        );

        $valid = $this->Usuario_model->has_access($this->usuario->id, $ruta);

        if (!$valid) {
            $data = array(
                'ruta' => strtolower(implode('.', $ruta)),
            );

            $this->add_view('acceso', $data);
            $this->render();

            return FALSE;
        } else {
            return TRUE;
        }
    }

    function check_usr_session() {

        if (!isset($this->usuario->id)) {
            redirect('login');
        }
    }

}

?>
