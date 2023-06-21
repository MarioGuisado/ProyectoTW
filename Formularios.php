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
		echo <<< HTML
		<form action="./index.php" method="POST" enctype="multipart/form-data">
		<h2>Edición de usuario</h2>
			<div>
				<p>
					<label>Fotografía: <input type="file" name="img" required/></label>
				</p>
				<p>
					<label>Nombre:
						<input type="text" name="nombre" required />
					</label>
				</p>
				<p>
					<label>Apellidos:</label>
						<input type="text" name="apellidos" required />
					</label>
				</p>
				<p>
					<label>Email:
						<input type="text" name="correo" required />
					</label>
				</p>
				<p>
					<label>Dirección:
						<input type="text" name="residencia" required/>
					</label>
				</p>
				<p>
					<label>Teléfono:
						<input type="text" name="tlf" required/>
					</label>
				</p>
				<p>
					<label>Rol:
						<input type="text" name="rol" required/>
					</label>
				</p>
				<p>
					<label>Estado:
						<input type="text" name="estdo" required/>
					</label>
				</p>
				

			<input type="hidden" id="9.11">
			<input type="submit" value="Confirmar modificación"/>
			</div>
		</form>
		HTML;
	}
?>