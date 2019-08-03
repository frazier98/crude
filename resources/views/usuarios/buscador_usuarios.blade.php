<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Buscador Usuarios</title>
	<link href="<?php echo url('/') ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo url('/') ?>/css/style.css" rel="stylesheet">
    <script src="<?php echo url('/')?>/js/jquery.min.js"></script>
    <script src="<?php echo url('/'); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo url('/') ?>/js/scripts.js"></script>
</head>
<body>
	<div class="container">
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
			
			<form action=" {{action('UsuariosController@buscar_usuario')}} " method="post">
				{{ csrf_field() }}
				
				<input type="text"  name="nom_usuario_buscador">
				<button type="submit"class="btn btn-warning" value="Buscar">Buscar Usuario</button>
			</form>
			@if(isset($arreglo_usuario))
				<div class="col-md-12">
                    <table class="table table-bordered">
                      <tr>
                        <td>NOMBRE</td>
                        <td>email</td>
                        <td>area</td>
                        <td>curriculum</td>
                        <td>foto</td>
                        <td>accion</td>                      
                      </tr>
                      @foreach($arreglo_usuario as $elemento)
                        <tr>
                            <td>{{$elemento->nom_usuario}}</td>
                            <td>{{$elemento->email}}</td>
                            <td>{{$elemento->area}}</td>
                            <td>{{$elemento->curriculum}}</td>
                             <td>
                            <img src="../../../practicas_individuales/practica8/public/img/images_noticias/{{$elemento->foto}}" style="width: 80%; height: 80%" alt="Card image cap">  
                                </td>
                            <td>
                            <a href="{{action('UsuariosController@eliminar_usuarios', $elemento->id_usuario)}}" class="btn btn-danger">ELIMINAR</a>
                            <a href=" {{action('UsuariosController@obtenerUsuario', $elemento->id_usuario)}} " class="btn btn-warning">MODIFICAR</a>
                            </td>
                            
                        </tr>
                      @endforeach

                     
                    </table>
                </div>
           
            
			@endif

		</div>
	</div>
</body>
</html>