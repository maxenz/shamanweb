//DECLARACION DE VARIABLES GLOBALES

var user;
var cellsRendererMovil,cellsRendererSituacion; 
var flgAfiliado = 0;
var flgAccionF10 = 0;
var flgTel = 0;
var flgLoc = 0;
var flgSanatorio = 0;
var flgSintomas = 0;
var flgIncTras = 0;
vecReclamos = [];
var datosPaciente = [];	
var columnas = [];
var columnasHistorialTraslado = [];
var columnasProgramacionTraslado = [];
var sourceGrados = [];
var sourceProgramacionTraslado = [];
var sourceHistorialTraslado = [];
var cellsRendererGrado, cellsRendererZona,dataAdapter,dataAdapterSug,dataAdapterDiag,cellsRendererIncMov;
var acumCategorizador = 0;
var flgPediatrico = 0;
var idSintoma = 0;
var flgMaxEmergencia = 0;



//DECLARACION DE FUNCIONES

function setUser(usuario) {
		
	user = usuario;	
		
}

function initBotones() {
	
	$('#btnAceptarCierre').jqxButton({width:100, height:30, theme:'metro'});
	$('#btnCancelarCierre').jqxButton({width:100, height:30, theme:'metro'});
	$('#btnAceptarObservacionesRec').jqxButton({width:100, height:30, theme:'metro'});
	$('#btnCancelarObservacionesRec').jqxButton({width:100, height:30, theme:'metro'});
	$('#btnAceptarAviso').jqxButton({width:100, height:30, theme:'metro'});
	$('#btnCancelarAviso').jqxButton({width:100, height:30, theme:'metro'});
	$('#btnAceptarPreDesp').jqxButton({width:100, height:30, theme:'metro'});
	$('#btnCancelarPreDesp').jqxButton({width:100, height:30, theme:'metro'});
	$('#btnAceptarPacienteTelefono').jqxButton({ width:100, height:35, theme:'metro' });
	$('#btnCancelarPacienteTelefono').jqxButton({ width:100, height:35, theme:'metro' });
	$('#btnBuscarAfiliadoEnPadron').jqxButton({ width:100, height:35, theme:'metro' });
	$('#btnConfirmarAfiliadoInexistente').jqxButton({ width:100, height:35, theme:'metro' });
	$('#btnConfirmarSintomaInexistente').jqxButton({ width:100, height:35, theme:'metro' });
	$('#btnBuscarSintoma').jqxButton({ width:100, height:35, theme:'metro' });	
		
}

function initDateTimeInput() {
	
	$('#dtFechaCierre').jqxDateTimeInput({width: 130, height: 27, theme: 'metro', textAlign: 'left', readonly:true, disabled:true });
	$('#dtFechaHorSalCierre').jqxDateTimeInput({width: 80, height: 27, theme: 'metro', textAlign: 'left', formatString: 't', showCalendarButton:false });
	$('#dtFechaHorLleCierre').jqxDateTimeInput({width: 80, height: 27, theme: 'metro', textAlign: 'left', formatString: 't',showCalendarButton:false });
	$('#dtFechaHorDeriv').jqxDateTimeInput({width: 80, height: 27, theme: 'metro', textAlign: 'left', formatString: 't',showCalendarButton:false });
	$('#dtFechaHorIte').jqxDateTimeInput({width: 80, height: 27, theme: 'metro', textAlign: 'left', formatString: 't',showCalendarButton:false });
	$('#dtFechaHorFinDeriv').jqxDateTimeInput({width: 80, height: 27, theme: 'metro', textAlign: 'left', formatString: 't',showCalendarButton:false });
	$('#dtFechaIncObservaciones').jqxDateTimeInput({width: 130, height: 27, theme: 'metro', textAlign: 'left', readonly:true, disabled:true});
	$("#dtFechaAviso").jqxDateTimeInput({ width: 130, height: 27, theme: 'metro', textAlign: 'left', readonly:true, disabled:true });
	$("#dtPreDespIncidente").jqxDateTimeInput({ width: 130, height: 27, theme: 'metro', textAlign: 'left', readonly: true, disabled: true });
	$("#dtFechaTraslado").jqxDateTimeInput({ width: 130, height: 27, theme: 'metro', textAlign: 'left'});
	$("#dtFechaHoraDomTrasladoOrigen").jqxDateTimeInput({ width: 160, height: 27, theme: 'metro', textAlign: 'left', formatString:'dd-MM-yyyy HH:mm'});
	$("#dtFechaHoraDomTrasladoDestino").jqxDateTimeInput({ width: 157, height: 27, theme: 'metro', textAlign: 'left', formatString:'dd-MM-yyyy HH:mm'});
	$("#dtFechaHoraRetornoTrasladoDestino").jqxDateTimeInput({ width: 157, height: 27, theme: 'metro', textAlign: 'left', formatString:'dd-MM-yyyy HH:mm'});
	$("#jqxDateIncidente").jqxDateTimeInput({ width: 130, height: 27, theme: 'metro', textAlign: 'left' });
	$('#dtDesdeHC').jqxDateTimeInput({width: 150, height: 27, theme: 'metro', textAlign: 'left',  formatString:'yyyy-MM-dd'});
	$('#dtHastaHC').jqxDateTimeInput({width: 150, height: 27, theme: 'metro', textAlign: 'left',  formatString:'yyyy-MM-dd'});
	$('#dtDesdeBusqServ').jqxDateTimeInput({width: 150, height: 27, theme: 'metro', textAlign: 'left',  formatString:'yyyy-MM-dd'});
	$('#dtHastaBusqServ').jqxDateTimeInput({width: 150, height: 27, theme: 'metro', textAlign: 'left',  formatString:'yyyy-MM-dd'});
	
}
	
function initPaneles() {
		
	$('#panelPreDespMovilEmpresa').jqxPanel({width:690,height:80,theme:'metro'});
	$('#panelPreDespIncidente').jqxPanel({width:690,height:80,theme:'metro'});
	$('#panelPreDespSugerencia').jqxPanel({width:690,height:135,theme:'metro'});
	$('#panelCierreIncidente').jqxPanel({width:690, height:80, theme:'metro' });
	$('#panelDatosDeCierre').jqxPanel({width:690, height:260, theme:'metro' });
	$('#panelObservacionesIncidente').jqxPanel({width:690,height:80,theme:'metro'});
	$('#panelObservaciones').jqxPanel({width:690,height:130,theme:'metro'});
	$('#panelAvisos').jqxPanel({width:690,height:80,theme:'metro'});
	$('#panelTrasladosGeneral').jqxPanel({width:955,height:165,theme:'metro'});
	$('#panelTrasladosOrigen').jqxPanel({width:955,height:110,theme:'metro'});
	$('#panelTrasladosDestino').jqxPanel({width:955,height:110,theme:'metro'});
	$('#panelIncidentesPrincipal').jqxPanel({width:958, height:440, theme:'metro'});	
}
	
function pruebaJSON() {
	
	$.ajax({
		type: 'GET',
		dataType : 'json',
		url : 'pruebita.php',
		success: function(datos){
			
			alert(datos.iva);
			alert(datos.grados);
					
		}
	});
}
	
	function initDropDown(srcIVA,srcGrados) {
		
		var sourceAccion = ["Reemplazar","Apoyar"];
		var sourceDWDeriv = ["NO","SI"];
		var sourceDropDownSexo = ["M","F"];
		var srcDespacharInc = ["M&oacute;viles","Empresas Prestadoras"];
		var opcionesIncidentes = ["Incidentes en Curso","Programados"];
		//var sourceDropDownIVA;
		// $.ajax({
			// type: 'GET',
			// dataType: 'json',
			// url: 'getIVA.php?opt=0',
			// success: function(datos){
				// sourceDropDownIVA = datos;
			// }
		// });
		// var sourceDropDownGrados;
		// $.ajax ({
			// type : 'GET',
			// dataType: 'json',
			// url: 'getGrados.php?opt=0',
			// success: function(datos){
				// sourceDropDownGrados = datos;
			// }
		// });
		
		var grados = {
			localdata: srcGrados,
			datatype: "json"
			};
		
		var iva = {
			localdata: srcIVA,
			datatype: "json"
			};
		
		 grados = new $.jqx.dataAdapter(grados);		
		 iva = new $.jqx.dataAdapter(iva);
				
		$("#dpDownAccion").jqxDropDownList({ source: sourceAccion, selectedIndex:0 , width: 110,height: 27, dropDownHeight:50, theme:'metro'});
		$("#dpDownDeriv").jqxDropDownList({ source: sourceDWDeriv, selectedIndex:0 , width: 50,height: 27, dropDownHeight:50, theme:'metro'});
		$("#dropDownSexo").jqxDropDownList({ source: sourceDropDownSexo, placeHolder:'...' , width: 50,height: 27, dropDownHeight:50, theme:'metro'});
		$("#dpDownSexoTraslado").jqxDropDownList({ source: sourceDropDownSexo, placeHolder:'...' , width: 50,height: 27, dropDownHeight:50, theme:'metro'});
		$("#dpDownDespacharPreDespIncidente").jqxDropDownList({ source: srcDespacharInc, selectedIndex: 0, width: 160,height: 27, dropDownHeight:50, theme:'metro'});
		
		$('#dpDownGradosTraslados').jqxDropDownList({ source: grados, placeHolder:'Seleccione...', valueMember:'ColorHexa',
													  displayMember:'AbreviaturaId', width: 120,height: 27, dropDownHeight:100, theme:'metro'});
													  
		$("#dropDownGrados").jqxDropDownList({ source: grados, placeHolder:'Seleccione...', valueMember:'ColorHexa',
											   		 displayMember:'AbreviaturaId', width: 178,height: 27, dropDownHeight:100, theme:'metro'});

		$("#dropDownIVA").jqxDropDownList({ source: iva,placeHolder:'Seleccione...' ,valueMember:'ID',displayMember:'Descripcion',
													  width: 100,height: 27, dropDownHeight:100, theme:'metro'});
											
		$("#dpDownIVATraslado").jqxDropDownList({ source: iva,placeHolder:'Seleccione...' ,valueMember:'ID',displayMember:'Descripcion',
											  		 width: 100,height: 27, dropDownHeight:100, theme:'metro'});
		
		$("#dropDownTipoIncidentes").jqxDropDownList({ source: opcionesIncidentes, animationType:'fade', theme:'metro',dropDownHeight:'50px',
												      selectedIndex: 0, width: '160px', height: 27 });	
													  
		$("#jqxSelGradoChart").jqxDropDownList({ source: grados, displayMember: 'Descripcion', valueMember : 'ID', animationType:'fade',
											   		 theme:'metro',dropDownHeight:'145px',  selectedIndex: 0, width: '170px', height: 27 });
	
	}
	
	function initMenuRecepcionComponentes() {
		
		$("#jqxMenuRecepcion,#jqxMenuTraslados").jqxMenu({ width: '950px', height: '40px', mode: 'horizontal', theme: 'metro' });
		$("#menuBusqServ").jqxMenu({ width: '788px', height: '35px', mode: 'horizontal', theme: 'metro' });		
		
	}
	
	function initCheckbox() {
		
		$("#chkViajeRealizado").jqxCheckBox({ boxSize:27, theme: 'metro' });
		$("#chkReclamoLogObserv").jqxCheckBox({ boxSize:27, theme: 'metro', locked: true });
		$("#chkReclamo").jqxCheckBox({ boxSize:27, theme: 'metro' });
		$("#chkTrasladoConRetorno").jqxCheckBox({ boxSize:27, disabled: true, theme: 'metro' });
		
	}
		
	function initTabs() {
		
		$('#jqxTabsOperativa').jqxTabs({ width: '962px', height: '480px', position: 'top', theme: 'metro' });	
		
	}
	
	function initPopUpsOperativa() {
		
		var x = 0;
		var y = 0;
		
		//POPUP CLIENTES
		$("#popupClientes").jqxWindow({ height:400, width: 545, theme: 'metro', autoOpen:false, isModal: true, resizable: false, animationType: 'combined'});
		x = ($(window).width() - $("#popupClientes").jqxWindow('width')) / 2 + $(window).scrollLeft();
	       y = ($(window).height() - $("#popupClientes").jqxWindow('height')) / 2 + $(window).scrollTop();
		$('#popupClientes').jqxWindow({ position: { x: x, y: y} });
	
		//POPUP BUSCO AFILIADO
		$("#popupBuscoAfiliado").jqxWindow({ height:360, width: 545, theme: 'metro', autoOpen:false, isModal: true, resizable: false, animationType: 'combined' });
		x = ($(window).width() - $("#popupBuscoAfiliado").jqxWindow('width')) / 2 + $(window).scrollLeft();
	       y = ($(window).height() - $("#popupBuscoAfiliado").jqxWindow('height')) / 2 + $(window).scrollTop();
		$('#popupBuscoAfiliado').jqxWindow({ position: { x: x, y: y} });
			
		//POPUP BUSCO SINTOMA
		$("#popupBuscoSintoma").jqxWindow({ height:360, width: 370, theme: 'metro', autoOpen:false, isModal: true, resizable: false, animationType: 'combined' });
		x = ($(window).width() - $("#popupBuscoSintoma").jqxWindow('width')) / 2 + $(window).scrollLeft();
	       y = ($(window).height() - $("#popupBuscoSintoma").jqxWindow('height')) / 2 + $(window).scrollTop();
		$('#popupBuscoSintoma').jqxWindow({ position: { x: x, y: y} });
		
		//POPUP CATEGORIZADOR
		$("#popupCategorizador").jqxWindow({ height:360, width: 600, theme: 'metro', autoOpen:false, isModal: true, resizable: false, animationType: 'combined' });
		x = ($(window).width() - $("#popupCategorizador").jqxWindow('width')) / 2 + $(window).scrollLeft();
	       y = ($(window).height() - $("#popupCategorizador").jqxWindow('height')) / 2 + $(window).scrollTop();
		$('#popupCategorizador').jqxWindow({ position: { x: x, y: y} });
			
		//POPUP PREASIGNO DESPACHO
		$("#popupPreasignoDespacho").jqxWindow({ height:380, width: 700, theme: 'metro', autoOpen:false, isModal: true, resizable: false, animationType: 'combined' });
		x = ($(window).width() - $("#popupPreasignoDespacho").jqxWindow('width')) / 2 + $(window).scrollLeft();
	       y = ($(window).height() - $("#popupPreasignoDespacho").jqxWindow('height')) / 2 + $(window).scrollTop();
		$('#popupPreasignoDespacho').jqxWindow({ position: { x: x, y: y} });
		
		//POPUP ESTABLECER CIERRE
		$("#popupEstablecerCierre").jqxWindow({ height:430, width: 700, theme: 'metro', autoOpen:false, isModal: true, resizable: false, animationType: 'combined' });
		x = ($(window).width() - $("#popupEstablecerCierre").jqxWindow('width')) / 2 + $(window).scrollLeft();
	       y = ($(window).height() - $("#popupEstablecerCierre").jqxWindow('height')) / 2 + $(window).scrollTop();
		$('#popupEstablecerCierre').jqxWindow({ position: { x: x, y: y} });
		
		//POPUP SANATORIOS
		$("#popupSanatorios").jqxWindow({ height:360, width: 545, theme: 'metro', autoOpen:false, isModal: true, resizable: false, animationType: 'combined'});
		x = ($(window).width() - $("#popupSanatorios").jqxWindow('width')) / 2 + $(window).scrollLeft();
	       y = ($(window).height() - $("#popupSanatorios").jqxWindow('height')) / 2 + $(window).scrollTop();
		$('#popupSanatorios').jqxWindow({ position: { x: x, y: y} });
		
		//POPUP DIAGNOSTICOS
		$("#popupDiagnosticos").jqxWindow({ height:290, width: 510, theme: 'metro', autoOpen:false, isModal: true, resizable: false, animationType: 'combined'});
		x = ($(window).width() - $("#popupDiagnosticos").jqxWindow('width')) / 2 + $(window).scrollLeft();
	       y = ($(window).height() - $("#popupDiagnosticos").jqxWindow('height')) / 2 + $(window).scrollTop();
		$('#popupDiagnosticos').jqxWindow({ position: { x: x, y: y} });
			
		//POPUP RECLAMOS - OBSERVACIONES
		$("#popupObservaciones").jqxWindow({ height:250, width: 700, theme: 'metro', autoOpen:false, isModal: true, resizable: false, animationType: 'combined'});
		x = ($(window).width() - $("#popupObservaciones").jqxWindow('width')) / 2 + $(window).scrollLeft();
	       y = ($(window).height() - $("#popupObservaciones").jqxWindow('height')) / 2 + $(window).scrollTop();
		$('#popupObservaciones').jqxWindow({ position: { x: x, y: y} });
		
		//POPUP TIPS - AVISOS
		$("#popupAvisos").jqxWindow({ height:140, width: 700, theme: 'metro', autoOpen:false, isModal: true, resizable: false, animationType: 'combined'});
		x = ($(window).width() - $("#popupAvisos").jqxWindow('width')) / 2 + $(window).scrollLeft();
	       y = ($(window).height() - $("#popupAvisos").jqxWindow('height')) / 2 + $(window).scrollTop();
		$('#popupAvisos').jqxWindow({ position: { x: x, y: y} });
		
		//POPUP LOG OBSERVACIONES
		$("#popupLogObservaciones").jqxWindow({ height:190, width: 500, theme: 'metro', autoOpen:false, isModal: true, resizable: false, animationType: 'combined'});
		x = ($(window).width() - $("#popupLogObservaciones").jqxWindow('width')) / 2 + $(window).scrollLeft();
	       y = ($(window).height() - $("#popupLogObservaciones").jqxWindow('height')) / 2 + $(window).scrollTop();
		$('#popupLogObservaciones').jqxWindow({ position: { x: x, y: y} });
		
		//POPUP HISTORIA CLINICA
		$("#popupHistoriaClinica").jqxWindow({ height:420, width: 700, theme: 'metro', autoOpen:false, isModal: true, resizable: false, animationType: 'combined'});
		x = ($(window).width() - $("#popupHistoriaClinica").jqxWindow('width')) / 2 + $(window).scrollLeft();
	       y = ($(window).height() - $("#popupHistoriaClinica").jqxWindow('height')) / 2 + $(window).scrollTop();
		$('#popupHistoriaClinica').jqxWindow({ position: { x: x, y: y} });
		
		//POPUP BUSQUEDA SERVICIOS
		$("#popupBusqServ").jqxWindow({ height:400, width: 800, theme: 'metro', autoOpen:false, isModal: true, resizable: false, animationType: 'combined'});
		x = ($(window).width() - $("#popupBusqServ").jqxWindow('width')) / 2 + $(window).scrollLeft();
	       y = ($(window).height() - $("#popupBusqServ").jqxWindow('height')) / 2 + $(window).scrollTop();
		$('#popupBusqServ').jqxWindow({ position: { x: x, y: y} });	
				
	}
	
	function openLogObserv() {
		
		var id = $('#hidRowIncidente').val();
		//$('#txtUsrLogObserv').val('');
		//$('#txtLogObservaciones').val('');
		var sourceLog = {datatype: "json",datafields: [{ name: 'ID' },{ name: 'Descripcion' }],url: 'getLogObservaciones.php?opt=0&id='+id };
		var dALog = new $.jqx.dataAdapter(sourceLog);
		$("#dpDownLogObserv").jqxDropDownList({source: dALog,valueMember:'ID',placeHolder: 'Seleccione...',displayMember:'Descripcion',selectedIndex:0,width: 200,height: 23,dropDownHeight:100,theme:'metro'});
		$('#popupLogObservaciones').jqxWindow('open');
				
		
	}
	
	function createGridHC(jHistoria) {
		
		cellsRendererGrado = function (row, columnfield, value, defaulthtml, columnproperties) {
			var data = $('#grdHistoriaClinica').jqxGrid('getrowdata',row);
			var color = "#" + data["ColorHexa"];	  
			return '<div style="width:50px;height:27px;text-align:center;line-height:27px;background: ' + color + ';">'+ value + '</div>'; 
	   }
		
		var columnasHC =
			 [
			 	{ text: 'ID', datafield: 'ID', hidden:true },
				{ text: 'ColorHexa', datafield: 'ColorHexa', hidden: true},
			  	{ text: 'Fecha', datafield: 'FecIncidente', width: '10%', align: 'center' },
			  	{ text: 'Inc', width:'10%', datafield: 'NroIncidente', align: 'center', cellsalign: 'center'},
				{ text: 'Gdo', width:'10%', datafield: 'Grado', cellsrenderer: cellsRendererGrado, align: 'center', cellsalign: 'center'},
				{ text: 'Paciente', width:'10%', datafield: 'Paciente', align: 'center'},
				{ text: 'Diagn&oacute;stico', width:'25%', datafield: 'Diagnostico', align: 'center'},
				{ text: 'M&oacute;vil', width:'10%', datafield: 'Movil', align: 'center', cellsalign: 'center'},
				{ text: 'S&iacute;ntomas', width:'25%', datafield: 'Sintomas', align: 'center'}	
			 ];
			 
		var sourceHistoria =
            {
                datatype: "json",
                datafields: [
                    { name: 'ID', type: 'int' },
                    { name: 'NroIncidente', type: 'string' },
                    { name: 'FecIncidente', type: 'string' },
                    { name: 'Grado', type: 'string' },
                    { name: 'Paciente', type: 'string' },
                    { name: 'Diagnostico', type: 'string' },
			{ name: 'Sintomas', type: 'string' },
			{ name: 'Movil', type: 'string'},
			{ name: 'ColorHexa', type: 'string'}
                ],
                localdata: jHistoria
            };	
			 
		var dAHistoria = new $.jqx.dataAdapter(sourceHistoria);	
	
		$("#grdHistoriaClinica").jqxGrid({
				width: '98%',
				height:200,
				altrows: true,
				showfilterrow: true,
				filterable: true,
				columnsresize: true,
				columns: columnasHC,
       			source: dAHistoria,
       			theme: 'metro'
		});		 
	}
	
	function setAjaxLoader() {
		
		$(document).ajaxStart(function() {
			$('body').addClass("loading");
		});

		$(document).ajaxStop(function() {
			$('body').removeClass("loading");
		});		
	 }
	
	function verHistoriaClinica() {
		
		$('#panelHistoriaClinica').each(function(index, element) {
            
			$(this).val('');
			
        });
			
		var cli = $('#txtCliente').val();
		var nroAf = $('#txtNroAfiliado').val();
			
		$.ajax({
			type : 'GET',
			dataType: 'json',
			url: 'getHistoriaClinica.php?opt=0&cli='+cli+'&nroAf='+nroAf,
			success: function(datos){ 
				
				if (datos.hClinica == 0) {
					
					alert('El afiliado no posee historia clínica');
					
				} else {
				
					$('#txtClienteHC').val(datos.paciente[0].Cliente);
					$('#txtAfiliadoHC').val(datos.paciente[0].NroAfiliado);
					$('#txtPacienteHC').val(datos.paciente[0].Paciente);
					$('#txtSexoHC').val(datos.paciente[0].Sexo);
					$('#txtEdadHC').val(datos.paciente[0].Edad);
					$('#txtDomHC').val(datos.paciente[0].Domicilio);
					$('#txtLocHC').val(datos.paciente[0].Loc);
					$('#txtTelHC').val(datos.paciente[0].Telefono);
					$('#txtObservHC').val(datos.paciente[0].Observ);
					var fDesde = strDateToJavascriptDate(datos.paciente[0].FDesde);
					var fHasta = strDateToJavascriptDate(datos.paciente[0].FHasta);
					$('#dtDesdeHC').jqxDateTimeInput('setDate', new Date(fDesde));
					$('#dtHastaHC').jqxDateTimeInput('setDate', new Date(fHasta));
					
					createGridHC(datos.hClinica);
					
					$('#grdHistoriaClinica').jqxGrid('focus');
					$('#grdHistoriaClinica').jqxGrid({selectedrowindex: 0});
					
					$('#popupHistoriaClinica').jqxWindow('open');
				
				}
							
			}		
		});
	}
	
	function refreshHC() {
		
		var cli = $('#txtCliente').val();
		var nroAf = $('#txtNroAfiliado').val();
		var fDesde = $('#dtDesdeHC').jqxDateTimeInput('getText');
		var fHasta = $('#dtHastaHC').jqxDateTimeInput('getText');	
			
		$.ajax({
			type : 'GET',
			dataType: 'json',
			url: 'getHistoriaClinica.php?opt=1&cli='+cli+'&nroAf='+nroAf+'&fDesde='+fDesde+'&fHasta='+fHasta,
			success: function(datos){ 

				createGridHC(datos);
									
			}	
		});		
	}
	
	function getLogObservacion(id) {
		
		$.ajax({
			url:'getLogObservaciones.php?opt=1&id='+id,
			type: 'GET',
			dataType : 'json',
			success: function(datos) {
				
				var obser = datos[0];
				var usr = datos[1];
				var rec = datos[2];
				$('#txtLogObservaciones').text(obser);
				$('#txtUsrLogObserv').val(usr);
				
				if (rec == 0) {
				
					$('#chkReclamoLogObserv').jqxCheckBox({ checked: false });
						
				} else {
					
					$('#chkReclamoLogObserv').jqxCheckBox({ checked: true });
				}
				
			 }
		});

	}
		
	function initGrdSugerenciaMovilesEmpresas(sourceMovilesEmpresas,columnasMovilesEmpresas) {
		
		var srcSugerencia = 
					{
						localdata: sourceMovilesEmpresas,
						datatype: "json"
					};
		var dASugerencia = new $.jqx.dataAdapter(srcSugerencia);
		$("#grdSugerenciaMovilesEmpresas").jqxGrid({
			width: 680,
			height:110,
			columns: columnasMovilesEmpresas,
	        source: dASugerencia,
	        theme: 'metro'
	    });			
	}
	
	function initGrdDiagnosticos() {
		
		var columnasDiagnosticos = [{ text: 'ID', datafield: 'ID', width: 70, hidden:true },
								{ text: 'Código', datafield: 'AbreviaturaId', width: 150, align: 'center' },
								{ text: 'Descripción', datafield: 'Descripcion',width:325, align: 'center' ,cellsalign:'center'}]; 

		
		 $("#grdDiagnosticos").jqxGrid({
			 width: 500,
			 height:283,
			 columnsresize: true,
			 altrows: true,
			 showfilterrow: true,
			 filterable: true,
			 sortable: true,
			 columns: [],
	         source: columnasDiagnosticos,
	         theme: 'metro',
	     });			
	}
	
	function initGrdHistorial() {
		
		var columnasHistorial = [
				{ text: 'Hora', datafield: 'Hora', width: '15%', align: 'center',cellsalign:'center' },
				{ text: 'Estado', datafield: 'Estado', width: '35%', align: 'center' },
				{ text: 'Movil', width:'15%', datafield: 'Movil', align: 'center' ,cellsalign:'center'},
				{ text: 'Usuario', datafield: 'Usuario', width: '35%', align: 'center'}
			]; 	
		
		$("#grdRecepcionHistorial").jqxGrid({
			width: 467,
			height: 78,
			columnsresize: true,
    	    source: [],
	        theme: 'metro',
	        columns: columnasHistorial
    	});	
		
	}
	
	function initGrdProgramacion() {

		var columnasProgramacion = [
				{ text: 'Fecha', datafield: 'Fecha', width: '20%' , align: 'center' ,cellsalign:'center' },
				{ text: 'Inc', datafield: 'Inc', width: '15%' , align: 'center',cellsalign:'center' },
				{ text: 'Prg.', width:'15%', datafield: 'Prg', align: 'center',cellsalign:'center'},
				{ text: 'Día Semana', datafield: 'DiaSem', width: '25%', align: 'center',cellsalign:'center'},
				{ text: 'Horario', datafield: 'Horario', width: '25%', align: 'center',cellsalign:'center'}
			]; 
		
		$("#grdRecepcionProgramacion").jqxGrid({
			width: 467,
			height: 78,
			columnsresize: true,
	        source: [],
	        theme: 'metro',
	        columns: columnasProgramacion
	    });	
		
	}
	
	function initGrdBusqServ() {
		
		var cellsRendererGrado = function (row, columnfield, value, defaulthtml, columnproperties) {
			var data = $('#grdBusqServ').jqxGrid('getrowdata',row);
			var color = "#" + data["ColorHexa"];	  
			return '<div style="width:50px;height:27px;text-align:center;line-height:27px;background: ' + color + ';">'+ value + '</div>'; 
	   }
		
		var columnasBusqServ = [
			{ text: 'ID', datafield: 'ID', hidden: true },
			{ text: 'Fecha', datafield: 'Fecha', width: '12%', align: 'center', filtertype: 'date'},
			{ text: 'Inc', datafield: 'NroInc', width:'8%',  align: 'center', cellsalign: 'center'},
			{ text: 'Grado', datafield: 'Grado',  width: '6%', cellsrenderer: cellsRendererGrado, cellsalign: 'center', cellsalign: 'center' },
			{ text: 'Cliente', datafield: 'Cliente', width: '16%', align:'center'},
			{ text: 'Afiliado', datafield: 'NroAf', width: '15%' , align:'center'},
			{ text: 'Paciente', datafield: 'Paciente', width: '17%', align:'center'},
			{ text: 'Domicilio', datafield: 'Domicilio',  width: '20%', align:'center'},
			{ text: 'Loc', datafield: 'Localidad', width: '6%',align:'center', cellsalign: 'center'},
			{ text: 'ColorHexa', datafield: 'ColorHexa', hidden: true }
		];
		
		$("#grdBusqServ").jqxGrid({
			width: 790,
			height: 320,
			showfilterrow: true,
			altrows: true,
			columnsresize: true,
			filterable: true,
			sortable: true,
			source: [],
			columnsresize: true,
			theme: 'metro',
        	columns: columnasBusqServ
    	});		
		
	}
	
	function openBusqServ() {
		
		initGrdBusqServ();
		getBusqServ(0,0);
		$('#popupBusqServ').jqxWindow('open');	
			
	}
	
	function getBusqServ(fDesde,fHasta) {
		
		$.ajax({
			
			dataType: 'json',
			type: 'GET',
			url: 'getBusquedaIncidentes.php?opt=0&fdesde='+fDesde+'&fhasta='+fHasta,
			success : function(datos){
			
				var fDesde = strDateToJavascriptDate(datos.fechas[0].fDesde);
				var fHasta = strDateToJavascriptDate(datos.fechas[0].fHasta);
				
				$('#dtDesdeBusqServ').jqxDateTimeInput('setDate', new Date(fDesde));
				$('#dtHastaBusqServ').jqxDateTimeInput('setDate', new Date(fHasta));
				setGrdBusqServ(datos.servicios);	
			}		
		});		
	}
	
	function setGrdBusqServ(jBusqServ) {
		
		 var sourceBusqServ ={
        	datatype: "json",
        	datafields: [{ name: 'ID' },{ name: 'Fecha'}, {name: 'NroInc'}, {name: 'Grado'},{name: 'Cliente'},{name: 'Afiliado'},
						 {name: 'Paciente'},{name: 'Domicilio'},{name: 'Localidad'},{name: 'ColorHexa'}],
		 	localdata: jBusqServ
			
   		 };	
		 
		 var dABusqServ = new $.jqx.dataAdapter(sourceBusqServ);	
		
		$('#grdBusqServ').jqxGrid({	source: dABusqServ});	
		
	}
	
	function actBusqServ() {
		
		var fDesde = $('#dtDesdeBusqServ').jqxDateTimeInput('getText');
		var fHasta = $('#dtHastaBusqServ').jqxDateTimeInput('getText');
		
		getBusqServ(fDesde,fHasta);
	}
	
	function focusGrdIncidentes() {
	
		$('#grdIncidentes').jqxGrid('focus');
		$('#grdIncidentes').jqxGrid('selectrow',0);
	
	}
	
	function initGrdIncidentes(datos) {

		
	
		 $("#grdIncidentes").jqxGrid({
			width: 800,
			height:255,
			pagesize:8,
			pagesizeoptions: ['8','10','12'],
			columnsresize: true,
			altrows: true,
			pageable: true,
			filterable: true,
			sortable: true,
			columns: columnasIncidentes,
			source: datos,
			theme: 'metro',
   		 });			
		
	}
	
	function initGrdMoviles(datos) {
		
		$("#grdMoviles").jqxGrid({
			width: 150,
			height:255,
			columnsresize: true,
			filterable: true,
			sortable: true,
			columns: columnasMoviles,
			source: datos,
			columnsresize: true,
			theme: 'metro'
			
    	});		
		
	}
	
	function setInitialData(version) {

		$.ajax({
			type: 'GET',
			dataType: 'json',
			url: 'getInitialData.php',
			error: function (request, status, error) {
        		console.log(request.responseText);
    		},
			success: function(datos){

				$(document).ready(function() {
			
				//$('#tituloOpcion').text('Operativa');
				//initGrdLocalidades();

				initGrdClientes();
				initGrdSintomas();											//SETEO GRILLA DE BUSQUEDA DE SINTOMAS (POPUP SINTOMAS)
				initGrdSanatorios();	
				inhabilitoControlesRecepcion();
				inhabilitoControlesTraslado();
				initMenuRecepcionComponentes();									//INICIALIZACION COMPONENTES MENU DE OPCIONES DE RECEPCION
				initTabs();	
				initPaneles();													//INICIALIZACION PANELES
				initDateTimeInput();											//INICIALIZACION DATE_TIME_INPUT
				initBotones();
				initCheckbox();													//INICIALIZACION CHECKBOX																
				setPopupsGenerales();
				initPopUpsOperativa();											//INICIALIZO TODOS LOS POPUPS UTILIZADOS EN EL FORMULARIO DE RECEPCION
				initGrdDiagnosticos();
				initGrdHistorial();
				initGrdProgramacion();
				setRenderersMoviles();
				setColumnasMoviles();
				setTooltips();
				bindEventosOperativa();
				bindGrillaLocalidades();

				var moviles =
					{
						localdata: datos.moviles,
						datatype: "json"
					};
				
				var incidentes = 
					{
						localdata: datos.incidentes,
						datatype: "json"
					};

				var jsonIncidentes = JSON.parse(incidentes.localdata);

				setRenderersIncidentes();
				setColumnasIncidentes();
				initGrdIncidentes(incidentes);
				initDropDown(datos.iva,datos.grados);
				initLogIncidentes(datos.logInc);
				initGrdMoviles(moviles); 
				flgMaxEmergencia = datos.valorEmer;
				spinner.stop();
				$('#jqxTabsOperativa').css("display","block");
				opcionesSegunVersion(version);	
				initSetGraficos();
				focusGrdIncidentes();	
				});
			}			
		});

	}

	function opcionesSegunVersion(version) {

	    if (version == 'full') {

	        $('#jqxMenuRecepcion li span').unbind('click').removeAttr('onClick');

	    } else {

	        $('.nav li.dropdown').css("display","block");
	    }

	    setInitialData(version);

}
	 
	 function initLogIncidentes(log) {
	 
		$('#logIncidentes').html(log);
	 
	}
	 
	 function setColumnasMoviles() {
	 
		columnasMoviles = [
			{ text: 'Mov', datafield: 'Movil', width: '30%', cellsrenderer: cellsRendererMovil, align: 'center' },
			{ text: 'Sit', datafield: 'Situacion', width: '30%', cellsrenderer: cellsRendererSituacion, align: 'center'},
			{ text: 'Loc', width:'40%', datafield: 'Localidad', cellsalign:'center', align: 'center'},
			{ text: 'ColorMovil', hidden:true, datafield: 'ColorMovil' },
			{ text: 'ColorSituacion', datafield: 'ColorSituacion', hidden:true}
		];
	  
	}
	 
	function setGrdMoviles() {
	
		$.ajax({
			type: 'GET',
			dataType: 'json',
			url:'qryMoviles.php?opt=0',
			success: function(moviles){
			
				var source =
				{
					localdata: moviles,
					datatype: "array"
				};
			
				initGrdMoviles(source);						
			},
		});	
	}
	
	function tieneReclamo(ID){
		
		var bRec = false;
		ID = ID.toString();

		
		for (var i = 0; i < vecReclamos.length; i++) {
			
			if (vecReclamos[i] == ID) {
				bRec = true;	
			}			
		}

		return bRec;
		
	}
	
	function setRenderersMoviles() {
		
		cellsRendererMovil = function (row, columnfield, value, defaulthtml, columnproperties) {
		var data = $('#grdMoviles').jqxGrid('getrowdata',row);
		var color = "#" + data["ColorMovil"];
		return '<div style="width:45px;height:27px;text-align:center;line-height:27px;background: ' + color + ';">'+ value + '</div>';
		      
    	}
	 
	 	cellsRendererSituacion = function (row, columnfield, value, defaulthtml, columnproperties) {
		var data = $('#grdMoviles').jqxGrid('getrowdata',row);
		var color = "#" + data["ColorSituacion"];      
    	return '<div style="width:45px;height:27px;text-align:center;line-height:27px;background: ' + color + ';">'+ value + '</div>';
    	}	
		
	}
	
	function setRenderersIncidentes() {
	
		 cellsRendererGrado = function (row, columnfield, value, defaulthtml, columnproperties) {
			var data = $('#grdIncidentes').jqxGrid('getrowdata',row);
			var color = "#" + data["ColorGrado"];	  
			return '<div style="width:40px;height:27px;text-align:center;line-height:27px;background: ' + color + ';">'+ value + '</div>'; 
		}
		
		cellsRendererSalida = function(row,columnfield,value,defaulthtml,columnproperties){
			var data = $('#grdIncidentes').jqxGrid('getrowdata',row);
			var movDespachado = data["MovilDespachado"];
			if (movDespachado) {
			
				return '<div style="width:35px;height:27px;text-align:center;line-height:27px;font-weight:bold;color:black">'+value+'</div>';
			
			} else {
				var movPreasignado = data["MovilPreasignado"];

				if (movPreasignado) {
					
				return '<div style="width:35px;height:27px;text-align:center;line-height:27px;font-weight:bold;color:blue">'+movPreasignado+'</div>';
				}
			}
		}
		
	  cellsRendererZona = function (row, columnfield, value, defaulthtml, columnproperties) {
		var data = $('#grdIncidentes').jqxGrid('getrowdata',row);
		var color = "#" + data["ColorZona"];
              
    	return '<div style="width:40px;height:27px;text-align:center;line-height:27px;background: ' + color + ';">'+ value + '</div>'; 
     }
	 
	 cellsRendererIncMov = function (row, columnfield, value, defaulthtml, columnproperties) {

		  return '<div style="width:100%;height:100%;text-align:center;line-height:26px">' + value + '</div>';  
     }
	 
	 cellsRendererAviso = function (row, columnfield, value, defaulthtml, columnproperties) {
		 
			var data = $('#grdIncidentes').jqxGrid('getrowdata',row);
			var ID = data["ID"];
			var reclamo = data["Reclamo"];
			
			if ((value != '') && (reclamo == 1)) {
					
		  		return '<div style="width:100%;height:100%;text-align:center;line-height:26px;background:yellow;color:red;font-weight:bold;">!</div>';  
				
			} else if ((value != '') && (reclamo == 0)) {
				
				return '<div style="width:100%;height:100%;text-align:center;line-height:26px;background:yellow;color:red;font-weight:bold;"></div>';
					
			} else if ((value == '') && (reclamo == 1)) {
				
				return '<div style="width:100%;height:100%;text-align:center;line-height:26px;color:red;font-weight:bold;">!</div>';					
				
			} else {
				
				return '<div style="width:100%;height:100%;text-align:center;line-height:26px;"></div>';
			}
     }	
		
	}
	
	function initSetGraficos() {
		
		var sampleData = [
			{ Grado: 'Grado', Despacho: 25, Salida: 74, Desplazamiento: 46, Atencion: 48}
               ];
			   
            var settings = {
                title: "Tiempos Operativos",
                description: "",
                showLegend: true,
                enableAnimations: true,
                padding: { left: 20, top: 5, right: 20, bottom: 5 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                source: sampleData,
                categoryAxis:
                    {
                        dataField: 'Grado',
                        showGridLines: true,
                        flip: false
                    },
                colorScheme: 'scheme01',
                seriesGroups:
                    [
                        {
                            type: 'column',
                            orientation: 'horizontal',
                            columnsGapPercent: 30,
                            valueAxis:
                            {
                                flip: true,
                                unitInterval: 10,
                                maxValue: 100,
								minValue:0,
                                displayValueAxis: true,
                                
                            },
                            series: [
                                    {dataField: 'Despacho', displayText: 'Despacho' },
									{dataField: 'Salida', displayText: 'Salida'},
									{dataField: 'Desplazamiento', displayText: 'Desplazamiento'},
									{dataField: 'Atencion', displayText: 'Atencion'}
								
                                ]
                        }
                    ]
            };
			
            $('#jqxChartTiemposOperativos').jqxChart(settings);
			


//SETEO DATA PARA GRAFICO DE TORTA (ESTO NO ESTA OPERATIVO TODAVIA, SON DATOS DE EJEMPLO)

		var data3 = [
   			{Grado: "Rojo", Cantidad: 33},
			{Grado: "Amarillo", Cantidad: 21},
			{Grado: "Verde", Cantidad: 31},
		]

		var pruebaArray = ['#FF0000', '#ffff00', '#48B15D'];    

		$.jqx._jqxChart.prototype.colorSchemes.push({ name: 'myScheme', colors: pruebaArray  });
		var settingsTorta = {
			title: "Distribución de servicios",
			description: "",
			enableAnimations: true,
			showLegend: false,
			legendPosition: { left: 50, top: 30, width: 50, height: 50 },
			padding: { left: 5, top: 5, right: 5, bottom: 5 },
			titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
			source: data3,
			colorScheme: 'myScheme',
			seriesGroups:
			[
				{
					type: 'pie',
					showLabels: true,
					series:
						[
							{
								dataField: 'Cantidad',
								displayText: 'Grado',
								labelRadius: 30,
								initialAngle: 15,
								radius: 45,
								innerRadius: 45,
								centerOffset: 0
							}
						]
				}
			]
	};
			
		$('#jqxChartServicios').jqxChart(settingsTorta);		
	
	}
	
	function refreshDataInc(opt) {
			
		if (opt == 0) {
	
			setIncidentesActuales();
		
		} else {
	
			setIncidentesProgramados();
	
		}
	
 		//$("#grdIncidentes").jqxGrid({ _cachedcolumns: null });
		//$('#grdIncidentes').jqxGrid({ columns : columnasIncidentes, source: sourceIncidentes });
	
	}
	
	function setColumnasIncidentes() {
	
		columnasIncidentes =  [{ text: 'ID', datafield: 'ID', align: 'center', hidden:true },
							   { text: 'Cod', datafield: 'Grado', width: 40, cellsrenderer: cellsRendererGrado, align: 'center' },
							   { text: 'Entidad', width:60, datafield: 'Cliente', align: 'center'},
							   { text: 'Inc', datafield: 'NroIncidente', width: 40, cellsalign:'center', align: 'center' },
							   { text: '', datafield:'Aviso', width:25, cellsrenderer: cellsRendererAviso},
							   { text: 'Domicilio', datafield: 'Domicilio', width: 130, align: 'center' },
							   { text: 'Sintomas', datafield: 'Sintomas', width: 120, align: 'center' },
							   { text: 'Loc', datafield: 'Localidad', width: 40, cellsrenderer: cellsRendererZona, align: 'center' },
							   { text: 'SE', datafield: 'SexoEdad', width: 40,cellsalign:'center', align: 'center' },
							   { text: 'ColGr', datafield: 'ColorGrado', hidden:true},
							   { text: 'ColZona', datafield: 'ColorZona', hidden:true},
							   { text: 'Mov', datafield: 'MovilDespachado', width: 35,cellsalign:'center', align: 'center', cellsrenderer: cellsRendererSalida },
							   { text: 'Llam', datafield: 'HorLlam', width: 40 , align: 'center'},
							   { text: 'Dsp', datafield: 'Despacho', width: 40, cellsalign:'center', align: 'center' },
							   { text: 'Sal', datafield: 'Salida', width: 40,cellsalign:'center', align: 'center' }, 
							   { text: 'Ate', datafield: 'Atencion', width: 40,cellsalign:'center', align: 'center' },
							   { text: 'Paciente', datafield: 'Paciente', width: 110, align: 'center' },
							   { text: 'FecInc', datafield:'FechaIncidente',hidden:true},
							   { text: 'Observaciones', datafield:'Observaciones',hidden:true},
							   {text: '', datafield: 'MovilPreasignado', hidden:true},
							   {text: 'ViajeId', datafield: 'ViajeId', hidden:true}
							   ]; 
	
	}
	
	function setIncidentesActuales() {
	
		$.ajax({
			type: 'GET',
			dataType: 'json',
			url:'getDataIncidentes.php?opt=0&optGrillaInc=0',
			success: function(incidentes){
			
				var source =
				{
					localdata: incidentes,
					datatype: "array"
				};
				
				initGrdIncidentes(source);							
			},
		});
		  
				}


	function setIncidentesProgramados() {
		
		sourceIncidentes ={
        	datatype: "json",
        	datafields: [{ name: 'ID' },{ name: 'Grado' },{ name: 'Traslado'}, {name: 'HoraLlegada'}, {name: 'Domicilio'},{name: 'Localidad'},{name: 'Sintomas'},
					 	 { name: 'ColorGrado'},{name: 'ColorZona'},{name: 'Cliente'},{name: 'Movil'}, {name: 'SexoEdad'}, {name: 'Referencia'},
						 { name: 'Paciente'},{name : 'Fecha'}],
						 url: 'getDataIncidentes.php?opt=0&optGrillaInc=1',
						 id: 'ID',
    		};	
	
		columnasIncidentes = [
								{ text: 'ID', datafield: 'ID', width: 30, align: 'center',hidden:true },
								{ text: 'Cod', datafield: 'Grado', width: 40, cellsrenderer: cellsRendererGrado , align: 'center'},
								{ text: 'Entidad', width:60, datafield: 'Cliente', align: 'center'},
								{ text: 'Nro', datafield: 'Traslado', width: 40,cellsalign:'center', align: 'center' },
								{ text: 'Domicilio', datafield: 'Domicilio', width: 130, align: 'center' },
								{ text: 'Sintomas', datafield: 'Sintomas', width: 120 , align: 'center'},
								{ text: 'Loc', datafield: 'Localidad', width: 40, cellsrenderer: cellsRendererZona, align: 'center' },
								{ text: 'SE', datafield: 'SexoEdad', width: 40, cellsalign:'center', align: 'center' },
								{ text: 'ColGr', datafield: 'ColorGrado', hidden:true},
								{ text: 'ColZona', datafield: 'ColorZona',hidden:true},
								{ text: 'Mov', datafield: 'Movil', width: 35, cellsalign:'center', align: 'center' },
								{ text: 'Fecha', datafield: 'Fecha', width: 70, align: 'center' },
								{ text: 'Lleg', datafield: 'HoraLlegada', width: 40 , align: 'center'},
								{ text: 'Paciente', datafield: 'Paciente', width: 180, align: 'center' },
								{ datafield: 'Aviso', hidden: true}
							  ]; 
	}
	
	function setHistorial(pInc) {
			
		var sourceHistorial ={
        	datatype: "json",
       		datafields: [{ name: 'Hora' },{ name: 'Estado' },{ name: 'Movil'}, {name: 'Usuario'}],
		 	url: 'getDataGrillasRecepcion.php?opt=0&inc='+pInc
    	};	
	
		
	
		$('#grdRecepcionHistorial').jqxGrid({ source: sourceHistorial  });
	
	}
	
	function setProgramacion(pInc) {
	
		sourceProgramacion ={
       		datatype: "json",
        	datafields: [{ name: 'Fecha' },{ name: 'Inc' },{ name: 'Prg'}, {name: 'DiaSem'}, {name: 'Horario'}],
			url: 'getDataGrillasRecepcion.php?opt=1&inc='+pInc
   		 };	
	 
			
	
		$('#grdRecepcionProgramacion').jqxGrid({ source: sourceProgramacion });
	
	}
	
	//*************************************//////////////
	
	function setGrdDiagnosticos() {
	
		var sourceDiagnosticos ={
        	datatype: "json",
        	datafields: [{ name: 'ID' },{ name: 'AbreviaturaId' },{ name: 'Descripcion'}],
			 url: 'getDiagnosticos.php'
    	};
		
		$('#grdDiagnosticos').jqxGrid({ source: sourceDiagnosticos });	
	
	}

	function setGrillaSugerenciasDespachoMoviles(loc,gdo) {
				
	var columnasSugerenciasDespacho = [
		{ text: 'ID', datafield: 'ID', hidden:true },
		{ text: 'Móvil', datafield: 'Movil', width: 50, align: 'center',cellsalign:'center' },
		{ text: 'Tipo de Móvil', width:300, datafield: 'TipoMovil', align: 'center'},
		{ text: 'Estado', datafield: 'EstMovil', width: 330, align: 'center'}]; 	
			
	$.ajax({
			type: 'GET',
			dataType: 'json',
			url: 'getInfoDespachar.php?opt=0&loc='+loc+'&gdo='+gdo,
			success : function(datos){
				
				initGrdSugerenciaMovilesEmpresas(datos,columnasSugerenciasDespacho);
				
			}
		
		});
	}

	function setGrillaSugerenciasDespachoEmpresas(loc,gdo) {
		
		var columnasSugerenciasDespacho = [
			{ text: 'ID', datafield: 'ID', hidden:true },
			{ text: 'Empresa', datafield: 'AbreviaturaId', width: 80, align: 'center',cellsalign:'center' },
			{ text: 'Nombre', width:300, datafield: 'RazonSocial', align: 'center'},
			{ text: 'Tipo de Cobertura', datafield: 'TipoCobertura', width: 300, align: 'center'}
		]; 
									   
		$.ajax({
			type: 'GET',
			dataType: 'json',
			url: 'getInfoDespachar.php?opt=1&loc='+loc+'&gdo='+gdo,
			success : function(datos){
				
				initGrdSugerenciaMovilesEmpresas(datos,columnasSugerenciasDespacho);
				
			}
		
		});
			
	
	}
	
	function initGrdClientes() {
		
		var columnasClientes =
			 [
			 	{ text: 'ID', datafield: 'ID', hidden:true },
			  	{ text: 'Código', datafield: 'Codigo', width: 220, align: 'center' },
			  	{ text: 'Razon Social', width:300, datafield: 'RazonSocial', align: 'center'}
			 ];
			
	
		$("#grdClientes").jqxGrid({
				width: 520,
				height:336,
				altrows: true,
				pagesize:10,
				pagesizeoptions: ['10','12','17'],
				pageable: true,
				showfilterrow: true,
				filterable: true,
       			source: [],
       			theme: 'metro',
				columns: columnasClientes
		});		 
		
		
	}

	function setGrillaClientes() {
	
		var sourceClientes ={
        		datatype: "json",
        		datafields: [{ name: 'ID' },{ name: 'Codigo' },{ name: 'RazonSocial'}],
				url: 'getSetClientes.php?opt=1'
   		};
		
		$('#grdClientes').jqxGrid({ source: sourceClientes });	 
		
	}
	
	function initGrdSanatorios() {
		
		var columnasSanatorios = [{ text: 'ID', datafield: 'ID', hidden:true, align: 'center' },
							  { text: 'Código', datafield: 'Sanatorio', width: 200, align: 'center' },
							  { text: 'Sanatorio', width:300, datafield: 'Descripcion', align: 'center'}];

		$("#grdSanatorios").jqxGrid({
				width: 520,
				height:315,
				altrows: true,
				filterable: true,
				sortable: true,
       			source: [],
				columnsresize: true,
       			theme: 'metro',
        		columns: columnasSanatorios
   			 });
			
	}

	function setGrillaSanatorios() {
	
		sourceSanatorios ={
        	datatype: "json",
        	datafields: [{ name: 'ID' },{ name: 'Sanatorio' },{ name: 'Descripcion'}],
			url: 'getSanatorios.php'
   		};	
	 
		$('#grdSanatorios').jqxGrid({ source: sourceSanatorios });
			 
	
	}
	
	//function initGrdLocalidades() {
//		
//		var columnasBusquedaLocalidades = [{ text: 'ID', datafield: 'LocId', hidden:true },
//									   { text: 'Código', datafield: 'Codigo', width: 50, align: 'center',cellsalign:'center' },
//									   { text: 'Localidad', width:225, datafield: 'Localidad', align: 'center'},
//									   { text: 'Partido', datafield: 'Partido', width: 225, align: 'center' }];
//			
//		$("#grdLocalidades").jqxGrid({
//				width: 520,
//				height:315,
//				altrows: true,
//				filterable: true,
//				sortable: true,
//       			source: [],
//				columnsresize: true,
//       			theme: 'metro',
//        		columns: columnasBusquedaLocalidades
//   			 });	
//		
//	}
//
//	function setGrillaBusquedaLocalidades() {
//	
//		
//		var sourceGrillaLocalidades ={
//        		datatype: "json",
//        		datafields: [{ name: 'ID' },{ name: 'Codigo' },{ name: 'Localidad'}, {name: 'Partido'}],
//				url: 'getInfoLocalidad.php'
//   		};
//		
//		$('#grdLocalidades').jqxGrid({ source: sourceGrillaLocalidades });	
//	 
//}

	function setGrillaAfiliados(pCli) {
	
		
		var sourceGrillaAfiliados ={
        		datatype: "json",
        		datafields: [{ name: 'ID' },{ name: 'NroAfiliado' },{ name: 'Tipo'}, {name: 'Apellido'},{name: 'Nombre'}],
				url: 'getInfoAfiliado.php?pNroAf=0&cli='+pCli
   		};	
	 
		var columnasBusquedaAfiliado = [{ text: 'ID', datafield: 'ID', hidden:true },
									{ text: 'Nro', datafield: 'NroAfiliado', width: 50, align: 'center',cellsalign:'center' },
									{ text: 'Tipo', width:50, datafield: 'Tipo', align: 'center',cellsalign:'center'},
									{ text: 'Apellido', datafield: 'Apellido', width: 205, align: 'center' },
									{ text: 'Nombre', datafield: 'Nombre', width: 205, align: 'center' }];
	
		$("#grdAfiliados").jqxGrid({
				width: 510,
				height:315,
				altrows: true,
				filterable: true,
				sortable: true,
       			source: sourceGrillaAfiliados,
				columnsresize: true,
       			theme: 'metro',
        		columns: columnasBusquedaAfiliado
   			 });
			
	}
	
	function initGrdSintomas() {
		
		columnasBusquedaSintomas = [{ text: 'ID', datafield: 'ID', hidden:true },
									{ text: 'S&iacute;ntoma', datafield: 'Descripcion', width: 330, align: 'center' }];
		
		$("#grdSintomas").jqxGrid({
				width: 350,
				height:315,
				altrows: true,
				filterable: true,
				sortable: true,
       			source: [],
				columnsresize: true,
       			theme: 'metro',
        		columns: columnasBusquedaSintomas
   			 });						
		}

	function setGrillaSintomas() {
			
		var sourceGrillaSintomas ={
        	datatype: "json",
        	datafields: [{ name: 'ID' },{ name: 'Descripcion' }],
			url: 'getInfoSintoma.php'
   		};
		
		$('#grdSintomas').jqxGrid({ source: sourceGrillaSintomas });	
	 
		
	}
	
	
	function setDataGrillaSugerencias(opt,loc,gdo) {

		limpiarPopupSugerencias();
	
		if (opt == 0) {
		
			setGrillaSugerenciasDespachoMoviles(loc,gdo);
		
		} else {
		
			setGrillaSugerenciasDespachoEmpresas(loc,gdo);			
		}
	
		//$("#grdSugerenciaMovilesEmpresas").jqxGrid({ _cachedcolumns: null });
		//$('#grdSugerenciaMovilesEmpresas').jqxGrid({ columns : columnasSugerenciasDespacho, source: sourceSugerenciasDespacho  });	
	}

	function limpiarPopupSugerencias() {

		$('#txtMovEmpresa').val('');
		$('#txtEstNombre').val('');
		$('#txtTipoMovCob').val('');

	}
	
	function getToday() {
	
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1;

		var yyyy = today.getFullYear();
		if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = yyyy+'-'+mm+'-'+dd;
		return today;
	
	}
	
	function moveRecepcion(mov,pPos) {
	
		var fec = getToday();
		var id = $('#hidRowIncidente').val();
		var page = "getOperativaMoves.php?";
		var parameters = "mov="+mov+"&fec="+fec+"&id="+id+"&pPos="+pPos;
		console.log(parameters);
		var urlMove = page + parameters
		
			
		$.ajax({
				type: "GET",
				dataType: 'json',
				url: urlMove,
				success: function(datos){		
					
					if (datos === 0) {
						
						setMessage('error',1000,'No hay más incidentes para visualizar','','');
						
					} else {
						
						var idRow = $('#hidRowIncidente').val();
						setArrayPaciente(datos);		
						setTextBoxPacientes();
						setHistorial(idRow);			
  						setProgramacion(idRow);		  
	
					}
				},

				error: function (xhr, ajaxOptions, thrownError) {

			        alert(thrownError);

      			}
		});				
	}
	
	function setLogIncidentes(tip) {
	
			$.ajax({
				type: "GET",
				dataType: "html",
				url: "qryLogIncidentes.php?opt=0&tip="+tip,
				success: function(datos){			
								
					$('#logIncidentes').html(datos);
		
				}
			});				
		}
			
	
	// function setDataOnChartOperativos(idGrado) {
	
		// var sourceGradosUpdated =
                // {
                   // datatype: "json",
                   // datafields: [
                        // { name: 'Despacho' },
                        // { name: 'Salida' },
						// { name: 'Desplazamiento' },
						// { name: 'Atencion' }
                    // ],
                    // url: 'getGrados.php?opt=1&idGrado='+idGrado
                // };
								
		// var dataAdapterGradosUpdated = new $.jqx.dataAdapter(sourceGradosUpdated);
		// $('#jqxChartTiemposOperativos').jqxChart({  source: dataAdapterGradosUpdated });
				
	// }
			
	function setDataPacienteRecepcion(idRow) {			//CON EL ID DEL INCIDENTE, BUSCO EN LA BASE DE DATOS VIA AJAX LOS DATOS DEL INCIDENTE
			
		$.ajax({
				type: "GET",
				dataType: "json",
				url: "getInfoIncidente.php?opt=0&id="+idRow,
				success: function(datos){			

					setArrayPaciente(datos);		//SETEO UN ARRAY CON DATOS DEL INCIDENTE
					setTextBoxPacientes();			//LLENO EL FORMULARIO DE RECEPCION CON LOS DATOS DEL INCIDENTE
								
				}
			});
		}
		

//INHABILITO TODOS LOS CONTROLES DE RECEPCION		
	function inhabilitoControlesRecepcion() {
	
		$('#dropDownGrados, #dropDownIVA, #dropDownSexo').jqxDropDownList({ disabled: true });
		$('#jqxDateIncidente').jqxDateTimeInput({ disabled: true, readonly:true });
		$('#jqxDateIncidente').jqxDateTimeInput('setDate', new Date(2000, 0, 1));
		$('#jqxPanelRecepcion :input').attr('disabled',true);
	
	}

	function inhabilitoControlesTraslado() {
	
		$('#dtFechaTraslado').jqxDateTimeInput({ disabled: true, readonly: true});
		$('#dtFechaHoraDomTrasladoOrigen').jqxDateTimeInput({ disabled: true, readonly: true });
		$('#dtFechaHoraDomTrasladoDestino').jqxDateTimeInput({ disabled: true, readonly: true });
		$('#dtFechaHoraRetornoTrasladoDestino').jqxDateTimeInput({ disabled: true, readonly: true });
		$('#dpDownSexoTraslado,#dpDownGradosTraslados,#dpDownIVATraslado').jqxDropDownList({ disabled: true });
		$('#chkTrasladoConRetorno').jqxCheckBox('disable');
		$('#panelTrasladosGeneral input, #panelTrasladosOrigen input,#panelTrasladosDestino input').attr("disabled",true);
	}

	function habilitoControlesTraslado() {
	
		$('#dtFechaHoraDomTrasladoOrigen').jqxDateTimeInput({ disabled: false, readonly: false });
		$('#dtFechaHoraDomTrasladoDestino').jqxDateTimeInput({ disabled: false, readonly: false });
		$('#dtFechaHoraRetornoTrasladoDestino').jqxDateTimeInput({ disabled: false, readonly: false });
		$('#dpDownSexoTraslado,#dpDownGradosTraslados,#dpDownIVATraslado').jqxDropDownList({ disabled: false });
		$('#chkTrasladoConRetorno').jqxCheckBox('enable');
		$('#panelTrasladosGeneral input, #panelTrasladosOrigen input,#panelTrasladosDestino input').not('#txtNroTraslado,#txtNroIncidentePanelTraslado,#txtLocTrasladoDestino,#txtLocTrasladoOrigen,#txtPartidoTrasladoOrigen').not('#dtFechaTraslado input').attr("disabled",false);
			
	
	}
	
	
	function setArrayPaciente(datos) {				//SETEO EN UN ARRAY LOS DATOS DEL INCIDENTE
	
		datosPaciente[0] = datos[0].Cliente;
		datosPaciente[1] = datos[0].NroAfiliado;
		datosPaciente[2] = datos[0].LocAbr;
		datosPaciente[3] = datos[0].Localidad;
		datosPaciente[4] = datos[0].Partido;
		datosPaciente[5] = datos[0].Calle;
		datosPaciente[6] = datos[0].Altura;
		datosPaciente[7] = datos[0].Piso;
		datosPaciente[8] = datos[0].Depto;
		datosPaciente[9] = datos[0].EntreCalle1;
		datosPaciente[10] = datos[0].EntreCalle2;
		datosPaciente[11] = datos[0].Sexo;
		datosPaciente[12] = parseInt(datos[0].Edad);
		datosPaciente[13] = datos[0].Grado;
		datosPaciente[14] = datos[0].Paciente;
		datosPaciente[15] = datos[0].IVA;
		datosPaciente[16] = datos[0].Plan;
		datosPaciente[17] = datos[0].CoPago;
		datosPaciente[18] = datos[0].Telefono;
		datosPaciente[19] = datos[0].NroIncidente;
		datosPaciente[20] = datos[0].Aviso;
		datosPaciente[21] = datos[0].Observaciones;
		datosPaciente[22] = datos[0].FechaIncidente;
		datosPaciente[23] = datos[0].Referencia;
		datosPaciente[24] = datos[0].Sintomas;
		$('#hidRowIncidente').val(datos[0].ID);
		$('#hidIdAfiliado').val(datos[0].idAfi);
				
	}

	function setTextBoxPacientes() {		//LLENO LOS TEXTBOX DEL FORMULARIO CON LOS DATOS DEL ARRAY DEL INCIDENTE
	
		$('#txtCliente').val(datosPaciente[0]);
		$('#txtNroAfiliado').val(datosPaciente[1]);
		$('#txtAbrLoc').val(datosPaciente[2]);
		$('#txtLoc').val(datosPaciente[3]);
		$('#txtPartido').val(datosPaciente[4]);
		$('#txtCalle').val(datosPaciente[5]);
		$('#txtAltura').val(datosPaciente[6]);
		$('#txtPiso').val(datosPaciente[7]);
		$('#txtDepartamento').val(datosPaciente[8]);
		$('#txtEntreCalle1').val(datosPaciente[9]);
		$('#txtEntreCalle2').val(datosPaciente[10]);
		
		var itemsSexo = $("#dropDownSexo").jqxDropDownList('getItems');
		var indexToSelect = -1;
		$.each(itemsSexo, function (index) {
			 if (this.label == datosPaciente[11]) {
				indexToSelect = index;
				 return false;
				}
			});
			
		$("#dropDownSexo").jqxDropDownList({ selectedIndex: indexToSelect });
		
		var itemsGrados = $("#dropDownGrados").jqxDropDownList('getItems');
		indexToSelect = -1;
		$.each(itemsGrados, function (index) {
			 if (this.label == datosPaciente[13]) {
				indexToSelect = index;
				 return false;
				}
			});
			
		$("#dropDownGrados").jqxDropDownList({ selectedIndex: indexToSelect });
			
		var itemIVA = $("#dropDownIVA").jqxDropDownList('getItemByValue',datosPaciente[15]);
		$('#dropDownIVA').jqxDropDownList('selectItem',itemIVA);
		
		$('#txtEdad').val(datosPaciente[12]);
		$('#txtPaciente').val(datosPaciente[14]);
		$('#txtPlan').val(datosPaciente[16]);
		$('#txtCoPago').val(datosPaciente[17]);
		$('#txtTelefono').val(datosPaciente[18]);
		$('#txtNroIncidente').val(datosPaciente[19]);
		$('#txtAviso').val(datosPaciente[20]);
		$('#txtObservaciones').val(datosPaciente[21]);
		fechaInc = datosPaciente[22];

		if (fechaInc.length == 8) {

			fechaInc = cacheDateToJavascript(fechaInc);

		} else {

			fechaInc = fechaInc.substring(0,10);
			fechaInc = strDateToJavascriptDate(fechaInc);	

		}
					console.log(fechaInc);
		$('#jqxDateIncidente').jqxDateTimeInput('setDate', fechaInc);

		$('#txtReferencias').val(datosPaciente[23]);
		$('#txtSintomas').val(datosPaciente[24]);
		$('#dialogoValidoTel').modal('hide');		
	
	}

	function clearControlesRecepcion() {
	
		$('#jqxPanelRecepcion :input').val('');
		$('#jqxDateIncidente').jqxDateTimeInput('setDate', new Date(2000, 0, 1));
		$('#jqxDateIncidente').jqxDateTimeInput({ disabled: true, readonly:true });	
		$('#grdRecepcionHistorial, #grdRecepcionProgramacion').jqxGrid({ source: [] });
		$('#dropDownGrados,#dropDownIVA,#dropDownSexo').jqxDropDownList('clearSelection');
		$('#dropDownGrados').css("background-color","white");	
	}
	
	function limpiarIncidente() {
	
		inhabilitoControlesRecepcion();
		clearControlesRecepcion();
		$('#btnGuardarIncidente').css("display","none");
		flgAccionF10 = 0;
	
	}
	
	function guardarIncidente() {
	
				var datosIncidente = getVecDatosIncidente();
				
				var msgError = validoGuardarIncidente();
				
				var opt = 0;
			
				 if (msgError === "") {
				 
					if (flgAccionF10 == 2) opt = 1;					
				 
					 $.ajax({
						type: "POST",
						url: "setIncidente.php?opt="+opt,
						data: { pArray : datosIncidente },
						success: function(datos){		
							
						if (datos === "") {
							var mensaje = 'El servicio fue guardado correctamente';
							setMessage('success',1500,mensaje,'',200);
							refreshDataInc(flgIncTras);	
							flgAccionF10 = 0;
							$('#jqxTabsOperativa').jqxTabs({ selectedItem : 0 });
							limpiarIncidente();
							focusGrdIncidentes();
						} else { 
							console.log(datos) 
						}
					  }
				    });	
						
				 } else {
					 	
					setMessage('error',2000,msgError,txtTelefono,'');
				
				}
	}
	
	function getVecDatosIncidente() {
	
					var itemSexo = $("#dropDownSexo").jqxDropDownList('getSelectedItem');
			if (itemSexo != null) var sexo = itemSexo.value;
			
			var itemGrado = $("#dropDownGrados").jqxDropDownList('getSelectedItem');
			if (itemGrado != null) var grado = itemGrado.label;
			
			var itemIVA = $("#dropDownIVA").jqxDropDownList('getSelectedItem');
			if (itemIVA != null) var iva = itemIVA.label;
			
			var fechaInc = $('#jqxDateIncidente').jqxDateTimeInput('getText');
			fechaInc = getFechaSQL(fechaInc);
			
			var datosIncidente = [];
				datosIncidente.push(fechaInc);
				datosIncidente.push($('#txtNroIncidente').val());
				datosIncidente.push($('#txtTelefono').val());
				datosIncidente.push($('#txtCliente').val());
				datosIncidente.push($('#txtNroAfiliado').val());
				datosIncidente.push($('#txtAviso').val());
				datosIncidente.push($('#txtAbrLoc').val());
				datosIncidente.push($('#txtLoc').val());
				datosIncidente.push($('#txtPartido').val());
				datosIncidente.push($('#txtCalle').val());
				datosIncidente.push($('#txtAltura').val());
				datosIncidente.push($('#txtPiso').val());
				datosIncidente.push($('#txtDepartamento').val());
				datosIncidente.push($('#txtEntreCalle1').val());
				datosIncidente.push($('#txtEntreCalle2').val());
				datosIncidente.push($('#txtReferencias').val());
				datosIncidente.push(sexo);
				datosIncidente.push($('#txtEdad').val());
				datosIncidente.push($('#txtSintomas').val());
				datosIncidente.push(grado);
				datosIncidente.push($('#txtPaciente').val());
				datosIncidente.push(iva);
				datosIncidente.push($('#txtPlan').val());
				datosIncidente.push($('#txtCoPago').val());
				datosIncidente.push($('#txtObservaciones').val());
				datosIncidente.push(user);
				
				return datosIncidente;
	
	}
	
	function setNroIncidenteNuevo() {
	
		$.ajax({
			url:'getInfoIncidente.php?opt=1',
			type : 'GET',
			success : function(pInc){
			
				$('#txtNroIncidente').val(pInc);
		
			}
		});
			

	}
	
	function buscarCliente(cliente,pFocus) {
	
		$.ajax({
				type: "GET",
				url: "getSetClientes.php?opt=0&cli="+cliente,
				success: function(datos){			
						
					if (datos == "ok") {
							
						setGrillaAfiliados(cliente);		//UNA VEZ QUE TENGO EL CLIENTE, RECIEN PUEDO SETEAR LA GRILLA CUANDO BUSQUE UN AFILIADO
						
						$('#'+pFocus).focus();
											
					} else {
							
						$('#grdClientes').jqxGrid('selectrow',0);	//SI NO ENCONTRO EL CLIENTE, MUESTRA POPUP CON GRILLA DE CLIENTES PARA BUSCARLO
						$('#popupClientes').jqxWindow('focus');
						$('#grdClientes').jqxGrid('focus');
						$('#popupClientes').jqxWindow('open');
							
					}
						
				}
			});

	}
	
		
	function setDataCliente() {
		
		var rowindex = $('#grdClientes').jqxGrid('getselectedrowindex');	
	
		var rowData = $('#grdClientes').jqxGrid('getrowdata',rowindex);	//OBTENGO LA INFO DEL CLIENTE
		
		var selectedItem = $('#jqxTabsOperativa').jqxTabs('selectedItem');
	
		switch (selectedItem) {
			
			case 1:
				$('#txtCliente').val(rowData.Codigo);	//SETEO EL CODIGO
				setTimeout(function(){
					$('#txtNroAfiliado').focus();
				}, 10)
			break;
			
			case 2:
				$('#txtClienteTraslado').val(rowData.Codigo);	//SETEO EL CODIGO
				setTimeout(function(){
					$('#txtNroAfiliadoTraslado').focus();
				}, 10)
			
			break;
					
		}
	
		setGrillaAfiliados(rowData.Codigo);		//SETEO LA GRILLA DE AFILIADOS (PORQUE YA TENGO EL CLIENTE)
	
		$('#popupClientes').jqxWindow('close');

	}
	
					
	function validoTelefonoCliente(tel) {
		
		$.ajax({
				type: "GET",
				dataType: "json",
				url: "getInfoIncidente.php?opt=0&tel="+tel,
				success: function(datos){			
						
					if (datos != 0) {
							
						$('#msgValidoTel').text("¿Se refiere al paciente " + datos[0]["Paciente"] + " ?");
						$('#dialogoValidoTel').modal('show');

						setArrayPaciente(datos);
													
					} else {
							
						switch (flgTel) {
								
							case 0:	
								setTimeout(function(){
								$('#txtCliente').focus();
							}, 10);
							break;
								
							case 1:
								setTimeout(function(){
									$('#txtPacienteTraslado').focus();
								}, 10);
							break;
							}			
						}	
					}
				});	
			}
			
	function setTextBoxSegunTelefono() {
		
		switch(flgTel) {
			
			case 0:		
			$('#txtCliente').val(datosPaciente[0]);
			$('#txtNroAfiliado').val(datosPaciente[1]);
			$('#txtAbrLoc').val(datosPaciente[2]);
			$('#txtLoc').val(datosPaciente[3]);
			$('#txtPartido').val(datosPaciente[4]);
			$('#txtCalle').val(datosPaciente[5]);
			$('#txtAltura').val(datosPaciente[6]);
			$('#txtPiso').val(datosPaciente[7]);
			$('#txtDepartamento').val(datosPaciente[8]);
			$('#txtEntreCalle1').val(datosPaciente[9]);
			$('#txtEntreCalle2').val(datosPaciente[10]);
			
			var itemsSexo = $("#dropDownSexo").jqxDropDownList('getItems');
			var indexToSelect = -1;
			$.each(itemsSexo, function (index) {
   				 if (this.label == datosPaciente[11]) {
        			indexToSelect = index;
       				 return false;
    				}
				});
				
			$("#dropDownSexo").jqxDropDownList({ selectedIndex: indexToSelect });
				
			$('#txtEdad').val(datosPaciente[12]);
			$('#txtPaciente').val(datosPaciente[14]);
			$('#txtPlan').val(datosPaciente[16]);
			$('#txtCoPago').val(datosPaciente[17]);
			$('#txtTelefono').val(datosPaciente[18]);
			$('#dialogoValidoTel').modal('hide');
			
			break;
			
			case 1:
			$('#txtClienteTraslado').val(datosPaciente[0]);
			$('#txtNroAfiliadoTraslado').val(datosPaciente[1]);
			$('#txtAbrLocTrasladoOrigen').val(datosPaciente[2]);
			$('#txtLocTrasladoOrigen').val(datosPaciente[3]);
			$('#txtPartidoTrasladoOrigen').val(datosPaciente[4]);
			$('#txtDomTrasladoOrigen').val(datosPaciente[5]);
			$('#txtAlturaTrasladoOrigen').val(datosPaciente[6]);
			$('#txtPisoTrasladoOrigen').val(datosPaciente[7]);
			$('#txtDepartamentoTrasladoOrigen').val(datosPaciente[8]);
			$('#txtEntreCalle1TrasladoOrigen').val(datosPaciente[9]);
			$('#txtEntreCalle2TrasladoOrigen').val(datosPaciente[10]);
			
			var itemsSexo = $("#dpDownSexoTraslado").jqxDropDownList('getItems');
			var indexToSelect = -1;
			$.each(itemsSexo, function (index) {
   				 if (this.label == datosPaciente[11]) {
        			indexToSelect = index;
       				 return false;
    				}
				});
				
			$("#dpDownSexoTraslado").jqxDropDownList({ selectedIndex: indexToSelect });
				
			$('#txtEdadTraslado').val(datosPaciente[12]);
			$('#txtPacienteTraslado').val(datosPaciente[14]);
			$('#txtPlanTraslado').val(datosPaciente[16]);
			$('#txtCoPagoTraslado').val(datosPaciente[17]);
			$('#txtTelefonoTraslado').val(datosPaciente[18]);
			$('#dialogoValidoTel').modal('hide');
				
			break;	
	
		} 		
	}
	
			
	// function validoLocalidad(loc) {
		
	// 	$.ajax({
	// 			type: "GET",
	// 			dataType: "json",
	// 			url: "getInfoLocalidad.php?loc="+loc,
	// 			success: function(datos){	
											
	// 				if (datos != 0) {
							
	// 					switch(flgLoc) {
	
	// 						case 0:
	// 								$('#txtLoc').val(datos[0].Localidad);
	// 								$('#txtPartido').val(datos[0].Partido);
	// 								$('#txtCalle').focus();
	// 						break;
							
	// 						case 1:
	// 								$('#txtLocDerivacion').val(datos[0].Localidad);
	// 								$('#txtNombreLugarDerivacion').focus();	
	// 						break;
							
	// 						case 2:
	// 								$('#txtLocTrasladoOrigen').val(datos[0].Localidad);
	// 								$('#txtPartidoTrasladoOrigen').val(datos[0].Partido);
	// 								$('#txtDomTrasladoOrigen').focus();
	// 						break;
							
	// 						case 3:
	// 								$('#txtLocTrasladoDestino').val(datos[0].Localidad);
	// 								$('#txtDomTrasladoDestino').focus();
	// 						break;	
								
	// 					}
								
									
	// 				} else {
							
	// 						$('#grdLocalidades').jqxGrid('selectrow',0);
	// 						$('#popupBuscoLocalidades').jqxWindow('focus');
	// 						$('#grdLocalidades').jqxGrid('focus');
	// 						$('#popupBuscoLocalidades').jqxWindow('open');					
							
	// 					}		
	// 				}
	// 			});		
	// 		}
//			
//	function setLocalidadElegida() {
//	
//			var rowindex = $('#grdLocalidades').jqxGrid('getselectedrowindex');	
//			var rowData = $('#grdLocalidades').jqxGrid('getrowdata',rowindex);
//			
//			switch (flgLoc) {
//				
//			
//				case 0:
//						$('#txtAbrLoc').val(rowData.Codigo);
//						$('#txtPartido').val(rowData.Partido);
//						$('#txtLoc').val(rowData.Localidad);
//						$('#txtCalle').focus();
//				break;
//				
//				case 1:
//						$('#txtLocAbrDerivacion').val(rowData.Codigo);
//						$('#txtLocDerivacion').val(rowData.Localidad);
//						$('#txtNombreLugarDerivacion').focus();	
//				break;
//				
//				case 2:
//						$('#txtAbrLocTrasladoOrigen').val(rowData.Codigo);
//						$('#txtPartidoTrasladoOrigen').val(rowData.Partido);
//						$('#txtLocTrasladoOrigen').val(rowData.Localidad);
//						$('#txtDomTrasladoOrigen').focus();
//				break;	
//				
//				case 3:
//						$('#txtAbrLocTrasladoDestino').val(rowData.Codigo);
//						$('#txtLocTrasladoDestino').val(rowData.Localidad);
//						$('#txtDomTrasladoDestino').focus();
//				break;
//				
//				
//			}
//					
//			$('#popupBuscoLocalidades').jqxWindow('close');				
//	}
	
	function validoAfiliado(nroAfiliado) {
	
		var cli = $('#txtCliente').val();
		
		
		$.ajax({
				type: "GET",
				dataType: "json",
				url: "getInfoAfiliado.php?pNroAf=1&nroAf="+nroAfiliado+"&cli="+cli,
				success: function(datos){	
											
					if (datos != 0) {
							
						setTextBoxAfiliado(datos);
									
					} else {
										
						$('#dialogoValidoAfiliado').modal('show');

																								
						}		
					}
				});		
			}
			
	function setTextBoxAfiliado(datos) {
		
		switch(flgAfiliado) {
			
			case 0:
					$('#txtTelefono').val(datos[0].Tel);
					$('#txtCliente').val(datos[0].Cliente);
					$('#txtNroAfiliado').val(datos[0].NroAfiliado);
					$('#txtAviso').val(datos[0].Observ);
					$('#txtAbrLoc').val(datos[0].CodigoLoc);
					$('#txtLoc').val(datos[0].Localidad);
					$('#txtPartido').val(datos[0].Partido);
					$('#txtCalle').val(datos[0].Calle);
					$('#txtAltura').val(datos[0].Altura);
					$('#txtPiso').val(datos[0].Piso);
					$('#txtDepartamento').val(datos[0].Depto);
					$('#txtEntreCalle1').val(datos[0].EntreCalle1);
					$('#txtEntreCalle2').val(datos[0].EntreCalle2);
					$('#txtReferencias').val(datos[0].Referencia);
					var itemSexo = $('#dropDownSexo').jqxDropDownList('getItemByValue',datos[0].Sexo);
					$('#dropDownSexo').jqxDropDownList('selectItem',itemSexo);
					var nombreCompleto = datos[0].Apellido + ", " + datos[0].Nombre;
					$('#txtPaciente').val(nombreCompleto);
					$('#txtEdad').val(datos[0].Edad);
					$('#txtAviso').focus();
			break;
			
			case 1:	
					$('#txtTelefonoTraslado').val(datos[0].Tel);
					$('#txtNroAfiliadoTraslado').val(datos[0].NroAfiliado);
					$('#txtAbrLocTrasladoOrigen').val(datos[0].CodigoLoc);
					$('#txtLocTrasladoOrigen').val(datos[0].Localidad);
					$('#txtPartidoTrasladoOrigen').val(datos[0].Partido);
					$('#txtDomTrasladoOrigen').val(datos[0].Calle);
					$('#txtAlturaTrasladoOrigen').val(datos[0].Altura);
					$('#txtPisoTrasladoOrigen').val(datos[0].Piso);
					$('#txtDepartamentoTrasladoOrigen').val(datos[0].Depto);
					$('#txtEntreCalle1TrasladoOrigen').val(datos[0].EntreCalle1);
					$('#txtEntreCalle2TrasladoOrigen').val(datos[0].EntreCalle2);
					$('#txtReferenciasTrasladoOrigen').val(datos[0].Referencia);
					var itemSexo = $('#dpDownSexoTraslado').jqxDropDownList('getItemByValue',datos[0].Sexo);
					$('#dpDownSexoTraslado').jqxDropDownList('selectItem',itemSexo);
					var nombreCompleto = datos[0].Apellido + ", " + datos[0].Nombre;
					$('#txtPacienteTraslado').val(nombreCompleto);
					$('#txtEdadTraslado').val(datos[0].Edad);
					$('#txtTelefonoTraslado').focus();
							
			break;
			
		}

	}

	// function setReclamos(incidentes) {

	// 	var vRec = [];

	// 	for (var i = 0; i < incidentes.length; i++) {
	// 		vRec.push(incidentes[i].ID);
	// 	}


	// 	$.ajax({
	// 		type: "POST",
	// 		data: { pArray : vRec },
	// 		url: "setReclamos.php",
	// 		success: function(datos){	

	// 			vecReclamos = datos;
	// 			console.log(vecReclamos);
	// 		}
	// 	});
	// }
	
	function setGrillaTimer(){
		
		var timer = $.timer(function() {
	
			refreshDataInc(flgIncTras);
			
        });

        timer.set({ time : 15000, autostart : true });	
		
	}
	
	
	function buscoAfiliadoEnPadron() {
		
		$('#dialogoValidoAfiliado').modal('hide');
		$('#grdAfiliados').jqxGrid('selectrow',0);
		$('#popupBuscoAfiliado').jqxWindow('focus');
		$('#grdAfiliados').jqxGrid('focus');
		$('#popupBuscoAfiliado').jqxWindow('open');
		
	}
	
	function setAfiliadoElegido() {
	
		var rowindex = $('#grdAfiliados').jqxGrid('getselectedrowindex');	
		var rowData = $('#grdAfiliados').jqxGrid('getrowdata',rowindex);
	
		validoAfiliado(rowData.NroAfiliado);

		$('#popupBuscoAfiliado').jqxWindow('close');	
	}
	
	/*******/
	
	function validoSintoma(pSint) {
		
		$.ajax({
				type: "GET",
				dataType: "json",
				url: "getInfoSintoma.php?sint="+pSint,
				success: function(datos){	
											
					if (datos != 0) {
							
						switch (flgSintomas) {
								
						 	case 0:
									$('#txtSintomas').val(datos[0].Descripcion);	
									idSintoma = datos[0].ID;
									var edadPaciente = $('#txtEdad').val();
									var cliente = $('#txtCliente').val();
									meFijoSiCategorizo(idSintoma,edadPaciente,cliente);
							break;	
								
						}
							
							
									
					} else {
													
							$('#dialogoValidoSintoma').modal('show');

							
						}		
					}
				});		
			}
		
	
	function meFijoSiCategorizo(idSintoma,edad,cli) {
		
			$.ajax({
					type: "GET",
					url: "getOpcionesCategorizacion.php?opt=0&cli="+cli,
					success: function(flgCategorizador){	
											
						if (flgCategorizador == 1) {
							
							abroCategorizador(idSintoma,edad);
															
						} else {
													
							$('#txtPaciente').focus();	
							
						}		
					}
				});	
		
		
	}
	
	function abroCategorizador(idSintoma,edad) {
		
			$.ajax({
					type: "GET",
					url: "getOpcionesCategorizacion.php?opt=1",
					success: function(limite){	
											
						if (edad <= limite) flgPediatrico = 1;
						
							getPreguntas(idSintoma,flgPediatrico);
						//$('#popupCategorizador').jqxWindow('focus');
						
					}
				});				
			}
			
			
	function getPreguntas(idSintoma,flgPediatrico) {
			
		$.ajax({
				type: "GET",
				dataType: "html",
				url: "getOpcionesCategorizacion.php?opt=2&flgPediatria="+flgPediatrico+"&idSint="+idSintoma,
				success: function(datos){
						
					$('#contentCategorizador').html(datos);
					$('#contentCategorizador .dpDownCateg').first().jqxDropDownList('focus');
					$('#popupCategorizador').jqxWindow('open');
								
					}
				});	
	}
	
	function getDataIncidenteForPopup() {
		
		var rowindex = $('#grdIncidentes').jqxGrid('getselectedrowindex');
		var data = $('#grdIncidentes').jqxGrid('getrowdata',rowindex);
		var fechaInc = data["FechaIncidente"];
		var nroInc = data["NroIncidente"];
		var grado = data["Grado"];
		var paciente = data["Paciente"];
		var colorGdo = data["ColorGrado"];
		var aviso = data["Aviso"];
		fechaInc = fechaInc.substring(0,10);
		fechaInc = strDateToJavascriptDate(fechaInc);

		
		var vecContenido = [];
		vecContenido[0] = fechaInc;
		vecContenido[1] = nroInc;
		vecContenido[2] = grado;
		vecContenido[3] = colorGdo;
		vecContenido[4] = paciente;
		vecContenido[5] = aviso;
		
		return vecContenido;
			
	}
	
	function validoLugarDerivacion(sanatorio) {
			
		$.ajax({
				type: "GET",
				dataType: "json",
				url: "getSanatorios.php?pAbr="+sanatorio,
				success: function(resultado){
						
					if (resultado == 0) {
								
						mostrarPopupSanatorios();
									
					} else {
									
						switch (flgSanatorio) {
										
							case 0:
									$('#txtLugarDerivacion').val(resultado[0].Descripcion);
									$('#dtFechaHorDeriv').jqxDateTimeInput('focus');
							break;
								
							case 1:
									$('#txtNosocomioTrasladoOrigen').val(resultado[0].Descripcion);
									$('#txtAbrLocTrasladoOrigen').focus();
							
							break;
							
							case 2:
									$('#txtNosocomioTrasladoDestino').val(resultado[0].Descripcion);
									$('#txtAbrLocTrasladoDestino').focus();
							break;	
										
						}
					}
				}
			 });   	
		}
		
	function mostrarPopupSanatorios() {
		
		$('#grdSanatorios').jqxGrid('selectrow',0);
		$('#popupSanatorios').jqxWindow('focus');
		$('#grdSanatorios').jqxGrid('focus');
		$('#popupSanatorios').jqxWindow('open');
		
	}
	
	function setSanatorioInFormulario() {
		
		var rowindex = $('#grdSanatorios').jqxGrid('getselectedrowindex');
		var data = $('#grdSanatorios').jqxGrid('getrowdata',rowindex);
		var sanatorio = data["Sanatorio"];
		var descripcion = data["Descripcion"];
		
		switch (flgSanatorio) {
									
			case 0:
					$('#txtAbrLugarDerivacion').val(sanatorio);
					$('#txtLugarDerivacion').val(descripcion);
					$('#dtFechaHorDeriv').jqxDateTimeInput('focus');	
			break;
								
			case 1:
					$('#txtNosocomioTrasladoOrigen').val(descripcion);
					$('#txtAbrLocTrasladoOrigen').focus();
							
			break;
							
			case 2:
					$('#txtNosocomioTrasladoDestino').val(descripcion);
					$('#txtAbrLocTrasladoDestino').focus();
			break;	
							
			}
		
		
		
	 	$('#popupSanatorios').jqxWindow('close');
				
	}
	
	function validoDiagnosticos() {
		
		var diag = $('#txtDiagnosticoAbrDerivacion').val();
		
		$.ajax({
				type: "GET",
				dataType: "json",
				url: "getDiagnosticos.php?pDiag="+diag,
				success: function(resultado){
						
					if (resultado == 0) {
								
						mostrarPopupDiagnosticos();
									
					} else {
									
						$('#txtDiagnosticoDerivacion').val(resultado[0].Descripcion);
						$('#dtFechaHorDeriv').jqxDateTimeInput('focus');
		
					}
				}
			 });   	
		}
				
	
	
	function setDiagnosticoInForm() {
		
		var rowindex = $('#grdDiagnosticos').jqxGrid('getselectedrowindex');
		var data = $('#grdDiagnosticos').jqxGrid('getrowdata',rowindex);
		var codigo = data["AbreviaturaId"];	
		var descripcion = data["Descripcion"];
		
		$('#txtDiagnosticoAbrDerivacion').val(codigo);
		$('#txtDiagnosticoDerivacion').val(descripcion);
		
		$('#popupDiagnosticos').jqxWindow('close');
		$('#chkReclamo').jqxCheckBox('focus');
			
	}
	
	function setDataDespachoPreasigno() {
		
		var rowindex = $('#grdIncidentes').jqxGrid('getselectedrowindex');
		var data = $('#grdIncidentes').jqxGrid('getrowdata',rowindex);
		var nroInc = data["NroIncidente"];
		var gdo = data["Grado"];
		var colGdo = data["ColorGrado"];
		var dom = data["Domicilio"];
		var loc = data["Localidad"];
		var idViaje = data["ViajeId"];
		var fecInc = strDateToJavascriptDate(data["FechaIncidente"]);
		
		$('#dtPreDespIncidente').jqxDateTimeInput('setDate', new Date(fecInc));
		$('#txtNroIncPreDespIncidente').val(nroInc);
		$('#txtGdoIncPreDespIncidente').val(gdo);
		$('#hidIdViaje').val(idViaje);
		$('#txtGdoIncPreDespIncidente').css("background-color","#"+colGdo);
		$('#txtDomAbrIncPreDespIncidente').val(loc);
		$('#txtDomIncPreDespIncidente').val(dom);
		$('#hidRowIncidente').val(rowindex);
		
		setDataGrillaSugerencias(0,loc,gdo);
		
		$('#popupPreasignoDespacho').jqxWindow('open');	
		
	}
	
	function setTitulosPanelMovilEmpresa(opt) {
		
		switch (opt) {			
			
			case 0:
				
				$('#tituloPreDespMovilEmpresa').text('Móvil');
				$('#movEmpresa').text('Móvil');
				$('#estNombre').text('Estado');
				$('#tipoMovCob').text('Tipo de Móvil');
				
			break;
			
			case 1:
				$('#tituloPreDespMovilEmpresa').text('Empresa');			
				$('#movEmpresa').text('Empresa');
				$('#estNombre').text('Nombre');
				$('#tipoMovCob').text('Tipo de Cobertura');
				
			break;	
						
		}	
	}
	
	function setAviso() {
		
		var fecha = $('#dtFechaAviso').jqxDateTimeInput('getText');
		fecha = getFechaSQL(fecha);
		var inc = $('#txtNroIncAviso').val();
		var aviso = $('#txtTipAviso').val();
		
		
		$.ajax({
				type: "GET",
				url: "updateIncidentes.php?opt=0&fecha="+fecha+"&inc="+inc+"&aviso="+aviso,
				success: function(datos){
										
					refreshDataInc(flgIncTras);
					$('#popupAvisos').jqxWindow('close');
					$('#txtTipAviso').val('');
				
				}
			});				
		}
		
	function setObservReclamos() {
	
		var flgRec = 0;
		var fecha = $('#dtFechaIncObservaciones').jqxDateTimeInput('getText');
		fecha = getFechaSQL(fecha);
		var inc = $('#txtNroIncObservaciones').val();
		var observ = $('#txtAreaObservacionesRecl').val();
		var checked = $('#chkReclamo').jqxCheckBox('checked');
		if (checked) flgRec = 1;
		if ($('#txtAreaObservacionesRecl').val() == '') {
			setMessage('error',1200,'Debe ingresar una observación.','','');
		} else {
		$.ajax({
				type: "GET",
				url: "updateIncidentes.php?opt=1&fecha="+fecha+"&inc="+inc+"&observ="+observ+"&flgRec="+flgRec+"&user="+user,
				success: function(datos){
										
					refreshDataInc(flgIncTras);
					$('#popupObservaciones').jqxWindow('close');
					$('#txtAreaObservacionesRecl').val('');
				
				}
			});	
		}			
	}
	
	
	function setSintomaElegido() {
		
		var rowindex = $('#grdSintomas').jqxGrid('getselectedrowindex');	
		var rowData = $('#grdSintomas').jqxGrid('getrowdata',rowindex);
		validoSintoma(rowData.Descripcion);
		$('#popupBuscoSintoma').jqxWindow('close');	
		
	}
	
	function validoGuardarIncidente() {
		
		var msgError = "";
		
		if ($('#txtTelefono').val() === "") msgError = msgError + 'Debe ingresar un teléfono <br/>';
		if ($('#txtCalle').val() === "") msgError = msgError + 'Debe ingresar un domicilio <br/>';
		if ($('#txtSintomas').val() === "") msgError = msgError + 'Debe ingresar un síntoma <br/>';
		if ($('#dropDownGrados').jqxDropDownList('selectedIndex') === -1) msgError = msgError + 'Debe seleccionar el grado del servicio <br/>';		
		
		return msgError;
	}

	
	
	function validoPreasignacion() {
		
		var bPreasignar = true;
		
		$('#grpSugerencia input[type="text"]').each(function(index, element) {
            
			if ($(this).val() == '') {
				
			  bPreasignar = false;
			}
			  		
      	});
			
		return bPreasignar;	
		
	}
	
	function preasignoIncidente() {
		
		var fechaInc = $('#dtPreDespIncidente').jqxDateTimeInput('getText');
		fechaInc = getFechaSQL(fechaInc);
		var nroMov = $('#txtMovEmpresa').val();
		var idViaje = $('#hidIdViaje').val();
		if (!validoPreasignacion()) nroMov = 0;
		
		$.ajax({
				type: "GET",
				url: "setSalidas.php?opt=0&fecha="+fechaInc+"&idViaje="+idViaje+"&mov="+nroMov,
				success: function(datos){
								
					$('#popupPreasignoDespacho').jqxWindow('close');
					refreshDataInc(0);	
										
				}
			});
	}
	
	function despachoIncidente() {
	
		var fechaInc = $('#dtPreDespIncidente').jqxDateTimeInput('getText');
		fechaInc = getFechaSQL(fechaInc);
		var nroMov = $('#txtMovEmpresa').val();
		var idViaje = $('#hidIdViaje').val();
		var tipoServicio = getTipoServicio();
		var condicion = getTipoAccion();
		
		if ((nroMov == '')) {
		
			setMessage('error',1000,'Debe indicar un móvil para despachar el servicio.','','');
		
		} else {

			var url = "setSalidas.php?opt=1";
			url+= "&fecha="+fechaInc;
			url+= "&mov="+nroMov;
			url+= "&idViaje="+idViaje;
			url+= "&tServ=" +tipoServicio;
			url+= "&cond=" +condicion;
		
			$.ajax({
				type: "GET",
				url: url,
				success: function(datos){

					console.log(datos);
					refreshDataInc(0);
					
				}
			});	
		}	
	}

	function getTipoServicio() {

		if ($('#movEmpresa').text() == 'Empresa') {

			return 'Z';

		} else {

			return 'S';
		}
	}

	function getTipoAccion() {

		var opt = $('#dpDownAccion').jqxDropDownList('getSelectedIndex');
		switch (opt) {

			case 0:
				return 'REE';
			break;

			case 1:
				return 'APO';
			break;
		}
		
	}
	
	function strDateToJavascriptDate(fecha) {
		
		var anio  = fecha.substring(0,4);
		var mes   = parseInt(fecha.substring(5,7));
		mes = mes.toString();
		var dia   = parseInt(fecha.substring(8,10));
		dia = dia.toString();
		var fechaJs = anio + ", " + mes + ", " + dia;
		return fechaJs;
		
	}

	function cacheDateToJavascript(fecha) {

		var anio  = fecha.substring(0,4);
		var mes   = parseInt(fecha.substring(4,6));
		mes = mes.toString();
		var dia   = parseInt(fecha.substring(6,8));
		dia = dia.toString();
		var fechaJs = anio + ", " + mes + ", " + dia;
		return fechaJs;
	}
	
	function setMessage(typeMsg,timeDelay,msg,txtToFocus,pos) {
	
		$('#notif').notify({
			closable : false,
			fadeOut: { enabled: true, delay: timeDelay },
			message: { html : true, text: msg },
			type : 'alert alert-'+typeMsg,		
		}).show();
		
		if (txtToFocus != '') $('#notif').notify({ onClosed: $('#'+txtToFocus).focus()}) ;
		if (pos != '') $('#notif').css("top",pos+"px");
		$('#notif').css("z-index",99999);
	
	}
	
	function setTooltips() {
	
			
		$('#itmAgregar,#itmAgregarTraslado').tooltip({title: 'Agregar un nuevo servicio', placement: 'bottom'});
		$('#itmCancelar,#itmCancelarTraslado').tooltip({title: 'Cancelar un servicio', placement: 'bottom'});
		$('#itmEditar,#itmEditarTraslado').tooltip({title: 'Modificar el servicio', placement: 'bottom'});
		$('#itmActualizar,#itmActualizarTraslado').tooltip({title: 'Refrescar los datos del servicio', placement: 'bottom'});
		$('#itmAtrasTotal,#itmAtrasTotalTraslado').tooltip({title: 'Regresar al primer servicio de la fecha', placement: 'bottom'});
		$('#itmAtras,#itmAtrasTraslado').tooltip({title: 'Regresar al servicio anterior', placement: 'bottom'});
		$('#itmAdelante,#itmAdelanteTraslado').tooltip({title: 'Avanzar al siguiente servicio', placement: 'bottom'});
		$('#itmAdelanteTotal,#itmAdelanteTotalTraslado').tooltip({title: 'Avanzar hasta el último servicio', placement: 'bottom'});
		$('#itmCategorizacion').tooltip({title: 'Abrir categorizaciones', placement: 'bottom'});
		$('#itmImprimir,#itmImprimirTraslado').tooltip({title: 'Imprimir el servicio', placement: 'bottom'});
		$('#itmProgramarFecha,#itmProgramarFechaTraslado').tooltip({title: 'Programar el servicio en fechas', placement: 'bottom'});
		$('#itmHistoriaClinica,#itmHistoriaClinicaTraslado').tooltip({title: 'Mostrar la historia clínica del paciente', placement: 'bottom'});
		$('#itmObservaciones,#itmObservacionesTraslado').tooltip({title: 'Ver Log de Observaciones', placement: 'bottom'});
		$('#itmBuscar,#itmBuscarTraslado').tooltip({title: 'Ver Buscador de Servicios', placement: 'bottom'});
	
	}
	
	function bindEventosOperativa() {
	


$('#grdBusqServ').on('rowdoubleclick',function(ev){
	
	var rowData = getRowData('grdBusqServ');
	var idRow = rowData.ID;
	clearControlesRecepcion();		//LIMPIO LOS CONTROLES DEL FORMULARIO DE RECEPCION	
  	inhabilitoControlesRecepcion(); //DISABLEO LOS CONTROLES DEL FORMULARIO DE RECEPCION
  	setHistorial(idRow);			  //CARGO GRILLA DE HISTORIAL DEL INCIDENTE
  	setProgramacion(idRow);		  //CARGO GRILLA DE PROGRAMACION DEL INCIDENTE
  	setDataPacienteRecepcion(idRow);		//BUSCO INFORMACION DEL INCIDENTE EN LA BASE DE DATOS
	$('#popupBusqServ').jqxWindow('close');
	
	
	
});

$('#dropDownTipoIncidentes').on('select', function (event) {
    var args = event.args;
    if (args) {            
        var index = args.index;
		flgIncTras = index;
		refreshDataInc(flgIncTras);
		setLogIncidentes(flgIncTras);
  	  }                        
	});			

//****************************************************************************************************************************************************
		
//CAPTO EL SELECT EN LA DROPDOWN DE GRADOS, Y CAMBIO EL GRAFICO DE TIEMPOS OPERATIVOS SEGUN GRADO		
$('#jqxSelGradoChart').on('select', function (event) {
    var args = event.args;
    if (args) {
               
        var args = event.args;
        var item = $('#jqxSelGradoChart').jqxDropDownList('getItem', args.index);
		var idGrado = item.value;
		//setDataOnChartOperativos(idGrado);
		
  	}                        
});	

//****************************************************************************************************************************************************
		
//CAPTO EL EVENTO DOBLE CLICK EN LA GRILLA DE INCIDENTES PARA QUE ME CAMBIE DE TAB Y ME MUESTRE LOS DATOS DEL INCIDENTE
$('#grdIncidentes').on('rowdoubleclick', function (event) 
{
	var args = event.args;
	var idxRow = args.rowindex;
	var rowData = getRowData('grdIncidentes');
	var idRow = rowData.ID;

  clearControlesRecepcion();		//LIMPIO LOS CONTROLES DEL FORMULARIO DE RECEPCION	
  inhabilitoControlesRecepcion(); //DISABLEO LOS CONTROLES DEL FORMULARIO DE RECEPCION
  setHistorial(idRow);			  //CARGO GRILLA DE HISTORIAL DEL INCIDENTE
  setProgramacion(idRow);		  //CARGO GRILLA DE PROGRAMACION DEL INCIDENTE
  setDataPacienteRecepcion(idRow);		//BUSCO INFORMACION DEL INCIDENTE EN LA BASE DE DATOS
  $('#jqxTabsOperativa').jqxTabs('select', 1);
   
	});
	
//****************************************************************************************************************************************************	
  
//SETEO VALOR MAXIMO DEL CATEGORIZADOR PARA QUE ME DE ROJO  	
  

//SETEO FUNCIONES DE MENU DE RECEPCION

	$('#itmAgregar').click(function(e) {
    
		clearControlesRecepcion();		//LIMPIO FORMULARIO DE RECEPCION
		$('#btnGuardarIncidente').css("display","inline-block");
		flgAccionF10 = 1;
		
		var today = new Date();
		var dd = today.getDate();
		var dy = today.getFullYear();
		var dm = today.getMonth();
	
		$('#dropDownGrados, #dropDownIVA, #dropDownSexo').jqxDropDownList({ disabled: false });
		$('#jqxPanelRecepcion :input').attr('disabled',false);
		$('#jqxDateIncidente').jqxDateTimeInput('setDate', new Date(dy,dm,dd));
		//$('#jqxDateIncidente').jqxDateTimeInput({ disabled: true, readonly:true });
		$('#txtLoc,#txtPartido,#txtDiagnostico,#txtCierre,#txtPacienteDerivado').attr('disabled',true);
		setNroIncidenteNuevo();
		$('#txtNroIncidente').attr('readonly',true);
		$('#txtTelefono').focus();
	
	});
	
	$('#itmCancelar').click(function(e) {
	
		limpiarIncidente();
					
     });
	 
	 $('#btnGuardarIncidente').click(function(e){
		
		guardarIncidente();
	 
	 });
	 
	 $('#itmEditar').click(function(e) {
        
		if ($('#txtNroIncidente').val() != "") {
		flgAccionF10 = 2;
		$('#btnGuardarIncidente').css("display","inline-block");
		$('#dropDownGrados, #dropDownIVA, #dropDownSexo').jqxDropDownList({ disabled: false });
		$('#jqxPanelRecepcion :input').attr('disabled',false);
		$('#txtLoc,#txtPartido,#txtDiagnostico,#txtCierre,#txtPacienteDerivado').attr('disabled',true);
		$('#txtNroIncidente').attr('readonly',true);
		$('#txtTelefono').focus(); 
		} else {
			
			alert('No hay ningún incidente seleccionado');	
		}
		
    });
					
//SETEO VALIDACION DEL CLIENTE	
	$("#txtCliente").keydown(function(ev) {
  		
		if (ev.which == 13) {		//SI TOCO ENTER
			
			var cliente = $(this).val().toString();
								
			buscarCliente(cliente,'txtNroAfiliado');		//BUSCO EL CLIENTE EN LA BASE DE DATOS
		}
});
//SETEO VALIDACION DEL CLIENTE TRASLADO
	$("#txtClienteTraslado").keydown(function(ev) {
  		
		if (ev.which == 13) {		//SI TOCO ENTER
			
			var cliente = $(this).val().toString();
								
			buscarCliente(cliente,'txtNroAfiliadoTraslado');		//BUSCO EL CLIENTE EN LA BASE DE DATOS
		}
});


	$('#grdClientes').on('rowdoubleclick',function(event) {	
				
			setDataCliente();
							
	});
	
	
	$('#grdClientes').keydown(function(ev) {
		
			if (ev.which == 13) {
				
				setDataCliente();
			}
		
	});
	
	
//SETEO VALIDACION TELEFONICA

		
	$("#txtTelefono").keydown(function(ev) {
  		
		if (ev.which == 13) {
			
			if ($('#txtTelefono').val().length > 5 ) {
			
				var tel = $('#txtTelefono').val();
				validoTelefonoCliente(tel);
				flgTel = 0;
	
			} else {
				
				$('#txtCliente').focus();
				
			}
			
			
		}
		
	});
	
	$("#txtTelefonoTraslado").keydown(function(ev) {
  		
		if (ev.which == 13) {
			
			if ($('#txtTelefonoTraslado').val().length > 5 ) {
			
				var tel = $('#txtTelefonoTraslado').val();
				validoTelefonoCliente(tel);
				flgTel = 1;
	
			} else {
				
				$('#txtPacienteTraslado').focus();
				
			}
			
			
		}
		
	});
			
	$('#btnAceptarPacienteTelefono').click(function(e) {
        
		switch (flgTel) {
								
			case 0:		
				setTimeout(function(){
					$('#txtAviso').focus();
				}, 10);
			break;
								
			case 1:		
				setTimeout(function(){
			$('#txtPacienteTraslado').focus();
		}, 10);
			break;
					
		}
						
		setTextBoxSegunTelefono();
			
    });	
	
	$('#btnCancelarPacienteTelefono').click(function(e) {
        	
		focusAfterCloseValidoTelefono();
				
    });

	$('#btnCancelarPacienteTelefono').keydown(function(e){
	
		if (e.which == 13) {
		
			focusAfterCloseValidoTelefono();
		
		}
	
	});
	
	$('#dialogoValidoTel').on('shown',function(e){
	
		setTimeout(function(){
			$('#btnAceptarPacienteTelefono').focus();
		}, 10);
		
	});
	
	function focusAfterCloseValidoTelefono() {
	
		switch (flgTel) {
				
			case 0:
				setTimeout(function(){
					$('#txtCliente').focus();
				}, 10);
			break;
				
			case 1:
				setTimeout(function(){
					$('#txtPacienteTraslado').focus();
				}, 10);
			break;	
				
		}
			
		$('#dialogoValidoTel').modal('hide');

	}
	
	//SETEO VALIDACION LOCALIDAD
	
	$('#txtAbrLoc,#txtAbrLocDerivacion,#txtAbrLocTrasladoOrigen,#txtAbrLocTrasladoDestino').keydown(function(ev) {
				
		if (ev.which == 13) {
			
		var idControl = $(this).attr("id");
		
		switch (idControl) {
			
			case 'txtAbrLoc':
				$('#hidAbrLoc').val(3);
			break;	
			
			case 'txtAbrLocDerivacion':
				$('#hidAbrLoc').val(4);
			break;
			
			case 'txtAbrLocTrasladoOrigen':
				$('#hidAbrLoc').val(5);
			break;
			
			case 'txtAbrLocTrasladoDestino':
				$('#hidAbrLoc').val(6);
			break;
			
		}
		
		var loc = $(this).val().toString();
		
		validoLocalidad(loc)
						
		}
		
	});
	


	$('#txtNroAfiliado').keydown(function(ev) {

    if (ev.which == 13) {

        var nroAfiliado = $('#txtNroAfiliado').val();
        validoAfiliado(nroAfiliado);
        flgAfiliado = 0;

    	}

	});
	
	$('#txtNroAfiliadoTraslado').keydown(function(ev) {
		
		if (ev.which == 13) {		
			
			var nroAfiliado = $('#txtNroAfiliadoTraslado').val();
			validoAfiliado(nroAfiliado);	
			flgAfiliado = 1;
			
		}
	});
	
//SETEO VALIDACION DE AFILIADO

	$('#btnBuscarAfiliadoEnPadron').keydown(function(e) {
                
		var idControl = $(this).attr("id");
							
		if ( e.which == 37 | e.which == 39) {
				
			$('#'+idControl).removeClass('btnPopup');
			$('#btnConfirmarAfiliadoInexistente').focus();
			$('#btnConfirmarAfiliadoInexistente').addClass('btnPopup');
								
		}

      });
			
	$('#btnConfirmarAfiliadoInexistente').keydown(function(e) {
                
		var idControl = $(this).attr("id");
	
		if ( e.which == 37 | e.which == 39) {
					
			$('#'+idControl).removeClass('btnPopup');
			$('#btnBuscarAfiliadoEnPadron').focus();
			$('#btnBuscarAfiliadoEnPadron').addClass('btnPopup');
								
		}

     });
			
	$('#btnConfirmarAfiliadoInexistente').click(function(e) {
        
		$('#dialogoValidoAfiliado').modal('hide');
		
		switch (flgAfiliado) {
			
			case 0:
				$('#txtAviso').focus();	
			break;
			
			case 1:
				$('#txtTelefonoTraslado').focus();
			break;
		}
		
    });
	
	$('#dialogoValidoAfiliado').on('shown',function(e){
	
		$('#btnConfirmarAfiliadoInexistente').focus();
	
	});
	

	
	$('#btnBuscarAfiliadoEnPadron').click(function(e) {
        
		buscoAfiliadoEnPadron();
		
    });
	
	$('#btnBuscarAfiliadoEnPadron').keydown(function(e) {
        
		if (e.which == 13) {
			
			buscoAfiliadoEnPadron();	
			
		}
		
    });
	
	
	$('#grdAfiliados').keydown(function(ev) {
		
		if (ev.which == 13) {		
			
			setAfiliadoElegido();	
			
		}
	});
	
	$('#grdAfiliados').on('rowdoubleclick', function(ev) {
		
			setAfiliadoElegido();
		
	});
	

	//SETEO VALIDACION DE SINTOMAS
	
	$('#txtSintomas').keydown(function(e) {
        
		if (e.which == 13) {
			
			var idControl = $(this).attr("id");
			var pSint;
			
			switch(idControl) {
				
				case 'txtSintomas':
						flgSintomas = 0;
						pSint = $('#txtSintomas').val();
						
				break;
								
			}
			
			validoSintoma(pSint);
						
		}
				
    });
	
	$('#contentCategorizador').on('close','.dpDownCateg',function(event) {
	
		acumCategorizador = 0;
		
		for (var i = 0; i < vecPreguntas.length; i++) {
			
			var item = $('#'+vecPreguntas[i]).jqxDropDownList('getSelectedItem');
			var valor = item.value;
			acumCategorizador = acumCategorizador + valor;	
			
		}
		
		if (acumCategorizador >= flgMaxEmergencia) {
			
			//$(this).jqxDropDownList('close');
			setTimeout(function(){
				$('#btnGuardarCateg').focus();
			}, 10);
				   
	   } else {
	   
			//alert($(this).text());// no funca. ver como focusear el proximo dropdown ya que no es rojo.
	   }
									  
				$.ajax({
				 type: "GET",
				 dataType: "json",
				 url: "getOpcionesCategorizacion.php?opt=3&acum="+acumCategorizador,
				 success: function(vecGrado){
						
						var grado = vecGrado[0];
						var color = vecGrado[1];
						
						$('#btnGradoCateg').css("background",'#'+color);
						$('#btnGradoCateg').css("display","block");
						$('#btnGradoCateg').text(grado);
						
						
						
				}
			 });   
		});	
			
		$('#contentCategorizador').on('click','#btnGuardarCateg',function(event) {
		
			
			var grado = $('#btnGradoCateg').text();
			
			var itemsGrado = $("#dropDownGrados").jqxDropDownList('getItems');
			var indexToSelect = -1;
			$.each(itemsGrado, function (index) {
   				 if (this.label == grado) {
        			indexToSelect = index;
       				 return false;
    				}
				});
				
			$("#dropDownGrados").jqxDropDownList({ selectedIndex: indexToSelect });
			$('#popupCategorizador').jqxWindow('close');
			$('#txtPaciente').focus();
			
			
        });	
		
		$('#contentCategorizador').on('click','#btnCancelarCateg',function(event) {
            
			$('#popupCategorizador').jqxWindow('close');
			$('#dropDownGrados').jqxDropDownList('focus');
					
        });
		
	
	$('#btnConfirmarSintomaInexistente').click(function(e) {
        
		confirmoSintomaInexistente();
	
    });
	
	$('#btnConfirmarSintomaInexistente').keydown(function(e){
	
		if (e.which == 13) {
		
			confirmoSintomaInexistente();
			
		}
	
	});
	
	function confirmoSintomaInexistente() {
	
		$('#dialogoValidoSintoma').modal('hide');
		$('#dropDownGrados').jqxDropDownList('focus');
	
	}
	
	$('#btnBuscarSintoma').click(function(e) {
        
		$('#dialogoValidoSintoma').modal('hide');
		$('#grdSintomas').jqxGrid('selectrow',0);
		$('#popupBuscoSintoma').jqxWindow('focus');
		$('#grdSintomas').jqxGrid('focus');
		$('#popupBuscoSintoma').jqxWindow('open');
			
    });
	
	$('#dialogoValidoSintoma').on('shown',function(e){
	

		$('#btnConfirmarSintomaInexistente').focus();

	
	});
	
	$('#popupBuscoSintoma').on('open',function(ev){
		
		setGrillaSintomas();
		
	});
	
	$('#popupDiagnosticos').on('open',function(ev){
		
		setGrdDiagnosticos();
		
	});
	
	$('#itmCtxPreasignar').click(function(e) {
       		
			$('#hidFlgSalida').val(0);
			$('#txtMovEmpresa').val('');
			$('#txtEstNombre').val('');
			$('#txtTipoMovCob').val('');
			$('#dpDownDespacharPreDespIncidente').jqxDropDownList({	selectedIndex : 0   });
			$('#accionPreDesp').css("display","none");
			$('#txtEstNombre').css("width","285px");
			$('#txtTipoMovCob').css("width","310px");
			setDataDespachoPreasigno();
			
	});
	
	$('#itmCtxReclamos').click(function(e) {
		
		$('#popupObservaciones').jqxWindow('open');	
		
	});
	
	$('#popupObservaciones').on('open',function(e) {
		
		var vecObserv = getDataIncidenteForPopup();

		$('#dtFechaIncObservaciones').jqxDateTimeInput('setDate', vecObserv[0]);
		$('#panelObservacionesIncidente :input').attr("disabled",true);
		$('#txtNroIncObservaciones').val(vecObserv[1]);
		$('#txtGdoObservaciones').val(vecObserv[2]);
		$('#txtGdoObservaciones').css("background-color","#"+vecObserv[3]);
		$('#txtPacienteObservaciones').val(vecObserv[4]);
		$('#txtAreaObservacionesRecl').focus();
		
		
	});
	
	$('#popupAvisos').on('open',function(e) {
		
		var vecAvisos = getDataIncidenteForPopup();
		
		$('#dtFechaAviso').jqxDateTimeInput('setDate', vecAvisos[0]);
		$('#txtNroIncAviso').val(vecAvisos[1]);
		$('#txtGdoAviso').val(vecAvisos[2]);
		$('#txtGdoAviso').css("background-color","#"+vecAvisos[3]);
		$('#txtPacienteAviso').val(vecAvisos[4]);
		$('#popupAvisos').jqxWindow('focus');
		$('#txtTipAviso').val(vecAvisos[5]);
		$('#txtTipAviso').focus();
			
	});
	
	$('#btnCancelarAviso').click(function(e) {
        
		$('#popupAvisos').jqxWindow('close');
			
    });
	
	
	
	
	$('#itmCtxDespachar').click(function(e) {
			
			$('#hidFlgSalida').val(1);
			$('#txtMovEmpresa').val('');
			$('#txtEstNombre').val('');
			$('#txtTipoMovCob').val('');
			$('#dpDownDespacharPreDespIncidente').jqxDropDownList({	selectedIndex : 0   });
			$('#txtEstNombre').css("width","230px");
			$('#txtTipoMovCob').css("width","250px");
			$('#accionPreDesp').css("display","block");
			setDataDespachoPreasigno();
		
    });
	
	$('#btnCancelarPreDesp').click(function(e) {
        
		$('#popupPreasignoDespacho').jqxWindow('close');
		
    });
	
	$('#btnCancelarObservacionesRec').click(function(e) {
        
		$('#popupObservaciones').jqxWindow('close');
		
    });
	
	$('#txtAbrLugarDerivacion,#txtNosocomioTrasladoOrigen,#txtNosocomioTrasladoDestino').keydown(function(e) {
        
		if (e.which == 13) {
			
			var idControl = $(this).attr("id");
			var sanatorio;
			
			switch (idControl) {
				
				case 'txtAbrLugarDerivacion':
						flgSanatorio = 0;
						sanatorio = $('#txtAbrLugarDerivacion').val();
						
				break;	
				
				case 'txtNosocomioTrasladoOrigen':
						flgSanatorio = 1;
						sanatorio = $('#txtNosocomioTrasladoOrigen').val();
				break;
				
				case 'txtNosocomioTrasladoDestino':
						flgSanatorio = 2;
						sanatorio = $('#txtNosocomioTrasladoDestino').val();
				break;
				
			}
					
				validoLugarDerivacion(sanatorio);
			
		}
	
    });
	

	$('#panelCierreIncidente :input').attr("disabled","true");
	$('#panelAvisos :input').not("#txtTipAviso").attr("disabled","true");
	$('#txtLugarDerivacion,#txtLocDerivacion,#txtDiagnosticoDerivacion').attr("disabled","true");
	
	$('#popupEstablecerCierre').on('open',function(event) {
		
			$('#txtLugarDerivacion,#txtAbrLugarDerivacion,#txtDomicilioDerivacion,#txtAlturaDerivacion,#txtPisoDerivacion,#txtDeptoDerivacion,#txtNombreLugarDerivacion,#txtDiagnosticoAbrDerivacion,#txtDiagnosticoDerivacion,#txtObservacionesDerivacion').val('');
			$('#dtFechaHorSalCierre').jqxDateTimeInput('focus');		
		
	});
	

	
	$('#txtDiagnosticoAbrDerivacion').keydown(function(e) {
        
		if (e.which == 13) {
			
				validoDiagnosticos();
			
		}
	
    });
	

	
	$('#grdDiagnosticos').on('bindingcomplete',function(e) {
		
		 $('#popupDiagnosticos').jqxWindow('open');
		 $('#grdDiagnosticos').jqxGrid('selectrow',0);
		 $('#popupDiagnosticos').jqxWindow('focus');
		 $('#grdDiagnosticos').jqxGrid('focus');
		 
	});
	
	$('#grdDiagnosticos').keydown(function(e) {
        
		if (e.which == 13) {
			
			setDiagnosticoInForm()			
			
		}
		
    });
	
	$('#grdDiagnosticos').on('rowdoubleclick',function(e) {
		
		setDiagnosticoInForm();
		
	});
	
	
	
	$('#btnCancelarCierre').click(function(e) {
        
		$('#popupEstablecerCierre').jqxWindow('close');
		
    });
	
	
	$('#grdSanatorios').keydown(function(e) {
        
		if (e.which == 13) {
			
			setSanatorioInFormulario();	
		}
		
    });
	
	$('#grdSanatorios').on('rowdoubleclick',function(e) {
		
			setSanatorioInFormulario();
		
	});
	
	
	
	$('#grdSugerenciaMovilesEmpresas').on('rowdoubleclick',function(event){
		
			var rowindex = $('#grdSugerenciaMovilesEmpresas').jqxGrid('getselectedrowindex');	
			var rowData = $('#grdSugerenciaMovilesEmpresas').jqxGrid('getrowdata',rowindex);
			
			var movEmpresa = "";
			var estNombre = "";
			var tipMovCob = "";
			
			var idxDropDown = $('#dpDownDespacharPreDespIncidente').jqxDropDownList('getSelectedIndex');
				
			if ( idxDropDown == 0) {
				
				movEmpresa = rowData.Movil;
				estNombre = rowData.EstMovil;
				tipMovCob = rowData.TipoMovil;	
				
			} else {
				
				movEmpresa = rowData.AbreviaturaId;
				estNombre = rowData.RazonSocial;
				tipMovCob = rowData.TipoCobertura;			
				
			}
			
				$('#txtMovEmpresa').val(movEmpresa);
				$('#txtEstNombre').val(estNombre);
				$('#txtTipoMovCob').val(tipMovCob);
			
	});
	
	$('#dpDownDespacharPreDespIncidente').on('change',function(event) {
		
		var opt = $('#dpDownDespacharPreDespIncidente').jqxDropDownList('getSelectedIndex');
		var loc = $('#txtDomAbrIncPreDespIncidente').val();
		var gdo = $('#txtGdoIncPreDespIncidente').val();
		
		setTitulosPanelMovilEmpresa(opt);
		
		setDataGrillaSugerencias(opt,loc,gdo);
			
	});
	
	
			
	$('#panelPreDespIncidente :input').attr("disabled","true");
			
	
	$('#itmCtxCierre').click(function(e) {
        	
			var rowindex = $('#grdIncidentes').jqxGrid('getselectedrowindex');
			var data = $('#grdIncidentes').jqxGrid('getrowdata',rowindex);
			var fechaInc = data["FechaIncidente"];
			var gdo = data["Grado"];
			var colGdo = data["ColorGrado"];
			var dom = data["Domicilio"];
			var loc = data["Localidad"];
			var nroInc = data["NroIncidente"];
					
			$('#txtNroIncCierre').val(nroInc);
			$('#txtGdoCierre').val(gdo);
			$('#txtDomCierre').val(dom);
			$('#txtDomAbrCierre').val(loc);
			$('#txtGdoCierre').css("background-color","#"+colGdo);
			fechaInc = fechaInc.substring(0,10);
			fechaInc = strDateToJavascriptDate(fechaInc);
			$('#dtFechaCierre').jqxDateTimeInput('setDate', fechaInc);
			
			$('#popupEstablecerCierre').jqxWindow('open');
			
    });
	
	
	
	$('#itmCtxTips').click(function(e) {
        
		$('#popupAvisos').jqxWindow('open');
		
    });
	
	$('#popupAvisos').on('open',function(e){
	
		setTimeout(function(){
			$('#txtTipAviso').focus();
		}, 10);
	
	});
	
	$('#txtTipAviso').keydown(function(e) {
        
		if (e.which == 13) {
			e.preventDefault(); 
			$('#btnAceptarAviso').focus();
		}
		
    });
	
	$('#btnAceptarObservacionesRec').click(function(e) {
        
		setObservReclamos();
		
    });
	
	$('#btnAceptarObservacionesRec').keydown(function(e) {
        
		if (e.which == 13) {
			e.preventDefault();
			setObservReclamos();
		}
		
    });
	
	$('#txtAreaObservacionesRecl').keydown(function(e) {
        
		if (e.which == 13) {
				
			e.preventDefault();
			$('#btnAceptarObservacionesRec').focus();
		}
		
    });
	
	$('#btnAceptarAviso').bind('click',function() {
        
		setAviso();	
					
    });

	
	$('#btnAceptarAviso').keydown(function(e) {
        
		if (e.which == 13) {
			e.preventDefault();
			setAviso();	
		}
		
    });
	
	$('#grdSintomas').keydown(function(ev) {
		
		if (ev.which == 13) {		
			
			setSintomaElegido();	
			
		}
	});
	
	$('#grdSintomas').on('rowdoubleclick',function(ev) {
		
			setSintomaElegido();
			
	});
	
	
	$('#txtPacienteTraslado').keydown(function(e) {
        
		if (e.which == 13) {
			
			$('#dpDownSexoTraslado').jqxDropDownList('focus');	
				
		}
		
    });
	
	$('#dpDownSexoTraslado').on('close',function(event) {
				
			 $('#txtEdadTraslado').focus();	
	
	});
	
	
	
//SETEO MENU CONTEXTUAL PARA GRILLA DE INCIDENTES	
	
	// $("#grdIncidentes").on('rowclick', function (event) {

                   // if (event.args.rightclick) {
					   
					    // var rowindex = $('#grdIncidentes').jqxGrid('getselectedrowindex');
					    // var data = $('#grdIncidentes').jqxGrid('getrowdata',rowindex);
						// var nroInc = data["NroIncidente"];
						// $('#itmCtxIncidente').text('Incidente ' + nroInc);
                        // var scrollTop = $(window).scrollTop();
                        // var scrollLeft = $(window).scrollLeft();
                        // menuContextualGrillaInc.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
                        // return false;
                    //}
                //});
				
	// $("#grdMoviles").on('rowclick', function (event) {

                   // if (event.args.rightclick) {
					   
					    // var rowindex = $('#grdMoviles').jqxGrid('getselectedrowindex');
					    // var data = $('#grdMoviles').jqxGrid('getrowdata',rowindex);
						// var nroMov = data["Movil"];
						// $('#itmCtxMovil').text('Móvil ' + nroMov);
                        // var scrollTop = $(window).scrollTop();
                        // var scrollLeft = $(window).scrollLeft();
                        // menuContextualGrillaMov.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
                        // return false;
                    // }
                // });				

                
				window.oncontextmenu = function() {
					 return false
				 };

	
	$('.itmInput').keydown(function(ev) {
		
		idControl = $(this).attr("id");
		
		if (ev.which == 13) {
			
			 if ( idControl == 'txtPaciente') {
			
					$('#dropDownIVA').jqxDropDownList('focus');
			
			} else if ( idControl == 'txtReferencias') {
				
					$('#dropDownSexo').jqxDropDownList('focus');
		
		    } else if (idControl == 'txtCoPago') {
				
					$('#txtObservaciones').focus();
				
			} else if (idControl == 'txtObservaciones'){ 
			
					$('#btnGuardarIncidente').focus();
					ev.preventDefault();
								
			} else {
				
					$(this).focusNextInputField();
				
			}
						
		}
	});
	
	$('#dropDownSexo').on('close',function(event) {
		
		$('#txtEdad').focus();
		
	});
	
	$('#dropDownIVA').on('close',function(event) {
		
		$('#txtPlan').focus();
		
	});
	
	
	// $('#tabRecepcion').click(function(e){
		
		// flgAccionF10 = 0;
		
	// });
	
	// $('#tabTraslado').click(function(e){
		
		// flgAccionF10 = 1;
		
	// });
	
	$('body').keydown(function(e){ 
	
		var boolValidacion;
		if (e.which == 121) {
		
			if (flgAccionF10 == 1 || flgAccionF10 == 2) {
			
				guardarIncidente();
				
			} else {
			
				guardarTraslado();
			}
	
		}
	});
	
	$('#dpDownLogObserv').on('select',function(ev){
		
		var item = $('#dpDownLogObserv').jqxDropDownList('getSelectedItem');
		var id = item.value;
		getLogObservacion(id);
		
	});
	
	$('#popupSanatorios').on('open',function(ev){
		
		setGrillaSanatorios();
		
	});


	$('#dropDownGrados,#dpDownGradosTraslados').on('change', function (event) {     
    var args = event.args;
    if (args) {
                      
        var index = args.index;
        var item = args.item;
        var color = item.value;
		
		$(this).css("background-color",'#'+color);

   		 }
	 });
	 
	 
	 $('#txtSintomasTraslado').keydown(function(e) {
        
		if (e.which == 13) {
			
			$('#chkTrasladoConRetorno').jqxCheckBox('focus');
		}
		
    });
	
	$('#chkTrasladoConRetorno').on('checked',function(event) {
		
			$('#dpDownGradosTraslados').jqxDropDownList('focus');
		
	});
	
	$('#chkTrasladoConRetorno').keydown(function(e) {
        
			if (e.which == 13) {
				
		   		 $('#chkTrasladoConRetorno').jqxCheckBox('check');
			 	
			}
		
    });
	
	$('#dpDownGradosTraslados').on('close', function(event) {
		
			$('#dpDownIVATraslado').jqxDropDownList('focus');
		
	});
	
	$('#dpDownIVATraslado').on('close',function(event) {
		
			$('#txtPlanTraslado').focus();
		
	});
	
	$('#txtObservTraslado').keydown(function(e) {
		
		if (e.which == 13) {
        
		$('#txtNosocomioTrasladoOrigen').focus();
		
		}
		
    });
	
	$('#txtReferenciasTrasladoOrigen').keydown(function(e) {
		
		if (e.which == 13) {
        
		$('#dtFechaHoraDomTrasladoOrigen').jqxDateTimeInput('focus');
		
		}
		
    });
	
	$('#dtFechaHoraDomTrasladoOrigen').keydown(function(e) {
		
		if (e.which == 13) {
        
		$('#txtNosocomioTrasladoDestino').focus();
		
		}
		
    });
	
	$('#txtReferenciasTrasladoDestino').keydown(function(e) {
		
		if (e.which == 13) {
        
		$('#dtFechaHoraDomTrasladoDestino').jqxDateTimeInput('focus');
		
		}
		
    });
	
	$('#dtFechaHoraDomTrasladoDestino').keydown(function(e) {
		
		if (e.which == 13) {
		
			$('#dtFechaHoraRetornoTrasladoDestino').jqxDateTimeInput('focus');
			
		}
	
    });
	
	$('#dropDownGrados').on('close',function(event) {
		
		$('#txtPaciente').focus();
			
	});
	
	$('#itmAgregarTraslado').click(function(e) {
        
		habilitoControlesTraslado();
		$('#txtClienteTraslado').focus();
		
    });
	
	$('#itmCancelarTraslado').click(function(e) {
        
		inhabilitoControlesTraslado();
		
    });
	
	$('#btnDomicilioAnexo').click(function(e) {
        
		$('#panelTrasladosOrigen,#panelTrasladosDestino').removeClass('escondoElemento');
		$('#grillasRealizacionProgramaciones').addClass('escondoElemento');
		$('#tdPartidoTrasladoDestino').removeClass('escondoElemento');
		$('#tdFecHoraRetorno').addClass('escondoElemento');
		$('#tituloPanelTrasladosOrigen').text("Anexo I");
		$('#tituloPanelTrasladosDestino').text("Anexo II");	
			
    });
	
	$('#btnDomicilioOrigenDestino').click(function(e) {
        
		$('#panelTrasladosOrigen,#panelTrasladosDestino').removeClass('escondoElemento');
		$('#grillasRealizacionProgramaciones').addClass('escondoElemento');
		$('#tdPartidoTrasladoDestino').addClass('escondoElemento');
		$('#tdFecHoraRetorno').removeClass('escondoElemento');
		$('#tituloPanelTrasladosOrigen').text("Origen");
		$('#tituloPanelTrasladosDestino').text("Destino");
			
    });
	
	$('#btnRealizacionProgramaciones').click(function(e) {
        
		$('#panelTrasladosOrigen,#panelTrasladosDestino').addClass('escondoElemento');
		$('#grillasRealizacionProgramaciones').removeClass('escondoElemento');
			
    });
	
	$('#btnAceptarPreDesp').click(function(e) {
	
			if ($('#hidFlgSalida').val() == 0) {
			
				preasignoIncidente();
			
			} else {
			
				despachoIncidente();
			
			}
    });
	
	$('#popupClientes').on('open',function(ev){
		
		setGrillaClientes();
		
	});
	
//FUNCION PARA FOCUSEAR EL NEXT INPUT		
$.fn.focusNextInputField = function() {
    return this.each(function() {
        var fields = $(this).parents('form:eq(0),body').find('button,input,textarea,select');
        var index = fields.index( this );
        if ( index > -1 && ( index + 1 ) < fields.length ) {
            fields.eq( index + 1 ).focus();
        }
        return false;
    });
   };

$.fn.focusNextDropDown = function() {
    return this.each(function() {
        var fields = $(this).parents('#contentCategorizador').find('.dpDownCateg input');
        var index = fields.index( this );
        if ( index > -1 && ( index + 1 ) < fields.length ) {
            fields.eq( index + 1 ).focus();
        }
        return false;
    });
   };   
			 	 							
}
	

