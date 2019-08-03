//rutas CRUD preguntas
		/*Route::get('PreguntasEncuesta', 'EncuestasController@MostrarPreguntas');
		Route::post('PreguntasEncuesta2', 'EncuestasController@CrearPregunta');
		Route::get('PreguntasEncuesta/{id}', 'EncuestasController@ModificarPregunta');
		Route::post('PreguntasEncuesta', 'EncuestasController@Modificar_EliminarPregunta');
//rutas CRUD preguntas


<!--


 <div class="row">
    <div class="col-md-12">
        <a href="{{action('NoticiasController@formularioNoticia')}}" alt="Crear nueva noticia" class="btn btn-success">Crear noticia</a>  
      <br/>
      <br/>
    </div>
  </div>

  <div class="row" style="margin-right: -30px; margin-left: -30px;">
    <div class="col-md-12">
        <table class="table table-hover">
          <tr>
            <td>Titulo</td>
            <td>Subtitulo</td>
            <td>Autor</td>
            <td>Fecha Creacion</td>
            <td>Fotos</td>
          </tr>

          @foreach($lista_noticias as $noticias)
            <tr>
                <td><a href=" {{action('NoticiasController@obtenerNoticia', $noticias->idnoticia)}} ">{{$noticias->titulo}}</a></td>
                <td>{{$noticias->subtitulo}}</td>
                <td>{{$noticias->autor}}</td>
                <td>{{$noticias->fecha_creacion}}</td>
                <td><a href="{{action('NoticiasController@ListarFotosNoticia', $noticias->idnoticia)}}">Fotos</a></td>
            </tr>
          @endforeach
        </table>
    </div>
  </div>



  <script type="text/javascript">
    $(function(){

      $(".eliminarNoticia").click(function(){
        var resp = confirm("¿Realmente desea eliminar esta noticia?");
        if(resp){
          $(this).parent().submit();
        }
      });

    });
</script>
 <?php /******************************************/?>

        </div>
    </div>
</div>
-->




public function mostrarIndicadores(){
        $bo = new BusinessObject([]);
        
        return view("indicadores");
    }

    public function mostrarDetalleIndicador(){
        $bo = new BusinessObject([]);
        
        return view("detalleIndicador");
    }

    //metodos de noticias (administrador)

    public function listarNoticias(){
    	$lista_noticias = DB::table('noticias')->get();

    	return view("/noticias/lista_noticias")
    	->with("lista_noticias",$lista_noticias)->with("title","Información");
    }

    public function formularioNoticia(){
        return view("/noticias/formulario_noticia")->with("title","Información");
    }

    public function GuardarNoticia(Request $request) {
        $insertar_noticia = DB::table('noticias')
        ->insert(
            ['titulo' => $request->titulo, 'subtitulo' => $request->subtitulo, 'autor' => $request->autor, 'noticia' => $request->cuerpo_noticia, 'foto_noticia' => 'sin imagen', 'vistas'  => 0, 'fecha_creacion' => $request->fecha_creacion]
        );

        return redirect(action('NoticiasController@listarNoticias'));
    }

    public function obtenerNoticia($idnoticia){
        $buscar_noticia = DB::table('noticias')
        ->where('idnoticia', '=', $idnoticia)
        ->get();


        return view("/noticias/formulario_noticia")
        ->with("buscar_noticia",$buscar_noticia)
        ->with("title","Información");
    }

    public function Modificar_EliminarNoticia(Request $request) {
        if (isset($request->btnActualizar)) {

            $noticia = Noticia::find($request->idnoticia);
            $noticia->titulo=$request->titulo;
            $noticia->subtitulo=$request->subtitulo;
            $noticia->autor=$request->autor;
            $noticia->noticia=$request->cuerpo_noticia;
            $noticia->fecha_creacion=$request->fecha_creacion;
            $noticia->save();
        }

        elseif(isset($request->btnEliminar)){
            $noticia = Noticia::find($request->idnoticia);
            $noticia->delete();

            $fotos_carpeta = DB::table('fotos_noticias')
            ->where('idnoticia', '=', $request->idnoticia)->get();

            for ($i=0; $i < count($fotos_carpeta); $i++) { 
                if(file_exists(public_path('img/images_noticias/'.$fotos_carpeta[$i]->foto_noticia))){
                    unlink(public_path('img/images_noticias/'.$fotos_carpeta[$i]->foto_noticia));
                }

            }

            $fotos_DB = DB::table('fotos_noticias')
            ->where('idnoticia', '=', $request->idnoticia);
            $fotos_DB->delete();      
        }


        return redirect(action('NoticiasController@listarNoticias'))
        ->with("title","Información");
    }

    //metodos fotos noticias
    public function ListarFotosNoticia($idnoticia) {
        $fotos_noticias = DB::table('fotos_noticias')
        ->where('idnoticia', '=', $idnoticia)
        ->orderBy('idfoto_noticia', 'ASC')
        ->get();

        return view('noticias.FotosNoticias.listado_FotosNoticias')
        ->with('fotos_noticias', $fotos_noticias)
        ->with('idnoticia', $idnoticia)
        ->with('title', 'Fotos Noticias');
    }

    public function AgregarImagen($idnoticia) {
        return view('noticias.FotosNoticias.formulario_FotosNoticias')
        ->with('idnoticia', $idnoticia)
        ->with('title', 'Agregar Imagen');
    }

    public function GuardarFotoNoticia(Request $request) {

        $valida_img = DB::table('fotos_noticias')
        ->where('idnoticia', '=', $request->idnoticia)
        ->get();
        
        foreach ($valida_img as $validar) {
            if ($validar->tipo_foto == $request->tipo_foto && $request->tipo_foto == 1) {
                return redirect(action('NoticiasController@ListarFotosNoticia', $request['idnoticia']))
               ->with('title', 'Fotos Noticias');
            }
        }

        if ((!isset($request->foto_noticia)) || (!isset($request->tipo_foto))) {
            return redirect(action('NoticiasController@ListarFotosNoticia', $request['idnoticia']));
        }

        if ($request->hasFile('foto_noticia')) {
            $nombre_imagen = $request->foto_noticia->getClientOriginalName();
            $archivo_ext = explode('.', $nombre_imagen);

            $file = $request->file('foto_noticia');
            $name = time().'_'.$request->idnoticia.'.'.$archivo_ext[1];
            $file->move(public_path('img').'/images_noticias/', $name);
            
        }
         $insertar_foto = DB::table('fotos_noticias')->insert(
            ['idnoticia' => $request->idnoticia, 'foto_noticia' => $name, 'tipo_foto' => $request->tipo_foto]
            );

        return redirect(action('NoticiasController@ListarFotosNoticia', $request['idnoticia']))
        ->with('title', 'Fotos Noticias');
    }

    public function ObtenerFoto($idfoto_noticia) {
        $buscar_foto = DB::table('fotos_noticias')->where('idfoto_noticia', '=', $idfoto_noticia)->get();
        return view('noticias.FotosNoticias.formulario_FotosNoticias')
        ->with('buscar_foto', $buscar_foto)
        ->with('title', 'Modificar');
    }

    public function Modificar_EliminarFoto(Request $request) {
       

        if (isset($request->btnActualizar)) {
            //Buscamos las fotos para poder validar despues
            $valida_img = DB::table('fotos_noticias')
            ->where('idnoticia', '=', $request->idnoticia)
            ->get();
            
            //recorremos todas las imagenes para saber si existen imagenes principales, en caso de ser cierto te regresa al listado de las fotos
            foreach ($valida_img as $validar) {
                if ($validar->tipo_foto == $request->tipo_foto && $request->tipo_foto == 1) {
                    return redirect(action('NoticiasController@ListarFotosNoticia', $request['idnoticia']))
                   ->with('title', 'Fotos Noticias');
                }
            }

            //preguntamos si en el request continene algun archivo
            if (!isset($request->foto_noticia)) {
                $foto = fotos_noticias::find($request->idfoto_noticia);
                $foto->tipo_foto = $request->tipo_foto;
                $foto->save();
            }

            else {
                $foto_noticia = fotos_noticias::find($request->idfoto_noticia);
                //preguntamos si existe un archivo en la carpeta img/images_noticias para eliminarlo de la carpeta y solo dejar la nueva imagen del usuario
                if(file_exists(public_path('img/images_noticias/'.$foto_noticia->foto_noticia))){
                    unlink(public_path('img/images_noticias/'.$foto_noticia->foto_noticia));
                }

                if ($request->hasFile('foto_noticia')) {
                   $nombre_imagen = $request->foto_noticia->getClientOriginalName();
                   $archivo_ext = explode('.', $nombre_imagen);

                   $file = $request->file('foto_noticia');
                   $name = time().'_'.$request->idnoticia.'.'.$archivo_ext[1];
                   $file->move(public_path('img').'/images_noticias/', $name);
                }

                $foto = fotos_noticias::find($request->idfoto_noticia);
                $foto->foto_noticia = $name;
                $foto->tipo_foto = $request->tipo_foto;
                $foto->save();

                
            }

            

        }

        elseif(isset($request->btnEliminar)){
            $foto_noticia = fotos_noticias::find($request->idfoto_noticia);
            $foto_noticia->delete();
               
            //preguntamos si existe un archivo en la carpeta img/images_noticias para eliminarlo
            if(file_exists(public_path('img/images_noticias/'.$foto_noticia->foto_noticia))){
                unlink(public_path('img/images_noticias/'.$foto_noticia->foto_noticia));
            }
        }


        return redirect(action('NoticiasController@ListarFotosNoticia', $request['idnoticia']))
        ->with("title","Fotos Noticias");
    }

/**** Nuevo *****/
    public function ListadoNoticiasInicio(){

        $noticias_inicio = DB::table('noticias')
        ->orderBy("fecha_creacion", "DESC")
        ->take(5)
        ->get();

        $fotos_noticias_inicio = DB::table('fotos_noticias')->get();
        

        $arreglo_noticias_inicio = array();
        $contador_primera = 0;
        foreach ($noticias_inicio as $noticia) {
            $llave_primera = $contador_primera;
            $arreglo_noticias_inicio[$contador_primera] = array(
                'idnoticia' => $noticia->idnoticia,
                'titulo' => $noticia->titulo,
                'subtitulo' => $noticia->subtitulo,
                'autor' => $noticia->autor,
                'noticia' => $noticia->noticia,
                'vistas' => $noticia->vistas,
                'fecha_creacion' => $noticia->fecha_creacion,
                'fotos' => array()
            );
            foreach ($fotos_noticias_inicio as $foto_noticia) {
                if (isset($foto_noticia->idnoticia)) {
                    if ($foto_noticia->idnoticia == $noticia->idnoticia) {
                        $arreglo_noticias_inicio[$contador_primera]['fotos'][] = array(
                            'tipo_foto' => $foto_noticia->tipo_foto,
                            'foto' => $foto_noticia->foto_noticia
                        );
                    }
                }
            }
            $contador_primera++;
        }

        $fecha = date('d-m-Y');

        return view('noticias.ListadoNoticiasInicio')
        ->with('arreglo_noticias_inicio', $arreglo_noticias_inicio)
        ->with('fecha', $fecha);
    }

}
