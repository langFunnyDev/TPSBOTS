<?php
	$link = mysqli_connect("localhost", "root", "", "IRC");
	
	if (mysqli_connect_errno()) {
		printf("Не удалось подключиться: %s\n", mysqli_connect_error());
	exit();
}

	
	 
	function SendToServer($msg, $channel=false)
	{
		global $CNF;
		if($channel)
		{
			fputs($CNF->socket, "PRIVMSG ".$CNF->channel." :$msg\n");
		} else
			fputs($CNF->socket, $msg."\n");
		print("Sending to server... ".$msg."\n");
	}
	
	
	
	function ProcessMessage($sender, $message, $link)
	{
		

		global $CNF;
		$command = explode(' ', $message, 2);
		if(mb_substr($command[0], 0, 1, "UTF-8") != "!")return;
		
		if($CNF->commandsProcessed++ > $CNF->commandsProcessedLimit)return;
		


		$cmd = preg_replace('~[.[:cntrl:][:space:]]~', '', (mb_strtolower($command[0], "UTF-8")));
		//$args = preg_replace('~[.[:cntrl:][:space:]]~', '', $command[1]);
		

		
		
		switch($cmd)
		{
			case "!привет":
			{
				SendToServer("@".$sender.", привет!", true);
				break;
			}
			
			case "!сайт":
			{
					SendToServer("Уважаемые зрители ссылка на наш сайт: http://corstat.xyz", true);
					break;
			}
			
			case "!новость_дня":
			{
				SendToServer("Уважаемые зрители в скором времени выйдет редизайн нашего сайта", true);
				break;
			}
			
			case "!help":
			{
				SendToServer("Доступные комманды: !привет, !сайт, !новость_дня, !help, !помогите", true);
				break;
			}
			
			case "!помогите":
			{
				SendToServer("Доступные комманды: !привет, !сайт, !новость_дня, !help, !помогите", true);
				break;
			}
			case "!почта":
			{
				$strofm = substr($message, 12);
				$sql = "INSERT INTO `IRC`.`CMD` (`id`, `NameOfSender`, `CommandString`, `Response`, `TimeStamp`) VALUES (NULL, \'.$sender.\', \'.$strofm.\', \'\', \'\');";
				
				$response = mysqli_query($link, $sql);
				
				if($response == TRUE){
					SendToServer("Ура товарищи", true);
				}
				break;
			}
			case "!stop":
			{
				if($sender == 'corwinthecat' || $sender == 'mrsteel228'){
					SendToServer("I'm stop", true);
					exit();	
				} else {
					SendToServer("You are idiot", true);
				}
				
				break;
			}	
			default:
			{
				print("+++command:" .$command[0]."\n");
			}
		}
	}
	

