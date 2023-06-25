<?php
	function HTMLNUEVA(){
		echo <<< HTML
		<form action="./index.php" method="POST" enctype="multipart/form-data">
		<h2>Nueva incidencia</h2>
			<fieldset>
				<legend>Datos principales: </legend>
				<p>
					<label>Titulo de la incidencia:
						<input type="text" name="titulo" placeholder="Introduzca el titulo de la incidencia" required />
					</label>
				</p>
				<p>
					<label>Descripción:
						<input type="text" name="descripcion" placeholder="Introduzca la descripción de la incidencia" required />
					</label>
				</p>
				<p>
					<label>Lugar:
						<input type="text" name="lugar" placeholder="Introduzca el lugar ocurre la incidencia" required />
					</label>
				</p>
				<p>
					<label>Palabras clave:
						<input type="text" name="claves" placeholder="" required/>
					</label>
				</p>
				<p>
					<label>Fotografía: <input type="file" name="img" /></label>
				</p>

			//Establecer la fecha a la del sistema

			<input type="hidden" id="9.11">
			<input type="submit" value="Enviar datos"/>
			</fieldset>
		</form>
		HTML;
	}

	function RolSelccionado($x){
		if($x == $_SESSION['tipo'])
			echo "selected";
	}

	function EditarUsuario(){
		$foto = $_SESSION['foto'];
		$nombre = $_SESSION['nombre'];
		$apellidos = $_SESSION['apellidos'];
		$email = $_SESSION['email'];
		$dir = $_SESSION['direccion'];
		$tlfn = $_SESSION['tlfn'];
		$tipo = $_SESSION['tipo'];
		$tipoContenido = "image/png";
		$imagenBase64 = base64_encode($foto);
		$src = "data:$tipoContenido;base64,$imagenBase64";
		if($_SESSION['tipo'] == "Administrador"){
			$habilitar = " ";
		}else{
			$habilitar = "disabled";
		}


		echo <<< HTML
		<form action="./index.php" method="POST" enctype="multipart/form-data">
			<h2>Edición de usuario</h2>
			<div>
				<p>
					<label>Fotografía:  <img src="$src" alt="Imagen"><input type="file" name="nuevaImg"/></label>
				</p>
				<p>
					<label>Nombre:
						<input type="text" name="nuevoNombre" value="$nombre" />
					</label>
				</p>
				<p>
					<label>Apellidos:</label>
						<input type="text" name="nuevoApellido" value="$apellidos" />
					</label>
				</p>
				<p>
					<label>Email:
						<input type="text" name="nuevoCorreo" value="$email" />
					</label>
				</p>
				<p>
					<label>Clave:
						<input type="text" name="nuevaClave1"  />
						<input type="text" name="nuevaClave2"  />
					</label>
				</p>
				<p>
					<label>Dirección:
						<input type="text" name="nuevaResidencia" value="$dir" />
					</label>
				</p>
				<p>
					<label>Teléfono:
						<input type="text" name="nuevoTlf" value="$tlfn" />
					</label>
				</p>
				<p>
					<label>Rol:
					<select name="rol" $habilitar>
		HTML;
				echo "<option value='Colaborador' ";
				RolSelccionado("Colaborador");
				echo " >Colaborador</option>";
				echo "<option value='Admin' ";
				RolSelccionado("Administrador");
				echo " >Administrador</option>";
		echo <<< HTML
					</select>
					</label>

				</p>
				<p>
					<label>Estado:
					<select name="estado" $habilitar>
					      <option value="Activo">Activo</option>
					      <option value="Inactivo">Inactivo</option>
					</select>
					</label>
				</p>	
			<input type="hidden" id="9.11">
			<input type="submit" name="confirmarModificacion" value="Confirmar modificación"/>
			</div>
		</form>
		HTML;
	}
?>