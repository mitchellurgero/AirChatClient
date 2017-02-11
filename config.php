<?php
/*
Edit the following values to configure RTSC2 to work with your current setup

*/
$http_bind = "https://gamingzone.space/http-bind"; //URL of the HTTP-BIND service of the XMPP Server
$fqdn_xmpp = "gamingzone.space"; //the Fully Qualified Domain Name of the server (EX: example.com) (This MUST be the domain the user authenticates against.) (If the server is xmpp.example.com, but the domain of authentication is example.com, put example.com)
$xmpp_port = "5222"; //The port of the XMPP server (Usually 5222)(Or 5223 for Legacy SSL)
$muc_xmpp = "conference.gamingzone.space"; //MUC service URL, configured on server, does not usually need to be in DNS.
$html_title = "gamingzone.space"; //Title of the login and dashboard
$html_desc = 'Online group chat with family and friends!'; //Description or slogan for login page.
$html_desc2 = '<div class="text-center">
Join us on XMPP!</a><br /><br />
XMPP Settings(External Only):<br />
<b>Server:</b> gamingzone.space<br />
<b>Port:</b> 5222<br />
<b>TLS:</b>Prefer<br />
<b>Username:</b> username@gamingzone.space
</div>'; //Second HTML Description.
$DEBUG = "false"; // Enabling Debug Mode will disable the error handler modal (The popup that comes up when an error occurs for a user) and it enables logging so you can look at the log and see what happened.
$FORCE_SSL = "true" //Force HTTPS for AirChat Users.
?>