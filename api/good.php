<?php
include_once "db.php";

$news=$News->find(['news'=>$_POST['news']]);

// 有找到按讚紀錄代表要收回讚del() good--，反之是要加一insert()按讚 good++
if($Log->count(['news'=>$_POST['news'], 'acc'=>$_SESSION['user']])>0){
    $Log->del(['news'=>$_POST['news'], 'acc'=>$_SESSION['user']]);
    $news['good']--;
}else{
    $Log->save(['news'=>$_POST['news'], 'acc'=>$_SESSION['user']]);
    $news['good']++;
}
$News->save($news);

?>