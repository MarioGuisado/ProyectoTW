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
						<input type="text" name="clave" placeholder="" required/>
					</label>
				</p>
				<p>
				<label>Fotografía: <input type="file" name="img" /></label>
			</p>

			<input type="hidden" id="9.11">
			<input type="submit" value="Enviar datos"/>
			</fieldset>
		</form>
		HTML;
	}