<?php
	include '../session/session.php';

	//DB Credentials in $database
	include '../phpscripts/databaseConnection.php';
	
	//Getting data ($result, $midasResult, $ttmResult, $giftResult, $gameResult, $dhabaResult, $maruResult)
	include '../phpscripts/dataForMostViewedProducts.php';
	$websiteResults = array($midasResult, $ttmResult, $giftResult, $gameResult, $dhabaResult, $maruResult);
	$indexI=0;
	$indexJ=0;	
		
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>emporium-Visit Statistics</title>
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
	
		
		var midas= <?php echo mysql_result($result, 5, 1); ?>;
		var ttm= <?php echo mysql_result($result, 0, 1); ?>;
		var little= <?php echo mysql_result($result, 3, 1); ?>;
		var dextrous= <?php echo mysql_result($result, 1, 1); ?>;
		var dhaba= <?php echo mysql_result($result, 2, 1); ?>;
		var maru= <?php echo mysql_result($result, 4, 1); ?>;
		
//		var websiteResult = new Array(6);

		var websiteResult = <?php echo json_encode($websiteResults); ?>;
		
		var productNames = new Array();
		var visitCount = new Array();
		for(var i=0; i<websiteResult.length; i++) {
			var tempNames = new Array();
			var tempCounts = new Array();			
			for(var j=0; j<websiteResult[i].length; j++){
				tempNames.push(websiteResult[i][j]['product_name']);
				tempCounts.push(parseInt(websiteResult[i][j]['visit_count']));
				console.log(websiteResult[i][j]['product_name']);
				console.log(websiteResult[i][j]['visit_count']);			
			}
			productNames.push(tempNames);
			visitCount.push(tempCounts);	
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
            categories: ['Midas Dream Cars', 'TTM Discover', 'Littles Gift Shop', 'Dextrous - Game on!', 'Dhaba-on-Wheels','Maru-Maru'],
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
            name: 'Most Viewed',
            data: [midas,ttm,little,dextrous,dhaba,maru]
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
            name: 'Most Viewed',
            data: visitCount[0]
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
            name: 'Most Viewed',
            data: visitCount[1]
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
            name: 'Most Viewed',
            data: visitCount[2]
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
            name: 'Most Viewed',
            data: visitCount[3]
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
            name: 'Most Viewed',
            data: visitCount[4]
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
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Most Viewed',
            data: visitCount[5]
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
          Most Viewed Vendor
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
          Most Viewed Products on Midas Dream Cars
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
          Most Viewed Products on TTM
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
          Most Viewed Products on Gift Shop
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
          Most Viewed Products on Game On
        </a>
      </h4>
    </div>
    <div id="gameCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="gameHeader">
      <div class="panel-body">
      	<div id="gameChart" style="width:800px; height: 400px; margin: 0 auto"></div>        
      </div>
    </div>
  </div>
  
   <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="dhabaHeader">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#dhabaCollapse" aria-expanded="true" aria-controls="dhabaCollapse">
          Most Viewed Products on Dhaba On Wheels
        </a>
      </h4>
    </div>
    <div id="dhabaCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="dhabaHeader">
      <div class="panel-body">
      	<div id="dhabaChart" style="width:800px;  height: 400px; margin: 0 auto"></div>        
      </div>
    </div>
  </div>
  
   <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="maruHeader">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#maruCollapse" aria-expanded="true" aria-controls="maruCollapse">
          Most Viewed Products on Maru Maru
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