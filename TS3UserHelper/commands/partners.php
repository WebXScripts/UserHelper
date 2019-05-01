<?php

	class partners
	{
		public static function onCommand($clientDB, $invokerid)
		{
			global $query, $application, $config;
			$query->sendMessage(1, $invokerid, "[b]Partnerzy serwera:[/b]");
			foreach($config['commands']['partners']['send_to_user'] as $send) {
				$query->sendmessage(1, $invokerid, $send);
		}
	}
}
