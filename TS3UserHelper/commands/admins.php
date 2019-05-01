<?php

	class admins
	{
		public static function onCommand($clientDB, $invokerid)
		{
			global $query, $application, $config;

			if ($clientDB['cid'] == $config["commands"]["admins"]["move_to"]) {
				$query->sendMessage(1, $invokerid, "[b]Znajdujesz się już na kanale pomocy![/b]");
				return;
			}
			if (!$query->getElement('success', $query->clientMove($invokerid, $config["commands"]["admins"]["move_to"]))) {
				$query->clientPoke($invokerid, "[b]Błąd! Sprawdź plik konfiguracyjny.[/b]");
				return;
			}
			else {
				$query->sendMessage(1, $invokerid, "Zostałeś pomyślnie przeniesniony na kanał pomocy.");
			}
		}
	}
