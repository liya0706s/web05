<?php
include_once "db.php";

$news=$News->find(['id'=>$_GET['idid']]);
?>
<span style="font-weight: bolder;">
<?=$news['title'];?>
</span>
<br>
<?=nl2br($news['news']);?>