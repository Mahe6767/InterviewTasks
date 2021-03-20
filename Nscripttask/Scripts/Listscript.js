function DeleteTrade(thisval){
	var deleteid	=	thisval.getAttribute('data-id');
	var r=confirm("Are You Sure You Want To Delete The Data?");
	if(r==true){
		window.location	=	"List.php?id="+deleteid;
		return true;
	}else{
		return false;
	}		
}

function GetDatevalues(){
	var fromdate	=	document.getElementById("From_id").value;
	var todate		=	document.getElementById("To_id").value;
	if(fromdate=="" || todate==""){
		alert("Choice The Dates");
	}else{
		window.location	= "List.php?Fromdate="+fromdate+"&Todate="+todate;
	}
}