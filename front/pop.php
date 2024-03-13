<fieldset>
    <legend>目前位置 : 首頁 > 人氣文章區 </legend>
    <table>
        <tr>
            <th style="width:30%">標題</th>
            <th style="width:50%">內容</th>
            <th style="width:20%">人氣</th>
        </tr>
        <?php
        $total = $News->count(['sh' => 1]);
        $div = 5;
        $pages = ceil($total / $div);
        $now = $_GET['p'] ?? 1;
        $start = ($now - 1) * $div;

        $rows = $News->all(['sh' => 1], " order by `good` desc limit $start, $div");
        foreach ($rows as $row) {
        ?>
            <tr>
                <td class="clo t" style="cursor: pointer;" data-id="<?= $row['id']; ?>">
                    <?= $row['title']; ?>
                </td>
                <td>
                    <div id="s<?= $row['id']; ?>">
                        <?= mb_substr($row['news'], 0, 25); ?>
                    </div>
                    <div id="a<?= $row['id']; ?>" style="display:none;" class="pop">
                    <h3 style="color:lightblue"><?=$row['title'];?></h3>    
                    <?= $row['news']; ?>
                    </div>
                </td>

                <td class="ct">
                    <span><?=$row['good'];?>個人說</span>
                    <img src='./icon/02B03.jpg' style='width:20px'>
                    <?php
                   
                    // 登入的按讚紀錄
                    if (isset($_SESSION['user'])) {
                        if ($Log->count(['news' => $row['id'], 'acc' => $_SESSION['user']]) > 0) {
                            echo "<a href='Javascript:good({$row['id']})'> 收回讚 </a>";
                        } else {
                            echo "<a href='Javascript:good({$row['id']})'> 讚 </a>";
                        }
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php
    if (($now - 1) > 0) {
        $prev = $now - 1;
        echo "<a href='?do=news&p=$prev'> < </a>";
    }

    for ($i = 1; $i <= $pages; $i++) {
        $fontsize = ($i == $now) ? 'font-size:22px' : 'font-size:18px';
        echo "<a href='?do=news&p=$i' style='$fontsize'> $i </a>";
    }

    if (($now + 1) >= $pages) {
        $next = $now + 1;
        echo "<a href='?do=news&p=$next'> > </a>";
    }
    ?>
</fieldset>

<script>
   $(".t").hover(function(){
    $(".pop").hide()
    let id= $(this).data('id')
    $("#a"+id).show()
   })

    // 用POST傳值，這裡指的是-按讚紀錄表的news
    function good(news) {
        $.post('./api/good.php', {
            news
        }, () => {
            location.reload();
        })
    }
</script>