<?php 
	//For marketplace
	$marketplaceQuery = "SELECT p.product_name as product_name, ifnull(AVG( r.rating ),0) as rating_avg, COUNT( r.rating ) as rating_count, 			
	count(r.review) as review_count
	FROM products p
	left JOIN rating r ON r.product_id = p.product_id 
	GROUP BY r.product_id
	ORDER BY AVG( r.rating )  DESC , COUNT( r.rating ) desc
	limit 10";

	$result = runSelectQuery($marketplaceQuery, $database);
	$totalResult = returnArray($result);
	
	//For Midas
	$midasQuery = "SELECT p.product_name as product_name, ifnull(AVG( r.rating ),0) as rating_avg, COUNT( r.rating ) as rating_count, 			
	count(r.review) as review_count
	FROM products p
	left JOIN rating r ON r.product_id = p.product_id 
	where p.vendor_id = 'midas'
	GROUP BY r.product_id
	ORDER BY AVG( r.rating )  DESC , COUNT( r.rating ) desc
	limit 5";

	$midasResult1 = runSelectQuery($midasQuery, $database);
	$midasResult = returnArray($midasResult1);


	//For TTM
	$ttmQuery = "SELECT p.product_name as product_name, ifnull(AVG( r.rating ),0) as rating_avg, COUNT( r.rating ) as rating_count, 			
	count(r.review) as review_count
	FROM products p
	left JOIN rating r ON r.product_id = p.product_id 
	where p.vendor_id = 'connect'
	GROUP BY r.product_id
	ORDER BY AVG( r.rating )  DESC , COUNT( r.rating ) desc
	limit 5";

	$ttmResult1 = runSelectQuery($ttmQuery, $database);
	$ttmResult = returnArray($ttmResult1);	
	
	//For Giftshop
	$giftQuery = "SELECT p.product_name as product_name, ifnull(AVG( r.rating ),0) as rating_avg, COUNT( r.rating ) as rating_count, 			
	count(r.review) as review_count
	FROM products p
	left JOIN rating r ON r.product_id = p.product_id 
	where p.vendor_id = 'little'
	GROUP BY r.product_id
	ORDER BY AVG( r.rating )  DESC , COUNT( r.rating ) desc
	limit 5";

	$giftResult1 = runSelectQuery($giftQuery, $database);
	$giftResult = returnArray($giftResult1);		
	
	//For GameOn
	$gameQuery = "SELECT p.product_name as product_name, ifnull(AVG( r.rating ),0) as rating_avg, COUNT( r.rating ) as rating_count, 			
	count(r.review) as review_count
	FROM products p
	left JOIN rating r ON r.product_id = p.product_id 
	where p.vendor_id = 'dextrous'
	GROUP BY r.product_id
	ORDER BY AVG( r.rating )  DESC , COUNT( r.rating ) desc
	limit 5";

	$gameResult1 = runSelectQuery($gameQuery, $database);
	$gameResult = returnArray($gameResult1);			
	
	
	//For Dhaba
	$dhabaQuery = "SELECT p.product_name as product_name, ifnull(AVG( r.rating ),0) as rating_avg, COUNT( r.rating ) as rating_count, 			
	count(r.review) as review_count
	FROM products p
	left JOIN rating r ON r.product_id = p.product_id 
	where p.vendor_id = 'dhabaonwhe'
	GROUP BY r.product_id
	ORDER BY AVG( r.rating )  DESC , COUNT( r.rating ) desc
	limit 5";

	$dhabaResult1 = runSelectQuery($dhabaQuery, $database);
	$dhabaResult = returnArray($dhabaResult1);				
	
	//For Maru Maru
	$maruQuery = "SELECT p.product_name as product_name, ifnull(AVG( r.rating ),0) as rating_avg, COUNT( r.rating ) as rating_count, 			
	count(r.review) as review_count
	FROM products p
	left JOIN rating r ON r.product_id = p.product_id 
	where p.vendor_id = 'maru'
	GROUP BY r.product_id
	ORDER BY AVG( r.rating )  DESC , COUNT( r.rating ) desc
	limit 5";

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