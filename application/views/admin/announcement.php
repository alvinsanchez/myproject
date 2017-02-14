<div class="col-md-5">
  <div class="row" style="background-color: #fff; padding: 2%; border:thin solid #ccc; border-radius: 4px;">
      <textarea name="name" onkeyup="autoAdjust(this)" class="form-control pull-left" style="resize: none;" placeholder="Write a post..."></textarea>
      <button type="button" name="button" class="btn btn-primary pull-right" style="margin-top: 2%;">Post</button>
  </div>
</div>




<script type="text/javascript">
  function autoAdjust(a){
    a.style.height = "1px";
    a.style.height = (25+a.scrollHeight)+"px";
  }
</script>
