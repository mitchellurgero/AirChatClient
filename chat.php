<?php
session_start();
require("config.php");
$usrColor = "";
//Check if user is logged in
if(!isset($_SESSION['username']) || !isset($_SESSION['ps'])){
	header("Location: ./");
	die();
}


$_POST['room'] = strtolower($_POST['room']);
echo'';
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

    <title>Chat <?php echo $_POST['room']; ?></title>
    <!-- Strophe Chat JS -->
    <script src='js/jquery1.11.3.js'></script>
    <script src='strophejs/strophe.js'></script>
    <script src='strophejs/strophe.muc.js'></script>
    <script src="js/bootstrap.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!--Strophe JavaScript functions / Handlers -->
    <script>
    var DEBUG_MODE = "<?php echo $DEBUG; ?>";
   	var BOSH_SERVICE = "<?php echo $http_bind; ?>";
	var connection = null;
	var crypto = null;
	var xmpp_pass = "<?php echo $_POST['password']; ?>";
	function log(msg) 
	{
    	$('#log').append('\n').append(document.createTextNode(msg));
	}

	function rawInput(data)
	{
    	log('RECV: ' + data);
    	//Check for errors:
    	var error = data.indexOf("error");
    	if(error != -1){
    		if(DEBUG_MODE == "false"){
    			document.getElementById("errorMsg").innerHTML = "<p>There was an error connecting to the room or server, please try again later.</p>";
				$('#errorModal').modal('show');
    		} else {
    			
    		}
    		
			
    	}
	}

	function rawOutput(data)
	{
    	log('SENT: ' + data);
	}

	function onConnect(status)
	{
    	if (status == Strophe.Status.CONNECTING) {
			log('Strophe is connecting.');
    	} else if (status == Strophe.Status.CONNFAIL) {
			log('Strophe failed to connect.');
    	} else if (status == Strophe.Status.DISCONNECTING) {
			log('Strophe is disconnecting.');
    	} else if (status == Strophe.Status.DISCONNECTED) {
			log('Strophe is disconnected.');
    	} else if (status == Strophe.Status.CONNECTED) {
			log('Strophe is connected.');
			connection.addHandler(onMessage, null, 'message', 'groupchat'); 
			connection.addHandler(onPresence, null, 'presence');
			connection.muc.join("<?php echo $_POST['room']; ?>_room@<?php echo $fqdn_xmpp; ?>", "<?php echo $_SESSION['username']; ?>", onMessage, onPresence, onRoster, "<?php echo $_POST['password']; ?>", null);
			var d = $pres({"from":"<?php echo $_SESSION['username']."@".$fqdn_xmpp; ?>","to":"<?php echo $_POST['room']; ?>_room@<?php echo $muc_xmpp; ?>/<?php echo $_SESSION['username']; ?>"}).c("x",{"xmlns":"http://jabber.org/protocol/muc"});
    		connection.send(d.tree());
			$("#sendMsg").prop( "disabled", false );
			document.getElementById("conStatus").innerHTML = "Connected!";
			
    	}
	}
function onMessage(msg) {
    var to = msg.getAttribute('to');
    var from = msg.getAttribute('from');
    var type = msg.getAttribute('type');
    var elems = msg.getElementsByTagName('body');
    //alert(to + from + type + ;
	//Get Message
	var res = from.replace("<?php echo $_POST['room']; ?>_room@<?php echo $muc_xmpp; ?>/", "");
	var res2 = res.toLowerCase();
	var usrColor = null;
	var frChar = res2.charAt(0);
	switch(frChar) {
    	case "a":
        	usrColor = "#0000b3";
        	break;
        case "b":
        	usrColor = "#D24D57";
        	break;
        case "c":
        	usrColor = "#F22613";
        	break;
        case "d":
        	usrColor = "#D91E18";
        	break;
        case "e":
        	usrColor = "#96281B";
        	break;
        case "f":
        	usrColor = "#EF4836";
        	break;
        case "g":
        	usrColor = "#DB0A5B";
        	break;
        case "h":
        	usrColor = "#D2527F";
        	break;
        case "i":
        	usrColor = "#663399";
        	break;
        case "j":
        	usrColor = "#9A12B3";
        	break;
        case "k":
        	usrColor = "#E26A6A";
        	break;
        case "l":
        	usrColor = "#446CB3";
        	break;
        case "m":
        	usrColor = "#22A7F0";
        	break;
        case "n":
        	usrColor = "#22313F";
        	break;
        case "o":
        	usrColor = "#19B5FE";
        	break;
        case "p":
        	usrColor = "#26A65B";
        	break;
        case "q":
        	usrColor = "#36D7B7";
        	break;
        case "r":
        	usrColor = "#E87E04";
        	break;
        case "s":
        	usrColor = "#D35400";
        	break;
        case "t":
        	usrColor = "#6C7A89";
        	break;
        case "u":
        	usrColor = "#BFBFBF";
        	break;
        case "v":
        	usrColor = "#1E824C";
        	break;
        case "w":
        	usrColor = "#86E2D5";
        	break;
        case "x":
        	usrColor = "#68C3A3";
        	break;
        case "y":
        	usrColor = "#66CC99";
        	break;
        case "z":
        	usrColor = "#4B77BE";
        	break;
        case "1":
        	usrColor = "#19B5FE";
        	break;
        case "2":
        	usrColor = "#2C3E50";
        	break;
        case "3":
        	usrColor = "#C5EFF7";
        	break;
        case "4":
        	usrColor = "#6BB9F0";
        	break;
        case "5":
        	usrColor = "#9B59B6";
        	break;
        case "6":
        	usrColor = "#BF55EC";
        	break;
        case "7":
        	usrColor = "#F62459";
        	break;
        case "8":
        	usrColor = "#F1A9A0";
        	break;
        case "9":
        	usrColor = "#F64747";
        	break;
        case "0":
        	usrColor = "#0000b3";
        	break;
        
    	default:
        	usrColor = "black";
        	break;
	} 
	
	
    if (type == "groupchat" && elems.length > 0) {
		var body = elems[0];
		//Now we put the message onto the page
		var tbl = document.getElementById("chatBody");
		var row = tbl.insertRow(-1);
		var cell1 = row.insertCell(0);
		cell1.innerHTML = '<b>' + res + '</b>';
		cell1.style.width = "100px";
		cell1.style.color = usrColor;
		var cell2 = row.insertCell(1);
		cell2.innerHTML = Strophe.getText(body);
		cell2.style.maxWidth = "400px";
		$("#chatDiv").animate({ scrollTop: $("#chatDiv").prop("scrollHeight") }, 25);
    }
    return true;
}
function onkey(){
	
}
function discon(){
	connection.disconnect();
}
function onPresence(data){
	//alert("Pres" + data);
	var type;
	var type2;
	$(data).find('item').each(function(){
    	var jid = $(this).attr('jid'); // The jabber_id of your contact
    	type = $(this).attr('role'); 
    	
	});
		
		var usr = data.getAttribute("from");
		var res = usr.replace("<?php echo $_POST['room']; ?>_room@<?php echo $muc_xmpp; ?>/","");
			res = "<b>" + res + "</b>";
		var tbl = document.getElementById("usrList2");
		if(type == 'none'){
			//alert(type);
			var oTable = document.getElementById('usrList2');
			var rowLength = oTable.rows.length;
			for (i = 0; i < rowLength; i++){
				
				var trs = tbl.getElementsByTagName("tr")[i];
    			var cellVal=trs.cells[0]
    			//alert(cellVal.innerHTML);
    			var cVal = cellVal.innerHTML;
    			//alert(res + " " + cVal);
	   			if(res == cVal){
	   				tbl.deleteRow(i);
	   				return true;
   				}
			}
		} else {
			var row = tbl.insertRow(-1);
			var cell1 = row.insertCell(0);
			cell1.innerHTML = res;
		}

	return true;
}
function onRoster(data){
	//alert("roster" + data);
	return true;
}
function encString(string){

}

function decString(string){
	
}

function sendMsg(){
	//do some stuff here.
	var msg = document.getElementById("message").value;
    //$("#chatBody").append("You: " + msg).append("\n");
    var o = {to:"<?php echo $_POST['room']; ?>_room@<?php echo $muc_xmpp; ?>", type : 'groupchat'}; 
	var m = $msg(o); m.c('body', null, msg); 
	connection.send(m.tree());
    document.getElementById("message").value = "";
    var objDiv = document.getElementById("chatBody");
	objDiv.scrollTop = objDiv.scrollHeight;
	

}
function callDash(){
	window.location.href='index.php';
}
function handleKeyPress(e){
 var key=e.keyCode || e.which;
  if (key==13){
     $( "#sendMsg" ).click();
  }
}
$(document).ready(function () {
$("#sendMsg").prop( "disabled", true );
    connection = new Strophe.Connection(BOSH_SERVICE);
    connection.rawInput = rawInput;
    connection.rawOutput = rawOutput;
    var usr = "<?php echo $_SESSION['username']."@".$fqdn_xmpp;?>";
    var pwd = "<?php echo $_SESSION['ps'];?>";
	connection.connect(usr, pwd, onConnect);
	if(DEBUG_MODE == "true"){
		document.getElementById("logger").style = "";
	} 
});
window.onbeforeunload = confirmExit;
  function confirmExit()
  {
    connection.disconnect();
    
    //return "You have attempted to leave this page.  If you have made any changes to the fields without clicking the Save button, your changes will be lost.  Are you sure you want to exit this page?";
  }


    </script>
  </head>
  <body style="background-color:#eee;">
  	<br />
  	<center><h3>Chat Room: <?php if(isset($_POST['room'])) echo $_POST['room']; ?></h3></center>
  	<br />
  	<br />
  	
		<div class="container">
			
			<div class="col-md-8">
			<div class="panel panel-default">
                <div class="panel-heading"> <strong class="">Messages: </strong><small id="conStatus">Connecting...</small>

                </div>
                <div class="panel-body" style="height:300px;">
					<div id="chatDiv" style="overflow-y: auto; width:100%; max-height:300px;">
					<table id="chatBody" class="table table-striped table-bordered table-hover" style="width:100%; height:100%;">

					</table>
					</div>
				</div>
                	<div class="panel-footer"><input type="text" id="message" style="width:90%;" onkeyup="handleKeyPress(event);" autocomplete="off">&nbsp;<input type="submit" id="sendMsg" class="btn btn-primary" value="Send" onClick="sendMsg()">
                </div>
            </div>
			</div>
			<div class="col-md-3">
				<div id="usrList">
					<div class="panel panel-default">
                		<div class="panel-heading"> <strong class="">Current Users:</strong></div>
						<div class="panel-body" style="height:300px; overflow-y: auto; width:100%;">
							<table id="usrList2" class="table table-striped table-bordered table-hover">
							
							</table>
						</div>
						<div class="panel-footer"><a href="logout.php" class="btn btn-info" onClick="discon()">Logout</a>&nbsp;<a href="index.php" class="btn btn-info" onClick="discon()">Change Rooms</a>
    	</div>
					</div>
			</div>
		</div>
	</div>
    <hr>
    <div class="container">
    <div class="col-md-6 col-md-offset-4">
    	<a href="#logCol" class="btn btn-info" data-toggle="collapse" id="logger" style="display: none;">Logs</a>
    </div>
    	<br /><br />
    	<div id="logCol" class="collapse">
    		<h3>Logs:</h3>
			<textarea id='log' style="width:100%; height:500px;" disabled></textarea>
		</div>
		<br /><br />
    </div>
<div id="errorModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">An Error Occured!</h4>
      </div>
      <div class="modal-body">
        <p>
			<div id="errorMsg">
			</div>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal" onClick="callDash()">Back to Dashboard</button>
      </div>
    </div>

  </div>
</div>
  </body>
  </html>
<?php


?>