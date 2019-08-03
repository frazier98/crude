<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Usuario;
use DB;
use Illuminate\Support\Facades\Storage;

class UsuariosController extends Controller
{
    var $context;

    public function listar_usuarios(){
        
        $usuarios = DB::table('usuarios')->get();
        
        return view("usuarios.listado_usuarios")->with("usuarios", $usuarios);
    }

    public function agregar_usuarios() {
        return view("usuarios.formulario_usuarios");
    }

    public function guardar_usuarios(Request $request) {
        $name_final="";
        
        if ($request->hasFile('foto_usuario')) {
            $nombre_imagen = $request->foto_usuario->getClientOriginalName();
            $archivo_ext = explode('.', $nombre_imagen);

            $file = $request->file('foto_usuario');
            $name = time().'.'.$archivo_ext[1];
            #dd($name);
            $file->move(public_path('img').'/images_noticias/', $name);
            $name_final=$name;
        }
         

   

        $insertar_usuario = DB::table('usuarios')
        ->insert(
            ['nom_usuario' => $request->nom_usuario, 'email' => $request->email, 'area' => $request->area, 'curriculum' => $request->curriculum, 'hijos' => $request->hijos,'intereses' => $request->intereses, 'foto' => $name_final]
        );

        return redirect(action('UsuariosController@listar_usuarios'));
    }

    

    public function obtenerUsuario($id_usuario){
        $buscar_usuario = DB::table('usuarios')
        ->where('id_usuario', '=', $id_usuario)
        ->get();


        return view("usuarios.formulario_usuarios")
        ->with("buscar_usuario",$buscar_usuario);
    }

    public function modificar_usuarios(Request $request) {
        //dd($request->all());
        $name_final = "";

        if ($request->foto_usuario == "") {
            $usuario = Usuario::find($request->id_usuario);
            $usuario->nom_usuario=$request->nom_usuario;
            $usuario->email=$request->email;
            $usuario->area=$request->area;
            $usuario->curriculum=$request->curriculum;
            $usuario->hijos=$request->hijos;
            $usuario->intereses=$request->intereses;
            $usuario->save();

            return redirect(action('UsuariosController@listar_usuarios'));

        }
        else {

            if ($request->hasFile('foto_usuario')) {
                $nombre_imagen = $request->foto_usuario->getClientOriginalName();
                $archivo_ext = explode('.', $nombre_imagen);

                $file = $request->file('foto_usuario');
                $name = time().'.'.$archivo_ext[1];
                #dd($name);
                $file->move(public_path('img').'/images_noticias/', $name);
                $name_final=$name;
            }

            $usuario = Usuario::find($request->id_usuario);
            $usuario->nom_usuario=$request->nom_usuario;
            $usuario->email=$request->email;
            $usuario->area=$request->area;
            $usuario->curriculum=$request->curriculum;
            $usuario->hijos=$request->hijos;
            $usuario->foto=$name_final;
            $usuario->save();

            return redirect(action('UsuariosController@listar_usuarios'));

        }
    }

    public function eliminar_usuarios($id_usuario) {
        $foto_usuario = Usuario::find($id_usuario);

        if(file_exists(public_path('img/images_noticias/'.$foto_usuario->foto))){
            unlink(public_path('img/images_noticias/'.$foto_usuario->foto));
        }

        $usuario = Usuario::find($id_usuario);
        $usuario->delete();

        
        return redirect(action('UsuariosController@listar_usuarios'));
    }

    //buscador
    public function mostrar_inicio_buscador() {
        return view('usuarios.buscador_usuarios');
    }

    public function buscar_usuario(Request $request) {
        $arreglo_usuario = DB::table('usuarios')
        ->where('nom_usuario', 'like', '%'.$request->nom_usuario_buscador.'%')->get();
        
         return view('usuarios.buscador_usuarios')->with('arreglo_usuario', $arreglo_usuario);
        
    }
}