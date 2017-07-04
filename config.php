<?php
	class Config {
		public $hostname = "irc.chat.twitch.tv"; //проверьте свой чат-сервер по адресу: http://tmi.twitch.tv/servers?channel=название_канала
		public $port = 6667;
		public $username = "TPSBOTS"; //логин на твитче
		public $password = "АККУРАТНА СИСЮРИТИ"; //oauth2-пароль. Можно получить по адресу: http://twitchapps.com/tmi/
		public $channel = "#mrsteel228"; //ваш канал в формате #канал (например, #cwelth)
	
		public $socket;
		
		//public $coolDownLimit = 60; //Время сброса счетчика команд в секундах (кулдаун)
		//public $coolDownTimer = $time - coolDownLimit;
		public $commandsProcessedLimit = 10; //Количество команд, которые отработает бот за время кулдауна
		public $commandsProcessed = 0;
	}

	$CNF = new Config();
	
?>
