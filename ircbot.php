<?php
	require("config.php");
	require("backend.php");
	
	$CNF->socket = fsockopen($CNF->hostname, $CNF->port);
	
	SendToServer("PASS $CNF->password");
	SendToServer("NICK $CNF->username");
	SendToServer("JOIN $CNF->channel");
	
	SendToServer(".color #00ff00", true);
	
	SendToServer("Бот запущен успешно", true);
	
	while(true)
	{
		while($data = fgets($CNF->socket))
		{
			flush();
			$msg = explode(' ', $data, 4);
			
			if($msg[0] == "PING") {
				SendToServer("PONG ".$msg[1]);
			} else
			{
				if($msg[1] == "PRIVMSG")
				{
					$text = substr($msg[3], 1);
					$sender = substr(explode('!', $msg[0])[0], 1);
					//print($sender." --==-- ".$text);
					ProcessMessage($sender, $text, $link);
				}
			}
		}
		
		if(!feof($CNF->socket)) continue;
		
		//if($CNF->coolDownTimer > 0)
		//{
		//	$CNF->coolDownTimer--;
		//} else {
		//	$CNF->coolDownTimer = $CNF->coolDownLimit;
		//	$CNF->commandsProcessed = 0;
		//}
		
		sleep(1);
	}
?>