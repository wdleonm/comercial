<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL);

        ini_set('error_reporting', E_ALL);
        $this->table_name = SYSTEM_SCHEME . '.usuario';
        $this->table2_name = SYSTEM_SCHEME . '.usuario_grupo';
        $this->table_seq = SYSTEM_SCHEME . '.usuario_id_seq';
        $this->view_name = SYSTEM_SCHEME . '.v_usuario_area';
    }

    public function get($usr)
    {
        return $this->db
            ->where('usuario', $usr)
            ->get($this->table_name);
    }

    public function is_valid($usuario, $clave)
    {
        $this->db->where('usuario', $usuario);
        $consulta = $this->db->get($this->table_name);

        if ($consulta->num_rows() > 0) {
            $consulta = $consulta->row();
         //   var_dump($clave); var_dump(substr($consulta->clave, 4, 32)); die();
            if (substr($consulta->clave, 4, 32) == $clave) {
                if ($consulta->estatus == 0) {
                    $this->session->set_flashdata('data', 'Usuario bloqueado.');
                    return FALSE;
                } else {
                    $this->session->set_userdata('usr_id', $consulta->id);
                    $this->session->set_userdata('usr_usuario', $consulta->usuario);
                    $this->session->set_userdata('sys_name', 'Página de Inicio');
                    return TRUE;
                }
            } else {
                $this->session->set_flashdata('data', 'Contraseña Incorrecta.');
                return FALSE;
            }
        } else {
            $this->session->set_flashdata('data', 'Usuario Incorrecto.');
            return FALSE;
        }
    }
    public function is_super($usr_id) {
        $cond = array(
            'id' => $usr_id,
        );
        $objUsuario = $this->db
                ->where($cond)
                ->get(SYSTEM_SCHEME . '.usuario')
                ->row();

        if ($objUsuario->super) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function has_access($usr_id, $ruta = array())
    {
         //  Si es un SuperUsuario no se valida nada más.
         if ($this->is_super($usr_id)) {
            return TRUE;
        }

        $r = '{';
        foreach ($ruta as $item) {
            $r .= ($r != '{') ? ',' : '';
            $r .= strtolower($item);
        }
        $r .= '}';

        $cond = array(
            'usr_id' => $usr_id,
            'rut_ruta' => $r,
        );
        $resultado = $this->db->where($cond)->get($this->view_name);

        if ($resultado->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function usuarios()
    {

        $consulta = $this->db->get($this->table_name);
        return $consulta->result();
    }


    public function estatus_usuarios(){

    $result = $this->db->query("SELECT id, estatus
	FROM sys_admin.usuario");
    return $result->result();





        
    }

    function usuario($usuario)
    {

        $consulta = $this->db->get_where($this->table_name, array('usuario' => $usuario));

        if ($consulta->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function correo($correo, $id)
    {

        if (!empty($id)) {
            $this->db->where('id <> ' . $id);
        }

        $this->db->where('email', $correo);
        $consulta = $this->db->get($this->table_name);

        if ($consulta->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function nuevo_guardar($usuario, $password, $nombre, $apellido, $correo, $grupos)
    {

        $datos = array(
            'usuario' => $usuario,
            'clave' => $password,
            'nombre' => mb_convert_encoding(mb_convert_case($nombre, MB_CASE_TITLE), "UTF-8"),
            'apellido' => mb_convert_encoding(mb_convert_case($apellido, MB_CASE_TITLE), "UTF-8"),
            'email' => $correo,
            'estatus' => 1
        );

        $this->db->insert($this->table_name, $datos);
        $id = $this->db->insert_id($this->table_seq);

        if (!empty($grupos)) {
            foreach ($grupos as $item) {

                $datos = array(
                    'hgrupo' => $item,
                    'husuario' => $id
                );

                $this->db->insert($this->table2_name, $datos);
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function usuario_ver($id)
    {

        $this->db->where('id', $id);
        $consulta = $this->db->get($this->table_name);
        return $consulta->row();
    }

    public function agregar_grupos_usuario($id, $grupos)
    {

        if (!empty($grupos)) {
            foreach ($grupos as $item) {

                $datos = array(
                    'hgrupo' => $item,
                    'husuario' => $id
                );
                $this->db->insert($this->table2_name, $datos);
            }
        }
    }

    public function eliminar_grupos_usuario($grupos)
    {

        if (!empty($grupos)) {
            foreach ($grupos as $item) {

                $this->db->where('id', $item);
                $this->db->delete($this->table2_name);
            }
        }
    }

    function editar_guardar($id, $password, $nombre, $apellido, $correo, $estatus)
    {

        $this->db->trans_begin();

        $datos = array(
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $correo,
            'estatus' => $estatus
        );

        if (!empty($password)) {
            $datos['clave'] = $password;
        }

        $this->db->where('id', $id);
        $this->db->update($this->table_name, $datos);


        $this->Auditoria_model->auditoria(DB_ACTION_UPDATE, $this->table_name, $id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function desactivar_usuario($id, $estatus_actual)
    {

        $this->db->trans_begin();

        // $datos = array(
        //     'estatus' => 0);

        if ($estatus_actual == 0) {

            $estatus_nuevo = 1;
        } else {
            $estatus_nuevo = 0;
        }

        $datos = array(
            'estatus' => $estatus_nuevo
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

    function eliminar_usuario($id, $registro)
    {

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

    public function validar_password($id, $password)
    {

        $this->db->where('id', $id);
        $consulta = $this->db->get($this->table_name);
        $consulta = $consulta->row();

        if ($consulta->clave == $password) {

            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function cambiar_password($id, $password)
    {

        $this->db->trans_begin();

        $datos = array(
            'clave' => $password
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

    //grafica
    function acceso_mes($usuario)
    {
        $result = $this->db->query("SELECT date_part('year', a.fecha) AS ANO, 
        date_part('month', a.fecha) AS MES,  
        COUNT(a.husuario) AS CONTEO, a.husuario,
        b.usuario as usuario,
        b.nombre as nombre
 FROM sys_admin.auditoria a
  join sys_admin.usuario b on a.husuario=b.id
      
 WHERE a.husuario=$usuario
        
 group by ano, mes, husuario,b.usuario, b.nombre
 order by ano, mes");
        return $result->result();
    }

    //     function acceso_dia($usuario)
    //     {
    //         $result = $this->db->query("SELECT date_part('day', fecha) AS DIA,  COUNT(husuario) AS CONTEO
    // FROM sys_admin.auditoria WHERE husuario=$usuario and date_part('year', fecha)='" . date("Y") . "'
    // GROUP BY  DIA ");
    //         return $result->result();
    //     }

    //     function acceso_total_año_mes_dia($usuario)
    //     {
    //         $result = $this->db->query("SELECT date_part('year', fecha) AS AÑO, date_part('month', fecha) AS MES, 
    //         date_part('day', fecha) AS DIA, COUNT(husuario) AS CONTEO
    // FROM sys_admin.auditoria
    // where husuario=$usuario
    // group by AÑO, MES, DIA
    // order by AÑO, MES, DIA
    // ");
    //         return $result->result();
    //     }
    //fin de grafica


}
