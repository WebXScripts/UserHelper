<?php
/*
UserHelper by WebX!
Version: 0.2
*/

$config = array();

$config['connection'] = array(
		'server_ip' => '127.0.0.1', #Adres IP
		'voice_port' => 9987, #Port TS3
		'query_port' => 10011, #Port Query
		'login' => "serveradmin", #Login
		'password' => "sw5vrGn7", #Hasło
		'bot_name' => '<tsforum.pl> UserHelper', #Nazwa bota
);

$config['settings'] = array(
		'cooldown' => 2, #Cooldown komend
		"random_name_timer" => 60, #Co ile ma generować imię bota
		"random_footer_timer" => 60, #Co ile ma generować footer
);

$config['greetings'] = array(
	'header' => 'Witaj [b]%client[/b] w aplikacji UserHelper!', #Header
	'welcome' => 'Nazywam się [b]%nick[/b] i jestem tu aby ci pomóc!', #Powitanie (dostępne zmienne %nick - losowe imie | %client - nick użytkownika)
	'help_start' => '[b]Oto dostępne komendy:[/b]', #Wprowadzenie komend
);

$config['random_footer'] = array(
	"[b]Życzymy miłych rozmów![/b]", #losowe footery (DÓŁ)
	"[b]Życzymy wesołych świąt![/b]",
	"[b]Życzymy szczęśliwego nowego roku![/b]",
);

$config['commands'] = array(
		'help' => array(
				'enabled' => true,
				'desc' => 'Wyświetla listę komend.', #Opis komendy
		),
		'admins' => array(
				'enabled' => true, #True/False
				'desc' => 'Automatycznie przenosi cię na Centrum Pomocy.', #Opis komendy
				'move_to' => 43, #Na ktory kanal movenac
		),
		'autoprivate' => array(
				'enabled' => true, #True/False
				'desc' => 'Automatycznie przenosi cię na nadanie kanału prywatnego.', #Opis komendy
				'move_to' => 43, #Na ktory kanal movenac
		),
		'faq' => array(
				'enabled' => true, #True/False
				'desc' => 'Wyświetla serwerowe Q&A.', #Opis komendy
				'space_type' => ' ', #Jaka ma byc przerwa miedzy pytaniami i odpowiedziami? np '____________'
				'questions_and_answers' => array(

					/*
					0 => array(
					'question' => 'Tutaj dodajesz swoje pytanie',
					'answer' => '> A tutaj odpowiedź!',
					),
					*/

					1 => array(
					'question' => '[b]Gdzie jestem?[/b]',
					'answer' => '> Znajdujesz się na najlepszym serwerze TeamSpeak3!',
					),
					2 => array(
					'question' => '[b]Czy jest otwarta rekturacja?[/b]',
					'answer' => '> Nie mam pojęcia! Spytaj Admina.',
					),
					3 => array(
					'question' => '[b]Czy ten serwer jest bezpieczny?[/b]',
					'answer' => '> Jasne, że jest... Nic nie ukrywamy... v.v',
					),
					4 => array(
					'question' => '[b]Czemu ten bot tak nawala na tej poczekalni???[/b]',
					'answer' => '> A no bo tak. XD',
					),
				),
				'end_footer' => '[b]Nie odnalazłeś tu odpowiedzi na swoje pytanie? Spytaj Administratora!', #Zakonczenie faq
		),
		'myinfo' => array(
				'enabled' => true, #True/False
				'desc' => 'Wyświetla informacje o Tobie.', #Opis komendy
				'send_to_user' => array(

					/*
					Dostępne zmienne:
					%nickname - nick
					%clientuid - UID
					%dbid - DBID
					%version - wersja
					%platform - platforma
					%myteamspeakid - ID MyTeamSpeak
					%firstconnected - pierwsze polaczenie
					%lastconnected - ostatnie polaczenie
					%totalconnections - wszystkch polaczen
					%ip - ip uzytkownika
					*/

				'[b]> Twój nick:[/b] %nickname',
				'[b]> Twóje UID:[/b] %clientuid',
				'[b]> Twóje DBID:[/b] %dbid',
				'[b]> Twoja wersja klienta:[/b] %version',
				'[b]> Twoja platforma:[/b] %platform',
				'[b]> Twoje MyTeamSpeakID:[/b] %myteamspeakid',
				'[b]> Pierwsze połączenie:[/b] %firstconnected',
				'[b]> Ostatnie połączenie:[/b] %lastconnected',
				'[b]> Wszystkich połączeń:[/b] %totalconnections',
				'[b]> Twoje IP:[/b] %ip',
			),
		),
		'partners' => array(
				'enabled' => true, #True/False
				'desc' => 'Wyświetla partnerów serwera.', #Opis komendy
				'send_to_user' => array(
					'> tsforum.pl - Polskie Wsparcie TeamSpeak.', #lista partnerow
					'> intcode.pl - Usługi programistyczne.',
				),
		),
);


?>
