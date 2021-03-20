function SubmitData(){
	var r=confirm("Are You Sure You Want To Submit The Data?");
	 if (r==true){
		$('.Alert_message').html('<marquee>Data Is Loading.Please Wait a Moment......</marquee>');
		window.location="FetchDataQuery.php";
		return true;
	}else{
		alert("You pressed Cancel!");
	}
}

