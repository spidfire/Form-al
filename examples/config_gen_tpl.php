<?php

if(!defined("CONFIG_INCLUDE")){
	die("Sorry you should include this file via the config found in the Server dir");
}
define("DEBUG",true);
define("MAINTENANCE_MODE",false);

define("APP_VERSION","1");
define("APP_VERSION_NAME","2.0");


define("EXTERNAL_ROOT","https://almanapp.nl/stage/{{basename}}/server/");

define("MYSQL_HOSTNAME","{mysql_host}");
define("MYSQL_DATABASE","{mysql_database}");
define("MYSQL_USERNAME","{mysql_username}");
define("MYSQL_PASSWORD","{mysql_password}"); 

define("MEDIA_TOKEN","{media_token}");
define("MEDIA_TOKENSECRET","{media_token_secret}");
define("MEDIA_URL","http://almanapp.nl/m/");


define("ADS_TOKEN","{ads_token}");
define("ADS_TOKENSECRET","{ads_token_secret}");
define("ADS_URL","http://a.almanapp.nl/");

// Email

define('MAIL_HOST', 'mail.almanapp.nl');
define("MAIL_MAX_BATCH", 1);
define("MAIL_NAME", "Almanapp Mailbot");
define('MAIL_ACCOUNT', 'noreply@almanapp.nl');
define('MAIL_PASSWORD', 'wZ7qc1BV');


// push key
define("GCM_CLIENT_KEY","444741374745");
define("GCM_KEY","AIzaSyBwfUq-WfYVrUZu3T4zQ4XA5DP56xFWvyw");
define("APS_PLACE",dirname(__FILE__)."/aps_cert.pem");




// Locale info

putenv('LC_ALL=nl_NL');
setlocale(LC_ALL, 'nl_NL');
date_default_timezone_set('CET');
bindtextdomain("Almanapp", ROOT."locale");
textdomain("Almanapp");



$hour = 23;
$minute = 30;
$second = 0;
$month = 12;
$day = 18;
$year = 2013;
$is_dst = -1;
define('LIVE_TIME',mktime($hour,$minute ,$second ,$month ,$day ,$year ,$is_dst ));

define('COUNDOWNPASSWORD','YOLOSWAG');

 



class Config extends DefaultConfig{
	static $customColors = array(
			'button' => 'ff0000',
			'button1' => 'FFFFFF', //Menu
			'button2' => '5c5a53', //Goudengids
			'button3' => '5c5a53' //Header
		);
	static $variables = array(
			'APPNAME' => "{appname}",
			'APPDESC' => "{appdesc}",
			'VERENIGING' => "{vereniging}", 
			'VERENIGING_WEBSITE' => "{vereniging_website}", 
			'IDENTIFIER' => "nl.almanapp.{basename}",
			'ROOTACCOUNT' => "{root_account}",
			'PLAATS' => "{plaats}",
			'CONTACT' => "{contact}",
			'CONTACT_MOB' => "{contact_mobiel}",
			'CONTACT_MAIL' => "{contact_email}",
			'IOSLINK' => "{ios_link}",
			'ANDROIDLINK' => "{android_link}",
			'BUILD_ID' => "{phonegapbuild_id}",
			'CORDOVA_WHITELIST' => array(
				array('url' => "http://127.0.0.1", 'sub' => 'true'),
				array('url' => "http://almanapp.nl", 'sub' => 'true'),
				array('url' => "http://m.almanapp.nl", 'sub' => 'true'),
				array('url' => "http://a.almanapp.nl", 'sub' => 'true'),
				array('url' => "http://amazonaws.com", 'sub' => 'true'),
				array('url' => "http://googleapis.com", 'sub' => 'true'),
				array('url' => "http://youtube.com", 'sub' => 'true'),
				array('url' => "http://soundcloud.com", 'sub' => 'true'),
				),
			'CORDOVA_PLUGINS' => '

					<gap:plugin name="com.chariotsolutions.cordova.plugin.keyboard_toolbar_remover" />
					<gap:plugin name="com.phonegap.plugin.statusbar" />
					<gap:plugin name="com.phonegap.plugins.PushPlugin" />
					<gap:plugin name="org.apache.cordova.device" />
					<gap:plugin name="org.apache.cordova.inappbrowser" />
					<gap:plugin name="org.apache.cordova.splashscreen" />',
		);//<gap:plugin name="com.ionic.keyboard" />

static $sentry_disable = false;
static $sentry_server= 'http://15258150be9445088da32102470bfb06:b0a1a85446434d26b4aa1c2b616cf727@ci.almanapp.nl:9000//3';
		

	static $encPublicKeyPass = "43BD7BBC9F44358BFCB4080B62E5849F035F874FEC1C0F5DA14BE9CF7499733D";

	static $pushOn = array(
			'news' => false,
			'user' => false,
			'group' => false
		);


	static $emailDebug = true;
	static $tokenbroken = "Uw token is niet meer geldig, log alstublieft opnieuw in!";
	static $norights = "U heeft geen toegang tot deze pagina!";
	static $nietingelogd = "U bent niet ingelogd, wilt u dit doen?";
	static $likeButtonText = "Ik lik dit";
	static $noLikeAnymore = "Lik niet meer";

	static function likeButtonCount($count){
		if($count == 0){
			return "Lik dit als eerste";
		}elseif($count == 1){
			return "1 lid likt dit";
		}else{
			return sprintf("%d leden likken dit", $count);
		}
	}
	static $userLoginField = 'email';
	static $userSearchParts = array('firstname','secondname','middlename','lastname','year','email','phone2');
	static $userIgnoreFields = array("identifier","searchable","bank_number","bank_tav","studyname","Faculty","studentnumber","notes","notes2",); 
	static $maxSearchResults = 15;
	

	//ledenlijst
	//IF(ISNULL(l.secondname), "",l.secondname),
	static $mysqlNameFormat = '
	CONCAT(
		IF(ISNULL(l.firstname), "",concat(l.firstname," ")),
		IF(ISNULL(l.middlename), "",concat(l.middlename," ")),
		IF(ISNULL(l.lastname), "",concat(l.lastname," ")),	
			
		IF(
			ISNULL(l.`year`),
			"" ,
			CONCAT("(",l.`year`,")")
		))';
	static $mysqlYearVar = 'year';
	static function fullnameFormat($array){
		$tussen = $array['middlename'] == "" ? "" : " ".$array['middlename'];
		$naam = $array['firstname'].$tussen. " ". $array['lastname'];
		if(trim($naam) == ""){
			$naam = $array['secondname'];
		}
		$max = 23;
		if(strlen($naam) > $max+3){
			$naam = substr($naam, 0,$max)."...";
		}
		$jaar = array();
			if(isset($array['notes'])){
				$jaar[] = $array['notes'];
			}

		if($array['year'] != 0){
			
				
			$jaar[] = $array['year'];
		}
		return $naam. (count($jaar) ==0 ? "" : " (".implode(" ", $jaar).")"); 
	}

	static function gender($ledenlijstObject){
		if(is_array($ledenlijstObject)){
			return $ledenlijstObject["Code man"] == 2 ? 'v': 'm';
		}elseif(is_object($ledenlijstObject)){
			return $ledenlijstObject->getValue("Code man") == 2 ? 'v': 'm';
		}else{
			throw new Exception("Unkonwn type object", 1);
			
		}
	}

	

	
	static function loginToSite($username=null, $password=null){
		
		return array(false, $session,"No external login");
		
	}

	static function getBeerInfo($username, $password){
		
		return "Geen financieele informatie gevonden!";
	}

	static function customUserdata($lid){

		return $lid;
	}
	static function customGroup($group){	

		return $group;
	}
}
