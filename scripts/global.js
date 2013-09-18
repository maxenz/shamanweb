// JavaScript Document

	
	
	function setPopupsGenerales() {
				
		$("#popupBuscoLocalidades").jqxWindow({ height:360, width: 545, theme: 'metro', autoOpen:false, isModal: true, resizable: false, animationType: 'combined' });
		x = ($(window).width() - $("#popupBuscoLocalidades").jqxWindow('width')) / 2 + $(window).scrollLeft();
		y = ($(window).height() - $("#popupBuscoLocalidades").jqxWindow('height')) / 2 + $(window).scrollTop();
		$('#popupBuscoLocalidades').jqxWindow({ position: { x: x, y: y} });
		
	}
	
	function openPopup(idPopup) {
		
		$('#'+idPopup).jqxWindow('open');
		$('#'+idPopup).jqxWindow('focus');
		
	}
	
	function getRowData(grilla) {
		
		var rowindex = $('#'+grilla).jqxGrid('getselectedrowindex');	
		var rowData = $('#'+grilla).jqxGrid('getrowdata',rowindex);	
		return rowData;
	}
	
	function setGrillaBusquedaLocalidades() {
	
		sourceGrillaLocalidades ={
        		datatype: "json",
        		datafields: [{ name: 'ID' },{ name: 'Codigo' },{ name: 'Localidad'}, {name: 'Partido'}],
				url: 'getInfoLocalidad.php'
   		};	
	 
		columnasBusquedaLocalidades = [{ text: 'ID', datafield: 'LocId', hidden:true },
									   { text: 'Código', datafield: 'Codigo', width: 50, align: 'center',cellsalign:'center' },
									   { text: 'Localidad', width:225, datafield: 'Localidad', align: 'center'},
									   { text: 'Partido', datafield: 'Partido', width: 225, align: 'center' }];
			
		$("#grdLocalidades").jqxGrid({
				width: 520,
				height:315,
				altrows: true,
				filterable: true,
				sortable: true,
       			source: sourceGrillaLocalidades,
				columnsresize: true,
       			theme: 'metro',
        		columns: columnasBusquedaLocalidades
   			 });
			
	}
	
	function validoLocalidad(abrLoc) {
		
		$.ajax({
				type: "GET",
				dataType: "json",
				url: "getInfoLocalidad.php?loc="+abrLoc,
				success: function(datos){	
					
					consultoValidacion(datos);
													
				}
			});		
		}
	
	function openPopupLocalidades() {
		setGrillaBusquedaLocalidades(); 
		openPopup('popupBuscoLocalidades');
		$('#grdLocalidades').jqxGrid('selectrow',0);
		$('#grdLocalidades').jqxGrid('focus');
				
	}
	
	function setDataInForm(codigo,localidad,partido) {
		
		var opt = $('#hidAbrLoc').val();
		
		
			
		switch(opt) {
				
			case '0':
			
				$('#txtAbrLocTit').val(codigo);
				$('#txtLocalidadTit').val(localidad);
				setTimeout(function(){
					$('#txtCalleTit').focus();
				}, 10);
			break;	
			
			case '1':
			
				$('#txtAbrLocInt').val(codigo);
				$('#txtLocInt').val(localidad);
				setTimeout(function(){
					$('#txtCalleInt').focus();
				}, 10);
			break;
			
			case '2':
			
				$('#txtAbrLocBase').val(codigo);
				$('#txtLocBase').val(localidad);
				setTimeout(function(){
					$('#txtCalleBase').focus();
				}, 10);
			break;
			
			case '3':
				$('#txtAbrLoc').val(codigo);
				$('#txtLoc').val(localidad);
				$('#txtPartido').val(partido);
				setTimeout(function(){
					$('#txtCalle').focus();
				}, 10);
			break;
			
			case '4':
				$('#txtAbrLocDerivacion').val(codigo);
				$('#txtLocDerivacion').val(localidad);
				setTimeout(function(){
					$('#txtNombreLugarDerivacion').focus();
				}, 10);
			break;
			
			case '5':
				$('#txtAbrLocTrasladoOrigen').val(codigo);
				$('#txtLocTrasladoOrigen').val(localidad);
				setTimeout(function(){
					$('#txtDomTrasladoOrigen').focus();
				}, 10);
			break;
			
			case '6':
				$('#txtAbrLocTrasladoDestino').val(codigo);
				$('#txtLocTrasladoDestino').val(localidad);
				setTimeout(function(){
					$('#txtDomTrasladoDestino').focus();
				}, 10);
			break;
			
			
		}
		
		
	}
	
	function consultoValidacion(datos) {


		if (datos == 0 ) {
		
			openPopupLocalidades();

							
		} else {
			
			
			setDataInForm(datos[0].Codigo,datos[0].Localidad,datos[0].Partido);			
			
								
		}
	
	}
	
	function setLocalidadElegidaFromGrid(opt) {
	
		var rowindex = $('#grdLocalidades').jqxGrid('getselectedrowindex');	
		var rowData = $('#grdLocalidades').jqxGrid('getrowdata',rowindex);
		
		var codigo = rowData.Codigo;
		var loc = rowData.Localidad;
		var partido = rowData.Partido;
		
		setDataInForm(codigo,loc,partido);
		
		$('#popupBuscoLocalidades').jqxWindow('close');
		
		
	}
	
	function bindGrillaLocalidades() {
		
		$('#grdLocalidades').on('rowdoubleclick',function(ev) {
			setLocalidadElegidaFromGrid();		
		});
		
		$('#grdLocalidades').on('keydown',function(event) {
			
			if (event.which == 13) {
				setLocalidadElegidaFromGrid();
			}
		});
		
	}
	
	function setStyleFocusButtons() {
		
		$('input[type="button"]').on('focus',function(ev){
				
			$(this).addClass('btnFocus');
				
		});
			
		$('input[type="button"]').on('focusout',function(ev){
				
			$(this).removeClass('btnFocus');
				
		});	
	}
	
	function setFocusNext() {
		
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
	}
	
	function getFechaSQL(fecha) {
	
		var vFecha = fecha.split("/");
		var dia = vFecha[0];
		var mes = vFecha[1];
		var anio = vFecha[2];
		var fechaSQL = anio + "-" + mes + "-" + dia;
		return fechaSQL;
			
	}
	
	