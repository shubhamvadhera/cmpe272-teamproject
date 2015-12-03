<?php 
	//For marketplace
	$marketplaceQuery = "SELECT v.vendor_id, count(1) as vendor_count FROM
		(SELECT u.product_id, p.vendor_id
		FROM userlog u
		LEFT JOIN products p on p.product_id = u.product_id ) v
		group by v.vendor_id order by vendor_id";

	$result = runSelectQuery($marketplaceQuery, $database);
	$numRows = mysql_num_rows($result);
	if ($numRows <= 0) {
	    die("Select query returned no rows");
	}
	
	//For Midas
	$midasQuery = "SELECT v.product_name, count(1) as visit_count FROM
		(SELECT p.product_name, u.product_id
		FROM userlog u
		LEFT JOIN products p on p.product_id = u.product_id where p.vendor_id='midas') v
		group by v.product_name order by visit_count desc limit 5";

	$midasResult1 = runSelectQuery($midasQuery, $database);
	$midasResult = returnArray($midasResult1);
	//echo $midasResult[1][0];

	//For TTM
	$ttmQuery = "SELECT v.product_name, count(1) as visit_count FROM
		(SELECT p.product_name, u.product_id
		FROM userlog u
		LEFT JOIN products p on p.product_id = u.product_id where p.vendor_id='connect') v
		group by v.product_name order by visit_count desc limit 5";

	$ttmResult1 = runSelectQuery($ttmQuery, $database);
	$ttmResult = returnArray($ttmResult1);	
	
	//For Giftshop
	$giftQuery = "SELECT v.product_name, count(1) as visit_count FROM
		(SELECT p.product_name, u.product_id
		FROM userlog u
		LEFT JOIN products p on p.product_id = u.product_id where p.vendor_id='little') v
		group by v.product_name order by visit_count desc limit 5";

	$giftResult1 = runSelectQuery($giftQuery, $database);
	$giftResult = returnArray($giftResult1);		
	
	//For GameOn
	$gameQuery = "SELECT v.product_name, count(1) as visit_count FROM
		(SELECT p.product_name, u.product_id
		FROM userlog u
		LEFT JOIN products p on p.product_id = u.product_id where p.vendor_id='dextrous') v
		group by v.product_name order by visit_count desc limit 5";

	$gameResult1 = runSelectQuery($gameQuery, $database);
	$gameResult = returnArray($gameResult1);			
	
	
	//For Dhaba
	$dhabaQuery = "SELECT v.product_name, count(1) as visit_count FROM
		(SELECT p.product_name, u.product_id
		FROM userlog u
		LEFT JOIN products p on p.product_id = u.product_id where p.vendor_id='dhabaonwhe') v
		group by v.product_name order by visit_count desc limit 5";

	$dhabaResult1 = runSelectQuery($dhabaQuery, $database);
	$dhabaResult = returnArray($dhabaResult1);				
	
	//For Maru Maru
	$maruQuery = "SELECT v.product_name, count(1) as visit_count FROM
		(SELECT p.product_name, u.product_id
		FROM userlog u
		LEFT JOIN products p on p.product_id = u.product_id where p.vendor_id='maru') v
		group by v.product_name order by visit_count desc limit 5";

	$maruResult1 = runSelectQuery($maruQuery, $database);
	$maruResult = returnArray($maruResult1);				
	
	
	
	function runSelectQuery($query, $database) {
	    if (!$result = mysql_query($query, $database)) {
	        die("Could not execute select query" . mysql_error());
	    }
	    return $result;
	    }
	    
	function returnArray($result) {
		$arrayData = array();
            	while($row=mysql_fetch_assoc($result)) {
            	array_push($arrayData, $row);
            } 
            return $arrayData;  
	}    
?>