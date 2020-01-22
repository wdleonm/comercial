<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grupo_controller extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model(MANEJADOR_CONFIG . '/Grupo_model');
        $this->load->model(MANEJADOR_CONFIG . '/Area_model');
    }

    public function index() {
        if (!$this->validate_access())
            return;

        $this->load->library('Template_table');

        // Datos para llenar la tabla basica
        $resultset = $this->Grupo_model->grupos();
        $controller = MANEJADOR_CONFIG . '/' . get_class();
        $titulo = 'Lista de Grupos';
        $table_headers = array(
            array("nombre", "Nombre", ""),
            array("descripcion", "Descripcion", "")
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
            $consulta['consulta'] = $this->Grupo_model->grupo_ver($id);
            if (!empty($consulta['consulta'])) {
                $consulta['areas'] = $this->Grupo_model->areas($id);
            } else {
                $consulta['consulta'] = "";
            }
        } else {
            $consulta['consulta'] = "";
        }
        $this->add_view(MANEJADOR_CONFIG . '/grupo_ver', $consulta);
        $this->render();
    }

    public function nuevo() {

        if (!$this->validate_access())
            return;

        $consulta['consulta'] = $this->Area_model->areas_final();
        $this->add_view(MANEJADOR_CONFIG . '/grupo_nuevo', $consulta);
        $this->render();
    }

    public function nuevo_guardar() {

        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        $areas = $this->input->post('areas');

        $this->Grupo_model->grupo_guardar($nombre, $descripcion, $areas);
        $this->session->set_flashdata('data', $nombre . ' Ha sido añadida a la base de datos.');
        redirect(MANEJADOR_CONFIG . '/grupo_controller/index');
    }

    public function editar($id = NULL) {

        if (!$this->validate_access())
            return;

        if (is_numeric($id)) {
            $consulta['consulta'] = $this->Grupo_model->grupo_ver($id);
            if (!empty($consulta['consulta'])) {
                $consulta['areas'] = $this->Grupo_model->areas($id);
                $consulta['l_areas'] = $this->Area_model->areas_final();
            } else {
                $consulta['consulta'] = "";
            }
        } else {
            $consulta['consulta'] = "";
        }

        $this->add_view(MANEJADOR_CONFIG . '/grupo_editar', $consulta);
        $this->render();
    }

    public function editar_guardar() {


        $id = $this->input->post('id');
        $descripcion = $this->input->post('descripcion');
        $nombre = $this->input->post('nombre');

        $this->Grupo_model->grupo_editar_guardar($nombre, $id, $descripcion);
        $this->session->set_flashdata('data', 'Se han actualizado los registros de ' . $nombre . '.');
        redirect(MANEJADOR_CONFIG . '/grupo_controller/index');
    }

    public function agregar_area() {


        $id = $this->input->post('id');
        $areas = $this->input->post('areas');

        $this->Grupo_model->agregar_area($id, $areas);
        redirect(MANEJADOR_CONFIG . '/grupo_controller/editar/' . $id);
    }

    public function eliminar_area() {

        $id = $this->input->post('id');
        $areas = $this->input->post('areas');

        $this->Grupo_model->eliminar_area($areas);
        redirect(MANEJADOR_CONFIG . '/grupo_controller/editar/' . $id);
    }

    public function borrar($id) {

        if (!$this->validate_access())
            return;

        if (is_numeric($id)) {
            $consulta = $this->Grupo_model->grupo_ver($id);
            if (!empty($consulta)) {
                $registro = $consulta->id . ', ' . $consulta->nombre . ', ' . $consulta->descripcion;
                if ($this->Grupo_model->eliminar_grupo($id, $registro)) {
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
