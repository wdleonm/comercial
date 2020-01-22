<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Area_model extends CI_Model {

    public function __construct() {
        parent:: __construct();

        $this->table_name = SYSTEM_SCHEME . '.area';
        $this->table_seq = SYSTEM_SCHEME . '.area_id_seq';
        $this->view_name = SYSTEM_SCHEME . '.v_area_ruta';
    }

    public function areas($where = '') {

        if (!empty($where)){
            $this->db->where($where);
        }
        $consulta = $this->db->get($this->view_name);
        return $consulta->result();
    }

    public function get($id) {

        return $this->db->where('id', $id)->get($this->table_name);
    }

    public function areas_final() {

        $this->db->where('array_length(ruta, 1) = 4');
        $consulta = $this->db->get($this->view_name);
        return $consulta->result();
    }

    public function padres() {

        $consulta = $this->db->get($this->view_name);
        return $consulta->result();
    }

    public function area_guardar($nombre, $hpadre) {

        if (!is_array($nombre)) {
            $nombre = Array($nombre);
        }

        foreach ($nombre AS $item) {

            if (!empty($item)) {

                $this->db->trans_begin();

                $datos = array(
                    'nombre' => $item,
                    'hpadre' => $hpadre,
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
        }
    }

    public function area_ver($id) {

        $this->db->where('id', $id);
        $consulta = $this->db->get($this->view_name);
        return $consulta->row();
    }

    public function area_editar_guardar($nombre, $id, $hpadre) {

        $this->db->trans_begin();

        $datos = array(
            'nombre' => $nombre,
            'hpadre' => $hpadre);
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $datos);

        $this->Auditoria_model->auditoria(DB_ACTION_UPDATE, $this->table_name, $id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function eliminar_area($id, $registro) {

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
