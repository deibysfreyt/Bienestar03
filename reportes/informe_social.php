<?php
	//Activamos el almacenamiento en el buffer
	ob_start();
	if (strlen(session_id()) < 1) 
  		session_start();

	if (!isset($_SESSION["nombre_apellido"])){
  		echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
	}else{
		if ($_SESSION['Gestion de Solicitud']==1){
?>
<html>
<head>
	<title>Informe Social</title>
	<meta charset="utf-8">
</head>
<body onload="window.print();">
	<?php 
		//Incluímos la clase Venta
		require_once "../modelos/modelo_consultas.php";
		//Instanaciamos a la clase con el objeto venta
		$consultas = new Consultas();
		//En el objeto $rspta Obtenemos los valores devueltos del método ventacabecera del modelo
		$rspta = $consultas->imprimir($_GET["id"]);
		//Recorremos todos los valores obtenidos
		$reg = $rspta->fetchObject();

	 ?>
	<table border="0px" style="margin: auto;">
		<tr align="center">
			<td><img src="../public/css/imagenes/Logo_Alcaldia.png" alt="Logo_alcaldia" style="height: 50px"></td>
			<td colspan="2">
				<h5>
					<strong>REPÚBLICA BOLIVARIANA DE VENEZUELA</strong><br>
					<strong>ALCALDIA DEL MINICIPIO IRIBARREN</strong><br>
					<strong>FUNDACIÓN DEL NIÑO MUNICIPIO IRIBARREN</strong><br>
					<strong>BARQUISIMETO - ESTADO LARA</strong><br>
					<strong>RIF: G-20006105-7</strong>
				</h5>
			</td>
			<td><img src="../public/css/imagenes/fondo.png" alt="Logo_fundacion" style="height: 50px"></td>
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr>
			<td style="font-size: 15spx">N° Control: <u><?php echo $reg->id_solicitud; ?></u></td>
			<td></td>
			<td></td>
			<td align="right" style="font-size: 15spx">Fecha: <u><?php echo $reg->fecha; ?></u></td>
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr>
			<td colspan="4" align="center"><strong style="font-size: 15px"><u><h5>INFORME SOCIAL</h5></u></strong></td>
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr>
			<td colspan="4"><h3><strong style="font-size: 15px">Datos del Solicitante</strong></h3></td>
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr>
			<td><p style="font-size: 12px">Nombre y Apellido: <u><?php echo $reg->solicitante; ?></u>,</p></td>
			<td><p style="font-size: 12px">.CI.: <u><?php echo $reg->cedula_s; ?></u>,</p></td>
			<td><p style="font-size: 12px">Fecha de Nacimiento: <u><?php echo $reg->fecha_s; ?></u>,</p></td>
			<td><p style="font-size: 12px">Estado Civil: <u><?php echo $reg->estado_civil; ?></u>,</p></td>
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr>
			<td><p style="font-size: 12px">N° de Hijos: <u><?php echo $reg->num_hijo; ?></u>,</p></td>
			<td><p style="font-size: 12px">Correo: <u><?php echo $reg->email; ?></u>,</p></td>		
			<td><p style="font-size: 12px">Parroquia: <u><?php echo $reg->parroquia; ?></u>,</p></td>
			<td><p style="font-size: 12px">Ocupación: <u><?php echo $reg->ocupacion; ?></u>,</p></td>
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr>
			<td><p style="font-size: 12px">Ingreso: <u><?php echo $reg->ingreso; ?>Bs</u>,</p></td>
			<td colspan="2"><p style="font-size: 12px">Dirección de Habitación: <u><?php echo $reg->direccion; ?></u>,</p></td>
			<td><p style="font-size: 12px">Teléfono Principal: <u><?php echo $reg->telefono_1; ?></u>,</p></td>
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr>
			<td><p style="font-size: 12px">Teléfono Secundario: <u><?php echo $reg->telefono_2; ?></u>,</p></td>
			<td><p style="font-size: 12px">Esterilizada: <u><?php echo $reg->esterilizada; ?></u>,</p></td>
					
			<td colspan="2"><p style="font-size: 12px">Beneficio Gubernamental: <u><?php echo $reg->beneficio_gubernamental; ?></u>.</p></td>		
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr>
			<td colspan="4"><h3><strong style="font-size: 15px">Datos del Beneficiario</strong></h3></td>
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr>
			<td><p style="font-size: 12px">Nombre y Apellido: <u><?php echo $reg->beneficiario; ?></u>,</p></td>
			<td><p style="font-size: 12px">.CI.: <u><?php echo $reg->cedula_p; ?></u>,</p></td>
			<td><p style="font-size: 12px">Fecha de Nacimiento: <u><?php echo $reg->fecha_p; ?></u>,</p></td>
			<td><p style="font-size: 12px">Parentesco: <u><?php echo $reg->parentesco; ?></u>.</p></td>
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr>
			<td colspan="3"><p style="font-size: 12px">Motivo de la Solicitud: <u><?php echo $reg->solicitud.' - '.$reg->descripcion; ?></u>,</p></td>
			<td><p style="font-size: 12px">Semana de Embarazo: <u><?php echo $reg->semana_embarazo; ?></u>.</p></td>
		</tr>
		<tr>
			<td><p style="font-size: 12px">Talla de Zapato: <u><?php echo $reg->talla_zapato; ?></u>.</p></td>
			<td><p style="font-size: 12px">Talla de Pantalón: <u><?php echo $reg->talla_pantalon; ?></u>.</p></td>
			<td><p style="font-size: 12px">Talla de Franela: <u><?php echo $reg->talla_franela; ?></u>.</p></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr>
			<td colspan="4"><h3><strong style="font-size: 15px">Área Física Ambiental</strong></h3></td>
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr>
			<td><p style="font-size: 12px">Tipo de vivienda: <u><?php echo $reg->tipo_vivienda; ?></u>,</p></td>
			<td><p style="font-size: 12px">Tenencia: <u><?php echo $reg->tenencia; ?></u>,</p></td>
			<td><p style="font-size: 12px">Construcción: <u><?php echo $reg->construccion; ?></u>,</p></td>
			<td><p style="font-size: 12px">Tipo de Piso: <u><?php echo $reg->tipo_piso; ?></u>,</p></td>
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr>
			<td colspan="4"><br></td>
		</tr>
		<tr align="center">
			<td colspan="2">_____________________________</td>
			<td colspan="2">_____________________________</td>
		</tr>
		<tr align="center">
			<td colspan="2" style="font-size: 12px"><strong>Gerente de Bienestar Social</strong></td>
			<td colspan="2" style="font-size: 12px"><strong>Presidencia</strong></td>
		</tr>
	</table>
</body>
</html>


<?php 
}
else
{
  echo 'No tiene permiso para visualizar el reporte';
}

}
ob_end_flush();
?>