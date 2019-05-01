<?php
	/*
	UserHelper by WebX!
	Version: 0.2
	*/

	error_reporting(E_ALL);
	date_default_timezone_set('Europe/Warsaw');
	ini_set('default_charset', 'UTF-8');
	setlocale(LC_ALL, 'UTF-8');

	require_once 'include/ts3admin.class.php';
	require_once 'include/userhelper.class.php';
	require_once 'config/config.php';
	include_once "commands/menu.php";

	define('OWNER', 'WebX!');
	define('VERSION', '0.2 STABLE');
	define('SUPPORT', 'ts.intcode.pl');

	$application = new userhelper();
	$menu = new menu();

	echo PHP_EOL;
	echo ':: UserHelper '.VERSION.PHP_EOL;
	echo ':: Aplikacja stworzona przez: '.OWNER.PHP_EOL;
	echo ':: Support aplikacji: '.SUPPORT.PHP_EOL;
	echo PHP_EOL;

	$query = new ts3admin($config['connection']['server_ip'], $config['connection']['query_port']);
	if ($query->getElement('success', $query->connect())) {
		echo ':: Polaczono z serwerem!'.PHP_EOL;
	}
	else {
		exit('!:: Aplikacja nie mogla polaczyc sie z serwerem.'.PHP_EOL);
	}
	if ($query->getElement('success', $query->login($config['connection']['login'], $config['connection']['password']))) {
		echo ':: Zalogowano do Query!'.PHP_EOL;
	}
	else {
		exit('!:: Aplikacja nie mogla zalogowac sie na serwer.'.PHP_EOL);
	}
	if ($query->getElement('success', $query->selectServer($config['connection']['voice_port'], 'port', false, $config['connection']['bot_name']))) {
		echo ':: Aplikacja wybrala serwer o porcie: '.$config['connection']['voice_port'].' i ustawila nick: '.$config['connection']['bot_name'].PHP_EOL;
	}
	else {
		exit('!:: Aplikacja nie mogla wybrac serwera.'.PHP_EOL);
	}

	$tsAdminSocket = $query->runtime['socket'];
	$application->sendCommand("servernotifyregister event=textprivate");
	$application->sendCommand("servernotifyregister event=server");

	$cache = array();
	$cache['cooldown'] = array();

	$cache['random_footer']['last_random_footer'] = array('time' => time() + $config['settings']['random_footer_timer'], 'footer' => $config['random_footer'][array_rand($config['random_footer'], 1)]);
	$cache['person_name']['last_random_name'] = array('time' => time() + $config['settings']['random_name_timer'], 'name' => $application->getName());

	if ($cache['person_name']['last_random_name']['time'] < time()) {
		echo ':: Wygenerowano imie: '.$cache['person_name']['last_random_name']['name'].PHP_EOL;
	}
	else {
		$cache['last_random_name'] = array('time' => time() + $config['settings']['random_name_timer'], 'name' => $application->getName());
		echo ':: Wygenerowano imie: '.$cache['person_name']['last_random_name']['name'].PHP_EOL;
	}
	if ($cache['random_footer']['last_random_footer']['time'] < time()) {
		echo ':: Wybrano footer: '.$cache['random_footer']['last_random_footer']['footer'].PHP_EOL;
	}
	else {
		$cache['last_random_footer'] = array('time' => time() + $config['settings']['random_footer_timer'], 'footer' => $config['random_footer'][array_rand($config['random_footer'], 1)]);
		echo ':: Wylosowano footer: '.$cache['random_footer']['last_random_footer']['footer'].PHP_EOL;
	}
	echo PHP_EOL.":: Wczytuję komendy:".PHP_EOL;;
	$cache['commands'] = array();
	foreach ($config['commands'] as $cmd => $cfg) {
		if ($cfg['enabled']) {
			include_once "commands/$cmd.php";
			$cache['commands'][] = $cmd;
			echo "!:: Zaladowano komende: $cmd".PHP_EOL;
		}
	}
	$opus = count($cache['commands']);
	echo PHP_EOL.'Logi:'.PHP_EOL;
	while (true) {
		$client = $application->getData();
		if (isset($client["notifycliententerview"]) && !empty($client["client_database_id"])) {
			$clientInfo = $query->getElement('data', $query->clientInfo($client['clid']));
			foreach ($config['greetings'] as $string) {
				$query->sendmessage(1, $client['clid'], $application->replaceUserInfo($string, $clientInfo['client_nickname'], $cache['person_name']['last_random_name']['name']));
			}
			$menu->onCommand($client, $client['clid']);
			$query->sendMessage(1, $client['clid'], $cache['random_footer']['last_random_footer']['footer']);
		}
		if (isset($client["notifytextmessage"]) && !empty($client["invokerid"])) {
			$explode = explode(" ", $client["msg"]);
			if (in_array($explode[0], $cache['commands'])) {
				if (array_key_exists($clientInfo['client_unique_identifier'], $cache['cooldown']) && time() - $cache['cooldown'][$clientInfo['client_unique_identifier']] < $config['settings']['cooldown']) {
					$application->write_cooldown();
					continue;
				}
				$clientDB = $query->getElement('data', $query->clientInfo($client["invokerid"]));
				$explode[0]::onCommand($clientDB, $client["invokerid"]);
				$cache['cooldown'][$clientDB['client_unique_identifier']] = time();
			}
			else {
				$query->sendmessage(1, $client['invokerid'], "[b]Hej ty! Podana komenda nie istnieje![/b]");
			}
		}
	}
