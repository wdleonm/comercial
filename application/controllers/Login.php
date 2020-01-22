<?php

class Login extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model(MANEJADOR_CONFIG . '/usuario_model');
       // $this->load->library('My_PHPMailer','mailer');
    }

    public function index() {
        $this->load->view('login');
    }

    public function iniciar_sesion() {
        $usuario = $this->input->post('usuario');
        $password = hash('md5', "scrum" . $this->input->post('password'));
        $is_valid = $this->usuario_model->is_valid($usuario, $password);

        if ($is_valid) {
            redirect('inicio');
        } else {
            redirect('login');
        }
    }

    public function cerrar_sesion() {
        $this->session->sess_destroy();
        redirect('login');
    }

}
