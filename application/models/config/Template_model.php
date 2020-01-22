<?php

class Template_model extends CI_Model {

    /* Usuario */

    public function set_usuario($usr) {
        if (!$this->session->userdata('tmplt_usuario')) {
            $this->load->model(MANEJADOR_CONFIG . '/usuario_model');
            $user = $this->usuario_model->get($usr)->row();
            $this->session->set_userdata('tmplt_usuario', $user);
        }
        $this->usuario = $this->session->userdata('tmplt_usuario');
    }

    public function get_usuario() {
        return $this->usuario;
    }

    /* Sistema */

    public function set_sistema($id) {
        if (!$this->session->userdata('tmplt_sistema')) {
            $this->load->model(MANEJADOR_CONFIG . '/area_model');
            $area = $this->area_model->get($id)->row();
            $this->session->set_userdata('tmplt_sistema', $area);
        }
        $this->sistema = $this->session->userdata('tmplt_sistema');
    }

    public function get_sistema() {
        return $this->sistema;
    }

    /* Area */

    public function set_area($id) {
        if (!$this->session->userdata('tmplt_area')) {
            $this->load->model(MANEJADOR_CONFIG . '/area_model');
            $area = $this->area_model->get($id)->row();
            $this->session->set_userdata('tmplt_area', $area);
        }
        $this->area = $this->session->userdata('tmplt_area');
    }

    public function get_area() {
        return $this->area;
    }

    function get_menu($idsistema, $idpadre = null, $forzar = FALSE) {



        $this->load->helper('types');
        //echo "...".$idpadre." - ".$this->usuario->id." - ".$idsistema."...";
        $cond = array(
            'pid' => $idpadre,
            'usr_id' => $this->usuario->id,
            'idsistema' => $idsistema,
        );
        $rslt = $this->db
                        ->where($cond)
                        ->get(SYSTEM_SCHEME . '.v_menu_usuario' . "_" . $this->usuario->id)->result();
        //var_dump($rslt);
        // FIXME: Este proceso no es nada optimo, porque es un recorrido
        // recursivo.

        $menu = array();
        $prefijo = $this->Template_model->get_system_home($idsistema);

        //var_dump($rslt);

        for ($i = 0; $i < count($rslt); $i++) {

            $itemMenu = new stdClass();
            $itemMenu->icono = $rslt[$i]->icono;
            $itemMenu->titulo = $rslt[$i]->titulo;

            $id = $rslt[$i]->mnu_id;
            $ruta = pg_array_parse($rslt[$i]->ruta);

            if (!empty($ruta) and count($ruta) >= 4) {
                $ruta = array_reverse($ruta);

                $itemMenu->href = site_url($prefijo->prefijo . '/' . $ruta[1] . '/' . $ruta[0]);
            } else {
                $itemMenu->href = $prefijo->prefijo . '/' . $rslt[$i]->url;
            }
            $itemMenu->childs = $this->get_menu($idsistema, $id, TRUE);

            $menu[$i] = $itemMenu;
        }
        //var_dump($menu); 
        return $menu;
    }

    function get_all_systems() {
        $rslt = $this->db
                        ->get(SYSTEM_SCHEME . '.v_sistema')->result();

        return $rslt;
    }

    function get_user_systems($usuario) {
        
        $sql = "SELECT v_usuario_area.rut_arr_ruta[2] as id,v_usuario_area.rut_ruta[2] as nombre," . SYSTEM_SCHEME . ".v_sistema.pid," . SYSTEM_SCHEME . ".v_sistema.pnombre," . SYSTEM_SCHEME . ".sistema.nombre as ver
FROM " . SYSTEM_SCHEME . ".v_usuario_area
INNER JOIN " . SYSTEM_SCHEME . ".v_sistema
ON v_usuario_area.rut_arr_ruta[2] = " . SYSTEM_SCHEME . ".v_sistema.id
INNER JOIN " . SYSTEM_SCHEME . ".sistema
ON v_usuario_area.rut_arr_ruta[2] = " . SYSTEM_SCHEME . ".sistema.idsistema
WHERE (v_usuario_area.usr_usuario = '" . $usuario . "') and (v_usuario_area.rut_ruta[2] <> '')
GROUP BY v_usuario_area.rut_arr_ruta[2],v_usuario_area.rut_ruta[2]," . SYSTEM_SCHEME . ".v_sistema.pid," . SYSTEM_SCHEME . ".v_sistema.pnombre," . SYSTEM_SCHEME . ".sistema.nombre
ORDER BY " . SYSTEM_SCHEME . ".v_sistema.pid desc ,v_usuario_area.rut_arr_ruta[2]";


        $consulta = $this->db->query($sql);

        return $consulta->result();
    }

    function get_system_home($sistema) {
        $sql = "SELECT * FROM " . SYSTEM_SCHEME . ".sistema WHERE sistema.idsistema = '" . $sistema . "'";
        $consulta = $this->db->query($sql);

        return $consulta->row();
    }

    function get_system_name($nombre) {
        
        $sql = "SELECT nombre FROM " . SYSTEM_SCHEME . ".sistema WHERE sistema.prefijo = '" . $nombre . "'";
        $consulta = $this->db->query($sql);

        return $consulta->row();
    }

    public function usuario_menuvista($id) {

        $sql = "CREATE OR REPLACE VIEW " . SYSTEM_SCHEME . ".v_menu_usuario_" . $id . " AS 
 WITH t AS (
         SELECT m.pid, m.porden, m.id AS mnu_id, m.orden, m.titulo, m.descripcion, m.icono, m.harea, m.url, m.idsistema, u.id AS usr_id, u.usuario AS usr_usuario
           FROM " . SYSTEM_SCHEME . ".v_menu m, " . SYSTEM_SCHEME . ".usuario u
        )
 SELECT t.pid, t.porden, t.mnu_id, t.orden, t.titulo, t.descripcion, t.icono, t.harea, t.url, t.idsistema, t.usr_id, t.usr_usuario, ( SELECT v_area_ruta.ruta
           FROM " . SYSTEM_SCHEME . ".v_area_ruta
          WHERE v_area_ruta.id = t.harea) AS ruta, ( SELECT v_area_ruta.arr_ruta
           FROM " . SYSTEM_SCHEME . ".v_area_ruta
          WHERE v_area_ruta.id = t.harea) AS arr_ruta, ua.rut_id
   FROM t
   JOIN " . SYSTEM_SCHEME . ".v_usuario_area ua ON t.usr_id = ua.usr_id
  WHERE t.usr_id = '" . $id . "' AND (ua.rut_id IN ( SELECT v_area_ruta.arr_ruta[4] AS arr_ruta
      FROM " . SYSTEM_SCHEME . ".v_area_ruta
     WHERE v_area_ruta.id = t.harea))
	 group by t.pid, t.porden, t.mnu_id, t.orden, t.titulo, t.descripcion, t.icono, t.harea, t.url, t.idsistema, t.usr_id, t.usr_usuario, ua.rut_id,ruta,arr_ruta;

ALTER TABLE " . SYSTEM_SCHEME . ".v_menu_usuario
  OWNER TO postgres";
        $sql = " CREATE OR REPLACE VIEW " . SYSTEM_SCHEME . ".v_menu_usuario_" . $id . " AS with t AS 
(
SELECT 
	m.pid, 
	m.porden, 
	m.id AS mnu_id, 
	m.orden, 
	m.titulo, 
	m.descripcion, 
	m.icono, 
	m.harea, 
	m.url, 
	m.idsistema, 
	u.id AS usr_id, 
	u.usuario AS usr_usuario
FROM 
	" . SYSTEM_SCHEME . ".v_menu m, 
	" . SYSTEM_SCHEME . ".usuario u
)
 SELECT 
	t.pid, 
	t.porden, 
	t.mnu_id, 
	t.orden, 
	t.titulo, 
	t.descripcion, 
	t.icono, 
	t.harea, 
	t.url, 
	t.idsistema, 
	t.usr_id, 
	t.usr_usuario, 
	(SELECT v_area_ruta.ruta FROM " . SYSTEM_SCHEME . ".v_area_ruta WHERE v_area_ruta.id = t.harea) AS ruta, 
	(SELECT v_area_ruta.arr_ruta FROM " . SYSTEM_SCHEME . ".v_area_ruta WHERE v_area_ruta.id = t.harea) AS arr_ruta
	
FROM 
	t
JOIN 
	" . SYSTEM_SCHEME . ".v_usuario_area ua 
ON 
	t.usr_id = ua.usr_id
  WHERE 
	t.usr_id = '" . $id . "' 
	AND 
	(ua.rut_id IN (SELECT v_area_ruta.arr_ruta[4] AS arr_ruta FROM " . SYSTEM_SCHEME . ".v_area_ruta WHERE v_area_ruta.id = t.harea) or t.harea is null)
GROUP BY 
t.pid, t.porden, t.mnu_id, t.orden, t.titulo, t.descripcion, t.icono, t.harea, t.url, t.idsistema, t.usr_id, t.usr_usuario, ruta,arr_ruta
ORDER BY t.porden, t.orden;
ALTER TABLE " . SYSTEM_SCHEME . ".v_menu_usuario
  OWNER TO postgres";
        $consulta = $this->db->query($sql);
    }

}
