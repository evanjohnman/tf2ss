<?php
if (empty($_POST['pass']) && empty($_POST['ip']) && empty($_POST['port'])) header('Location: https://chrome.google.com/webstore/detail/tf2-server-stats/gokjikhaolldmkhocahjmfikmomenbpd');
	require __DIR__ . '/SourceQuery/SourceQuery.class.php';
	
	// For the sake of this example
	//Header( 'Content-Type: text/plain' );
	Header( 'X-Content-Type-Options: nosniff' );
	Header("Access-Control-Allow-Origin: *");
	
	// Edit this ->
	define( 'SQ_SERVER_ADDR', $_POST['ip'] );
	define( 'SQ_SERVER_PORT', $_POST['port'] );
	define( 'SQ_TIMEOUT',	  1 );
	define( 'SQ_ENGINE',	  SourceQuery :: SOURCE );
	// Edit this <-
	
	$Query = new SourceQuery( );
	
	try
	{
		$Query->Connect( SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE );
		
		if (!empty($_POST['pass'])) { $Query->SetRconPassword( $_POST['pass']); }
		
		if (!empty($_POST['pass'])){ echo 'Time left: '.$Query->Rcon( 'timeleft' );
		echo '<br>';
		echo 'Next map: '.$Query->Rcon('nextmap'); }
		echo $Query->Ping();
		echo '<br><br><b>Server info</b><br><div id="i">';
		if (!empty($Query->GetInfo()))
		{	
			foreach ($Query->GetInfo() as $key=>$info)
			{
		  		echo $key.': '.$info.'<br>';
			}
		}
		else echo 'Could not retrieve the server\'s information. Check that the server is online, ports have been forwarded properly, and that it is a Team Fortress 2 dedicated server, and try again.';
		echo '</div><br><br><b>Players</b><br><div id="p">';
		if (!empty($Query->GetPlayers()))
		{
			foreach($Query->GetPlayers() as $key=>$player)
			{
		    		echo $key.': <br>';
		    		foreach ($player as $key=>$pstat)
		    		{
					echo '<div id="p'.$key.'">&nbsp;&nbsp;&nbsp;&nbsp;'.$key.': '.$pstat.'<br></div>';
		    		}
			}
		}
		else echo 'Could not retrieve the list of players currently connected to the server.';
		echo '</div><br><br><b>Cvars</b><br><div id="c">';
		if (!empty($Query->GetRules()))
		{
			foreach ($Query->GetRules() as $key=>$cvar)
			{
		    		echo $key.': '.$cvar.'<br>';
			}
		}
		else echo 'Could not retrieve the server\'s cvars.';
		echo '</div>';
	}
	catch( Exception $e )
	{
		echo $e->getMessage( );
	}
	
	$Query->Disconnect( );
