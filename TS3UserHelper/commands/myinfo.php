<?php

	class myinfo
	{
		public static function getInfo($message, $clientDB)
		{
			global $query, $application, $config;
			$edited_message = array(
				'%nickname' => $clientDB["client_nickname"],
				'%clientuid' => $clientDB["client_unique_identifier"],
				'%version' => $clientDB["client_version"],
				'%platform' => $clientDB["client_platform"],
				'%firstconnected' => date('d.m.Y h:m:s', $clientDB['client_created']),
				'%lastconnected' => date('d.m.Y h:m:s', $clientDB["client_lastconnected"]),
				'%totalconnections' => $clientDB["client_totalconnections"],
				'%myteamspeakid' => $clientDB["client_myteamspeak_id"],
				'%dbid' => $clientDB["client_database_id"],
				'%ip' => $clientDB["connection_client_ip"],
			);
			return str_replace(array_keys($edited_message), array_values($edited_message), $message);
		}

		public static function onCommand($client, $invokerid)
		{
			global $query, $application, $config, $clientDB;
			$query->sendMessage(1, $invokerid, "[b]Informacje o tobie:[/b]");
			foreach($config['commands']['myinfo']['send_to_user'] as $cmd) {
				$query->sendmessage(1, $invokerid, self::getInfo($cmd, $clientDB));
			}
		}
	}
