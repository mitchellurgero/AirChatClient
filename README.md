# AirChatXMPP
AirChat - An XMPP WebClient

AirChat is an XMPP web client that uses StropheJS, BOSH, and Bootstrap. This client is lightweight on resources for both server and client side. 

The client supports TLS connections and Group Chats only.

### Third-Party extensions or libraries used

- Bootstrap3
- StropheJS
- JSXC (https://jsxc.org)
- AES.js (B. Poettering)

# Features

- SSL/TLS encrypted Group Chat (MUC Support)
- Working login and registration system
- elegant, and simple bootstrap theme
- light on resources both server and client side
- Supports password protected rooms
- Built-in debug mode for resolve issues with connections, etc



# Installing AirChat

### Prerequisites

- Apache2 (Debian) or IIS7+ with IIS_PHP extensions installed (Windows)
- PHP5+ with mcrypt, and curl extensions/modules installed
- An XMPP Server, ejabberd/ejabberd2 preferred. TurnKeyLinux has a great appliance that comes configured for BOSH out of the box.
- An SSL Certificate (Optional, but still worth looking into.)

### Installing an XMPP server

Installing an XMPP server can be simple if you are familiar with Linux configuration files.

I recommend using TurnKey Linux's [ejabberd](https://www.turnkeylinux.org/ejabberd).

Any XMPP server that supports registration and BOSH (http-bind or https-bind) works fine. There are a lot of tutorials for installing and using XMPP servers on Linux, so I recommend google.

### Installing AirChat

AirChat is simple, just download the master.zip file from GitHub, or git clone this repository.
After downloading, unzip or move the files into /var/www or the root of your web server. Then modify config.php to match your current XMPP server configuration.

That's it! You are done! Enjoy!
