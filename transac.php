<?php
session_start();
$itid = $_GET['itid'];
$itype = $_GET['itype'];
include ('dbconnection.php');
$iname_query = "";
$delquery = "";

switch ($itype) {
	case '1':
		$delquery = "delete from food_items where prod_id=" . $itid . ";";
		$iname_query = "select * from food_items where prod_id='{$itid}';";
		break;
	case '2':
		$delquery = "delete from tech_items where prod_id=" . $itid . ";";
		$iname_query = "select * from tech_items where prod_id='{$itid}';";
		break;
	case '3':
		$delquery = "delete from house_items where prod_id=" . $itid . ";";
		$iname_query = "select * from house_items where prod_id='{$itid}';";
		break;
}
$iname_result = $mysql->query($iname_query);
$item = $iname_result->fetch_assoc();
$iname = $item['name'];
$seller_id = $item['user_id'];
$trans = "insert into transactions(seller_id,buyer_id,prod_id,prod_name) values({$seller_id}, {$_SESSION['buyer_id']}, {$itid}, '{$iname}');";

if ($mysql->query($delquery)) {
	if ($mysql->query($trans)) {
		header('location:home.php');
	} else
		echo "Database Corrupted. Writing Transaction failed";
} else
	header('location:logout.php');
