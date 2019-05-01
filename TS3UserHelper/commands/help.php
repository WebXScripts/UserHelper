<?php

	class help
	{
		public static function onCommand($clientInfo, $invokerid)
		{
			global $query, $application, $config, $cache, $cmd;
			$query->sendMessage(1, $invokerid, $config['greetings']['help_start']);
			foreach($config['commands'] as $cmd => $cfg) {
				$query->sendmessage(1, $invokerid, '> '.$cmd.' - '.$cfg['desc']);
			}
		}
	}
