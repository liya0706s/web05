<?php
$ques = $Que->all();
foreach ($ques as $que) {
?>
    <fieldset>
        <legend>目前位置 : 首頁 > 問卷調查 > <span id="title"></span></legend>
        <h4><?=$que['text'];?></h4>
        <input type="radio" name="" value="<?=$que['id'];?>">

    <?php
        }
    ?>
    </fieldset>