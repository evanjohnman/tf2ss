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
		foreach ($Query->GetInfo() as $key=>$info)
		{
		    echo $key.': '.$info.'<br>';
		}
		echo '</div><br><br><b>Player Info</b><br><div id="p">';
		foreach($Query->GetPlayers() as $key=>$player)
		{
		    echo $key.': <br>';
		    for ($countstat=2; $countstat <= 5; $countstat++)
		    {
			echo '<div id="p'.$key.'">&nbsp;&nbsp;&nbsp;&nbsp;'.$key.': '.$pstat.'<br></div>';
		    }
		}
		echo '</div><br><br><b>Convars</b><br><div id="c">';
		foreach ($Query->GetRules() as $key=>$cvar)
		{
		    echo $key.': '.$cvar.'<br>';
		}
		echo '</div>';
	}
	catch( Exception $e )
	{
		echo $e->getMessage( );
	}
	
	$Query->Disconnect( );
