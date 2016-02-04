<?php
require_once("http://premiumincentives.biz/mobi/visaloyalty1/Connections/dms.php");

?>
<?php
$sql = "SELECT image_name, description, store_id FROM ims_promo WHERE status = 1 AND end_date >=  CURRENT_DATE() ORDER BY RAND() LIMIT 1";
$query = mysqli_query($dms,$sql);
$count = mysqli_num_rows($query);

if ($count <1) {
$result = "";
$result .= "<div class=\"swiper-wrapper\">";
$result .= "<div class=\"swiper-slide\">";
$result.="<img class=\"slider-img\" src=\"http://premiumincentives.biz/visang/images/photo/default.png\"/><br/>";
$result.="<a href=\"merchant.html\" class=\"swiper_read_more\">Click to visit merchant partners</a>";
$result.="</div>";

} else {
$result="";
//$result .="<div class=\"swiper-container swiper-init\" data-effect=\"slide\" data-direction=\"vertical\" data-pagination=\".swiper-pagination\">";

while ($row = mysqli_fetch_assoc($query)) {
$result .= "<div class=\"swiper-slide\">";
$result.="<img class=\"slider-img\" src=\"http://premiumincentives.biz/visang/images/photo/".$row['image_name']."\"/><br/>";

$result.="</div>";

}
//$result.="<div class=\"swiper-pagination\"></div>";
 //$result.="</div>";


}

echo $result;

?>
