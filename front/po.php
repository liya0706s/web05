<style>
  .type-item {
    display: block;
  }

  .types {
    display: inline-block;
    vertical-align: top;
  }

  .list {
    width: 600px;
    display: inline-block;
    vertical-align: top;
  }
</style>

<div>目前位置 : 首頁 > 分類網誌 > <span class="type">健康新知</span></div>

<fieldset class="types">
  <legend>分類網誌</legend>
  <a class="type-item" data-id="1">健康新知</a>
  <a class="type-item" data-id="2">菸害防治</a>
  <a class="type-item" data-id="3">癌症防治</a>
  <a class="type-item" data-id="4">慢性病防治</a>
</fieldset>

<fieldset class="list">
  <legend>文章列表</legend>
  <div class="list-item" style="display: none;"></div>
  <div class="article"></div>
</fieldset>

<script>
  // getList(1)
  $(".type-item").on('click', function() {
    $(".type").text($(this).text())
    let id = $(this).data('id')
    // getList(id)
  })


  function getList(id) {
    $.get('./api/get_list.php', {
      id
    }, (list) => {
      $(".list-item").html(list)
      $(".list-item").show()
      $(".article").hide()
    })
  }
</script>