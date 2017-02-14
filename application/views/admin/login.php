<?php
  	if(isset($this->session->userdata['logged_in'])){
      redirect('admin/Admin/dashboard', 'refresh');
    }
?>
<div class="container" id="in">
  <div class="row col-md-5 col-md-offset-3" style="border:thin solid #ccc;padding: 2%; display:none; margin-top: 5%; border-radius:4px; background-color:#FAFAFA;" id="index">
    <form class="form-horizontal" method="post" action="<?php echo base_url() ?>admin/Admin/login" id="login">
  <div class="form-group">
    <label for="Username" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
      <input type="username" class="form-control" id="username" name="username" placeholder="Username">
    </div>
  </div>
  <div class="form-group">
    <label for="Password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" id="submit" class="btn btn-primary form-control">Sign in</button>
    </div>
  </div>
</form>
  </div>
</div>
<script type="text/javascript">

  $(document).ready(function(){
    $('#index').slideDown();
      $('#login').submit(function(event){
        event.preventDefault();
        $.ajax({
          url: $(this).attr('action'),
          type: $(this).attr('method'),
          data: $(this).serialize(),
          success: function(response){
            if(response == 1){
              window.location.href= "dashboard";
            }
            else{
              $.notify({
              	// options
                title: "<font style='font-size: 20px; font-weight: bold;'><span class='glyphicon glyphicon-warning-sign'></span>&nbsp;&nbsp;Notice</font>",
              	message: '<br/><br/><font style="font-size: 16px;">'+response+'</font>',
              	target: '_blank'
              },{
              	// settings
              	element: 'body',
              	position: null,
              	type: "danger",
              	allow_dismiss: true,
              	newest_on_top: false,
              	showProgressbar: false,
              	placement: {
              		from: "top",
              		align: "center"
              	},
              	offset: 20,
              	spacing: 10,
              	z_index: 1031,
              	delay: 1000,
              	timer: 2000,
              	url_target: '_blank',
              	mouse_over: null,
              	animate: {
              		enter: 'animated fadeInDown',
              		exit: 'animated fadeOutUp'
              	}
              });
            }
          }
        });
      });
  });

</script>
