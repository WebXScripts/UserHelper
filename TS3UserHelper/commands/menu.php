<?php

	class menu
	{
		public static function onCommand($clientInfo, $invokerid)
		{
			global $query, $application, $config, $cache, $cmd;
			foreach($config['commands'] as $cmd => $cfg) {
				$query->sendmessage(1, $invokerid, '> '.$cmd.' - '.$cfg['desc']);
			}
		}
	}
