<?php

	$Get_Json_content	=	file_get_contents('http://nscript.net/chart.php');
	$decodedcontent		=	json_decode($Get_Json_content);
	$conncetion			=	mysqli_connect("localhost","root","","nscript_task");
	
	foreach($decodedcontent as $key=>$value){
		
		$keyvalues			=	str_replace(" ","_",$key);
		$reqval[$keyvalues]	=	$value;	
	}
	
	foreach($reqval['Time_Series_(1min)'] as $ky=>$val){
		
		$insertvalue	=	(array)$val;
		
		$open		=	$insertvalue['1. open'];
		$high		=	$insertvalue['2. high'];
		$low		=	$insertvalue['3. low'];
		$close		=	$insertvalue['4. close'];
		$volume		=	$insertvalue['5. volume'];
		$created_at	=	$ky;
		
		$sql		=	"SELECT * FROM trading_datas WHERE open_data='".$open."' AND high='".$high."' AND low='".$low."' AND close='".$close."' AND volume='".$volume."' AND created_at='".$created_at."' AND (deleted='1' OR deleted='0')";
		$result		=	mysqli_query($conncetion,$sql);
		$rowcount	=	mysqli_num_rows($result);
		
		if($rowcount==0){
			$insertquery	=	"INSERT INTO trading_datas (`open_data`,`high`,`low`,`close`,`volume`,`created_at`,`deleted`) VALUES ('".$open."','".$high."','".$low."','".$close."','".$volume."','".$created_at."','0')";
		
			$query			=	mysqli_query($conncetion,$insertquery);
		}
		
		header('Location:List.php');
	}
	
	
	
	
	
	
?>