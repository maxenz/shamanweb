<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Shaman SGE - Login</title>

<link href="css/stylelogin.css" rel="stylesheet" type="text/css" />
<link href="../styles/toastr.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" media="all" type="text/css" href="css/jquery-impromptu.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-impromptu.js"></script>
<script type="text/javascript" src="../scripts/toastr.min.js"></script>
<script type="text/javascript" src="../scripts/spin.min.js"></script>

</head>

<body class="invisible">
	
<div id="loader"></div>

<div id="wrapper">

    <div class="user-icon"></div>
    <div class="pass-icon"></div>

    <form name="login-form" class="login-form" id="frmLogin">
        <div class="header">
            <h1>Login Shaman SGE</h1>
            <span>Por favor ingrese su nombre de usuario y contraseña.</span>
        </div>
   
        <div class="content">
	        <input name="usuario" type="text" class="input username" value="" id="txtUser"  />
            <input name="password" type="password" class="input password" value="" id="txtPassword"  />
            <input type="hidden" name="version" value="<?php echo $_GET["v"] ?>" id="txtVersion"></input>
        </div>

        <div class="footer">
            <input type="button" value="Login" class="button" id="btnSubmit" />
        </div>
    </form>

</div>

<div class="gradient"></div>

<script>

    var version = '<?php echo $_GET["v"] ?>';
    var vDataClientes;
    
    var opts = {
      lines: 17, // The number of lines to draw
      length: 15, // The length of each line
      width: 6, // The line thickness
      radius: 27, // The radius of the inner circle
      corners: 1, // Corner roundness (0..1)
      rotate: 0, // The rotation offset
      direction: 1, // 1: clockwise, -1: counterclockwise
      color: '#088CCC', // #rgb or #rrggbb or array of colors
      speed: 1, // Rounds per second
      trail: 60, // Afterglow percentage
      shadow: false, // Whether to render a shadow
      hwaccel: false, // Whether to use hardware acceleration
      className: 'spinner', // The CSS class to assign to the spinner
      zIndex: 2e9, // The z-index (defaults to 2000000000)
      top: '280px', // Top position relative to parent in px
      left: 'auto' // Left position relative to parent in px
    };
    
    var target = document.getElementById('loader');
    var spinner = new Spinner(opts);

    if (version == 'full') {

        $('.login-form .footer .button ').css("background","green");
        $('.login-form .footer .button ').css("border","1px solid green");
        $('.login-form .footer .button:hover').css("background","green");
        $('body').css("background","green");

    }

    $('body').removeClass("invisible");
    
    //POPUP QUE SE GENERA CUANDO EL USUARIO TIENE MAS DE UNA EMPRESA DISPONIBLE.
    
    function openPopupEmpresas(){	
		$.prompt('<div id="selEmpresas"></div>', {
	        title: "Para ingresar, seleccione el cliente deseado.",
            top: '40%',
	        buttons: { "Ingresar": true, "Cancelar": false },
	        submit: function(e,v,m,f){
                
                if (v) {
                
                    e.preventDefault();
                    validarIngreso();    
                    
                }
	        }
        });		
    }
    
    //OBTENGO DATOS DE LA EMPRESA DEL VECTOR TRAIDO VIA AJAX
    
    function getDatosSesionEmpresa(nom) {
    
        for (var i = 0; i < vDataClientes.length; i++) {
        
            if (nom == vDataClientes[i][0]) {
            
                vLocal = [];
                vLocal[0] = nom;
                vLocal[1] = vDataClientes[i][1];
                vLocal[2] = vDataClientes[i][2];
                vLocal[3] = vDataClientes[i][3];
                vLocal[4] = vDataClientes[i][4];
                vLocal[5] = vDataClientes[i][5];
                
                return vLocal;
            
            } 
        }
    }
    
    //VALIDO QUE HAYA SELECCIONADO ALGUNA EMPRESA E INICIO SESION
    
    function validarIngreso() {
    
        var seleccionoEmpresa = $("input[type='radio']").is(":checked");
        
        if (seleccionoEmpresa) {
            
            var empSeleccionada = $("input[type='radio']:checked");
            var nomEmpresa = empSeleccionada.val();
            var vSesionUsuario = getDatosSesionEmpresa(nomEmpresa);
            iniciarSesionCliente(vSesionUsuario);
        
        } else {
        
            alert('Debe seleccionar al menos un cliente');
        }
    
    }
    
    //INICIO SESION CON LOS DATOS DEL USUARIO / CLIENTE Y REDIRECCIONO AL INDEX
    
    function iniciarSesionCliente(vec) {
    
        $.ajax({
			type: 'POST',
            dataType: 'json',
			url: '../php/setSesionEmpresa.php',
            data: {
                usuario: $("#txtUser").val(),
                datasource: vec[1],
                catalog: vec[2],
                dbuser: vec[3],
                dbpass: vec[4],
                conexion: vec[5],
                cliente: vec[0],
                v: $("#txtVersion").val()
            },
			error: function (request, status, error) {
            
        		console.log('error' + request.responseText);

    		},
			success: function(){
            
                window.location = '../php/index.php';
            
            }
            
         });
    
    }
    
    //VOY A CONTROL.PHP Y VALIDO EL USUARIO / PASSWORD
    
    $('#btnSubmit').on('click',function(){
    
        $.ajax({
            type: 'GET',
            url: '../php/control.php',
            data: {
                'usuario': $('#txtUser').val(),
                'password': $('#txtPassword').val(),
                'version': $('#txtVersion').val()
            },
            dataType: 'json',
            beforeSend: function(){
                spinner.spin(target);  
            },
            complete: function(){
                spinner.stop();
            },
            error: function(request){
                console.log('error:  ' + request);
            },
            success: function(vClientes){
                
                console.log(vClientes);
                vDataClientes = vClientes;
                            
                if (vClientes === 0) {

                    toastr.error('Los datos de inicio de sesión son incorrectos.', 'Error!',{positionClass: 'toast-center', timeOut: 2000});
                    
                } else if (vClientes === 1) {
                    
                    toastr.error('No tiene acceso a este módulo.', 'Error!',{positionClass: 'toast-center', timeOut: 2000});
                
                } else {
                
                  if (vClientes.length > 1) {
                    
                        var strEmpresas = "";
                        for (var i = 0; i < vClientes.length; i++) {
                    
                            strEmpresas += "<div class=\"field\"><input type=\"radio\" name=\"rdEmpresas\" id=\""+vClientes[i][0]+"\"";
                            strEmpresas += " value=\""+vClientes[i][0]+"\" class=\"radioinput\" /><label for=\""+vClientes[i][0]+"\">";
                            strEmpresas +=  vClientes[i][0]+"</label></div>";
                        
                        }
                                        
                        openPopupEmpresas();
                        $('#selEmpresas').append(strEmpresas);

                  
                      } else {
                        
                       var vSesionUsuario = getDatosSesionEmpresa(vClientes[0][0]);
                       iniciarSesionCliente(vSesionUsuario);
                  }
                  
                }
            }
        });
        
        return false;
   
     });
    
</script>

</body>
</html>