<fieldset>
    <legend>目前位置 : 首頁 > 最新文章區 </legend>
    <table>
        <tr>
            <th>標題</th>
            <th>內容</th>
        </tr>
        <?php
        $total = $News->count();
        $div = 5;
        $pages = ceil($total / $div);
        $now = $_GET['p'] ?? 1;
        $start = ($now - 1) * $div;

        $rows = $News->all(['sh' => 1], " limit $start, $div");
        foreach($rows as $row){
        ?>
        <tr>
            <td id="t" >
                <?= $row['title']; ?>
            </td>
            
            <td>
                <div class="s<?= $row['id']; ?>">
                    <?= mb_substr($row['news'], 0, 25); ?>
                </div>
                <div class="a<?= $row['id']; ?>">
                    <?= $row['news']; ?>
                </div>
            </td>
        </tr>
        <?php } ?>
    </table>
    <?php
    if(($now-1)>0){
        $prev=$now-1;
        echo "<a href='?do=news&p=$next'> < </a>";
    }

    for($i=1; $i<=$pages; $i++){
        $fontsize=($i==$now)?'font-size:22px':'font-size:18px';
        echo "<a href='?do=news&$i' style='$fontsize'> $i </a>";
    }

    if(($now+1)>=$pages){
        $next=$now+1;
        echo "<a href='?do=news&p=$next'> > </a>";
    }

    ?>
</fieldset>