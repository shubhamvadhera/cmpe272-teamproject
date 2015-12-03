<?php
	// start a session
	session_start();
	// check if user is logged in. if not, send to login.
	if (!(isset($_SESSION["login"]) && $_SESSION["login"] != "")) {
		header("Location: ../login-sign-in/sign-in.html");
		exit;
	}
	
	//DB Credentials
$username = "vishwasm_admin";
$host = "localhost";
$database = "vishwasm_marketplace";
$password = "admin123";

//Connect to Database
$conn = connectDB($host, $database, $username, $password);
$queryS = "SELECT v.vendor_id, count(1) as vendor_count FROM
(SELECT u.product_id, p.vendor_id
FROM userlog u
LEFT JOIN products p on p.product_id = u.product_id ) v
group by v.vendor_id order by vendor_id";

$result = runSelectQuery($queryS, $conn);
$numRows = mysql_num_rows($result);
if ($numRows <= 0) {
    die("Select query returned no rows");
}

/*for ($i = 0; $i < $numRows; $i++) {
                print("<br/>");
                for ($j = 0; $j < 2; $j++) {
                    print(" " . mysql_result($result, $i, $j));
                }
                print("<br/>");
            }*/
            
//echo mysql_result($result, 0, 1);

function connectDB($host, $database, $username, $password) {
    if (!($conn = @mysql_connect($host, $username, $password))) {
        die("Could not connect to database" . mysql_error());
    }
    if (!mysql_select_db($database, $conn)) {
        die("Could not open database" . mysql_error());
    }

    return $conn;
}


function runSelectQuery($query, $conn) {
    if (!$result = mysql_query($query, $conn)) {
        die("Could not execute select query" . mysql_error());
    }
    return $result;
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
		
		
		
		
		
		
		
		var midas= <?php echo mysql_result($result, 5, 1); ?>;
		var ttm= <?php echo mysql_result($result, 0, 1); ?>;
		var little= <?php echo mysql_result($result, 3, 1); ?>;
		var dextrous= <?php echo mysql_result($result, 1, 1); ?>;
		var dhaba= <?php echo mysql_result($result, 2, 1); ?>;
		var maru= <?php echo mysql_result($result, 4, 1); ?>;
		
		
		
		
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Vendor Statistics'
        },
        subtitle: {
            text: 'Our most popular vendors by product visits'
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
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Times Viewed',
            data: [midas,ttm,little,dextrous,dhaba,maru]
        }]
    });
});
		</script>
	</head>
	<body background:../img/blureffect01.jpg>
		<div id="navigation">
  	<div class="wrapper">
   	  <ul>
      	<a href="http://vishwasmukund.com/marketplace/" style="color: #6666cc;">Home</a>
   	</ul>
  	</div>
	</div>
<script src="../js/highcharts.js"></script>
<script src="../js/exporting.js"></script>

<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

	</body>
</html>