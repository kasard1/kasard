
<?php
	define('myeshop', true);
   include("include/db_connect.php");
   include("functions/functions.php");
   
$sorting = $_GET["sort"];   
 
switch ($sorting)
{
    case 'price-asc';
    $sorting = 'price ASC';
    $sort_name = '���� �� �����������';
    break;

    case 'price-desc';
    $sorting = 'price DESC';
    $sort_name = '���� �� ��������';
    break;
    
    case 'popular';
    $sorting = 'count DESC';
    $sort_name = '����������';
    break;
    
    case 'news';
    $sorting = 'datetime DESC';
    $sort_name = '�������';
    break;
    
    case 'brand';
    $sorting = 'brand';
    $sort_name = '�������';
    break;
    
    default:
    $sorting = 'products_id DESC';
    $sort_name = '��� ����������';
    break;                           
} 
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="content-type" content="text/html;charset=windows-1251" />
	<style>
    ul {list-style:none;}
    </style>
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    
    <link href="trackbar/trackbar.css" rel="stylesheet" type="text/css" />
    
    
	<script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/js/jcarousellite_1.0.1.js"></script>
    <script type="text/javascript" src="/js/shop-script.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="/trackbar/jquery.trackbar.js"></script>
    <script type="text/javascript" src="/js/TextChange.js"></script>

    <title>��������-������� ������������ �������</title>
</head>
<body>
<div id="block-body">
<?php
	include ("include/block-header.php");
?>
<div id="block-right">
<?php
	include ("include/block-category.php");
    include ("include/block-parameter.php");
    include ("include/block-news.php");
?>
</div>
<div id="block-content">
<div id="block-sorting">
<p id="nav-breadcrumbs"><a href="index.php">������� ��������</a> \ <span>��� ������</span>\</p>
<ul id="option-list">
<li>���: </li>
<li><img id="style-grid" src="/images/icon-grid.png" /></li>
<li><img id="style-list" src="/images/icon-list.png" /></li>
<li>�����������:</li>
<li><a id="select-sort"><?php echo $sort_name; ?></a> 
<ul id="sorting-list">
    <li><a href="index.php?sort=price-asc" >���� �� �����������</a></li>
    <li><a href="index.php?sort=price-desc" >���� �� ��������</a></li>
    <li><a href="index.php?sort=popular" >����������</a></li>
    <li><a href="index.php?sort=news" >�������</a></li>
    <li><a href="index.php?sort=brand" >�� � �� �</a></li>
</ul>
</li>
</ul>
</div>
<ul id="block-tovar-grid">
<?php 
	$num = 6; // ����� ��������� ������� ����� �������� �������.
    $page = (int)$_GET['page'];              
    
	$count = mysql_query("SELECT COUNT(*) FROM table_products WHERE visible = '1'",$link);
    $temp = mysql_fetch_array($count);

	If ($temp[0] > 0)
	{  
	$tempcount = $temp[0];

	// ������� ����� ����� �������
	$total = (($tempcount - 1) / $num) + 1;
	$total =  intval($total);

	$page = intval($page);

	if(empty($page) or $page < 0) $page = 1;  
       
	if($page > $total) $page = $total;
	 
	// ��������� ������� � ������ ������
    // ������� �������� ������ 
	$start = $page * $num - $num;

	$qury_start_num = " LIMIT $start, $num"; 
	}
             
$result = mysql_query("SELECT * FROM table_products WHERE visible='1' ",$link);
if (mysql_num_rows($result) > 0)
{
  $row = mysql_fetch_array($result); 
  do 
  {
   if  ($row["image"] != "" && file_exists("./uploads_images/".$row["image"]))
{
$img_path = './uploads_images/'.$row["image"];
$max_width = 200; 
$max_height = 200; 
 list($width, $height) = getimagesize($img_path); 
$ratioh = $max_height/$height; 
$ratiow = $max_width/$width; 
$ratio = min($ratioh, $ratiow); 
$width = intval($ratio*$width); 
$height = intval($ratio*$height);    
}else
{
$img_path = "/images/no-image.png";
$width = 110;
$height = 200;
} 
//$query_reviews = mysql_query("SELECT * FROM table_reviews WHERE products_id = '{$row["products_id"]}' AND moderat='1'",$link);  
//$count_reviews = mysql_num_rows($query_reviews);

    echo '
    <li>
    <div class="block-images-grid" >
    <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
    </div>
    <p class="style-title-grid" ><a href="">'.$row["title"].'</a></p>
    <ul class="reviews-and-counts-grid">
    <li><img src="/images/eye-icon.png" /><p>0</p></li>
     <li><img src="/images/comment-icon.png" /><p>0</p></li>

     </ul>
     <a class="add-cart-style-grid" ></a>
     <p class="style-price-grid" ><strong>'.$row["price"].'</strong> ���.</p>
     <div class="mini-features">
     '.$row["mini_features"].'
     </div>
    </li>
    ';}
    while ($row = mysql_fetch_array($result));
   
}

?>
</ul>

<ul id="block-tovar-list">
<?php 
$result = mysql_query("SELECT * FROM table_products WHERE visible='1' ",$link);
if (mysql_num_rows($result) > 0)
{
  $row = mysql_fetch_array($result); 
  do 
  {
   if  ($row["image"] != "" && file_exists("./uploads_images/".$row["image"]))
{
$img_path = './uploads_images/'.$row["image"];
$max_width = 150; 
$max_height = 150; 
 list($width, $height) = getimagesize($img_path); 
$ratioh = $max_height/$height; 
$ratiow = $max_width/$width; 
$ratio = min($ratioh, $ratiow); 
$width = intval($ratio*$width); 
$height = intval($ratio*$height);    
}else
{
$img_path = "/images/no-image.png";
$width = 80;
$height = 70;
} 
    echo '
    <li>
    <div class="block-images-list" >
    <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/>
    </div>
    
    <ul class="reviews-and-counts-list">
                
    <li><img src="/images/eye-icon.png" /><p>0</p></li>
     <li><img src="/images/comment-icon.png" /><p>0</p></li>
     </ul>
     
     <p class="style-title-list" ><a href="">'.$row["title"].'</a></p>
     <a class="add-cart-style-list" ></a>
     <p class="style-price-list" ><strong>'.$row["price"].'</strong> ���.</p>
     <div class="style-text-list">
     '.$row["mini_description"].'
     </div>
    </li>
    ';}
    while ($row = mysql_fetch_array($result));
   
}

?>
</ul>
</div>
<?php
	include ("include/block-footer.php");
?>
</div>

</body>
</html>