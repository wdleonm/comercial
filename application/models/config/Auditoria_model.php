<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auditoria_model extends CI_Model {

    public function __construct() {
        parent:: __construct();

        $this->table_name = SYSTEM_SCHEME . '.auditoria';
        $this->table2_name = SYSTEM_SCHEME . '.usuario';
    }

    public function auditoria($action, $table_name, $element_id, $registro = NULL) {

        $e = new Exception();
        $trace = $e->getTrace();
        $class = $trace[2]['class'];
        $method = $trace[2]['function'];
        $zona = strtolower('{' . $class . ', ' . $method . '}');

        $datos = array(
            'fecha' => date('Y-m-d h:i:s A'),
            'accion' => $action,
            'tabla' => $table_name,
            'id_elemento' => $element_id,
            'zona' => $zona,
            'husuario' => $this->session->userdata('tmplt_usuario')->id,
            'registro' => $registro,
            'nombre_pc' => gethostbyaddr($_SERVER['REMOTE_ADDR'])
        );

        $this->db->insert($this->table_name, $datos);
    }

    public function tablas() {

        $this->db->select('tabla');
        $this->db->group_by('tabla');
        $this->db->order_by('tabla');
        $consulta = $this->db->get($this->table_name);
        return $consulta->result();
    }

    public function usuarios() {

        $this->db->select("usuario.id, usuario ||' - ' || apellido ||' '|| nombre AS nombre");
        $this->db->join($this->table2_name, 'husuario = usuario.id');
        $this->db->group_by('usuario.id, nombre');
        $this->db->order_by('nombre');
        $consulta = $this->db->get($this->table_name);
        return $consulta->result();
    }

    public function auditoria_ajax($where) {

        $this->db->select("auditoria.id, to_char(fecha, 'HH12:MI:SS AM') AS hora, to_char(fecha, 'dd/mm/yyyy') AS fecha, accion, tabla, id_elemento, zona, nombre_pc, usuario ||' - ' || apellido ||' '|| nombre AS nombre");
        foreach ($where as $item) {
            $this->db->where($item);
        }
        $this->db->join($this->table2_name, 'husuario = usuario.id');
        $consulta = $this->db->get($this->table_name);
        return $consulta->result();
    }

    public function auditoria_ver($id) {

        $this->db->select("auditoria.id, to_char(fecha, 'HH12:MI:SS AM') AS hora, to_char(fecha, 'dd/mm/yyyy') AS fecha, accion, tabla, id_elemento, zona, registro, nombre_pc, usuario ||' - ' || apellido ||' '|| nombre AS nombre");
        $this->db->where('auditoria.id', $id);
        $this->db->join($this->table2_name, 'husuario = usuario.id');
        $consulta = $this->db->get($this->table_name);
        return $consulta->row();
    }

}
