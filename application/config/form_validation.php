<?php

$config = array(
    'usuario_nuevo' => array(
        array(
            'field' => 'usuario',
            'label' => 'Usuario',
            'rules' => 'trim|required|callback_usuario'
        ), array(
            'field' => 'password1',
            'label' => 'Contraseña',
            'rules' => 'alpha_numeric|required|callback_password'
        ), array(
            'field' => 'nombre',
            'label' => 'Nombre',
            'rules' => 'trim|required'
        ), array(
            'field' => 'apellido',
            'label' => 'Apellido',
            'rules' => 'trim|required'
        ), array(
            'field' => 'correo',
            'label' => 'Correo',
            'rules' => 'trim|required|callback_correo'
        ), array(
            'field' => 'grupos[]',
            'label' => 'Grupos',
            'rules' => 'numeric'
        )
    ),
    'usuario_editar' => array(
    array(
            'field' => 'password1',
            'label' => 'Contraseña',
            'rules' => 'min_length[6]|max_length[12]'
        ), array(
            'field' => 'nombre',
            'label' => 'Nombre',
            'rules' => 'trim|required'
        ), array(
            'field' => 'apellido',
            'label' => 'Apellido',
            'rules' => 'trim|required'
        ), array(
            'field' => 'correo',
            'label' => 'Correo',
            'rules' => 'trim|required|callback_correo'
        ), array(
            'field' => 'grupos[]',
            'label' => 'Grupos',
            'rules' => 'numeric'
        )
    )
);
