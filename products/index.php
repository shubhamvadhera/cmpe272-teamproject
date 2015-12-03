<?php
	// start a session
	session_start();
	// check if user is logged in. if not, send to login.
	if (!(isset($_SESSION["login"]) && $_SESSION["login"] != "")) {
		header("Location: ../login-sign-in/sign-in.html");
		exit;
	}
	
$username = "vishwasm_admin";
$host = "localhost";
$database = "vishwasm_marketplace";
$password = "admin123";

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

//Connect to Database
$conn = connectDB($host, $database, $username, $password);
$queryDextrous = "SELECT p.product_name, count(1) as visit_count FROM userlog u
LEFT JOIN products p ON u.product_id = p.product_id
LEFT JOIN vendor v on p.vendor_id = v.vendor_id
WHERE v.vendor_id = "dextrous"
GROUP BY p.product_name
ORDER BY visit_count DESC LIMIT 5";
$queryMidas = "SELECT p.product_name, count(1) as visit_count FROM userlog u
LEFT JOIN products p ON u.product_id = p.product_id
LEFT JOIN vendor v on p.vendor_id = v.vendor_id
WHERE v.vendor_id = "midas"
GROUP BY p.product_name
ORDER BY visit_count DESC LIMIT 5";
$queryTtm = "SELECT p.product_name, count(1) as visit_count FROM userlog u
LEFT JOIN products p ON u.product_id = p.product_id
LEFT JOIN vendor v on p.vendor_id = v.vendor_id
WHERE v.vendor_id = "connect"
GROUP BY p.product_name
ORDER BY visit_count DESC LIMIT 5";
$queryLittle = "SELECT p.product_name, count(1) as visit_count FROM userlog u
LEFT JOIN products p ON u.product_id = p.product_id
LEFT JOIN vendor v on p.vendor_id = v.vendor_id
WHERE v.vendor_id = "little"
GROUP BY p.product_name
ORDER BY visit_count DESC LIMIT 5";
$queryDhaba = "SELECT p.product_name, count(1) as visit_count FROM userlog u
LEFT JOIN products p ON u.product_id = p.product_id
LEFT JOIN vendor v on p.vendor_id = v.vendor_id
WHERE v.vendor_id = "dhabaonwhe"
GROUP BY p.product_name
ORDER BY visit_count DESC LIMIT 5";
$queryMaru = "SELECT p.product_name, count(1) as visit_count FROM userlog u
LEFT JOIN products p ON u.product_id = p.product_id
LEFT JOIN vendor v on p.vendor_id = v.vendor_id
WHERE v.vendor_id = "maru"
GROUP BY p.product_name
ORDER BY visit_count DESC LIMIT 5";
$queryAll = "SELECT p.product_name, count(1) as visit_count FROM userlog u
LEFT JOIN products p ON u.product_id = p.product_id
LEFT JOIN vendor v on p.vendor_id = v.vendor_id
GROUP BY p.product_name
ORDER BY visit_count DESC LIMIT 5";

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
		
		var obj =[20,30,40,50];
		var xyz = "<?php echo $bool ?>";
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
            categories: ['product1', 'product2', 'product3', 'product4', 'product5','product6','product7','product8','product9','product10'],
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
            name: 'Most Viewed',
            data: [obj[1],obj[2], obj[3], obj[4], 7,20,34,06,111,2]
        }, {
            name: 'Most Reviewed',
            data: [133, 156, 47, 408, 6]
        }, {
            name: 'Most Rated',
            data: [10, 9, 5, 40, 38]
        }]
    });
});
		</script>
	</head>
	<body>
<script src="../js/highcharts.js"></script>
<script src="../js/exporting.js"></script>

<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

	</body>
</html>