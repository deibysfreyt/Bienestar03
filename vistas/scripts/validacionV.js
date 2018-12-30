function validacionV(){
	var Obser = document.getElementById('observaciones').value;
	var FechaV = document.getElementById('fecha_v').value;		
	var Benef = document.getElementById('id_persona').selectedIndex;		
	var TrabSo = document.getElementById('trabajador_social').value;
 
		//Test campo obligatorio del Solicitante
		if(Obser == null || Obser.length == 0 || /^\s+$/.test(Obser)){
			alert('ERROR: El campo observaciones NO debe ir vacío o lleno de solamente espacios en blanco');
			return false;
		}
		if(!isNaN(FechaV)){
			alert('ERROR: Debe elegir una fecha valida');
			return false;
		}
		
		if(Benef == null || Benef == 0){
			alert('ERROR: Debe seleccionar un Beneficiario');
			return false;
		}
		
		if(TrabSo == null || TrabSo.length == 0 || /^\s+$/.test(TrabSo)){
			alert('ERROR: El campo del Trabajador Social NO debe ir vacío o lleno de espacios en blanco');
			return false;
		}
	}