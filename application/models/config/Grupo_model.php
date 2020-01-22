<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grupo_model extends CI_Model {

    public function __construct() {
        parent:: __construct();

        $this->table_name = SYSTEM_SCHEME . '.grupo';
        $this->table2_name = SYSTEM_SCHEME . '.grupo_area';
        $this->table_seq = SYSTEM_SCHEME . '.grupo_id_seq';
        $this->view_name = SYSTEM_SCHEME . '.v_grupo_area';
    }

    public function grupos() {

        $consulta = $this->db->get($this->table_name);
        return $consulta->result();
    }

    public function grupo_guardar($nombre, $descripcion, $areas) {

        $this->db->trans_begin();

        $datos = array(
            'nombre' => $nombre,
            'descripcion' => $descripcion,
        );
        $this->db->insert($this->table_name, $datos);
        $id = $this->db->insert_id($this->table_seq);

        if (!empty($areas)) {
            foreach ($areas as $item) {

                $datos = array(
                    'harea' => $item,
                    'hgrupo' => $id);
                $this->db->insert($this->table2_name, $datos);
            }
        }

        $this->Auditoria_model->auditoria(DB_ACTION_INSERT, $this->table_name, $id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function grupo_ver($id) {

        $this->db->where('id', $id);
        $consulta = $this->db->get($this->table_name);
        return $consulta->row();
    }

    public function areas($id) {

        $this->db->where('grp_id', $id);
        $consulta = $this->db->get($this->view_name);
        return $consulta->result();
    }

    public function grupo_editar_guardar($nombre, $id, $descripcion) {

        $this->db->trans_begin();

        $datos = array(
            'nombre' => $nombre,
            'descripcion' => $descripcion);
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $datos);

        $this->Auditoria_model->auditoria(DB_ACTION_UPDATE, $this->table_name, $id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function eliminar_grupo($id, $registro) {

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

    public function agregar_area($id, $areas) {
        if (!empty($areas)) {
            foreach ($areas as $item) {

                $datos = array(
                    'harea' => $item,
                    'hgrupo' => $id);
                $this->db->insert($this->table2_name, $datos);
            }
        }
    }

    public function eliminar_area($areas) {
        if (!empty($areas)) {
            foreach ($areas as $item) {

                $this->db->where('id', $item);
                $this->db->delete($this->table2_name);
            }
        }
    }

    public function grupos_usuario($id) {

        $this->db->where('husuario', $id);
        $this->db->select('usuario_grupo.id, grupo.id as id_grupo, nombre, descripcion');
        $this->db->join($this->table_name, 'hgrupo = grupo.id');
        $consulta = $this->db->get(SYSTEM_SCHEME . '.usuario_grupo');
        return $consulta->result();
    }

}
