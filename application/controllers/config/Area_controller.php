<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Area_controller extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model(MANEJADOR_CONFIG . '/Area_model');
    }

    public function index() {

        if (!$this->validate_access())
            return;

        $this->load->library('Template_table');

        // Datos para llenar la tabla basica
        $resultset = $this->Area_model->areas();
        $controller = MANEJADOR_CONFIG . '/' . get_class();
        $titulo = 'Lista de Áreas';
        $table_headers = array(
            array("espacio", "Nombre", ""),
            array("ruta", "Ruta", ""),
            array("id_padre", "Id Padre", ""),
            array("id", "Id", "")
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
            $consulta['consulta'] = $this->Area_model->area_ver($id);
        } else {
            $consulta['consulta'] = "";
        }
        $this->add_view(MANEJADOR_CONFIG . '/area_ver', $consulta);
        $this->render();
    }

    public function nuevo() {

        if (!$this->validate_access())
            return;

        $consulta['consulta'] = $this->Area_model->padres();
        $this->add_view(MANEJADOR_CONFIG . '/area_nuevo', $consulta);
        $this->render();
    }

    public function nuevo_guardar() {

        $nombre = $this->input->post('nombre');
        $hpadre = $this->input->post('hpadre');
        $this->Area_model->area_guardar($nombre, $hpadre);
        $this->session->set_flashdata('data', 'Se han añadida a la base de datos.');
        redirect(MANEJADOR_CONFIG . '/area_controller/index');
    }

    public function editar($id = NULL) {

        if (!$this->validate_access())
            return;

        if (is_numeric($id)) {
            $consulta['consulta'] = $this->Area_model->area_ver($id);
            $consulta['padres'] = $this->Area_model->padres();
        } else {
            $consulta['consulta'] = "";
        }

        $this->add_view(MANEJADOR_CONFIG . '/area_editar', $consulta);
        $this->render();
    }

    public function editar_guardar() {

        $id = $this->input->post('id');
        $hpadre = $this->input->post('hpadre');
        $nombre = $this->input->post('nombre');
        $hpadre_old = $this->input->post('hpadre_old');

        if (empty($hpadre)) {
            $hpadre = $hpadre_old;
        }

        $this->Area_model->area_editar_guardar($nombre, $id, $hpadre);
        $this->session->set_flashdata('data', 'Se han actualizado los registros de ' . $nombre . '.');
        redirect(MANEJADOR_CONFIG . '/area_controller/index');
    }

    public function borrar($id) {

        if (!$this->validate_access())
            return;

        if (is_numeric($id)) {
            $consulta = $this->Area_model->area_ver($id);
            if (!empty($consulta)) {
                $registro = $consulta->id . ', ' . $consulta->ruta . ', ' . $consulta->id_padre;
                if ($this->Area_model->eliminar_area($id, $registro)) {
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
