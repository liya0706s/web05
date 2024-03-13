<fieldset>
    <legend>目前位置 : 首頁 > 最新文章區 </legend>
    <table>
        <tr>
            <th style="width:30%;">標題</th>
            <th style="width:50%;">內容</th>
            <th></th>
        </tr>
        <?php
        $total = $News->count();
        $div = 5;
        $pages = ceil($total / $div);
        $now = $_GET['p'] ?? 1;
        $start = ($now - 1) * $div;

        $rows = $News->all(['sh' => 1], " limit $start, $div");
        foreach ($rows as $row) {
        ?>
            <tr>
                <td class="clo t" style="cursor:pointer;" data-id="<?= $row['id']; ?>">
                    <?= $row['title']; ?>
                </td>

                <td>
                    <div id="s<?= $row['id']; ?>">
                        <?= mb_substr($row['news'], 0, 25); ?>...
                    </div>
                    <div id="a<?= $row['id']; ?>" style="display: none;">
                        <?= $row['news']; ?>
                    </div>
                </td>
                <td>
                    <?php
                    // 登入的按讚紀錄
                    if (isset($_SESSION['user'])) {
                        if ($Log->count(['news' => $row['id'], 'acc' => $_SESSION['user']])>0) {
                            echo "<a href='Javascript:good({$row['id']})'>收回讚</a>";
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
        echo "<a href='?do=news&$i' style='$fontsize'> $i </a>";
    }

    if (($now + 1) >= $pages) {
        $next = $now + 1;
        echo "<a href='?do=news&p=$next'> > </a>";
    }

    ?>
</fieldset>

<script>
    $(".t").on('click', function() {
        let id = $(this).data('id');
        $(`#s${id},#a${id}`).toggle();
    })

    function good(news) {
    $.post('./api/good.php',{news},()=>{
    location.reload();
})
    }
</script>