<?php
$que = $Que->find($_GET['id']);
?>
<fieldset>
    <legend>目前位置 : 首頁 > 問卷調查 > <?= $que['text']; ?></legend>
    <h4><?= $que['text']; ?></h4>

    <?php
    $opts = $Que->all(['subject_id' => $_GET['id']]);
    foreach ($opts as $opt) {
        $total = ($que['vote'] != 0) ? $que['vote'] : 1;
        $rate = round($opt['vote'] / $total, 2);
    ?>
        <div style="display: flex; width:90%;">
            <div style="width:40%;"><?=$opt['text'];?></div>
            <div style="width:<?= 40 * $rate; ?>%; background-color:lightgrey; height:20px;"></div>
            <div><?=$opt['vote'];?>票(<?=$rate*100;?>%)</div>
        </div>

    <?php
    }
    ?>
    <div class="ct">
        <button onclick="location.href='?do=que'">返回</button>
    </div>
</fieldset>