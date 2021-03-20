<?php  
	$limitvalue		=	10;
	$requireddata	=	array();
	if(isset($_POST['limitcount']))	$limitvalue	=	$_POST['limitcount'];

	$conncetion	=	mysqli_connect("localhost","root","","nscript_task");
	$sql		=	"SELECT volume FROM trading_datas WHERE deleted=0 LIMIT 0,".$limitvalue;
	$result		=	mysqli_query($conncetion,$sql);
	while($trad_val	=	$result->fetch_assoc()){
		$requireddata[]	=	$trad_val;
	}
	
	$graphdata	=	$requireddata;
	
	$reqdata['graphcontent']	=	$graphdata;
	$reqdata['count']			=	0;
	$reqdata['limitvalue']		=	$limitvalue;
	
	if(isset($_POST['limitcount'])){
		$reqdata['graphcontent']	=	$graphdata;
		$reqdata['count']			=	1;
		$reqdata['limitvalue']		=	$limitvalue;
		echo json_encode($reqdata);
	}else{
		$graphdata	=	json_encode($requireddata);
	}
	
?>
<?php  if($reqdata['count']==0){ ?>
<!DOCTYPE HTML>
<html> 
	<?php include 'header.html'; ?>
	<body>
		<label style="text-align:center;font-size:30px;">Trade Data's</label>
		<div class="row" style="margin-top:30px;">
			<div class="col-sm-1"></div>
			<div class="col-sm-2">
				<label>Choose Limits</label>
			</div>
			<div class="col-sm-3">
				<select class="form-control" Onchange="GraphValueUpload();" id="Tradelimit" style="width:300px;">
					<option>10</option>
					<option>20</option>
					<option>300</option>
					<option>500</option>
					<option>700</option>
					<option>900</option>
					<option>1000</option>
				</select>
			</div>
			
		</div>
		<div class="graph_data" style="margin-top:100px;">
			<input type="hidden" name="chart_data" value='<?php echo $graphdata;  ?>'>
			<input type="hidden" name="limitcount" value='<?php echo $reqdata['limitvalue'];  ?>'>
			<div id="chartContainer" style="height: 300px; width: 100%;">
			</div>
		</div>
	</body>
	
</html>

<?php } ?>