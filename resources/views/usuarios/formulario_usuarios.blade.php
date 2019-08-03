<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
     <link href="<?php echo url('/') ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo url('/') ?>/css/style.css" rel="stylesheet">
    <script src="<?php echo url('/')?>/js/jquery.min.js"></script>
    <script src="<?php echo url('/'); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo url('/') ?>/js/scripts.js"></script>

      
    <body>
        <div class="container" >
        <div class="row">
          <div class="col-md-12">
              <ul class="nav nav-tabs">
                  <li class="nav-item"><a class="nav-link active" href="<?php echo url('/ListadoUsuarios'); ?>">Inicio</a></li>
                
     
                </li>
                  

              </ul>              
          </div>          
      </div>
      <br/>
        
            <div class="row">
                <div class="col-md-12">
                    <div class="row" align="right">
                            <div class="col-md-12">
                                <a class="btn btn-primary" href=" {{action('UsuariosController@listar_usuarios')}} ">Regresar</a>
                            </div>
                        </div>
                        <br>
                    <div class="panel panel-info">
                        @if(isset($buscar_usuario))
                        <div class="panel-body">
                            <form action=" {{action('UsuariosController@modificar_usuarios')}} " method="post" files="true" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <input type="hidden" name="id_usuario" value=" {{$buscar_usuario[0]->id_usuario}} ">
                                        <label>Nombre</label>
                                        <input type="text" autocomplete="true" name="nom_usuario" class="form-control" placeholder="Nombre" value=" {{$buscar_usuario[0]->nom_usuario}} ">
                                        <br>

                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control" placeholder="" value=" {{$buscar_usuario[0]->email}} ">
                                        
                                        <label>telefono</label>
                                        <input type="text" name="curriculum" class="form-control" value=" {{$buscar_usuario[0]->curriculum}} ">

                                        <label>Estado Civil</label>
                                        <input type="text" name="area" class="form-control" placeholder="" value=" {{$buscar_usuario[0]->area}} ">

                                        <label>¿Tines hijos?</label>
                                        <input type="text" name="hijos" class="form-control" placeholder="" value=" {{$buscar_usuario[0]->hijos}} ">

                                        <label>Intereses</label>
                                        <input type="text" name="intereses" class="form-control" placeholder="" value=" {{$buscar_usuario[0]->intereses}} ">

                                        <label>Foto del usuario</label>
                                        <input type="file" name="foto_usuario" class="form-control" placeholder="foto" value="{{$buscar_usuario[0]->foto}}">

                                        <br>
                                        <br>
                                        <br>

                                        <button class="btn btn-primary" type="submit" value="guardar">Guardar Cambios</button>
                                    </div>

                                </div>
                            </form>
                            <a href=" {{action('UsuariosController@listar_usuarios')}} " class="btn btn-warning">CANCELAR</a>
                        </div>
                        @else
                       
                        <div class="panel-body">
                            <form action=" {{action('UsuariosController@guardar_usuarios')}} " method="post" files="true" enctype="multipart/form-data">                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="form-group col-md-8">

                                        <label>Nombre</label>
                                        <input type="text" autocomplete="true" name="nom_usuario" class="form-control" placeholder="Nombre del usuario" value="">
                                        <br>

                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control" placeholder="" value="">
                                        
                                        <label>Telefono</label>
                                        <input type="text" name="curriculum" class="form-control" value="">

                                        <label>Estado civil </label>
                                   
                                          <select class="form-control" name="area">
                                            <option value="Soltero">Soltero</option>
                                            <option value="Casado">Casado</option>
                                          </select>
                                          <label>¿tines hijos? </label>
                                          <label>si
                                          <input type="radio" name="hijos" class="form-control" value="si">
                                          </label>
                                          <label>no
                                          <input type="radio" name="hijos" class="form-control" value="no">
                                          </label>
                                          <br>
                                          <label>intereses </label>
                                          <label>libros 
                                          <input type="checkbox" name="intereses" class="form-control" value="libros">
                                          </label>
                                          <label>Musica
                                          <input type="checkbox" name="intereses" class="form-control" value="Musica">
                                          </label>
                                          <label>Deportes
                                          <input type="checkbox" name="intereses" class="form-control" value="Deportes">
                                          </label>
                                          <label>Otros
                                          <input type="checkbox" name="intereses" class="form-control" value="Otros">
                                          </label>
                                          <br>
                                           

                                        <label>Foto del usuario</label>
                                        <input type="file" name="foto_usuario" class="form-control" placeholder="foto" value="">

                                        <br>
                                        <br>
                                        <br>

                                        <button class="btn btn-primary" type="submit" value="guardar">AGREGAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                         @endif
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


