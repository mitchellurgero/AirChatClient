<?php
/*
Edit the following values to configure RTSC2 to work with your current setup

*/
$http_bind = "http://urgero.org:5280/http-bind"; //URL of the HTTP-BIND service of the XMPP Server
$fqdn_xmpp = "urgero.org"; //the Fully Qualified Domain Name of the server (EX: example.com) (This MUST be the domain the user authenticates against.) (If the server is xmpp.example.com, but the domain of authentication is example.com, put example.com)
$xmpp_port = "5222"; //The port of the XMPP server (Usually 5222)(Or 5223 for Legacy SSL)
$muc_xmpp = "conference.urgero.org"; //MUC service URL, configured on server, does not usually need to be in DNS.
$html_title = "AirChat - Beta"; //Title of the login and dashboard
$html_desc = "A chat client for all."; //Description or slogan for login page.
$DEBUG = "true"; // Enabling Debug Mode will disable the error handler modal (The popup that comes up when an error occurs for a user) and it enables logging so you can look at the log and see what happened.
?>