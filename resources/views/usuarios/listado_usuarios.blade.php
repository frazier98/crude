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
    <div class="container-fluid">
      <div class="row">
            <div class="col-md-12">
              <ul class="nav nav-tabs">
                  <li class="nav-item"><a class="nav-link active" href="<?php echo url('/ListadoUsuarios'); ?>">Inicio</a></li>
                 </li>
               </ul>              
            </div> 
        </div>
        <div class="row">
          <div class="col-md-12">
			  
		  <!--espacion-->


	<br/>
    	<div class="col-md-12">
			
			
            <div style="float:right">
            
            </div>
            <br/>
            <br/>
			
	 <!--tabla-->
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						
						<th>
							Foto
						</th>
						<th>
						  Datos del usuario
						</th>
						<th>
						  Acciones
						</th>
						
					</tr>
				</thead>
				<tbody>

                @foreach($usuarios as $usuario)
                        <tr>
                            <td style="width: 30%; height: 30%">
                               <img src="<?php echo url('/') ?>/img/images_noticias/{{$usuario->foto}}" style="width: 20%; height: 20%" >  
                            </td>
                            <td> 
                            Nombre: {{$usuario->nom_usuario}}<br/>
                            Email: {{$usuario->email}}<br/>
                            Estado:  {{$usuario->area}}<br/>
                            Telefono: {{$usuario->curriculum}}<br/>
                            hijos: {{$usuario->hijos}}<br/>
                            intereses: {{$usuario->intereses}}<br/>
                            </td>
                           
                           
                            <td>
                            <a href="{{action('UsuariosController@eliminar_usuarios', $usuario->id_usuario)}}" class="btn btn-danger">ELIMINAR</a>
                            <a href=" {{action('UsuariosController@obtenerUsuario', $usuario->id_usuario)}} " class="btn btn-warning">MODIFICAR</a>
                            </td>
                            
                        </tr>
                      @endforeach
				
				</tbody>
			</table> 
			<a href="<?php echo url('/CrearUsuario')?>" class="btn btn-success" >Agregar</a>
		</div>
          </div>

      </div>

  </div>


   
  </body>
</html



