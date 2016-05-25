<?php
/*
Edit the following values to configure RTSC2 to work with your current setup

*/
$http_bind = "https://airchat.urgero.org/http-bind"; //URL of the HTTP-BIND service of the XMPP Server
$fqdn_xmpp = "airchat.urgero.org"; //the Fully Qualified Domain Name of the server (EX: example.com) (This MUST be the domain the user authenticates against.) (If the server is xmpp.example.com, but the domain of authentication is example.com, put example.com)
$xmpp_port = "5222"; //The port of the XMPP server (Usually 5222)(Or 5223 for Legacy SSL)
$muc_xmpp = "conference.airchat.urgero.org"; //MUC service URL, configured on server, does not usually need to be in DNS.
$html_title = "AirChat | Public Chat Service"; //Title of the login and dashboard
$html_desc = 'A chat client for all.'; //Description or slogan for login page.
$html_desc2 = '<div class="text-center">Join us on <a href="mumble://airchat.urgero.org:64738/">Mumble!</a><br /><br /><a href="https://play.google.com/store/apps/details?id=com.morlunk.mumbleclient.free">Android Client for Mumble</a><br /><a href="https://itunes.apple.com/us/app/mumble/id443472808?mt=8">Apple Client for Mumble</a></div>'; //Second HTML Description.
$DEBUG = "false"; // Enabling Debug Mode will disable the error handler modal (The popup that comes up when an error occurs for a user) and it enables logging so you can look at the log and see what happened.
$FORCE_SSL = "true" //Force HTTPS for AirChat Users.
?>