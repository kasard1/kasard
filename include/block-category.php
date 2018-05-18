<?php
	define('myeshop', true);
	//defined('myeshop') or die('Доступ запрещён!');
?>
<div id="block-category">
<p class="header-title" >Категории товаров</p>

<ul>

<li><a>Письменные принадлежности</a>
<ul class="category-section">
<li><a href="view_cat.php?type=pismo"><strong>Все бренды </strong> </a></li>

<?php

  $result = mysql_query("SELECT * FROM category WHERE type='pismo'",$link);
  
 If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{
	echo '
    
  <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
    
    ';
}
 while ($row = mysql_fetch_array($result));
} 
	
?>

</ul>
</li>

<li><a>Корректирующие средства</a>
<ul class="category-section">
<li><a href="view_cat.php?type=correct"><strong>Все бренды</strong> </a></li>

<?php

  $result = mysql_query("SELECT * FROM category WHERE type='correct'",$link);
  
 If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{
	echo '
    
  <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
    
    ';
}
 while ($row = mysql_fetch_array($result));
} 
	
?>

</ul>
</li>

<li><a>Канцелярские мелочи</a>
<ul class="category-section">
<li><a href="view_cat.php?type=cancmel"><strong>Все бренды</strong> </a></li>
<?php

  $result = mysql_query("SELECT * FROM category WHERE type='cancmel'",$link);
  
 If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{
	echo '
    
  <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
    
    ';
}
 while ($row = mysql_fetch_array($result));
} 
	
?>
</ul>
</li>

</ul>

</div>