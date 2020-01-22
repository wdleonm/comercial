<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inicio extends MY_Controller {

    public function __construct() {
        parent:: __construct();
    }

    public function index() {
        if (!$this->validate_access())
            return;

        $sql = "select * From " . SYSTEM_SCHEME . ".area";
        $areas = $this->db->query($sql);
        $consulta['areas'] = $areas->num_rows();

        $sql = "select * From " . SYSTEM_SCHEME . ".grupo";
        $grupos = $this->db->query($sql);
        $consulta['grupos'] = $grupos->num_rows();

        $sql = "select * From " . SYSTEM_SCHEME . ".menuitem";
        $menus = $this->db->query($sql);
        $consulta['menus'] = $menus->num_rows();

        $sql = "select * From " . SYSTEM_SCHEME . ".usuario";
        $usuarios = $this->db->query($sql);
        $consulta['usuarios'] = $usuarios->num_rows();

        $this->add_view(MANEJADOR_CONFIG . '/inicio', $consulta);
        $this->render();
    }

}
