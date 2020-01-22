<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sistema_model extends CI_Model {

    public function __construct() {
        parent:: __construct();

        $this->table_name = SYSTEM_SCHEME . '.sistema';
        $this->table_seq = SYSTEM_SCHEME . '.sistema_id_seq';
    }

    public function sistemas() {

        $consulta = $this->db->get($this->table_name);
        return $consulta->result();
    }

    public function sistema_guardar($nombre, $prefijo, $controlador, $harea) {

        $this->db->trans_begin();

        $datos = array(
            'nombre' => $nombre,
            'prefijo' => $prefijo,
            'controlador' => $controlador,
            'idsistema' => $harea,
            'activo' => TRUE
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

    public function sistema_ver($id) {

        $this->db->where('id', $id);
        $consulta = $this->db->get($this->table_name);
        return $consulta->row();
    }

    public function sistema_editar_guardar($id, $nombre, $prefijo, $controlador, $harea, $estatus) {

        $this->db->trans_begin();

        $datos = array(
            'nombre' => $nombre,
            'prefijo' => $prefijo,
            'controlador' => $controlador,
            'idsistema' => $harea,
            'activo' => $estatus);

        $this->db->where('id', $id);
        $this->db->update($this->table_name, $datos);

        $this->Auditoria_model->auditoria(DB_ACTION_UPDATE, $this->table_name, $id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function eliminar_sistema($id, $registro) {

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
