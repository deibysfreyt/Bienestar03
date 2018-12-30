function validacion(){
 
		//Solicitante
		var CedulaS = document.getElementById('cedula').value;
		var NombreS = document.getElementById('nombre_apellido').value;
		var FechaS = document.getElementById('fecha_nacimiento').value;
		var SexoS = document.getElementById('sexo').selectedIndex;
		var DireccionS = document.getElementById('direccion').value;
		var Telef_1 = document.getElementById('telefono_1').value;
		var Telef_2 = document.getElementById('telefono_2').value;
		var CorreoS = document.getElementById('email').value;
		var ParroquiaS = document.getElementById('parroquia').selectedIndex;
		var EstadoC = document.getElementById('estado_civil').selectedIndex;
		var OcupacionS = document.getElementById('ocupacion').value;
		var BeneficioGu = document.getElementById('beneficio_gubernamental').value;
		var Esteri = document.getElementById('esterilizada').selectedIndex;

		//Beneficio
		var CedulaB = document.getElementById('cedula_b').value;
		var NombreB = document.getElementById('nombre_apellido_b').value;
		var FechaB = document.getElementById('fecha_nacimiento_b').value;
		var ParentescoB = document.getElementById('parentesco_b').selectedIndex;
		var Tipo_S = document.getElementById('id_tipo_solicitud').selectedIndex;

		//Informacion de Solicitud
		var MedioI = document.getElementById('medio_informacion').value;
		var FechaT = document.getElementById('fecha').value;
		var Tipo_v = document.getElementById('tipo_vivienda').selectedIndex;
		var Tenen = document.getElementById('tenencia').selectedIndex;
		var Construc = document.getElementById('construccion').selectedIndex;
		var Tipo_p = document.getElementById('tipo_piso').selectedIndex;
 
		//Test campo obligatorio del Solicitante
		if(CedulaS == null || CedulaS.length == 0 ){
			alert('ERROR: El solicitante debe ingresar una cedula Valida');
			return false;
		}
		if(NombreS == null || NombreS.length == 0 || /^\s+$/.test(NombreS)){
			alert('ERROR: El campo nombre del solicitante NO debe ir vacío o lleno de solamente espacios en blanco');
			return false;
		}
		if(!isNaN(FechaS)){
			alert('ERROR: El solicitante debe elegir una fecha de nacimiento valida');
			return false;
		}
		if(SexoS == null || ParroquiaS == 0){
			alert('ERROR: Debe seleccionar una opcion en parroquia');
			return false;
		}
		if(DireccionS == null || DireccionS.length == 0 || /^\s+$/.test(DireccionS)){
			alert('ERROR: El campo nombre del solicitante NO debe ir vacío');
			return false;
		}
		if(Telef_1 == null || Telef_1.length == 0 || !(/^[0]\d{3}\-\d{7}$/.test(Telef_1)) || /^\s+$/.test(Telef_1) ){
			alert('ERROR: El solicitante debe ingresar un telefono Principal segun el formato 0416-1237788');
			return false;
		}
		if( Telef_1.length != 0 && !(/^[0]\d{3}\-\d{7}$/.test(Telef_1)) ){
			alert('ERROR: El solicitante debe ingresar un telefono Secundario segun el formato 0416-1237788');
			return false;
		}
		if(!(/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/.test(CorreoS)) && CorreoS != null && CorreoS.length != 0){
			alert('ERROR: Debe escribir un correo válido');
			return false;
		}
		if(ParroquiaS == null || ParroquiaS == 0){
			alert('ERROR: Debe seleccionar una opcion en parroquia');
			return false;
		}
		if(EstadoC == null || EstadoC == 0){
			alert('ERROR: Debe seleccionar el estado civil');
			return false;
		}
		if(OcupacionS == null || OcupacionS.length == 0 || /^\s+$/.test(OcupacionS)){
			alert('ERROR: El campo direccion del solicitante NO debe ir vacío');
			return false;
		}
		if(/^\s+$/.test(BeneficioGu)){
			alert('ERROR: El campo Beneficio Gubernamental del solicitante NO debe ir lleno de solamente espacios en blanco');
			return false;
		}
		if(Esteri == null || Esteri == 0){
			alert('ERROR: Debe seleccionar una opcion del campo Esterilizada');
			return false;
		}

		//Beneficiario
		if(isNaN(CedulaB)){
			alert('ERROR: El Beneficiario debe ingresar una cedula Valida');
			return false;
		}
		if(NombreB == null || NombreB.length == 0 || /^\s+$/.test(NombreB)){
			alert('ERROR: El campo nombre del Beneficiario NO debe ir vacío o lleno de solamente espacios en blanco');
			return false;
		}
		if(!isNaN(FechaB)){
			alert('ERROR: El Beneficiario debe elegir una fecha de nacimiento valida');
			return false;
		}
		if(ParentescoB == null || ParentescoB == 0){
			alert('ERROR: Debe seleccionar un Parentesco en el Beneficiario');
			return false;
		}
		if(Tipo_S == null || Tipo_S == 0){
			alert('ERROR: Debe seleccionar una Solicitud en el Beneficiario');
			return false;
		}

		//Informacion de Solicitud
		if(MedioI == null || MedioI.length == 0 || /^\s+$/.test(MedioI)){
			alert('ERROR: El campo Medio Informacion NO debe ir vacío o lleno de solamente espacios en blanco');
			return false;
		}
		if(!isNaN(FechaT)){
			bootbox.alert('ERROR: La fecha de Solicitud no es valida');
			return false;
		}
		if(Tipo_v == null || Tipo_v == 0){
			alert('ERROR: Debe seleccionar un Tipo de Vivienda');
			return false;
		}
		if(Tenen == null || Tenen == 0){
			alert('ERROR: Debe seleccionar una Tenencia');
			return false;
		}
		if(Construc == null || Construc == 0){
			alert('ERROR: Debe seleccionar un Tipo de construccion');
			return false;
		}
		if(Tipo_p == null || Tipo_p == 0){
			alert('ERROR: Debe seleccionar un Tipo Piso');
			return false;
		}
 
	}