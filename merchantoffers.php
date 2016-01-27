
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/jquery.mobile-1.4.5.min.js"></script>

<?php
//include("checklogin.php");
require_once("http://premiumincentives.biz/mobi/visaloyalty/Connections/dms.php");

//$id = $_GET['id'];
//$mercatid = $id;
$var1 = 1;
$var = 0;
$result = "";


  
if (isset($_GET['id'])) {
	$mercatid = $_GET['id'];
//$mercatid = $_GET['mercatid'];
}
if (isset($_GET['hmercatid'])) {
	$mercatid = $_GET['hmercatid'];
//$mercatid = $_GET['mercatid'];
}
if (isset($_GET['stateid'])) {
	$stateid = $_GET['stateid'];
//$mercatid = $_GET['mercatid'];
}

//$showform = $_GET['noform'];
if (!isset($stateid)) {
$dropdown1 = "<select id=\"stateid\" class=\"dropbtn\">";
$dropdown1 .="<option value=\"\">Select City</option>";
$dropdown1 .="<option value=\"25\">Lagos</option>";
$dropdown1 .="<option value=\"2\">Abuja</option>";   
$dropdown1 .="<option value=\"3\">Portharcourt</option>";
$dropdown1 .="</select>";   
}
else {

if ($stateid == 25) {
$dropdown1 = "<select id=\"stateid\" class=\"dropbtn\">";
$dropdown1 .="<option value=\"\">Select City</option>";
$dropdown1 .="<option value=\"25\" selected>Lagos</option>";
$dropdown1 .="<option value=\"2\">Abuja</option>";   
$dropdown1 .="<option value=\"3\">Portharcourt</option>";
$dropdown1 .="</select>";	
}

elseif ($stateid == 2) {
$dropdown1 = "<select id=\"stateid\" class=\"dropbtn\">";
$dropdown1 .="<option value=\"\">Select City</option>";
$dropdown1 .="<option value=\"25\">Lagos</option>";
$dropdown1 .="<option value=\"2\" selected>Abuja</option>";   
$dropdown1 .="<option value=\"3\">Portharcourt</option>";
$dropdown1 .="</select>";	
}

elseif ($stateid == 3){
$dropdown1 = "<select id=\"stateid\" class=\"dropbtn\">";
$dropdown1 .="<option value=\"\">Select City</option>";
$dropdown1 .="<option value=\"25\">Lagos</option>";
$dropdown1 .="<option value=\"2\">Abuja</option>";   
$dropdown1 .="<option value=\"3\" selected>Portharcourt</option>";
$dropdown1 .="</select>";	
}
}

$sql = "SELECT storeid, store_name, ims_store.state, states.state AS mstate, current_address, mercatname, store_story, imgname FROM ims_store";
$sql .= " LEFT JOIN ims_mer_cat ON ims_store.mercatid = ims_mer_cat.mercatid";
$sql .= " JOIN states ON ims_store.state = states.stateid";
$sql.= " WHERE ims_store.status = '$var1'";
if (isset($mercatid)) {
	if ($mercatid != "") {
		if ( $mercatid != $var){
	$sql.=" AND ims_store.mercatid = $mercatid";
		}
	}
	}
if (isset($stateid)) {
	if ($stateid != "") {
		if ( $stateid != $var){
	$sql.=" AND ims_store.state = $stateid";
		}
	}
	}

	$query = mysqli_query($dms,$sql);
	$count = mysqli_num_rows($query);

//if (!isset($_GET['showform'])) {
//if ($noform != "noform"){
$result .="<div class=\"dropdown\"> $dropdown1</div>";

	//$result .="";

//}
$result .="<input name=\"hmercatid\" id=\"hmercatid\" type=\"hidden\" value='$mercatid'>";



if ($count > 0){
$result .="<div id=\"display_list\">" ; //container for records to be displayed	
	while($row = mysqli_fetch_assoc($query)){
		$merid = $row['storeid'];
		$mercatname = $row['mercatname'];
		$img = $row['imgname'];
		$state = $row['mstate'];
		$desc = $row['store_story'];
			
	
		
	$result .="<div class=\"mer-offer\">";
	
	


	$result.="<img src=\"http://premiumincentives.biz/visang/images/photo/".$row['imgname']."\" class=\"mer-image\"/>";

	$result.= "<div class=\"mer-info\">";
$result.="<p class =\"mer-store\">".$row['store_name']."</p>";
$result .="<p class=\"mer-address\"><i class=\"fa fa-map-marker\"> ".$row['current_address']."</i></p>";

	$result .="<b class=\"cat icon ion-location iconcolor\"> $state</b>";
  
$result.= " <div data-role=\"main\" class=\"ui-content\">";
 $result.= "<div data-role=\"collapsible\" data-iconpos=\"right\" data-theme=\"a\" data-content-theme=\"a\">";
     $result.= " <h1>Offers</h1>";
	$result .="<p>";
				$result .="<ul>";
		$sql2= "SELECT merid, offering, offering_type FROM ims_offering_cat";
		$sql2.=" WHERE merid = $merid AND status = '$var1'";
		$query2 = mysqli_query($dms,$sql2);
		$count2 = mysqli_num_rows($query2);
		if ($count2 >0){
			while ($row2 = mysqli_fetch_assoc($query2)){
				$offtype = $row2['offering_type'];
				
			
				if ($offtype == 1) {
					
					$result .="<li class=\"fa fa-tag\" style=\"float:left;\">  <i style=\"color:#999; padding-left:5px;\">{$row2['offering']}</i></li><br/><br/>";
					
				}else {
					
					$result .="<li class=\"fa fa-gift\" style=\"float:left;\">  <i style=\"color:#999; padding-left:5px;\">{$row2['offering']}</i></li><br/><br/>";

				}
				
			}$result .="</ul></p>"; 		
		}
					$result.="</div></div>";
		



   $result .="</div>"; 
     $result .="</div>";
	 
	 
}
$result .="</div>";// close display_list 
echo $result;
}
else {
	$result .="<div id=\"display_list\">" ; //container for records to be displayed
	$result .="<div class=\"mer-offer\">";
	$result .="<img class=\"mer-image\" src=\"images/discount.jpg\" />";
							 $result.="<div class=\"message-text\" align=\"center\">No Registered Merchant</div>";
							 $result.="</div>";
	$result .="</div>";// close display_list 
echo $result;
}

//echo $sql;
//echo "<br>";
//echo $stateid;
//echo $_GET['noform'];
?>
