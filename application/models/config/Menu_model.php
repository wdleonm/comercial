<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_model extends CI_Model {

    public function __construct() {
        parent:: __construct();

        $this->table_name = SYSTEM_SCHEME . '.menuitem';
        $this->table_seq = SYSTEM_SCHEME . '.menuitem_id_seq';
        $this->view_name = SYSTEM_SCHEME . '.v_area_ruta';
    }

    public function menus() {

        $consulta = $this->db->get($this->table_name);
        return $consulta->result();
    }

    public function menus_padres($id_sistema) {

        $this->db->where('hpadre IS NULL');
        $this->db->where('idsistema', $id_sistema);
        $consulta = $this->db->get($this->table_name);
        return $consulta->result();
    }

    public function areas() {

        $this->db->where('array_length(ruta, 1) = 1');
        $consulta = $this->db->get($this->view_name);
        return $consulta->result();
    }

    public function sistemas() {

        $this->db->where('array_length(ruta, 1) = 2');
        $consulta = $this->db->get($this->view_name);
        return $consulta->result();
    }

    public function metodos($id_sistema) {

        $consulta = $this->db->query('SELECT * FROM ' . $this->view_name . ' WHERE array_length(ruta, 1) = 4 AND arr_ruta[2] = ' . $id_sistema);
        return $consulta->result();
    }

    public function nuevo_guardar($titulo, $descripcion, $icono, $url, $orden, $hpadre, $harea, $id_sistema) {

        $this->db->trans_begin();

        $datos = array(
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'icono' => $icono,
            'url' => $url,
            'orden' => $orden,
            'hpadre' => $hpadre,
            'harea' => $harea,
            'idsistema' => $id_sistema
        );

        $this->db->insert($this->table_name, $datos);

        $id = $this->db->insert_id($this->table_seq);
        $this->Auditoria_model->auditoria(DB_ACTION_INSERT, $this->table_name, $id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function editar_guardar($id, $titulo, $descripcion, $icono, $url, $orden, $hpadre, $harea) {

        $this->db->trans_begin();

        $datos = array(
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'icono' => $icono,
            'url' => $url,
            'orden' => $orden,
            'hpadre' => $hpadre,
            'harea' => $harea,
        );

        $this->db->where('id', $id);
        $this->db->update($this->table_name, $datos);

        $this->Auditoria_model->auditoria(DB_ACTION_UPDATE, $this->table_name, $id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function menu_ver($id) {

        $this->db->where('id', $id);
        $consulta = $this->db->get($this->table_name);
        return $consulta->row();
    }

    public function metodo($id) {

        $this->db->where('id', $id);
        $consulta = $this->db->get($this->view_name);
        return $consulta->row();
    }

    function eliminar_menu($id, $registro) {

        $this->db->trans_begin();

        $this->db->where('id', $id);
        $this->db->delete($this->table_name);

        $this->Auditoria_model->auditoria(DB_ACTION_DELETE, $this->table_name, $id, $registro);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

}
