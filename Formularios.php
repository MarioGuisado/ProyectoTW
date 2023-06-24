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
	function EditarUsuario(){
		$foto = $_SESSION['foto'];
		$tipoContenido = "image/png";
		$imagenBase64 = base64_encode($foto);
		$src = "data:$tipoContenido;base64,$imagenBase64";

		echo <<< HTML
		<form action="./index.php" method="POST" enctype="multipart/form-data">
			<h2>Edición de usuario</h2>
			<div>
				<p>
					<label>Fotografía:  <img src="$src" alt="Imagen"><input type="file" name="nuevaImg"/></label>
				</p>
				<p>
					<label>Nombre:
						<input type="text" name="nuevoNombre" />
					</label>
				</p>
				<p>
					<label>Apellidos:</label>
						<input type="text" name="nuevoApellido" />
					</label>
				</p>
				<p>
					<label>Email:
						<input type="text" name="nuevoCorreo" />
					</label>
				</p>
				<p>
					<label>Clave:
						<input type="text" name="claveAnterior"  />
						<input type="text" name="nuevaClave"  />
					</label>
				</p>
				<p>
					<label>Dirección:
						<input type="text" name="nuevaResidencia"/>
					</label>
				</p>
				<p>
					<label>Teléfono:
						<input type="text" name="nuevoTlf"/>
					</label>
				</p>
				<p>
					<label>Rol:
					<select name="rol" disabled>
					      <option value="Colaborador">Colaborador</option>
					      <option value="Admin">Administrador</option>
					</select>
					</label>

				</p>
				<p>
					<label>Estado:
					<select name="estado" disabled>
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