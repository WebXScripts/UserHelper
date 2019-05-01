<?php

	class autoprivate
	{
		public static function onCommand($clientDB, $invokerid)
		{
			global $query, $application, $config;
			if ($clientDB['cid'] == $config["commands"]["autoprivate"]["move_to"]) {
				$query->sendMessage(1, $invokerid, "[b]Znajdujesz się już na kanale nadawania kanału prywatnego![/b]");
				return;
			}
			if (!$query->getElement('success', $query->clientMove($invokerid, $config["commands"]["autoprivate"]["move_to"]))) {
				$query->clientPoke($invokerid, "[b]Błąd! Sprawdź plik konfiguracyjny.[/b]");
				return;
			}
			else {
				$query->sendMessage(1, $invokerid, "Zostałeś pomyślnie przeniesniony na kanał: Automatyczny kanał prywatny.");
				$query->sendMessage(1, $invokerid, "Poczekaj, aż bot utworzy ci kanał.");
			}
		}
	}
