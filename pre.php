<?php
session_start();
require("config.php");
require("prebind.php");
//before showing the whole dash we need to prebind.
if(!isset($_SESSION['sid'])){
	$params = [
        "user" => $_SESSION['username'],
        "password" => $_SESSION['ps'],
        "tld" => $fqdn_xmpp,
        "boshUrl" => $http_bind
        //For openfire it's something like http://<your-xmpp-fqdn>:7070/http-bind/
    ];
    $xmpp = new XmppPrebind($params);
	echo json_encode($xmpp->connect());
}
?>