<?php
//include("checklogin.php");
require_once("http://premiumincentives.biz/mobi/visaloyalty1/Connections/dms.php");

$sql = "SELECT promo_head, image_name_page, end_date, description, store_id FROM ims_promo WHERE status = 1 AND end_date >=  CURRENT_DATE()";

$query = mysqli_query($dms,$sql);
$count = mysqli_num_rows($query);


if ($count <1) {
	
	
$result = "";	

$result .="<div class=\"promo-offer\">";	
						 $result.="<div class=\"message-text\" align=\"center\">No Promo Available</div>";



} else {
$result=""; 
$result.="<div class=\"promo-offer\">";
while ($row = mysqli_fetch_assoc($query)) {
	$merid = $row['store_id'];
	$title = $row["promo_head"];
	$desc = $row["description"];
	$end = $row["end_date"];
	
	$store_sql = "SELECT store_name, current_address FROM ims_store WHERE storeid = $merid";
	$store_query = mysqli_query($dms,$store_sql);
	$store_row = mysqli_fetch_assoc($store_query);
	$store = $store_row["store_name"];
	$address = $store_row["current_address"];

$result.="<img class=\"promo-image\" src=\"http://premiumincentives.biz/visang/images/photo/".$row['image_name_page']."\"/>";
$result.="<div class=\"promo-mer-info\">";
$result .= "<p class =\"promo-store\">$store</p>";
$result.="<p class=\"promo-info\">$title</p>";
$result .="<p class=\"promo-address\"><i class=\"fa fa-map-marker\"> $address</i></p>";
$result.="<p class=\"description-new\">$desc</p>";
$result.="<p class=\"list-mer-expiry\"><i class=\"fa fa-calendar\"> Expires: $end</i></p>";

$result.="</div>";


}

$result.="</div>";

         
                      
                    
}

echo $result;



?>

<script>
$(document).ready(function(){
	$('.backgroundpg1').css('position:"relative", margin-top:"50px"');
	
});
</script>