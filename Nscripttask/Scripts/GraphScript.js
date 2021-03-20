window.onload = function () {
	var chart_vals	=	$('input[name=chart_data]').val();
	var limit_count	=	$('input[name=limitcount]').val();
	if(chart_vals.length!='2') GettingChartCOntents(chart_vals,limit_count);
	else alert("No data Found");
}

function GraphValueUpload(){
	var e 			= document.getElementById("Tradelimit");
	var limitcount = e.options[e.selectedIndex].text;
	$.ajax({
		url: "Graph.php",
		type:"POST",
		data:{
			limitcount:limitcount 
		},
		success: function(result){
		
			var loadresult	=	JSON.parse(result);			
			var loadresu_st = JSON.stringify(loadresult.graphcontent);
			
			$('input[name=chart_data]').val(loadresu_st);
			$('input[name=limitcount]').val(loadresult['limitvalue']);
			var limit_count	=	$('input[name=limitcount]').val();
			var chart_vals	=	$('input[name=chart_data]').val();
			var datavals	=	[];
			if(loadresult.graphcontent!='') GettingChartCOntents(chart_vals,limit_count);
			else alert("No data Found");
		}
	});
}


function GettingChartCOntents(chart_vals,limit_count){
	var datavals	=	[];
	for(var i=1;i<=limit_count;i++){
		var graphdatasX	=	i;
		var reqYdata	=	JSON.parse(chart_vals);
		var graphdatasY	=	parseInt(reqYdata[i-1]['volume']);
		datavals.push({x:graphdatasX,y:graphdatasY});
	}
	
	var chart = new CanvasJS.Chart("chartContainer",
	{
	  title:{
		text: ""  
	  },
	  data: [{        
		type: "line",
		showInLegend: true,
		legendMarkerType: "triangle",
		legendMarkerColor: "red",
		dataPoints: datavals
	  }]
	});

	chart.render();
}