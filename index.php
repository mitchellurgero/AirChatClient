<?php
session_start();
//Check for POST (Login Attempt)
require("config.php");

//Check is Force_SSL = true
if($FORCE_SSL == "true"){
	if($_SERVER["HTTPS"] != "on")
	{
    	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    	exit();
	}
}

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
	global $html_title, $html_desc,$html_desc2;
	echo '';
	?>
  <body>

<div class="container">
  <div class="page-header">
    <center><h1>Sign in to <?php echo $html_title; ?> </h1><h3><small><?php echo $html_desc; ?></small></h3></center>
  </div>
    <div class="row">
    	<div class="col-md-4 col-md-offset-2">
    		<p>
    		<?php echo $html_desc2; ?>
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
    	<center>Powered By <a href="https://github.com/mitchellurgero/AirChatClient" target="_blank">AirChat</a></center>
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
                                <input class="form-control" id="usernameReg" name="username" placeholder="Username" required="" type="text" maxlength="12">
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
  <body onLoad="getRoomList()">
	
<div class="container">
  <div class="page-header">
    <center><h3>Create a room to begin chatting with friends!</h3><small>(Works better with Chrome/Firefox!)</small></center>
    <center><small>Welcome, <?php echo $_SESSION['username'] ?>!</small></center>
  </div>
    <div class="row">
    	<div class="col-md-6">
    	<div class="panel panel-default" style="max-height: 600px;">
            <div class="panel-heading"> <strong class="">Current open Rooms:</strong></div>
                <div class="panel-body">
                	<div id="listRooms" style="max-height: 595px;">
    					Getting Room List, Please wait...
    				</div>
                </div>
        <div class="panel-footer">&nbsp;</div>
        </div>     
                
    		
    	</div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"> <strong class="">Create a room:</strong>

                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="chat.php" method="POST" target="_blank" onsubmit="clearText()" style="width:100%; height:180px;">
                        <div class="form-group">
                            <label for="room" class="col-sm-3 control-label">Room:</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="room" name="room" placeholder="Room Name" required="" type="text" maxlength="16">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password:</label>
                            <div class="col-sm-9">
                               <!-- <input class="form-control" id="password" name="password" placeholder="Password" required="" type="password"> --> <small>Passwords not currently supported at this time.</small>
                            </div>
                        </div>
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success btn-sm pull-right" id="form_btn" name="form_btn">Create Room</button>
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
    	<center>Powered By <a href="https://github.com/mitchellurgero/AirChatClient" target="_blank">AirChat</a></center>
    	</div>
    </div>
</div><br /><br />

  </body>
	
	
	<?php
}
//Have the same header in both functions
function head(){
	global $http_bind, $fqdn_xmpp, $html_title, $muc_xmpp;
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
    <script src="js/jquery-ui.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src='strophejs/strophe.js'></script>
    <script src='strophejs/strophe.register.js'></script>
    <script src='strophejs/strophe.muc.js'></script>
    <script src='strophejs/strophe.roster.js'></script>
    <script src="js/bootstrap.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
   <!--  <link href="jsxc/css/jsxc.css" media="all" rel="stylesheet" type="text/css" />
   	<link href="jsxc/css/jsxc.webrtc.css" media="all" rel="stylesheet" type="text/css" /> -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
    var BOSH_SERVICE = "<?php echo $http_bind; ?>";
	var connection = null;
	var isDash = "<?php echo $_SESSION['dash'];?>";
	function rawInput(data){
		console.log("INPUT -- " + data);
	}
	function rawOutput(data){
		console.log("OUTPUT -- " + data);
	}
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
			
    	} else if (status == Strophe.Status.AUTHFAIL) {
			document.getElementById("error").innerHTML = '<span style="color:red">Incorrect username or password!</span>';
			$("#username").prop( "disabled", false );
			$("#password").prop( "disabled", false );
			$("#submitBtn").prop( "disabled", false );
			$("#reset").prop( "disabled", false );
			$("#password").prop("value","");
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
	function clearText(){
		setTimeout(function(){clearTextTime();}, 2000);
		
	}
	function clearTextTime(){
		document.getElementById("room").value="";
		document.getElementById("password").value="";
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
	
	function getRoomList(){
		connection = new Strophe.Connection(BOSH_SERVICE);
		connection.rawInput = rawInput;
		connection.rawOutput = rawOutput;
		var usr = "<?php echo $_SESSION['username']; ?>"  + "@<?php echo $fqdn_xmpp;?>";
		var pwd = "<?php echo $_SESSION['ps']; ?>";
		connection.connect(usr, pwd, onRoomList);
		console.log("End Get Room List...");
	}
	function onRoomList(status){
		console.log("Get room list...");
		if (status == Strophe.Status.CONNECTED) {
			console.log("CONNECTED!");
			connection.muc.listRooms("<?php echo $muc_xmpp; ?>", onRoomCb1, onRoomError);
			
		} else if(status == Strophe.Status.AUTHFAIL) {
			console.log(status);
			
		} else if(status == Strophe.Status.CONNFAIL){
			console.log(status);
		}
	}
	function onRoomError(data){
		console.log("Room List error: " + data);
	}
	function onRoomCb1(rooms){
		console.log("onROOM!");
		var roomTable = "";
    	rooms1 = xmlToJson(rooms);
    	roomTable = '<table class="table" id="dataTable1">';
    	roomTable += '<thead>';
		roomTable += '<tr>';
		roomTable += '<th>Room Name</th>';
		roomTable += '</tr>';
		roomTable += '</thead>';
		roomTable += '<tfoot>';
		roomTable += '<tr>';
		roomTable += '<th>Room Name</th>';
		roomTable += '</tr>';
		roomTable += '</tfoot>';
    	console.log(JSON.stringify(rooms1));
		for (i = 0; i < rooms1.query.item.length; i++) {
			var item = rooms1.query.item[i];
			var name = item["@attributes"].jid;
			var name1 = name.split("@");
			var name2 = name1[0].split("_room");
			roomTable = roomTable + "\n" + '<tr><td><a href="#" onClick="gotoRoom(\'' + name2[0] + '\')">' + name2[0] + '</a></td></tr>';
			
		}
		roomTable = roomTable + "\n" + '</table>';
		document.getElementById("listRooms").innerHTML = roomTable;
		$('#dataTable1').DataTable();

	}
	function gotoRoom(room_name){
		document.getElementById("room").value = room_name;
		document.getElementById("form_btn").click();
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

$(document).ready(function () {
	//Do stuff?
	
});
window.onbeforeunload = confirmExit;
  function confirmExit()
  {
    connection.disconnect();
    //jsxc.xmpp.logout();
    
  }
function xmlToJson(xml) {
	
	// Create the return object
	var obj = {};

	if (xml.nodeType == 1) { // element
		// do attributes
		if (xml.attributes.length > 0) {
		obj["@attributes"] = {};
			for (var j = 0; j < xml.attributes.length; j++) {
				var attribute = xml.attributes.item(j);
				obj["@attributes"][attribute.nodeName] = attribute.nodeValue;
			}
		}
	} else if (xml.nodeType == 3) { // text
		obj = xml.nodeValue;
	}

	// do children
	if (xml.hasChildNodes()) {
		for(var i = 0; i < xml.childNodes.length; i++) {
			var item = xml.childNodes.item(i);
			var nodeName = item.nodeName;
			if (typeof(obj[nodeName]) == "undefined") {
				obj[nodeName] = xmlToJson(item);
			} else {
				if (typeof(obj[nodeName].push) == "undefined") {
					var old = obj[nodeName];
					obj[nodeName] = [];
					obj[nodeName].push(old);
				}
				obj[nodeName].push(xmlToJson(item));
			}
		}
	}
	return obj;
}
    </script>
  </head>
	<?php
}
//Have the same footer in both functions
function foot(){
	echo '';
	?>
</html>
	
	<?php
}
?>