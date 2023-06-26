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
			<fieldset class="incidencia">
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
			echo "<input type='submit' name='ConfirmarInsercion' value='ConfirmarInsercion'/>";
		}else{
			echo "<input type='submit' name='EnviarDatos' value='EnviarDatos'/>";
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
		<h3>Ordenar por:</h3>
		<form action="./index.php" method="POST" enctype="multipart/form-data">
			<div class="busqueda">
			<input type="radio" name="radioGroup" value="Antiguedad" checked>Antiguedad
		  
			<input type="radio" name="radioGroup"  value="Positivos">Número de positivos
		  
			<input type="radio" name="radioGroup"  value="PositivosNetos">Número de positivos netos
			</div>
			
			<div class="busqueda">
			<p><label>Texto de búsqueda:<input type="text" name="textoBusqueda"/></label></p>
			<p><label>Lugar:<input type="text" name="textoLugar"/></label></p>
			</div>

			<div class="busqueda">
			<label><input type="checkbox" name="Pendiente" checked>Pendiente</label>
		  	<label><input type="checkbox" name="Comprobada" checked>Comprobada</label>
		  	<label><input type="checkbox" name="Tramitada" checked>Tramitada</label>
		  	<label><input type="checkbox" name="Irresoluble"checked>Irresoluble</label>
		  	<label><input type="checkbox" name="Resuelta"checked>Resuelta</label>
		  	</div>
		  	
		  	<input type="submit" name='EnviarCriterios' value='EnviarCriterios' />
		</form>

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
		if($x){
			$seleccionado = "disabled";
			$habilitar = "disabled";
			$foto = isset($_POST['nuevaImg'])? $_POST['nuevaImg']:NULL;
			$nombre = $_POST['nuevoNombre'];
			$apellidos = $_POST['nuevoApellido'];
			$email = $_POST['nuevoCorreo'];
			$dir = $_POST['nuevaResidencia'];
			$tlfn = $_POST['nuevoTlf'];
			$estado = $_POST['estado'];
			if($_POST['rol'] == "Administrador"){
				$rol = 1;
			}else{
				$rol = 0;
			}
		}else{
			if($_SESSION['tipo'] == "Administrador"){
				$habilitar = " ";
			}else{
				$habilitar = "disabled ";
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
		$imagenBase64 = base64_encode($foto);
		$src = "data:$tipoContenido;base64,$imagenBase64";

		echo <<< HTML
		<form action="./index.php" method="POST" enctype="multipart/form-data">
			<h2>Edición de usuario</h2>
			<fieldset class="editarUsuario">
				<p>
					<label>Fotografía:  <img src="$src" alt="Imagen"><input type="file" name="nuevaImg" $seleccionado /></label>
				</p>
				<p>
					<label>Nombre:
						<input type="text" name="nuevoNombre" value="$nombre" $seleccionado/>
					</label>
				</p>
				<p>
					<label>Apellidos:</label>
						<input type="text" name="nuevoApellido" value="$apellidos" $seleccionado/>
					</label>
				</p>
				<p>
					<label>Email:
						<input type="text" name="nuevoCorreo" value="$email" $seleccionado/>
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
						<input type="text" name="nuevoTlf" value="$tlfn" $seleccionado/>
					</label>
				</p>
				<p>
					<label>Rol:
					<select name="rol" $habilitar $seleccionado>
						<option value='Administrador'
		HTML;
				RolSelccionado("1",$rol);
				echo " >Administrador</option>";
				echo "<option value='Colaborador' ";
				RolSelccionado("0",$rol);
				
		echo <<< HTML
					>Colaborador</option>
					</select>
					</label>

				</p>
				<p>
					<label>Estado:
					<select name='estado' $habilitar $seleccionado>
				HTML;
					      echo "<option value='Activo' ".EstadoSelccionado("activo",$estado).">Activo</option>";
					      echo "<option value='Inactivo' ".EstadoSelccionado("activo",$estado).">Inactivo</option>";
					echo "</select>";
					echo "</label>";
				echo "</p>";
		echo "<input type='hidden' name='tipoEditar' value=".$email.">";
		if($x){
			echo "<input type='submit' name='confirmarModificacion' value='Confirmar modificación'/>";
		}else{
			echo "<input type='submit' name='Modificacion' value='Modificar usuario'/>";
		}
		echo "</fieldset>";
		echo "</form>";
	}

	function NuevoUsuario(){
		$url = $_SERVER['SCRIPT_NAME'];
		echo <<< HTML
		<h2>Nuevo usuario</h2>
		<form method="post" action="$url">
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
					<option value='Colaborador'>Colaborador</option>
					<option value='Administrador'>Administrador</option>
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
			<input type='submit' name='NuevoUsuario' value='Crear usuario'/>
			</fieldset>
			</form>

		HTML;
	}
?>