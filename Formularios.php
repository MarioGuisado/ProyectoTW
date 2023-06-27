<?php
	function HTMLNUEVA($x){
		$titulo = "";
		$descripcion = "";
		$lugar = "";
		$claves = "";
		if($x){
			$seleccionado = "disabled";
			$titulo = $_SESSION['titulo'];
			$descripcion = $_SESSION['descripcion'];
			$lugar = $_SESSION['lugar'];
			$claves = $_SESSION['claves'];
		}
		else{
			$seleccionado = "";
		}
		
		echo <<< HTML
		<h2>Nueva incidencia</h2>
		<form action="./index.php" method="POST" enctype="multipart/form-data">
			<fieldset class="nuevaincidencia">
				<legend>Datos principales: </legend>
				<p>
					<label>Titulo de la incidencia:
						<input type="text" name="titulo" placeholder="Introduzca el titulo de la incidencia" value="$titulo" $seleccionado required />
					</label>
				</p>
				<p>
					<label>Descripción:
						<input type="text" name="descripcion" placeholder="Introduzca la descripción de la incidencia" value="$descripcion" $seleccionado required />
					</label>
				</p>
				<p>
					<label>Lugar:
						<input type="text" name="lugar" placeholder="Introduzca el lugar ocurre la incidencia" value="$lugar" $seleccionado required />
					</label>
				</p>
				<p>
					<label>Palabras clave:
						<input type="text" name="claves" placeholder="Palabras Clave" value="$claves" $seleccionado required/>
					</label>
				</p>

			<input type="hidden" id="9.11">
		HTML;
		if($x){
			echo "<input type='submit' name='ConfirmarInsercion' value='Confirmar insercion'/>";
		}else{
			echo "<input type='submit' name='EnviarDatos' value='Enviar datos'/>";
		}
		echo "</fieldset>";
		echo "</form>";
	}

	function EDITARINCIDENCIA(){
	
		$seleccionado = "disabled";
		$titulo = $_SESSION['titulo'];
		$descripcion = $_SESSION['descripcion'];
		$lugar = $_SESSION['lugar'];
		$claves = $_SESSION['claves'];
		$habilitar = "";
		if($_SESSION['tipo'] != "Administrador"){
			$habilitar = "disabled";
		}
		
		echo <<< HTML
		<h2>Estado de la incidencia</h2>
		<form action="./index.php" method="POST" enctype="multipart/form-data">
			<fieldset class="incidencia">
				<input type="radio" name="radioGroup" value="Pendiente" $habilitar checked>
				<label for="radio1">Pendiente</label>
			  
				<input type="radio" name="radioGroup" $habilitar value="Comprobada">
				<label for="radio1">Comprobada</label>
			  
				<input type="radio" name="radioGroup" $habilitar value="Tramitada">
				<label for="radio2">Tramitada</label>
			  
				<input type="radio" name="radioGroup" $habilitar value="Irresoluble">
				<label for="radio3">Irresoluble</label>
			  
				<input type="radio" name="radioGroup" $habilitar value="Resuelta">
				<label for="radio4">Resuelta</label>
			  
				<input type="submit" value="EnviarEstado" $habilitar>
			</fieldset>
		</form>
		<h2>Nueva incidencia</h2>
		<form action="./index.php" method="POST" enctype="multipart/form-data">
			<fieldset class="incidencia">
				<legend>Datos principales: </legend>
				<p>
					<label>Titulo de la incidencia:
						<input type="text" name="titulo" placeholder="Introduzca el titulo de la incidencia" value="$titulo"  required />
					</label>
				</p>
				<p>
					<label>Descripción:
						<input type="text" name="descripcion" placeholder="Introduzca la descripción de la incidencia" value="$descripcion" required />
					</label>
				</p>
				<p>
					<label>Lugar:
						<input type="text" name="lugar" placeholder="Introduzca el lugar ocurre la incidencia" value="$lugar" required />
					</label>
				</p>
				<p>
					<label>Palabras clave:
						<input type="text" name="claves" placeholder="Palabras Clave" value="$claves" required/>
					</label>
				</p>

			<input type="hidden" id="9.11">
			<input type='submit' name='EnviarDatos' value='EnviarDatos'/>
			</fieldset>
			</form>
			<h2> Fotografías Adjuntas </h2>
			<form  action="./index.php" method="POST" enctype="multipart/form-data" class="fotos">
			 	<img src="" alt="Imagen"><input type="file" name="nuevaImg"/>
			  	<input type="submit" name='EnviarFotos' value='EnviarFotos' />
			</form>	
		HTML;	
	}
	function HTMLVER(){
		echo <<< HTML
		<h2>Criterios de búsqueda:</h2>
		<fieldset class="busqueda">
		<legend>Ordenar por</legend>
		<form action="./index.php" method="POST" enctype="multipart/form-data">
			<div class="busqueda1">
			<input type="radio" name="radioGroup" value="Antiguedad" checked>Antiguedad
		  
			<input type="radio" name="radioGroup"  value="Positivos">Número de positivos
		  
			<input type="radio" name="radioGroup"  value="PositivosNetos">Número de positivos netos
			</div>
			
			<div class="busqueda2">
			<p><label>Texto de búsqueda:<input type="text" name="textoBusqueda"/></label></p>
			<p><label>Lugar:<input type="text" name="textoLugar"/></label></p>
			</div>

			<div class="busqueda3">
			<label><input type="checkbox" name="Pendiente" checked>Pendiente</label>
		  	<label><input type="checkbox" name="Comprobada" checked>Comprobada</label>
		  	<label><input type="checkbox" name="Tramitada" checked>Tramitada</label>
		  	<label><input type="checkbox" name="Irresoluble"checked>Irresoluble</label>
		  	<label><input type="checkbox" name="Resuelta"checked>Resuelta</label>
		  	</div>
		  	
		  	<input type="submit" name='EnviarCriterios' value='EnviarCriterios' />
		</form>
		</fieldset>

		HTML;	
	}

	function RolSelccionado($x,$rol){
		if($x == $rol)
			echo "selected";
	}

	function EstadoSelccionado($x,$est){
		if($x == $est)
			echo "selected";
	}

	function EditarUsuario2(){
		$clave1 = isset($_POST['nuevaClave1']) ? $_POST['nuevaClave1'] : " ";
		$clave2 = isset($_POST['nuevaClave2']) ? $_POST['nuevaClave2'] : " ";
		if($clave1 == $clave2){
			$_SESSION['clave'] = $clave1;
			EditarUsuario(true,$_POST['tipoEditar']);
		}else{
			EditarUsuario(false,$_POST['tipoEditar']);
			echo "<p>Error, la nueva clave debe de ser igual en los dos campos</p>";
		}
	}

	function EditarUsuario($x,$yo){
		$url = $_SERVER['SCRIPT_NAME'];
		$correcto = true;
		if($x){
			$seleccionado = "readonly";
			$habilitar = "disabled";
			$foto = isset($_FILES['nuevaImg']['name'])? $_FILES['nuevaImg']['name']:$_POST['tipoImg'];
			$nombre = isset($_POST['nuevoNombre']) && !empty($_POST['nuevoNombre']) && is_string($_POST['nuevoNombre']) ? $_POST['nuevoNombre'] : NULL;
			$apellidos = isset($_POST['nuevoApellido']) && !empty($_POST['nuevoApellido']) && is_string($_POST['nuevoApellido']) ? $_POST['nuevoApellido'] : NULL;
			$email = isset($_POST['nuevoCorreo']) && filter_var($_POST['nuevoCorreo'],FILTER_VALIDATE_EMAIL) && !empty($_POST['nuevoCorreo'])? $_POST['nuevoCorreo'] : NULL;;
			$dir = isset($_POST['nuevaResidencia']) ? $_POST['nuevaResidencia'] : NULL;
			$tlfn = isset($_POST['nuevoTlf']) && preg_match('/(\(\+[0-9]{2}\))?\s*[0-9]{3}\s*[0-9]{6}/',$_POST['nuevoTlf'])? $_POST['nuevoTlf'] : NULL ;
			$estado = isset($_POST['estado']) ?  $_POST['estado'] : $_POST['tipoEstado'];
			$rol =isset($_POST['rol']) ? $_POST['rol'] :$_POST['tipoRol'];
		}else{
			if($_SESSION['tipo'] == "Administrador"){
				$habilitar = " ";
			}else{
				$habilitar = "readonly ";
			}
			$seleccionado = "";
			if($yo == $_SESSION['email']){
				$rol = $_SESSION['rol'];
				$foto = $_SESSION['foto'];
				$nombre = $_SESSION['nombre'];
				$apellidos = $_SESSION['apellidos'];
				$email = $_SESSION['email'];
				$dir = $_SESSION['direccion'];
				$tlfn = $_SESSION['tlfn'];
				$estado = $_SESSION['estado'];
			}else{
				$db = conexion();
	
				$consulta = "SELECT nombre,apellidos,passwd,email,foto,direccion,tlfn,admin,estado FROM USUARIOS WHERE email='$yo'";
				$res = $db->query($consulta);
				if($res){
					if(mysqli_num_rows($res)>0){
						while($tupla = $res->fetch_assoc()){
							$foto = $tupla['foto'];
							$nombre = $tupla['nombre'];
							$apellidos = $tupla['apellidos'];
							$email = $tupla['email'];
							$dir = $tupla['direccion'];
							$tlfn = $tupla['tlfn'];
							$estado = $tupla['estado'];
							$rol = $tupla['admin'];
						}
					}
				}
				desconexion($db);
			}
		}
		$tipoContenido = "image/png";
		$src = "data:$tipoContenido;base64,$foto";

		echo <<< HTML
		<form action="$url" method="POST" enctype="multipart/form-data">
			<h2>Edición de usuario</h2>
			<fieldset class="editarUsuario">
				<p>
					<label>Fotografía:  <img src="$src" alt="Imagen"><input type="file" name="nuevaImg" $seleccionado /></label>
				</p>
				<p>
					<label>Nombre:
		HTML;
		if(!is_null($nombre)){
			echo '<input type="text" name="nuevoNombre" value="'.$nombre.'" '.$seleccionado.'/>';
		}else{
			echo '<input type="text" name="nuevoNombre" />';
			echo $correcto = false;
		}
		echo <<< HTML
					</label>
				</p>
				<p>
					<label>Apellidos:</label>
		HTML;
		if(!is_null($apellidos)){
			echo '<input type="text" name="nuevoApellido" value="'.$apellidos.'" '.$seleccionado.'/>';
		}else{
			echo '<input type="text" name="nuevoApellido" />';
			echo $correcto = false;
		}
		echo <<< HTML
					</label>
				</p>
				<p>
					<label>Email:
		HTML;
		if(!is_null($email)){
			echo '<input type="text" name="nuevoCorreo" value="'.$email.'" '.$seleccionado.'/>';
		}else{
			echo '<input type="text" name="nuevoCorreo" />';
			echo $correcto = false;
		}
		echo <<< HTML
					</label>
				</p>
		HTML;
			if(!$x){
				echo <<< HTML
					<p>
						<label>Clave:
							<input type="text" name="nuevaClave1"  />
							<input type="text" name="nuevaClave2"  />
						</label>
					</p>
				HTML;
			}
		echo <<< HTML
				<p>
					<label>Dirección:
						<input type="text" name="nuevaResidencia" value="$dir" $seleccionado/>
					</label>
				</p>
				<p>
					<label>Teléfono:
		HTML;
		if(!is_null($tlfn)){
			echo '<input type="text" name="nuevoTlf" value="'.$tlfn.'" '.$seleccionado.'/>';
		}else{
			echo '<input type="text" name="nuevoTlf" />';
			echo $correcto = false;
		}
		echo <<< HTML
						<input type="text" name="nuevoTlf" value="$tlfn" $seleccionado/>
					</label>
				</p>
				<p>
					<label>Rol:
					<select name="rol" $habilitar $seleccionado>
						<option value='1'
		HTML;
				RolSelccionado("1",$rol);
				echo " >Administrador</option>";
				echo "<option value='0' ";
				RolSelccionado("0",$rol);
				echo ">Colaborador</option>";
				
		echo <<< HTML
					</select>
					</label>

				</p>
				<p>
					<label>Estado:
					<select name='estado' $habilitar $seleccionado>
				HTML;
					      echo "<option value='Activo' ";
					      EstadoSelccionado("Activo",$estado);
					      echo ">Activo</option>";
					      echo "<option value='Inactivo' ";
					      EstadoSelccionado("Inactivo",$estado);
					      echo ">Inactivo</option>";
					echo "</select>";
					echo "</label>";
				echo "</p>";
		echo "<input type='hidden' name='tipoEditar' value=".$email.">";
		echo "<input type='hidden' name='tipoRol' value=".$rol.">";
		echo "<input type='hidden' name='tipoEstado' value=".$estado.">";
		echo "<input type='hidden' name='tipoImg' value=".$foto.">";
		if($x && $correcto){			
			echo "<input type='submit' name='confirmarModificacion' value='Confirmar modificación'/>";
		}else{
			echo "<input type='submit' name='Modificacion' value='Modificar usuario'/>";
		}
		echo "</fieldset>";
		echo "</form>";
	}

	function NuevoUsuario(){
		$url = "./index.php?p=usuarios";
		echo <<< HTML
		<h2>Nuevo usuario</h2>
		<form method="post" action="$url" enctype="multipart/form-data">
		<fieldset class="nuevoUsuario">
			<p>
				<label>Fotografía: <input type="file" name="Img"/></label>
			</p>
			<p>
				<label>Nombre:
					<input type="text" name="nombre"/>
				</label>
			</p>
			<p>
				<label>Apellidos:</label>
					<input type="text" name="apellido"/>
				</label>
			</p>
			<p>
				<label>Email:
					<input type="text" name="correo"/>
				</label>
			</p>
			<p>
				<label>Clave:
					<input type="text" name="clave1"  />
					<input type="text" name="clave2"  />
				</label>
			</p>
			<p>
				<label>Dirección:
					<input type="text" name="Residencia" />
				</label>
			</p>
			<p>
				<label>Teléfono:
					<input type="text" name="Tlf" />
				</label>
			</p>
			<p>
				<label>Rol:
				<select name="rolUser">
					<option value='0'>Colaborador</option>
					<option value='1'>Administrador</option>
				</select>
				</label>
			</p>
			<p>
				<label>Estado:
				<select name="estadoUser">
				      <option value="Activo">Activo</option>
				      <option value="Inactivo">Inactivo</option>
				</select>
				</label>
			</p>
			<input type="hidden" id="9.11">
			<input type="hidden" name='tipoImg' value="NULL">
			<input type='submit' name='ConfUser' value='Crear usuario'/>
			<input type='submit' name='Cancelar' value='Cancelar'/>
			</fieldset>
			</form>

		HTML;
	}
	function ConfNuevoUsuario(){
		$url = "./index.php?p=usuarios";
		$correcto = true;
		$img = isset($_FILES['Img']['name']) ? $_FILES['Img']['name']: $_POST['tipoImg'];
		$nombre = isset($_POST['nombre']) && !empty($_POST['nombre']) && is_string($_POST['nombre']) ? $_POST['nombre']: NULL;
		$apellido = isset($_POST['apellido']) && !empty($_POST['apellido']) && is_string($_POST['apellido']) ? $_POST['apellido']: NULL;
		$email=isset($_POST['correo']) && filter_var($_POST['correo'],FILTER_VALIDATE_EMAIL) && !empty($_POST['correo'])? $_POST['correo'] : NULL;
		$telefono=isset($_POST['Tlf']) && preg_match('/(\(\+[0-9]{2}\))?\s*[0-9]{3}\s*[0-9]{6}/',$_POST['Tlf'])? $_POST['Tlf'] : NULL ;
		$clave = isset($_POST['clave1']) &&  isset($_POST['clave2']) && !empty($_POST['clave1']) &&  $_POST['clave2']===$_POST['clave1'] ? $_POST['clave1']: null;
		$direccion = isset($_POST['Residencia']) ? $_POST['Residencia']: NULL;
		$rol = isset($_POST['rolUser']) ? $_POST['rolUser']: $_POST['tipoRol'];
		$estado = isset($_POST['estadoUser']) ? $_POST['estadoUser']: $_POST['tipoEstado'];
		echo $img;
		echo <<< HTML
		<h2>Nuevo usuario</h2>
		<form method="post" action="$url" enctype="multipart/form-data">
		<fieldset class="nuevoUsuario">
			<p>
		HTML;
		if(!is_null($img)){
			echo "<label>Fotografía: <img src='".$img."' alt='Imagen'></label>";
		}else{
			echo '<label>Fotografía: <input type="file" name="Img" value="Hola" disabled/></label>';
		}
		echo <<< HTML
			</p>
			<p>
				<label>Nombre:
					<input type="text" name="nombre" 
		HTML;
		if(!is_null($nombre)){
			echo 'value="'.$nombre.'" readonly/>';
		}else{
			echo 'placeholder="Error: campo incorrecto"/>';
			$correcto = false;
		}
		echo <<< HTML
				</label>
			</p>
			<p>
				<label>Apellidos:</label>
					<input type="text" name="apellido" 
		HTML;
		if(!is_null($apellido)){
			echo 'value="'.$apellido.'" readonly/>';
		}else{
			echo 'placeholder="Error: campo incorrecto"/>';
			$correcto = false;
		}
		echo <<< HTML
				</label>
			</p>
			<p>
				<label>Email:
					<input type="text" name="correo" 
		HTML;
		if(!is_null($email)){
			echo 'value="'.$email.'" readonly/>';
		}else{
			echo 'placeholder="Error: campo incorrecto"/>';
			$correcto = false;
		}
		echo <<< HTML
				</label>
			</p>
			<p>
				<label>Clave:
					<input type="text" name="clave1"
		HTML;
		if(!is_null($clave)){
			echo 'value="'.$clave.'" readonly/>';
		}else{
			echo 'placeholder="Error: campo incorrecto"/>';
			$correcto = false;
		}
		echo <<< HTML
					<input type="text" name="clave2"
		HTML;
		if(!is_null($clave)){
			echo 'value="'.$clave.'" readonly/>';
		}else{
			echo 'placeholder="Error: campo incorrecto"/>';
			$correcto = false;
		}
		echo <<< HTML
				</label>
			</p>
			<p>
				<label>Dirección:
					<input type="text" name="Residencia" value="$direccion" readonly />
				</label>
			</p>
			<p>
				<label>Teléfono:
					<input type="text" name="Tlf"
		HTML;
		if(!is_null($telefono)){
			echo 'value="'.$telefono.'" readonly/>';
		}else{
			echo 'placeholder="Error: campo incorrecto"/>';
			$correcto = false;
		}
		echo <<< HTML
				</label>
			</p>
			<p>
				<label>Rol:
				<select name="rolUser" disabled>
					<option value='1'
		HTML;
				RolSelccionado("1",$rol);
				echo " >Administrador</option>";
				echo "<option value='0' ";
				RolSelccionado("0",$rol);
				echo ">Colaborador</option>";
		echo <<< HTML
				</select>
				</label>
			</p>
			<p>
				<label>Estado:
				<select name="estadoUser" disabled>
		HTML;
			echo "<option value='Activo' ";
			EstadoSelccionado("Activo",$estado);
			echo ">Activo</option>";
			echo "<option value='Inactivo' ";
			EstadoSelccionado("Inactivo",$estado);
			echo ">Inactivo</option>";
		echo <<< HTML
				</select>
				</label>
			</p>
			<input type="hidden" id="9.11">
		HTML;
		echo "<input type='hidden' name='tipoRol' value=".$rol.">";
		echo "<input type='hidden' name='tipoEstado' value=".$estado.">";
		echo "<input type='hidden' name='tipoImg' value=".$img.">";
		if($correcto){
			echo "<input type='submit' name='MeterUsuario' value='Confirmar'/>";
		}else{
			echo "<input type='submit' name='ConfUser' value='Crear usuario'/>";
		}
		echo <<< HTML
			<input type='submit' name='Cancelar' value='Cancelar'/>
			</fieldset>
			</form>

		HTML;
	}

	function CajaComentarios($id){
		echo <<< HTML
		<form method="POST" action="./index.php>
			<input type="text" name="Comentario" placeholder="Escriba un comentario..." required />
					</label>
			<input type="hidden" id="9.11">
			<input type="hidden" name="ID" value="$id" />
			<input type='submit' name='EnviarComentario' value='EnviarComentario'/>
		</form>
		HTML;
	}


?>