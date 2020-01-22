<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inicio extends MY_Controller {

    public function __construct() {

        parent:: __construct();

        $this->load->model(MANEJADOR_CONFIG . "/template_model");
        $this->load->model(MANEJADOR_CONFIG . "/Usuario_model");
        $this->load->helper("variables_helper");
    }

    public function index() {
        // if (!$this->validate_access())
        //     return;

        // $this->load->helper('text');

        $this->add_view('inicio');
        $this->render();
    }

    public function cambio_sistema($sistemas, $areas) {

        $menuss = $this->template_model->get_menu($sistemas);
        $this->load->model(MANEJADOR_CONFIG . '/area_model');
        $s = $this->area_model->get($sistemas)->row();
        $this->session->set_userdata('tmplt_sistema', $s);
        $this->sistema = $this->session->userdata('tmplt_sistema');

        $s = $this->area_model->get($areas)->row();
        $this->session->set_userdata('tmplt_area', $s);
        $this->area = $this->session->userdata('tmplt_area');

        $this->session->set_userdata('tmplt_menu', $menuss);

        $var = array();
        $var = $this->template_model->get_system_home($sistemas);

        $this->_build_template();


        $sql = "select nombre From " . SYSTEM_SCHEME . ".sistema WHERE idsistema = " . $sistemas;
        $sistema = $this->db->query($sql);
        $consulta = $sistema->row();

        $this->session->set_userdata('sys_name', $consulta->nombre);

        redirect($var->prefijo . "/" . $var->controlador);
    }

    public function perfil() {

        $consulta['consulta'] = $this->Usuario_model->usuario_ver($this->session->userdata('usr_id'));

        $this->add_view("mensaje");
        $this->add_view("perfil", $consulta);
        $this->render();
    }

    public function perfil_cambiar_clave() {

        $password1 = $this->input->post('clave');
        $password2 = $this->input->post('clave2');

        if (!empty($password1) and ! empty($password2)) {
            if ((strlen($password1) < 6) or ( strlen($password1) > 12) or ( strlen($password2) < 6) or ( strlen($password2) > 12)) {

                $this->session->set_flashdata('data', 'La contraseña debe ser mayor a 6 y menor a 12 digitos.');
                $this->session->set_flashdata('tipo', 'warning');
                $this->perfil();
            } else {
                if ($password1 === $password2) {

                    $this->session->set_flashdata('data', 'La contraseña se ha cambiado satisfactoriamente.');
                    $this->Usuario_model->cambiar_password($this->session->userdata('usr_id'), (randomText(4) . md5("scrum" . $password1) . randomText(4)));
                    $this->perfil();
                } else {

                    $this->session->set_flashdata('data', 'Las contraseñas no coinciden.');
                    $this->session->set_flashdata('tipo', 'warning');
                    $this->perfil();
                }
            }
        } else {

            $this->session->set_flashdata('data', 'No se detectaron cambios.');
            $this->session->set_flashdata('tipo', 'warning');
            $this->perfil();
        }
    }

}
