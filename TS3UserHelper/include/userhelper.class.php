<?php

	class userhelper
	{
		public function write_cooldown()
		{
			global $query, $config, $client, $clientDB;

			if ($config['settings']['cooldown'] == 1) {
				return $query->sendMessage(1, $client["invokerid"], "[b]Komend możesz używać co 1 sekundę![/b]");
			}
			else if ($config['settings']['cooldown'] <= 4) {
				return $query->sendMessage(1, $client["invokerid"], '[b]Komend możesz używać '.$config['settings']['cooldown'].' sekundy![/b]');
			}
			else {
				return $query->sendMessage(1, $client["invokerid"], '[b]Komend możesz używać '.$config['settings']['cooldown'].' sekund![/b]');
			}
		}

		public function getName()
		{
			$json = json_decode(file_get_contents("https://uinames.com/api/?region=poland"), true);
			return $json['name'];
		}

		public function sendCommand($command)
		{
			global $tsAdminSocket;
			$splittedCommand                                = str_split($command, 1024);
			$splittedCommand[(count($splittedCommand) - 1)] .= "\n";
			foreach ($splittedCommand as $commandPart) {
				fputs($tsAdminSocket, $commandPart);
			}

			return fgets($tsAdminSocket, 4096);
		}

		public function getData()
		{
			global $tsAdminSocket;
			$data = fgets($tsAdminSocket, 4096);
			if (!empty($data)) {
				$datasets = explode(' ', $data);
				$output   = array();
				foreach ($datasets as $dataset) {
					$dataset = explode('=', $dataset);
					if (count($dataset) > 2) {
						for ($i = 2; $i < count($dataset); $i++) {
							$dataset[1] .= '='.$dataset[$i];
						}
						$output[self::unEscapeText($dataset[0])] = self::unEscapeText($dataset[1]);
					}
					else if (count($dataset) == 1) {
						$output[self::unEscapeText($dataset[0])] = '';
					}
					else {
						$output[self::unEscapeText($dataset[0])] = self::unEscapeText($dataset[1]);
					}
				}
				return $output;
			}
		}

		public function unEscapeText($text)
		{
			$escapedChars   = array("\t", "\v", "\r", "\n", "\f", "\s", "\p", "\/");
			$unEscapedChars = array('', '', '', '', '', ' ', '|', '/');
			$text           = str_replace($escapedChars, $unEscapedChars, $text);
			return $text;
		}

		public function replaceUserInfo($message, $clientname, $botname)
		{
			$edited_message = array(
				'%client' => $clientname,
				'%nick' => $botname,
			);
			return str_replace(array_keys($edited_message), array_values($edited_message), $message);
		}
	}
