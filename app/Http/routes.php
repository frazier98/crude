<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//usuarios
Route::get('ListadoUsuarios', 'UsuariosController@listar_usuarios');
Route::get('CrearUsuario', 'UsuariosController@agregar_usuarios');
Route::post('Usuarios', 'UsuariosController@guardar_usuarios');
Route::get('ModificarUsuarios/{id}', 'UsuariosController@obtenerUsuario');
Route::post('ModificarUsuarios2', 'UsuariosController@modificar_usuarios');
Route::get('EliminarUsuarios2/{id}', 'UsuariosController@eliminar_usuarios');

//buscador
Route::get('BuscadorUsuarios', 'UsuariosController@mostrar_inicio_buscador');
Route::post('BuscadorUsuarios2', 'UsuariosController@buscar_usuario');
