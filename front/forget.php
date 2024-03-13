<div>請輸入信箱以查詢密碼:</div>
<div>
    <input type="email" name="email" id="email">
</div>
<div id="result"></div>
<input type="button" class="where" value="尋找" onclick="find()">

<script>
function find(){
  $.post('./api/forget.php',{email:$("#email").val()},(res)=>{
    $("#result").text(res)
  })
}
</script>