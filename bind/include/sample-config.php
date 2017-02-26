<?php
/* API Configuration */

$config["api_url"]		= "http://dns.nnxx/manedmanager";			// Application Install Location
$config["api_server_name"]	= "dns.nnxx";						// Name of the DNS server (important: part of the authentication process)
$config["api_auth_key"]		= "ninux";						// API authentication key


/* Log file */

$config["log_file"]		= "/var/log/messages";


/* Lock File - 	Used to prevent clashes when multiple instances are accidently run. */

$config["lock_file"]		= "/var/lock/namedmanager_lock";


/* Bind Configuration Files */

$config["bind"]["version"]		= "9";					// version of bind (currently only 9 is supported, although others may work)
$config["bind"]["reload"]		= "/usr/sbin/rndc reload";		// command to reload bind config & zonefiles
$config["bind"]["config"]		= "/etc/bind/named.namedmanager.conf";	// configuration file to write bind config too
$config["bind"]["zonefiledir"]		= "/etc/bind/zones/";			// directory to write zonefiles too
										// note: if using chroot bind, will often be /var/named/chroot/var/named/
$config["bind"]["verify_zone"]		= "/usr/sbin/named-checkzone";		// Used to verify each generated zonefile as OK
$config["bind"]["verify_config"]	= "/usr/sbin/named-checkconf";		// Used to verify generated NamedManager configuration


/* Unusual Compatibility Options */

// Include a full path to the zonefiles in Bind - useful if Bind lacks a
// directory configuration or you really, really to store you zonefiles
// in a different location
//
// $config["bind"]["zonefullpath"]		= "on";


// force debugging on for all users + scripts
// (note: debugging can be enabled on a per-user basis by an admin via the web interface)
//$_SESSION["user"]["debug"] = "on";
?>
