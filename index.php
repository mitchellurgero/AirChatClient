<?php
session_start();
//Check for POST (Login Attempt)
require("config.php");
if(isset($_POST['username']) && isset($_POST['password'])){
	//Log them in against prosody database here. (Or maybe a flat file? who knows yet.)
}
head();
//Check for logged in session
if(isset($_SESSION['username']) && isset($_SESSION['ps'])){
	//Now we know they are logged in: let's process it here
	dsDash();
} else {
	//Now we know they are NOT logged in, push them to a login screen.
	dsLogin();
}
foot();

//Function to show the login page.
function dsLogin(){
	global $html_title, $html_desc;
	echo '';
	?>
  <body>

<div class="container">
  <div class="page-header">
    <center><h1>Sign in to <?php echo $html_title; ?> </h1><h3><small><?php echo $html_desc; ?></small></h3></center>
  </div>
    <div class="row">
    	<div class="col-md-4 col-md-offset-2">
    		<br /><br /><br />
    		<p>
    		XMPP based chat client for all.<br />
    		Login to chat with your friends!
    		</p>
    	</div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"> <strong class="">Login</strong>

                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" onsubmit="return false;" method="POST">
                        <div class="form-group">
                            <label for="username" class="col-sm-3 control-label">Username</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="username" name="username" placeholder="Username" required="" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="password" name="password" placeholder="Password" required="" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success btn-sm" onClick="login()" id="submitBtn">Sign in</button>
                                <button type="reset" class="btn btn-default btn-sm" id="reset">Reset</button>
                            </div>
                        </div>
                        <div class="form-group last">
                        	<div class="col-sm-offset-3 col-sm-9">
                        		<div id="error"></div>
                        	</div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">Not Registered? <a href="#" class="" data-toggle="modal" data-target="#regModal">Register here</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
	<div class="row">
    	<div class="col-md-4 col-md-offset-4">
    	<center>Coded with &hearts;</center>
    	</div>
    </div>
</div><br /><br />
<div id="regModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Register for an Account</h4>
      </div>
      <div class="modal-body">
        <p>
				<form class="form-horizontal" role="form" onsubmit="return false;" method="POST">
                        <div class="form-group">
                            <label for="username" class="col-sm-3 control-label">Username</label>
                            <div class="col-sm-6">
                                <input class="form-control" id="usernameReg" name="username" placeholder="Username" required="" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-6">
                                <input class="form-control" id="passwordReg1" name="password" placeholder="Password" required="" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password Again:</label>
                            <div class="col-sm-6">
                                <input class="form-control" id="passwordReg2" name="password" placeholder="Password Again" required="" type="password">
                            </div>
                        </div>
                        <div class="form-group last">
                        	<div class="col-sm-offset-3 col-sm-9">
                        		<div id="errorReg"></div>
                        	</div>
                        </div>
                    </form>
        </p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-info" onClick="register()">Register</button>&nbsp;&nbsp;<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</body>
<script>
$('#usernameReg').bind('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if(event.keyCode == 9 || event.which == 9){
    	//return true;
    } else {
        if(event.keyCode != 8 || event.which != 8){
       		if (!regex.test(key)) {
       			event.preventDefault();
       			return false;
    		}
    	}	
    }

});
$('#username').bind('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if(event.keyCode == 9 || event.which == 9){
    	//return true;
    } else {
        if(event.keyCode != 8 || event.which != 8){
       		if (!regex.test(key)) {
       			event.preventDefault();
       			return false;
    		}
    	}	
    }

});
</script>
	
	<?php
}

//Function to show the "dashboard" or "Global Lobby"
function dsDash(){
	global $html_title, $html_desc;
	echo '';
	?>
  <body>

<div class="container">
  <div class="page-header">
    <center><h3>Create a room to begin chatting with friends!</h3></center>
  </div>
    <div class="row">
    	<div class="col-md-4 col-md-offset-2">
    		<br /><br /><br />
    		<p>
    		Type the room name and password for that room in the fields to the right.<br /><br />
    		
    		</p>
    	</div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"> <strong class="">Create a room:</strong>

                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="chat.php" method="POST">
                        <div class="form-group">
                            <label for="room" class="col-sm-3 control-label">Room:</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="room" name="room" placeholder="Room Name" required="" type="text" maxlength="16">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password:</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="password" name="password" placeholder="Password" required="" type="password">
                            </div>
                        </div>
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success btn-sm">Create Room</button>
                            </div>
                        </div>
                        <div class="form-group last">
                        	<div class="col-sm-offset-3 col-sm-9">
                        		<div id="error"></div>
                        	</div>
                        	
                        </div>
                        
                    </form>
                    
                </div>
                <div class="panel-footer"><a href="logout.php">Logout</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('#room').bind('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if(event.keyCode == 9 || event.which == 9){
    	//return true;
    } else {
        if(event.keyCode != 8 || event.which != 8){
       		if (!regex.test(key)) {
       			event.preventDefault();
       			return false;
    		}
    	}	
    }

});

</script>
<div class="container">
	<div class="row">
    	<div class="col-md-4 col-md-offset-4">
    	<center>Coded with &hearts;</center>
    	</div>
    </div>
</div><br /><br />

  </body>
	
	
	<?php
}
//Have the same header in both functions
function head(){
	global $http_bind, $fqdn_xmpp, $html_title;
	echo '';
	?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title><?php echo $html_title; ?></title>
    <script src='js/jquery1.11.3.js'></script>
    <script src='strophejs/strophe.js'></script>
    <script src='strophejs/strophe.register.js'></script>
    <script src="js/bootstrap.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
    var BOSH_SERVICE = "<?php echo $http_bind; ?>";
	var connection = null;
   	function onConnect(status)
	{
    	if (status == Strophe.Status.CONNECTING) {
			document.getElementById("error").innerHTML = '<span style="color:DarkBlue">Connecting...<span class="glyphicon glyphicon-refresh glyphicon-spin"></span></span>';
    	} else if (status == Strophe.Status.CONNFAIL) {
			document.getElementById("error").innerHTML = '<span style="color:red">Could not connect!</span>';
			$("#username").prop( "disabled", false );
			$("#password").prop( "disabled", false );
			$("#submitBtn").prop( "disabled", false );
			$("#reset").prop( "disabled", false );
    	} else if (status == Strophe.Status.DISCONNECTING) {
			
    	} else if (status == Strophe.Status.DISCONNECTED) {
			
    	} else if (status == Strophe.Status.CONNECTED) {
			document.getElementById("error").innerHTML = '<span style="color:green">Connected!</span>';
			$.ajax({
				method:'post',
				url:'con.php',
				data:{
					username:document.getElementById("username").value,
					password:document.getElementById("password").value
				},
				success:function(result) {
					if(result == "success"){
						window.location.href="index.php";
					}
					
				}
				}).fail(function(e) {
					alert("failed");
			});
			connection.disconnect();
    	}
	}
	function rawInput(data)
	{
    	//alert(data);
    	//Check for errors:
    	var error = data.indexOf("bad-auth");
    	if(error != -1){
    		document.getElementById("error").innerHTML = '<span style="color:red">Invalid username or password!</span>';
			$("#username").prop( "disabled", false );
			$("#password").prop( "disabled", false );
			$("#submitBtn").prop( "disabled", false );
			$("#reset").prop( "disabled", false );
			
    	}
	}
	function login(){
	if(document.getElementById("username").value == "" || document.getElementById("password").value == ""){
		
	} else {
		$("#username").prop( "disabled", true );
		$("#password").prop( "disabled", true );
		$("#submitBtn").prop( "disabled", true );
		$("#reset").prop( "disabled", true );
		connection = new Strophe.Connection(BOSH_SERVICE);
		connection.rawInput = rawInput;
    	var usr = document.getElementById("username").value + "@<?php echo $fqdn_xmpp;?>";
    	var pwd = document.getElementById("password").value
		connection.connect(usr, pwd, onConnect);	
	}

	}
    function register(){
    	document.getElementById("errorReg").innerHTML = '<span style="color:DarkBlue">Checking....<span class="glyphicon glyphicon-refresh glyphicon-spin"></span></span>';
    	connection = new Strophe.Connection(BOSH_SERVICE);
    	var callback = function (status) {
    	if (status === Strophe.Status.REGISTER) {
        	// fill out the fields
        	connection.register.fields.username = document.getElementById("usernameReg").value;
        	connection.register.fields.password = document.getElementById("passwordReg1").value;
        	// calling submit will continue the registration process
        	connection.register.submit();
    	} else if (status === Strophe.Status.REGISTERED) {
        	document.getElementById("errorReg").innerHTML = '<span style="color:green">Account Registered!</span>';
    	} else if (status === Strophe.Status.CONFLICT) {
	        document.getElementById("errorReg").innerHTML = '<span style="color:red">Account taken!</span>';
    	} else if (status === Strophe.Status.NOTACCEPTABLE) {
        	document.getElementById("errorReg").innerHTML = '<span style="color:red">Username could not be accepted by the server.</span>';
    	} else if (status === Strophe.Status.REGIFAIL) {
        	document.getElementById("errorReg").innerHTML = '<span style="color:red">Registration failed!</span>';
		} else if (status === Strophe.Status.CONNECTED) {
    		 // do something after successful authentication
    	} else {
        	// Do other stuff
    	}
		};
		if(document.getElementById("passwordReg1").value != document.getElementById("passwordReg2").value){
    		document.getElementById("errorReg").innerHTML = '<span style="color:red">Passwords do not match.</span>';
    	} else {
    		if(document.getElementById("usernameReg").value == ""){
    			document.getElementById("errorReg").innerHTML = '<span style="color:red">Username cannot be blank!</span>';
    		} else {
    			connection.register.connect("<?php echo $fqdn_xmpp; ?>", callback, 60, 1);	
    		}
			
    	}
    }
    </script>
  </head>
	<?php
}
//Have the same footer in both functions
function foot(){
	echo '';
	?>
	<br />
	<br />
 <nav class="navbar navbar-inverse navbar-fixed-bottom">
  <div class="container-fluid">
    <div>
    <br />
    <center style="color:white">Powered By <a href="#">AirChat</a></center>
    </div>
  </div>
</nav>
</html>
	
	<?php
}
?>