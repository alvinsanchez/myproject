<div class="col-md-9">
  <div class="row" style="background-color: #fff; padding: 2%; border:thin solid #ccc; border-radius: 4px; height: 500px;">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Student Lists</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane" id="profile">dd</div>
    <div role="tabpanel" class="tab-pane active" id="home">
      <div class="container-fluid" style="border: thin solid #ccc;border-top: none; border-radius: 0px 0px 4px 4px; height: 420px;"><br/>
        <div class="panel panel-default">
          <div class="panel-heading"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Student List</div>
          <div class="panel-body">
            <table class="table table-bordered table-responsive">
              <thead class="thead">
                <tr>
                  <td>ID</td><td>First Name</td><td>Middle Name</td><td>Last Name</td><td>Year Level</td>
                </tr>
              </thead>
              <tbody id="showdata">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="messages">...</div>
    <div role="tabpanel" class="tab-pane" id="settings">...</div>
  </div>
</div>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Student Information</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <div class="col-md-3">
              <div class="row">
                <img src="<?php echo base_url() ?>assets/bootstrap/img/arya-stark.jpg" class="img-rounded img-responsive">
              </div>
            </div>
            <div class="col-md-8 col-sm-offset-1 well" id="personalInfo">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span>&nbsp;&nbsp;&nbsp;Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
  $(function(){

      getStudents();

    function getStudents(){
      $.ajax({
        type: 'ajax',
        url: '<?php echo base_url() ?>admin/Admin/getStudents',
        async: true,
        dataType: 'json',
        success: function(data){
          var html = '';
          var i;
          for(i=0;i<data.length;i++){
            html +='<tr id="click" class="click" data-value="'+data[i].student_id+'">'+
                        '<td>'+data[i].student_id+'</td>'+
                        '<td>'+data[i].firstname+'</td>'+
                        '<td>'+data[i].middlename+'</td>'+
                        '<td>'+data[i].lastname+'</td>'+
                        '<td>'+data[i].year_level+'</td>'+
                    '</tr>';
          }
          $('#showdata').html(html);
        }
      });
    }

    $('#showdata').on('click','#click', function(){
      var id = $(this).attr('data-value');
      $('#myModal').modal('show');
      $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url() ?>admin/Admin/getModal',
        data: {id:id},
        async: true,
        dataType: 'json',
        success: function(data){
          var value = 'ID: '+data.student_id+'<br/>'+
                      'Firstname: '+data.firstname+'<br/>'+
                      'Middlename: '+data.middlename+'<br/>'+
                      'Lastname: '+data.lastname+'<br/>'+
                      'Year Level: '+data.year_level+'<br/>';

          $('#personalInfo').html(value);
        },
        error: function(){
          alert('Not working!');
        }
      });
    });

  });
</script>
