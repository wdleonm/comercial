<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sistema_controller extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model(MANEJADOR_CONFIG . '/Sistema_model');
        $this->load->model(MANEJADOR_CONFIG . '/Area_model');
        $this->load->helper('variables_helper');
    }

    public function index() {

        if (!$this->validate_access())
            return;

        $this->load->library('Template_table');

        // Datos para llenar la tabla basica
        $resultset = $this->Sistema_model->sistemas();
        $controller = MANEJADOR_CONFIG . '/' . get_class();
        $titulo = 'Lista de Sistemas';
        $table_headers = array(
            array("nombre", "Nombre", ""),
            array("prefijo", "Prefijo", ""),
            array("controlador", "Controlador", "")
        );

        /* metodo , tooltip , color del boton , icono, contenido del boton */
        $table_button = array(
            array("ver", "", "btn btn-primary btn-sm", "fas fa-eye", "Ver"),
            array("editar", "", "btn btn-info btn-sm", "fas fa-edit", "Editar"),
            array("", "", "btn-danger delete_element btn-sm", "fas fa-trash", "Eliminar")
        );

        /* metodo , tooltip , color del boton , icono */
        $header_button = array(
            array("nuevo", "Nuevo", "btn-primary btn-sm", "fas fa-plus")
        );

        /* 1 con contraseña, 0 sin contraseña */
        $delete = 0;

        $this->add_view('mensaje');
        $vista = $this->template_table->basic_table($resultset, $table_headers, $table_button, $header_button, $titulo, $controller, $delete);
        $this->add_html($vista);
        $this->render();
    }

    public function ver($id = null) {

        if (!$this->validate_access())
            return;

        if (is_numeric($id)) {
            $consulta['consulta'] = $this->Sistema_model->sistema_ver($id);
            $consulta['area'] = $this->Area_model->area_ver($consulta['consulta']->idsistema);
        } else {
            $consulta['consulta'] = "";
        }
        $this->add_view(MANEJADOR_CONFIG . '/sistema_ver', $consulta);
        $this->render();
    }

    public function nuevo() {

        if (!$this->validate_access())
            return;

        $consulta['consulta'] = $this->Area_model->areas('array_length(ruta, 1) = 2');
        $this->add_view(MANEJADOR_CONFIG . '/sistema_nuevo', $consulta);
        $this->render();
    }

    public function nuevo_guardar() {

        $nombre = $this->input->post('nombre');
        $prefijo = convert_null($this->input->post('prefijo'));
        $controlador = $this->input->post('controlador');
        $harea = $this->input->post('harea');

        $this->Sistema_model->sistema_guardar($nombre, $prefijo, $controlador, $harea);
        $this->session->set_flashdata('data', 'Se han añadida a la base de datos.');
        redirect(MANEJADOR_CONFIG . '/sistema_controller/index');
    }

    public function editar($id = NULL) {

        if (!$this->validate_access())
            return;

        if (is_numeric($id)) {
            $consulta['consulta'] = $this->Sistema_model->sistema_ver($id);
            $consulta['areas'] = $this->Area_model->areas('array_length(ruta, 1) = 2');
            $nombre = $this->input->post('nombre');
            $prefijo = convert_null($this->input->post('prefijo'));
            $controlador = $this->input->post('controlador');
            $harea = $this->input->post('harea');
        } else {
            $consulta['consulta'] = "";
        }

        $this->add_view(MANEJADOR_CONFIG . '/sistema_editar', $consulta);
        $this->render();
    }

    public function editar_guardar() {

        $id = $this->input->post('id');
        $nombre = $this->input->post('nombre');
        $prefijo = convert_null($this->input->post('prefijo'));
        $controlador = $this->input->post('controlador');
        $harea = $this->input->post('harea');
        $estatus = $this->input->post('estatus');

        $this->Sistema_model->sistema_editar_guardar($id, $nombre, $prefijo, $controlador, $harea, $estatus);
        $this->session->set_flashdata('data', 'Se han actualizado los registros de ' . $nombre . '.');
        redirect(MANEJADOR_CONFIG . '/sistema_controller/index');
    }

    public function borrar($id) {

        if (!$this->validate_access())
            return;

        if (is_numeric($id)) {
            $consulta = $this->Sistema_model->sistema_ver($id);
            if (!empty($consulta)) {
                $registro = $consulta->id . ', ' . $consulta->idsistema . ', ' . $consulta->controlador;
                if ($this->Sistema_model->eliminar_sistema($id, $registro)) 
             {
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

}
