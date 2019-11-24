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
	<link rel="stylesheet" href="reporte.css">
	<link rel="stylesheet" href="../public/bootstrap/dist/css/bootstrap.min.css">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>
<body>
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
	<div class="modelo" id="contenedor">
		<div class="izquierda">
			<table class="b">
				<tr style="text-align: center;">
					<td><img src="../public/css/imagenes/Logo_Alcaldia.png" alt="Logo_alcaldia" style="height: 50px;"></td>
					<td>
						<h6>
							<strong>REPÚBLICA BOLIVARIANA DE VENEZUELA</strong><br>
							<strong>ALCALDIA DEL MINICIPIO IRIBARREN</strong><br>
							<strong>FUNDACIÓN DEL NIÑO MUNICIPIO IRIBARREN</strong><br>
							<strong>BARQUISIMETO - ESTADO LARA</strong><br>
						</h6>
					</td>
					<td><img src="../public/css/imagenes/fondo.png" alt="Logo_fundacion" style="height: 60px; margin: auto;"></td>
				</tr>
				<tr>
					<td colspan="3">.</td>					
				</tr>
				<tr>
					<td colspan="3">
						<b>F. DE SOLICITUD: </b> <?php echo $reg->fecha; ?>
						&nbsp;
						&nbsp;
						&nbsp;
						&nbsp;
						&nbsp;
						&nbsp;
						&nbsp;
						&nbsp;
						<b>BARQUISIMETO:</b>
						<input type="text" name="fecha_actual" style="border: 0px;" id="fecha_actual" readonly=”readonly”>
					</td>
				</tr>
			</table>
			<h5 style="text-align: center;"><u><strong>INFORME SOCIAL</strong></u></h5>
			<table class="bo">
				<tr>
					<td><b>SOLICITANTE: </b></td>
					<td> &nbsp;<?php echo $reg->solicitante; ?></td>
					<td colspan="2"><b>N° CEDULA: </b><?php echo $reg->cedula_s; ?></td>
				</tr>
				<tr>
					<td><b>F. DE NAC: </b></td>
					<td>&nbsp;<?php echo $reg->fecha_s; ?></td>
					<td colspan="2"><b>EDAD: </b><?php echo $reg->edad_s; ?></td>
				</tr>
				<tr>
					<td><b>ESTADO CIVIL: </b></td>
					<td>&nbsp;<?php echo $reg->estado_civil; ?></td>
					<td colspan="2"><b>PARROQUIA: </b><?php echo $reg->parroquia; ?></td>
				</tr>
				<tr>
					<td colspan="4"><b>DIRECCIÓN: </b><?php echo $reg->direccion; ?></td>
				</tr>
				<tr>
					<td><b>TLF. CELULAR: </b></td>
					<td>&nbsp;<?php echo $reg->telefono_1; ?></td>
					<td colspan="2"><b>TLF FIJO: </b><?php echo $reg->telefono_2; ?></td>
				</tr>
				<tr>
					<td><b>OCUPACIÓN: </b></td>
					<td>&nbsp;<?php echo $reg->ocupacion; ?></td>
					<td colspan="2"><b>INGRESOS: </b><?php echo $reg->ingreso; ?><b>Bs</b></td>
				</tr>
			</table>
			<h5>.</h5>
			<h5 style="text-align: center;"><u><strong>DATOS DEL BENEFICIARIO</strong></u></h5>
			<table class="bo">
				<tr>
					<td><b>BENEFICIARIO:</b></td>
					<td>&nbsp;<?php echo $reg->beneficiario; ?></td>
					<td colspan="2"><b>N° CEDULA: </b><?php echo $reg->cedula_b; ?></td>
				</tr>
				<tr>
					<td><b>F. DE NAC: </b></td>
					<td>&nbsp;<?php echo $reg->fecha_b; ?></td>
					<td colspan="2"><b>EDAD: </b><?php echo $reg->edad_b; ?></td>
				</tr>
				<tr>
					<td><b>SOLICITUD: </b></td>
					<td>&nbsp;<?php echo $reg->solicitud.' - '.$reg->descripcion; ?></td>
					<td colspan="2"><b>S. DE EMBA: </b><?php echo $reg->semana_embarazo; ?></td>
				</tr>
			</table>
			<h5>.</h5>
			<h5 style="text-align: center;"><u><strong>ÁREA FISICA AMBIENTAL</u></strong></h5>
			<table class="bor" id="este">
				<tr>
					<td><b>T. DE VIVIENDA</b></td>
					<td><b>TENENCIA</b></td>
					<td><b>CONSTRUCCIÓN</b></td>
					<td><b>TIPO DE PISO</b></td>
				</tr>
				<tr>
					<td><?php echo $reg->tipo_vivienda; ?></td>
					<td><?php echo $reg->tenencia; ?></td>
					<td><?php echo $reg->construccion; ?></td>
					<td><?php echo $reg->tipo_piso; ?></td>
				</tr>
			</table>
			<h5>.</h5>
			<h5 style="text-align: center;"><u><strong>NUCLEO FAMILIAR</u></strong></h5>
		    <table id="detalles" class="borfami">
		      <thead>
		        <th><b>N°</b></th>
		        <th><b>NOMBRE Y APELLIDO</b></th>
		        <th><b>EDAD</b></th>
		        <th><b>PARENTESCO</b></th>
		        <th><b>OCUPACÍON</b></th>
		        <th><b>OBSERVACÍO</b></th>
		      </thead>
		      <tbody>
		                                  
		      </tbody>
		      <tfoot>
		        <th></th>
		        <th></th>
		        <th></th>
		        <th></th>
		        <th></th>
		        <th></th> 
		      </tfoot>                      
		    </table>
		</div>
		<div class="derecha">
			<h5 style="text-align: center;"><u><strong>ÁREA MÉDICO ASISTENCIAL</u></strong></h5>
			<table class="bor3">
				<tr>
					<td>	</td>
					<td>	</td>
				</tr>
				<tr>
					<td><b>DIAGNÓSTICO:</b></td>
					<td>
						<?php if ( isset($reg->diagnostico) ) {echo "___<u>".$reg->diagnostico."<u/>___";}else{ echo "__________________________________________";} ?>
					</td>
				</tr>
				<tr>
					<td><b>MOTIVO DE LA SOLICITUD:</b></td>
					<td>__________________________________________</td>
				</tr>
				<tr>
					<td><b>RECURSOS DISPONIBLES:</b></td>
					<td>__________________________________________</td>
				</tr>
				<tr>
					<td><b>MONTO APROBADO:</b></td>
					<td>__________________________________________</td>
				</tr>
				<tr>
					<td><b>OBSERVACIÓN:</b></td>
					<td>
						<?php if ( isset($reg->observacion) ) {echo "___<u>".$reg->observacion."<u/>___";}else{ echo "___________________________________________";} ?>
					</td>
				</tr>
				<tr>
					<td><b>T. SOCIAL RESPONSABLE:</b></td>
					<td>________<u><?php echo $reg->usuario; ?></u>________</td>
				</tr>
				<tr>
					<td colspan="2"><br></td>
				</tr>
			</table>
			<h5 style="text-align: center;"><u><strong>VISITA DOMICILIARIA</u></strong></h5>
			<table class="bor3">
				<tr>
					<td><b>OBSERVACIONES:</b></td>
					<td>___________________________________________</td>
				</tr>
				<tr>
					<td colspan="2">______________________________________________________________</td>
				</tr>
				<tr>
					<td colspan="2">______________________________________________________________</td>
				</tr>
				<tr>
					<td colspan="2">______________________________________________________________</td>
				</tr>
				<tr>
					<td colspan="2">______________________________________________________________</td>
				</tr>
				<tr>
					<td colspan="2">______________________________________________________________</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
			</table>
			<table>
				<tr>
					<td><b>FECHA:</b>______________ &nbsp;</td>
					<td><b> RESPONSABLE:</b>____________________________</td>
				</tr>
			</table>
			<table>
				<tr>
					<td colspan="4"><br></td>
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
				<tr>
					<td colspan="4"><br></td>
				</tr>
				<tr>
					<td colspan="4"><br></td>
				</tr>
				<tr align="center">
					<td colspan="2">_____________________________&nbsp; </td>
					<td colspan="2">&nbsp; _____________________________</td>
				</tr>
				<tr align="center">
					<td colspan="2"><strong>G. DE BIENESTAR SOCIAL</strong></td>
					<td colspan="2"><strong>PRESIDENCIA</strong></td>
				</tr>
				<tr>
					<td colspan="4"><br></td>
				</tr>
				<tr align="center">
					<td colspan="4">
						<b>Av. Venezuela con calle 30, al lado de la Perfectura de Iribarren. Telf.(0251) 232.07.09</b>
					</td>
				</tr>
				<tr align="center">
					<td colspan="4">
						<b>Fax (0251) 232.87.03 www.alcadiadebarquisimeto.gov.ve</b>
					</td>
				</tr>
				<tr align="center">
					<td colspan="4">
						<b>email: fundaciondelniñoiribarren@hotmail.com</b>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<script type="text/javascript" src="../public/jquery/dist/jquery.min.js"></script>
	<script>
		//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = (day)+"-"+(month)+"-"+now.getFullYear();
    $('#fecha_actual').val(today);

		var report = <?php echo $reg->id_solicitud; ?>;
		$.post("../ajax/consultas.php?op=listarFamiliarReport&id="+report,function(r)
		{
			$("#detalles").html(r);	
		});

	</script>
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