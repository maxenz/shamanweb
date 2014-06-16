
function initComponentes() {

	$('#panelBases').jqxPanel({width:'700',height:'300',theme:'metro'});
	$("#menuGrillaBases").jqxMenu({ width: '800', height: '40px', mode: 'horizontal', theme: 'metro' });

}

function bindEventos() {

$('#dialogoEliminar').on('shown',function(ev){

	$('#btnElimBase').focus();

});

$('#dialogoEliminar').on('hide',function(ev){

	$('#grdBases').jqxGrid('focus');

});

$('#grdBases').on('rowdoubleclick',function(e){
	
	//editBase();
	
});

$('#grdBases').keydown(function(e) {
    
	if (e.which == 13) {
		
		//editBase();	
	}
	
	if (e.which == 46) {
		
		//setPopupEliminar();	
	}
	
	if (e.which == 45) {
	
		//agregarBase();
		
	}
	
});

$('input[type="text"],textarea').keydown(function(ev){
		
	id = $(this).attr("id");
		
	if(ev.which == 13) {
			
		switch (id) {
				
			case 'txtAbrLocBase':
				var abrLocBase = $('#txtAbrLocBase').val();
				$('#hidAbrLoc').val(2);
				validoLocalidad(abrLocBase);	
			break;
				
			case 'txtObsBase':
				$('#btnAceptarBase').focus();
				ev.preventDefault();
			break;
										
			default:
				$(this).focusNextInputField();
			break;
		}
	}		
});				

}

	function elimBase() {
	
		var rowData = getRowData('grdBases');
		var id = rowData.ID;
		procesoEliminarBase(id);
	
	}

	function setPopupEliminar() {

		$('#dialogoEliminar').modal('show');
		
	}
	
	function procesoEliminarBase(id) {
		
		$.ajax({
			
			type: 'GET',
			url: 'getSetBasesOperativas.php?opt=1&id='+id,
			success: function(datos) {	
			
			setGrdBases();
			$('#dialogoEliminar').modal('hide');
				
			}
		});
		
	}

	function agregarBase() {
			
		$('#hidIdBase').val(0);
			
		$('#ctGrillaBases').toggle('slow',function(event){
				
			$('#ctOpcionesBases').toggle('slow');
				$('#txtCodBase').focus();
				blanqueoForm();
		});			
	}
	
	function blanqueoForm() {
		
		$('#ctPanelBases input[type="text"]').each(function(index, element) {
            
			$(this).val('');
			
        });	
		
	}
	
	function procesarNuevaBase() {
		
		var bValido = validoNuevaBase();
		
		if (bValido) {
			
			var vecNuevaBase = [];
			$('#ctPanelBases input[type="text"]').each(function(index, element) {
            
			var valor = $(this).val();

			vecNuevaBase.push(valor);
		
        	});
		
			if ($('#hidIdBase').val() == 0) {
				
				insertNuevaBase(vecNuevaBase,0)
					
			} else {
				
				vecNuevaBase.push($('#hidIdBase').val());
				insertNuevaBase(vecNuevaBase,1);
					
			}
		}
	}
	
	function validoNuevaBase() {
		
		var msgError = "";
		var bValido = true;
		
		if ($('#txtCodBase').val() == "") msgError = msgError +  "- Debe determinar el c&oacute;digo de base. <br />";
		if ($('#txtDescBase').val() == "") msgError = msgError +  "- Debe determinar la descripci&oacute;n de la base. <br />";
		if ($('#txtCalleBase').val() == "") msgError = msgError + "- Debe determinar el domicilio de la base. <br />";
		if ($('#txtAbrLocBase').val() == "") msgError = msgError + "- Debe determinar la localidad de la base. <br />";	
		
		if (msgError != "") {
			$('#notif').notify({
				closable : false,
				fadeOut: { enabled: true, delay: 1000 },
				message: { html : true, text: msgError },
				type : 'alert alert-error',
				onClosed : $('#txtCodBase').focus()
					
			}).show();
			
			bValido = false;	
			
		}
		
		return bValido;		
	}
	
	function editBase() {
		
		var rowData = getRowData('grdBases');
		var id = rowData.ID;
		
		setDatosBase(id);
			
	}
	
	function setDatosBase(id) {
			
		$.ajax({
			type: 'GET',
			dataType: 'json',
			url:  'getSetBasesOperativas.php?opt=3&id='+id,
			success: function(datos){
					
					$('#hidIdBase').val(id);
					$('#txtCodBase').val(datos[0].AbreviaturaId);
					$('#txtDescBase').val(datos[0].DescripcionBase);
					$('#txtAbrLocBase').val(datos[0].AbrLoc);
					$('#txtLocBase').val(datos[0].Localidad);
					$('#txtCalleBase').val(datos[0].Calle);
					$('#txtAlturaBase').val(datos[0].Altura);
					$('#txtPisoBase').val(datos[0].Piso);
					$('#txtDeptoBase').val(datos[0].Depto);
					$('#txtCodPostBase').val(datos[0].CP);
					$('#txtECalle1Base').val(datos[0].ECalle1);
					$('#txtECalle2Base').val(datos[0].ECalle2);
					$('#txtRefBase').val(datos[0].Ref);		
					$('#txtTel1Base').val(datos[0].Tel1);
					$('#txtTel2Base').val(datos[0].Tel2);
					$('#txtTel3Base').val(datos[0].Tel3);
					$('#txtObsBase').val(datos[0].Obser);
					$('.ctToggle').toggle('slow');
					$('#txtCodBase').focus();
												
			}		
		});	
	}
	
	function insertNuevaBase(vecNuevaBase,optInsModif) {
	
		 $.ajax({
			type: "POST",
			url: "getSetBasesOperativas.php?opt=2&optInsModif="+optInsModif,
			data: { pArray : vecNuevaBase },
			success: function(datos){
			
				var mensaje = "";
				
				if (datos == 0) {
					mensaje = "La base fue ingresada correctamente.";
				} else {
					mensaje = "La base fue modificada correctamente.";	
				}
				 setGrdBases();
				 verGrilla();
				 
				  $('#notif').notify({
					closable : false,
					fadeOut: { enabled: true, delay: 1000 },
					message: { html : false, text: mensaje },
					type : 'alert alert-success'
				}).show();
						
			}
		});	
	}
	
	function verGrilla() {
		
		$('#ctOpcionesBases').toggle('slow',function(event){
			
			$('#ctGrillaBases').toggle('slow');
			$('#grdBases').jqxGrid('focus');
		});	
	}


	function initGrdBases() {
	
			$("#grdBases").jqxGrid({
				width:800,
				height:400,
				source: [],
				theme: 'metro',
				columns: [],
				altrows:true,
				showfilterrow: true,
				filterable: true,
			});				
		}
	
	function setGrdBases() {
	
		sourceBases ={
        	datatype: "json",
        	datafields: [{ name: 'ID' },{ name: 'AbreviaturaId'}, {name: 'Descripcion'}, {name: 'Domicilio'},{name: 'Localidad'}],
		 	url: 'getSetBasesOperativas.php?opt=0'
   		 };	
		
		columnasBases = [
			{ text: 'ID', datafield: 'ID', hidden: true },
			{ text: 'C&oacute;digo', datafield: 'AbreviaturaId', width:'10%', cellsalign:'center', align: 'center'},
			{ text: 'Base Operativa', datafield: 'Descripcion', width: '40%', align: 'center'},
			{ text: 'Domicilio', width:'40%', datafield: 'Domicilio', align: 'center'},
			{ text: 'Loc', width:'10%', datafield: 'Localidad', align: 'center', cellsalign: 'center'},
		];
		
		$('#grdBases').jqxGrid({ source: sourceBases, columns: columnasBases});
		$('#grdBases').jqxGrid('selectrow',0);
		$('#grdBases').jqxGrid('focus');
	
	}