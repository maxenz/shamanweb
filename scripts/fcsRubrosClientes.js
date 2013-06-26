	
	function setFocusGrid() {
	
		$('#grdRubrosClientes').jqxGrid('selectrow',0);
		$('#grdRubrosClientes').jqxGrid('focus');	
			
	}
	
	function agregarRubroCliente() {
	
		setPopupAgregar(); 
	
	}
	
	function deleteRubroCliente() {
	
		var rowData = getRowData('grdRubrosClientes');
		var id = rowData.ID;
		setPopupEliminar(id); 
	
	}

	function initGrdRubrosClientes() {
		
		var columnas = [
			{ text: 'ID', datafield: 'ID', hidden: true },
			{ text: 'Código', datafield: 'AbreviaturaId', width: '30%',cellsalign:'center', align: 'center'},
			{ text: 'Rubro Clientes', datafield: 'Descripcion', width:'70%', align: 'center'}	
		];
	
		$("#grdRubrosClientes").jqxGrid({
			width:400,
			height:400,
			columnsresize: false,
			autoshowfiltericon: true,
			editable: true,
			editmode: 'dblclick',
			source: [],
			theme: 'metro',
			columns: columnas,
			handlekeyboardnavigation: function (event) {
				var rowData = getRowData('grdRubrosClientes');
				var id = rowData.ID;

				var key = event.charCode ? event.charCode : event.keyCode ? event.keyCode : 0;
				switch (key) {
					
					case 46:
						setPopupEliminar(id);
						return true;
					break;
					
					case 45:
						setPopupAgregar();
						return true;
					break;
					
					case 13:
						return false;
					break;	
					
				}
			
			},
			altrows:true,
			filterable: true,
			sortable: true,
			showfilterrow: true
		});				
	}
		
	function deleteRubro(id){
		
		$.ajax({
			type: 'GET',
			url : 'getSetRubrosClientes.php?opt=2&id='+id,
			success: function(datos) {
				
				$('#dialogoEliminar').modal('hide');
				setFocusGrid();
				setGrdRubrosClientes();
			}
			
		});
		
	}
			
	function setGrdRubrosClientes() {
		
		var sourceRubrosClientes ={
        	datatype: "json",
        	datafields: [{ name: 'ID' },{ name: 'AbreviaturaId'}, {name: 'Descripcion'}],
		 	url: 'getSetRubrosClientes.php?opt=0'
   		 };	
		
		$('#grdRubrosClientes').jqxGrid({ source: sourceRubrosClientes });
	}
	
	function setPopupEliminar(id) {
		
		$('#dialogoEliminar').modal('show');
		
		$('#btnElimRubro').on('click',function(ev){
		
			deleteRubro(id);
		
		});
		
		$('#btnElimRubro').keydown(function(ev){
		
			if (ev.which == 13) {
			
				deleteRubro(id);
				ev.preventDefault();
			}
		});	
	}
	
	function actualizarGrd() {
	
		setGrdRubrosClientes();
		setFocusGrid();
	
	}
	
	function setPopupAgregar() {
		
		$('#txtCodRubro').val('');
		$('#txtDescRubro').val('');

		$('#dialogoAgregar').modal('show');
	
		$('#btnAceptarRubroCliente').on('click',function(ev){
		
			var cod = $('#txtCodRubro').val();
			var desc = $('#txtDescRubro').val();
			agregoRubro(cod,desc);
			$('#dialogoAgregar').modal('hide');
		
		});
		
		$('#btnCancelarRubroCliente').on('click',function(ev){
		
			setFocusGrid();
		
		});
		
	}
	
	function bindEventos() {
	
		$('#dialogoAgregar').on('shown',function(ev){
		
			$('#txtCodRubro').focus();
		
		});
		
		$('#dialogoAgregar').on('hide',function(ev){
		
			setFocusGrid();
		
		});
		
		$('#dialogoEliminar').on('shown',function(ev){
		
			$('#btnElimRubro').focus();
		
		});
		
		$('#dialogoEliminar').on('hide',function(ev){
		
			setFocusGrid();
		
		});
			
		$('#txtCodRubro').keydown(function(ev){
			
			if (ev.which == 13) {
				
				$('#txtDescRubro').focus();	
			}
			
		});
		
		$('#txtDescRubro').keydown(function(event){
			
			if (event.which == 13) {
				
				$('#btnAceptarRubroCliente').focus();
				event.preventDefault();
					
			}	
		});
	
		$('#grdRubrosClientes').on('cellendedit',function(ev){
			
			var args = ev.args;
			var column = args.datafield;
			var value = args.value;
			var row = args.rowindex;
			updateCampo(row,value,column);
			
		});
		
	}
	
	function updateCampo(row,value,column) {
		
		var rowData = getRowData('grdRubrosClientes');	
		var id = rowData.ID;
		
		$.ajax({
			type: 'GET',
			url : 'getSetRubrosClientes.php?opt=3&campo='+column+'&value='+value+'&id='+id,
		});
	}
	
	function agregoRubro(cod,desc) {	
		
		$.ajax({
			type : 'GET',
			url : 'getSetRubrosClientes.php?opt=1&cod='+cod+'&desc='+desc,
			success : function(datos) {
				setGrdRubrosClientes();
				$('#dialogoAgregar').dialog('close');		
				
			},	
		});	
	}