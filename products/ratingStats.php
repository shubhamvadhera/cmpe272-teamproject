<?php
	include '../session/session.php';

	//DB Credentials in $database
	include '../phpscripts/databaseConnection.php';
	
	//Getting data ($result, $midasResult, $ttmResult, $giftResult, $gameResult, $dhabaResult, $maruResult)
	include '../phpscripts/dataForMostRatedProducts.php';
	$websiteResults = array($midasResult, $ttmResult, $giftResult, $gameResult, $dhabaResult, $maruResult);
	
		
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>emporium-Rating Statistics</title>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">		
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>		
		<style type="text/css">

		  .open .dropdown-toggle {
		      color: #fff;
		      background-color: #555 !important;
		  }
		  .dropdown-menu li a {
		      color: #000 !important;
		  }
		  .dropdown-menu li a:hover {
		      background-color: red !important;
		  }
		  
		#bg {
			position:fixed; 
			top:-50%; 
			left:-50%; 
			width:200%; 
			height:200%;
		}
		#bg img {
			position:absolute; 
			top:0; 
			left:0; 
			right:0; 
			bottom:0; 
			margin:auto; 
			min-width:50%;
			min-height:50%;
		}
		
		  
		  #page-wrap { position: relative; z-index: 2; width: 1000px; margin: 50px auto; padding: 20px; background: rgba(188, 200, 216, 0.7); -moz-box-shadow: 0 0 20px black; -webkit-box-shadow: 0 0 20px black; box-shadow: 0 0 20px black; }
		  .close {position:absolute;top:20px;right:20px;background:url(../img/close.gif) 0 0 no-repeat;width:15px;height:15px}
		.close span {position:absolute;width:100%;height:100%;top:0;left:0;background:url(../img/close_active.gif) 0 0 no-repeat}
		  
		</style>
		<script type="text/javascript">

		var demo_2 = <?php echo count($totalResult); ?>;
		console.log("Len of result:" + demo_2);
		var newResult = <?php echo json_encode($totalResult); ?>;
		var avgArray = new Array();
		var ratingArray = new Array();
		var reviewArray = new Array();
		var nameArray = new Array();						
		for(var i=0; i<10; i++) {
			nameArray.push(newResult[i]['product_name']);
			avgArray.push(parseInt(newResult[i]['rating_avg']));
			console.log("Data:"+newResult[i]['rating_avg']+" "+newResult[i]['rating_count']+" "+newResult[i]['review_count']);
			ratingArray.push(parseInt(newResult[i]['rating_count']));
			reviewArray.push(parseInt(newResult[i]['review_count']));									
		}

		var websiteResult = <?php echo json_encode($websiteResults); ?>;
		
		var productNames = new Array();
		var avgRating = new Array();
		var totalRating = new Array();		
		var totalReview = new Array();				
		for(var i=0; i<websiteResult.length; i++) {
			var tempNames = new Array();
			var tempAvg = new Array();			
			var tempRating = new Array();
			var tempReview = new Array();									
			for(var j=0; j<websiteResult[i].length; j++){
				tempNames.push(websiteResult[i][j]['product_name']);
				tempAvg.push(parseInt(websiteResult[i][j]['rating_avg']));			
				tempRating.push(parseInt(websiteResult[i][j]['rating_count']));			
				tempReview.push(parseInt(websiteResult[i][j]['review_count']));			
			}
			productNames.push(tempNames);
			avgRating.push(tempAvg);	
			totalRating.push(tempRating);
			totalReview.push(tempReview);
		}
		
		
		
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Product Statistics'
        },
        subtitle: {
            text: ' '
        },
        xAxis: {
            categories: nameArray,
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: '',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' '
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            /*y: 80,*/
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Avg Rating',
            data: avgArray
        }, {
            name: 'Total Ratings',
            data: ratingArray
        }, {
            name: 'Total Reviews',
            data: reviewArray
        }]
    });
    
        $('#midasChart').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Midas Product Statistics'
        },
        subtitle: {
            text: ' '
        },
        xAxis: {
            categories: productNames[0],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: '',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' '
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            /*y: 80,*/
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Avg Rating',
            data: avgRating[0]
        },{
            name: 'Total Ratings',
            data: totalRating[0]
        },{
            name: 'Total Reviews',
            data: totalReview[0]
        }]
    });
    
    $('#ttmChart').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'TTM Product Statistics'
        },
        subtitle: {
            text: ' '
        },
        xAxis: {
            categories: productNames[1],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: '',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' '
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            /*y: 80,*/
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Avg Rating',
            data: avgRating[1]
        },{
            name: 'Total Ratings',
            data: totalRating[1]
        },{
            name: 'Total Reviews',
            data: totalReview[1]
        }]
    });
    
    $('#giftChart').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Littles Product Statistics'
        },
        subtitle: {
            text: ' '
        },
        xAxis: {
            categories: productNames[2],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: '',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' '
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            /*y: 80,*/
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Avg Rating',
            data: avgRating[2]
        },{
            name: 'Total Ratings',
            data: totalRating[2]
        },{
            name: 'Total Reviews',
            data: totalReview[2]
        }]
    });
    
    $('#gameChart').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Game On Product Statistics'
        },
        subtitle: {
            text: ' '
        },
        xAxis: {
            categories: productNames[3],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: '',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' '
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            /*y: 80,*/
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Avg Rating',
            data: avgRating[3]
        },{
            name: 'Total Ratings',
            data: totalRating[3]
        },{
            name: 'Total Reviews',
            data: totalReview[3]
        }]
    });
    
    $('#dhabaChart').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'DhabaOnWheels Product Statistics'
        },
        subtitle: {
            text: ' '
        },
        xAxis: {
            categories: productNames[4],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: '',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' '
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            /*y: 80,*/
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Avg Rating',
            data: avgRating[4]
        },{
            name: 'Total Ratings',
            data: totalRating[4]
        },{
            name: 'Total Reviews',
            data: totalReview[4]
        }]
    });
    
    $('#maruChart').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Maru Maru Product Statistics'
        },
        subtitle: {
            text: ' '
        },
        xAxis: {
            categories: productNames[5],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: '',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' '
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            /*y: 80,*/
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || 'rgba(100,100,100,0.1'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Avg Rating',
            data: avgRating[5]
        },{
            name: 'Total Rating',
            data: totalRating[5]
        },{
            name: 'Total Review',
            data: totalReview[5]
        }]
    });
});
		</script>
	</head>
	<body>
<script src="../js/highcharts.js"></script>
<script src="../js/exporting.js"></script>
	<div id="page-wrap" style="height=100%">
	<h3>
	<a href="http://vishwasmukund.com/marketplace" class="close white" data-type="close"><span></span></a>
	</h3>
	
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Most Rated Product on emporium
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
      	<div id="container" style="width:800px; height: 400px; margin: 0 auto"></div>        
      </div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Most Rated Product on Midas Dream Cars
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">

        <div id="midasChart" style="width:800px; height: 400px; margin: 0 auto"></div>
      </div>
    </div>
  </div>
  
   <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="ttmHeader">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#ttmCollapse" aria-expanded="true" aria-controls="ttmCollapse">
          Most Rated Product on TTM
        </a>
      </h4>
    </div>
    <div id="ttmCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="ttmHeader">
      <div class="panel-body">

      	<div id="ttmChart" style="width:800px; height: 400px; margin: 0 auto"></div>        
      </div>
    </div>
  </div>
  
   <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="giftHeader">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#giftCollapse" aria-expanded="true" aria-controls="giftCollapse">
          Most Rated Product on Gift Shop
        </a>
      </h4>
    </div>
    <div id="giftCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="giftHeader">
      <div class="panel-body">

      	<div id="giftChart" style="width:800px; height: 400px; margin: 0 auto"></div>        
      </div>
    </div>
  </div>
  
   <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="gameHeader">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#gameCollapse" aria-expanded="true" aria-controls="gameCollapse">
          Most Rated Product on Game On
        </a>
      </h4>
    </div>
    <div id="gameCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="gameHeader">
      <div class="panel-body">

      	<div id="gameChart" style="width:800px;  height: 400px; margin: 0 auto"></div>        
      </div>
    </div>
  </div>
  
   <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="dhabaHeader">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#dhabaCollapse" aria-expanded="true" aria-controls="dhabaCollapse">
          Most Rated Product on Dhaba On Wheels
        </a>
      </h4>
    </div>
    <div id="dhabaCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="dhabaHeader">
      <div class="panel-body">

      	<div id="dhabaChart" style="width:800px; height: 400px; margin: 0 auto"></div>        
      </div>
    </div>
  </div>
  
   <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="maruHeader">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#maruCollapse" aria-expanded="true" aria-controls="maruCollapse">
          Most Rated Product on Maru Maru
        </a>
      </h4>
    </div>
    <div id="maruCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="maruHeader">
      <div class="panel-body">

      	<div id="maruChart" style="width:800px; height: 400px; margin: 0 auto"></div>        
      </div>
    </div>
  </div>
</div>
	</div>
	<div id="bg">
		<img src="../img/bg/header-bg.jpg" alt="error">
	</div>
	</body>
</html>