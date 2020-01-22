<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auditoria_controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(MANEJADOR_CONFIG . '/Auditoria_model');
        $this->load->helper('types_helper');
    }

    public function index()
    {

        if (!$this->validate_access())
            return;

        $this->add_view('mensaje');
        $consulta['tablas'] = $this->Auditoria_model->tablas();
        $consulta['usuarios'] = $this->Auditoria_model->usuarios();
        $this->add_view(MANEJADOR_CONFIG . '/index_auditoria', $consulta);
        $this->render();
    }

    public function ver($id = null)
    {

        if (!$this->validate_access())
            return;

        if (is_numeric($id)) {
            $consulta['consulta'] = $this->Auditoria_model->auditoria_ver($id);
            if (!empty($consulta['consulta'])) {
                $consulta['area'] = pg_array_parse($consulta['consulta']->zona);
            } else {
                $consulta['consulta'] = "";
            }
        } else {
            $consulta['consulta'] = "";
        }
        $this->add_view(MANEJADOR_CONFIG . '/auditoria_ver', $consulta);
        $this->render();
    }

    public function auditoria_ajax()
    {
        $accion = $this->input->post('accion');
        $tabla = $this->input->post('tabla');
        $usuario = $this->input->post('usuario');
       
        if (!empty($tabla)) {
            $where[] = "tabla = '" . $tabla . "'";
        }
        if (!empty($usuario)) {
            $where[] = "husuario = " . $usuario;
        }
        if (!empty($accion)) {
            $where[] = "accion = '" . $accion . "'";
        }
       

        if (!empty($where)) {
            $consulta = $this->Auditoria_model->auditoria_ajax($where);
            echo json_encode($consulta);
        }
    }
}
