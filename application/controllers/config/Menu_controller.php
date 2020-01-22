<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(MANEJADOR_CONFIG . '/Menu_model');
        $this->load->helper('types_helper');
        $this->load->helper('variables_helper');
    }

    public function index() {

        if (!$this->validate_access())
            return;

        $this->load->library('Template_table');

        // Datos para llenar la tabla basica
        $resultset = $this->Menu_model->menus();
        $controller = MANEJADOR_CONFIG . '/' . get_class();
        $titulo = 'Lista de Menu';
        $table_headers = array(
            array("id", "Id", ""),
            array("titulo", "Titulo", ""),
            array("descripcion", "Descripción", "")
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

    public function nuevo() {

        if (!$this->validate_access())
            return;

        $this->load->helper('types_helper');
        $id_sistema = $this->input->post('id_sistema');
        $consulta['bloqueo'] = 0;

        if (!empty($id_sistema)) {
            $consulta['bloqueo'] = 1;
            $consulta['menus_padres'] = $this->Menu_model->menus_padres($id_sistema);
            $consulta['metodos'] = $this->Menu_model->metodos($id_sistema);
            $consulta['id_sistema'] = $id_sistema;
        }


        $consulta['sistemas'] = $this->Menu_model->sistemas();
        $consulta['areas'] = $this->Menu_model->areas();
        $this->add_view(MANEJADOR_CONFIG . '/menu_nuevo', $consulta);
        $this->render();
    }

    public function nuevo_guardar() {

        $titulo = $this->input->post('titulo');
        $descripcion = convert_null($this->input->post('descripcion'));
        $icono = convert_null($this->input->post('icono'));
        $url = convert_null($this->input->post('url'));
        $orden = convert_null($this->input->post('orden'));
        $hpadre = convert_null($this->input->post('hpadre'));
        $harea = convert_null($this->input->post('harea'));
        $id_sistema = $this->input->post('id_sistema');

        $this->Menu_model->nuevo_guardar($titulo, $descripcion, $icono, $url, $orden, $hpadre, $harea, $id_sistema);
        $this->session->set_flashdata('data', $titulo . ' Ha sido añadida a la base de datos.');
        redirect(MANEJADOR_CONFIG . '/menu_controller/index');
    }

    public function ver($id = null) {

        if (!$this->validate_access())
            return;

        if (is_numeric($id)) {
            $consulta['consulta'] = $this->Menu_model->menu_ver($id);
            if (!empty($consulta['consulta'])) {
                $consulta['padre'] = $this->Menu_model->menu_ver($consulta['consulta']->hpadre);
                $consulta['metodo'] = $this->Menu_model->metodo($consulta['consulta']->harea);
            } else {
                $consulta['consulta'] = "";
            }
        } else {
            $consulta['consulta'] = "";
        }
        $this->add_view(MANEJADOR_CONFIG . '/menu_ver', $consulta);
        $this->render();
    }

    public function editar($id = null) {

        if (!$this->validate_access())
            return;

        $this->load->helper('types_helper');
        if (is_numeric($id)) {
            $consulta['consulta'] = $this->Menu_model->menu_ver($id);
            if (!empty($consulta['consulta'])) {
                $consulta['menus_padres'] = $this->Menu_model->menus_padres($consulta['consulta']->idsistema);
                $consulta['metodos'] = $this->Menu_model->metodos($consulta['consulta']->idsistema);
            } else {
                $consulta['consulta'] = "";
            }
        } else {
            $consulta['consulta'] = "";
        }
        $this->add_view(MANEJADOR_CONFIG . '/menu_editar', $consulta);
        $this->render();
    }

    public function editar_guardar() {

        $id = $this->input->post('id');
        $titulo = $this->input->post('titulo');
        $descripcion = convert_null($this->input->post('descripcion'));
        $icono = convert_null($this->input->post('icono'));
        $url = convert_null($this->input->post('url'));
        $orden = convert_null($this->input->post('orden'));
        $hpadre = convert_null($this->input->post('hpadre'));
        $harea = $this->input->post('harea');
        $id_area = convert_null($this->input->post('id_area'));

        //la tabla donde se seleccion el area tiene un error, si se cambia la pagina donde se selecciono el area,
        //no tomara el valor y lo dejara como nulo, si esta vacio se le asigna el valor que peseia antes.
        if (empty($harea)) {
            $harea = $id_area;
        }

        $this->Menu_model->editar_guardar($id, $titulo, $descripcion, $icono, $url, $orden, $hpadre, $harea);
        $this->session->set_flashdata('data', $titulo . ' Ha sido actualizado.');
        redirect(MANEJADOR_CONFIG . '/menu_controller/index');
    }

    public function borrar($id) {

        if (!$this->validate_access())
            return;

        if (is_numeric($id)) {
            $consulta = $this->Menu_model->menu_ver($id);
            if (!empty($consulta)) {
                $registro = $consulta->titulo . ', ' . $consulta->descripcion . ', ' . $consulta->harea;
                if ($this->Menu_model->eliminar_menu($id, $registro)) {
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
