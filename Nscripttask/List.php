<?php 
	include 'header.html'; 
	$conncetion	=	mysqli_connect("localhost","root","","nscript_task");
	$sql		=	"SELECT * FROM trading_datas ";
	if(isset($_GET['Fromdate']) && isset($_GET['Todate'])){
		$dateandtime1	=	explode('T',$_GET['Fromdate']);
		$dateandtime2	=	explode('T',$_GET['Todate']);
		$sql.=	"WHERE created_at BETWEEN '".$dateandtime1[0]." ".$dateandtime1[1]."' AND '".$dateandtime2[0]." ".$dateandtime2[1]."' AND deleted=0";
	}else{
		$sql.=	"WHERE deleted=0";
	}
	
	$requireddata	=	array();
	$result			=	mysqli_query($conncetion,$sql);
	
	while($trad_val	=	$result->fetch_assoc()){
		$requireddata[]	=	$trad_val;
	}
	
	if(isset($_GET['id'])){
		$sql1	=	"UPDATE trading_datas SET deleted=1 WHERE id='".$_GET['id']."'";
		header("Location:List.php");
	}
?>
<html>
	<body>
		<div class="row" >
			<div class="col-sm-3"></div>
			<div class="from_date col-sm-2" style="margin-top:20px;">
				<label>From Date</label>
				<input type="datetime-local" name="from_date" id="From_id" value="<?php if(isset($_GET['Fromdate'])){ echo $_GET['Fromdate']; } ?>">
			</div>
			<div class="from_date col-sm-2" style="margin-top:20px;">
				<label>To Date</label>
				<input type="datetime-local" name="to_date" id="To_id" value="<?php if(isset($_GET['Todate'])){ echo $_GET['Todate']; } ?>">
			</div>
			<div class="submit_btn col-sm-3" style="margin-top:20px;">
				<button type="button" Onclick="GetDatevalues();">Submit</button>
			</div>
		</div>
		<div class="container">
			<table class="table" style="margin-top:100px;">
				<thead>
				  <tr>
					<th>Open</th>
					<th>High</th>
					<th>Low</th>
					<th>Close</th>
					<th>Volume</th>
					<th>Created Time</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody>
					<?php foreach($requireddata as $key=>$value){ ?>
						<tr>
							<td><?php echo $value['open_data']; ?></td>
							<td><?php echo $value['high']; ?></td>
							<td><?php echo $value['low']; ?></td>
							<td><?php echo $value['close']; ?></td>
							<td><?php echo $value['volume']; ?></td>
							<td><?php echo $value['created_at']; ?></td>
							<td><i class="fa fa-trash" style="font-size:15px" Onclick="DeleteTrade(this);" data-id="<?php echo $value['id']; ?>"></i></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</body>
</html>