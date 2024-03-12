<?php
include_once "db.php";

$rows=$News->all(['type'=>$_GET['id'], 'sh'=>1]);

foreach($rows as $row){
?>
<div>
<a href="Javascript:getNews(<?=$row['id'];?>)">
<?=$row['title'];?>
</a>
</div>
<?php
}
?>