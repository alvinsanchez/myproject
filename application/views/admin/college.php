<div class="col-md-9">
  <div class="row" style="background-color: #fff; padding: 2%; border:thin solid #ccc; border-radius: 4px;">
    <!-- Nav tabs -->
      <ul class="nav nav-tabs" id="tabs" role="tablist">
        <li role="presentation" id="Add" class="active"><a href="#add" aria-controls="add" role="tab" data-toggle="tab">Add Organization</a></li>
        <li role="presentation" id="View"><a href="#view" aria-controls="view" role="tab" data-toggle="tab">View Organizations</a></li>
        <li role="presentation" id="Pending"><a href="#pending" aria-controls="pending" role="tab" data-toggle="tab">Pending Requests <span class="badge" id="badge" style="display:none;background-color: #990012;"></span></a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="add">
          <div class="container-fluid"><br/>
            <div class="well">
              <font style="color: #777;font-weight: bold;font-size:20px;">Enter Organization Information</font>
            </div>
            <form id="OrgForm" action="insertOrganization" method="post">
              <div class="form-group">
                  <label for="Organization" class="col-md-3 control-label">Organization Name</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="organization">
                </div>
              </div><br/><br/>
              <div class="form-group">
                  <label for="Purpose" class="col-md-3 control-label">Purpose</label>
                <div class="col-md-9">
                  <textarea onkeyup="autoAdjust(this)" name="purpose" class="form-control" style="resize: none;"></textarea>
                </div>
              </div><br/><br/><br/>


              <div class="form-group">
                  <label for="Studentcode" class="col-md-3 control-label">Student Code</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="student_code" id="student_code">
                </div>
              </div><br/><br/>

              <div class="" id="info" style="border: thin solid #ccc;display: none;padding: 2%; border-radius: 4px;">

              </div><br/>

              <div class="form-group">
                  <label for="Position" class="col-md-3 control-label">Position</label>
                <div class="col-md-9">
                  <select class="form-control" name="position">
                    <option value="President">President</option>
                    <option value="Vice President">Vice President</option>
                  </select>
                </div>
              </div><br/><br/>

              <div class="form-group">
                  <label for="Department" class="col-md-3 control-label">Department</label>
                <div class="col-md-9">
                  <select class="form-control" name="department">
                    <option value="CECS">CECS</option>
                    <option value="CABEIHM">CABEIHM</option>
                    <option value="CTE">CTE</option>
                    <option value="CAS">CAS</option>
                  </select>
                </div>
              </div><br/><br/>

              <div class="form-group">
                  <label for="Description" class="col-md-3 control-label">Description</label>
                <div class="col-md-9">
                  <textarea onkeyup="autoAdjust(this)" name="description" class="form-control" style="resize: none;"></textarea>
                </div>
              </div><br/><br/><br/>


              <button type="button" class="btn btn-primary  col-md-offset-5" id="submitOrg" name="button"><span class="glyphicon glyphicon-check"></span>&nbsp;&nbsp;&nbsp;Submit</button>
            </form>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="view"><br/>
          <table class="table table-bordered table-responsive">
            <thead>
              <tr>
                <th>Organization</th><th>Department</th><th>Date Created</th><th>Actions</th>
              </tr>
            </thead>
            <tbody id="showOrg">

            </tbody>
          </table>


          <div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="title"></h4>
                </div>
                <div class="modal-body" >
                  <form method="post" id="updateForm">
                  <div class="container-fluid" id="modalBody">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" id="editUpdate" class="btn btn-primary">Update</button>
                </form>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

          <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="title">Delete Organization</h4>
                </div>
                <div class="modal-body" >
                  <div class="container-fluid" id="deletemodalBody">

                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" id="deleteBtn" class="btn btn-danger">Delete</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

        </div>
        <div role="tabpanel" class="tab-pane" id="pending">
<!--Pending Request--><br/>
            <table class="table table-bordered table-responsive">
              <thead>
                <tr>
                  <th>Organization</th><th>Department</th><th>Date Requested</th><th>Actions</th>
                </tr>
              </thead>
              <tbody id="showPendingOrg">

              </tbody>
            </table>
        </div>
      </div>
  </div><br/>
</div>

<script>
  $(document).ready(function(){
    $( "#student_code" ).autocomplete({
      close: function(event, ui){
        var data = $(this).val();
        loadStudent();
      },
      source: 'getStudentInfo'

    });

    loadOrganization();
    loadPendingOrgs();
    // $('#student_code').keydown(function(e){
    //   if(e.which == 13){
    //     loadStudent();
    //   }
    // });

    function loadStudent(){
      var data = $('#student_code').val();

      if(data != ""){
        $.ajax({
          type: 'ajax',
          url: 'getStudentFullInfo',
          method: 'post',
          data: {student_code: data},
          dataType: 'json',
          success: function(data){
            if(data){
              var html = '';
              var i;
                html +='<div class="container-fluid">'+
                          '<font style="font-weight: bold;">Applicant\'s Information</font><hr/>'+
                          '<div class="row"><label class="control-label col-sm-1" for="Name">Name</label>'+
                          '<div class="col-md-6">'+
                            '<input type="text" readonly class="form-control" value="'+data.firstname+' '+data.middlename+' '+data.lastname+'"/>'+
                          '</div>'+
                          '<label class="control-label col-sm-1" for="SR - Code">Student Number</label>'+
                          '<div class="col-md-4"><input readonly type="text" value="'+data.student_no+'" class="form-control"/></div>'+
                          '</div><br/>'+

                          '<div class="row"><label class="control-label col-xs-1" for="department">Department</label>'+
                          '<div class="col-xs-3 col-xs-offset-1">'+
                            '<input type="text" readonly class="form-control" value="'+data.department+'"/>'+
                          '</div>'+
                          '<label class="control-label col-xs-1" for="SR - Code">Program/Year/Section</label>'+
                          '<div class="col-xs-3 col-xs-offset-2"><input readonly type="text" value="'+data.program+' '+data.year_level+'-'+data.section+'" class="form-control"/></div>'+
                          '</div><br/>'+

                          '</div>';



              $('#info').html(html);
              $('#info').slideDown(50);
            }
            else{
              $('#info').slideUp(50);
              alert("No Records Found!");
              $('#student_code').val("");
              $('#student_code').focus();
            }
          }
        });
      }
      else{
        $('#info').hide();
      }

    }

    function loadOrganization(){
      var accepted = 1;
      $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url()?>admin/Admin/getOrganization',
        data: {'accept': accepted},
        dataType: 'json',
        success: function(data){
          var x;
          var orgs= '';
          for(x=0; x < data.length; x++){
            orgs += '<tr>'+
                        '<td>'+data[x].org_name+'</td>'+
                        '<td>'+data[x].department+'</td>'+
                        '<td>'+data[x].date_created+'</td>'+
                        '<td><div class="btn-group" role="group" aria-label="...">'+
                              '<button type="button" id="viewEdit" data-value="'+data[x].org_id+'" class="btn btn-warning">Edit</button>'+
                              '<button type="button" id="viewDelete" data-value="'+data[x].org_id+'" class="btn btn-danger">Delete</button>'+
                              '<button type="button" id="viewPopulate" class="btn btn-primary">Populate Group</button>'+
                         '</div></td>'+
                    '</tr>';
          }
          $('#showOrg').html(orgs);
        },
        error : function(){
          alert('err');
        }
      });
    }

    function loadPendingOrgs(){
      var statusNumber = 0;
      $.ajax({
        type: 'ajax',
        url: 'loadPendingOrgs',
        data: {'statusNumber' : statusNumber},
        dataType: 'json',
        method: 'get',
        success: function(data){
          var pendingOrgs = '';
          var i;
          for(i=0;i<data.length;i++){
            pendingOrgs += '<tr>'+
                                '<td>'+data[i].org_name+'</td>'+
                                '<td>'+data[i].department+'</td>'+
                                '<td>'+data[i].date_requested+'</td>'+
                                '<td><button class="btn btn-primary" id="accept" data-value="'+data[i].org_id+'">Accept</button><button id="ignore" data-value="'+data[i].org_id+'" class="btn btn-warning">Ignore</button></td>'+
                            '</tr>';
          }
          $('#showPendingOrg').html(pendingOrgs);

          if(data.length > 0){
            $('#badge').text(data.length);
            $('#badge').show();
          }
          else{
            $('#badge').hide();
          }
        },
        error: function(){
          alert('Error Loading Pending Organization');
        }
      });
    }

    $('#submitOrg').click(function(){
      $.ajax({
        type: 'ajax',
        url: 'insertOrganization',
        method: 'post',
        data: $('#OrgForm').serialize(),
        dataType: 'json',
        success: function(data){
          if(data == true){
            $.notify({
              // options
              title: "<font style='font-size: 20px; font-weight: bold;'><span class='glyphicon glyphicon-warning-sign'></span>&nbsp;&nbsp;Notice</font>",
              message: '<br/><br/><font style="font-size: 16px;">Successfully Inserted</font>',
              target: '_blank'
            },{
              // settings
              element: 'body',
              position: null,
              type: "success",
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
              delay: 2000,
              timer: 2000,
              url_target: '_blank',
              mouse_over: null,
              animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
              }
            });
            $('#OrgForm')[0].reset();
            loadPendingOrgs();
            $('#info').hide();
          }
          else {
            $.notify({
              // options
              title: "<font style='font-size: 20px; font-weight: bold;'><span class='glyphicon glyphicon-warning-sign'></span>&nbsp;&nbsp;Notice</font>",
              message: '<br/><br/><font style="font-size: 16px;">'+data+'</font>',
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

    $('#showPendingOrg').on('click','#accept', function(){
      var org_id = $(this).attr('data-value');

      $.ajax({
        type:'ajax',
        url: 'acceptPendingOrgs',
        method: 'post',
        data: {'org_id': org_id},
        dataType: 'json',
        success: function(data){
          if(data == true){
            $.notify({
              // options
              title: "<font style='font-size: 20px; font-weight: bold;'><span class='glyphicon glyphicon-warning-sign'></span>&nbsp;&nbsp;Notice</font>",
              message: '<br/><br/><font style="font-size: 16px;">Successfully Updated</font>',
              target: '_blank'
            },{
              // settings
              element: 'body',
              position: null,
              type: "success",
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
              delay: 2000,
              timer: 2000,
              url_target: '_blank',
              mouse_over: null,
              animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
              }
            });
            $('#Add').removeClass("active");
            $('#Pending').addClass("active");
            loadPendingOrgs();
            loadOrganization();
          }
        }
      });
    });

    $('#showPendingOrg').on('click','#ignore', function(){
      var org_id = $(this).attr('data-value');

      $.ajax({
        type:'ajax',
        url: 'ignorePendingOrgs',
        method: 'post',
        data: {'org_id': org_id},
        dataType: 'json',
        success: function(data){
          if(data == true){
            $.notify({
              // options
              title: "<font style='font-size: 20px; font-weight: bold;'><span class='glyphicon glyphicon-warning-sign'></span>&nbsp;&nbsp;Notice</font>",
              message: '<br/><br/><font style="font-size: 16px;">Successfully Updated</font>',
              target: '_blank'
            },{
              // settings
              element: 'body',
              position: null,
              type: "success",
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
              delay: 2000,
              timer: 2000,
              url_target: '_blank',
              mouse_over: null,
              animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
              }
            });
            $('#Add').removeClass("active");
            $('#Pending').addClass("active");
            loadPendingOrgs();
            loadOrganization();
          }
        }
      });

    });


      $('#showOrg').on('click','#viewEdit', function(){
        var org_id = $(this).attr('data-value');

        $.ajax({
          type: 'ajax',
          url: 'groupInfo',
          method: 'get',
          data: {'org_id': org_id},
          dataType: 'json',
          success: function(data){
            var groupInfo = '';
                groupInfo +='<input type="hidden" value="'+data.org_id+'" name="orgId">'+

                            '<div class="form-group">'+
                                '<label for="Organization Name" class="col-md-3 control-label">Organization Name </label>'+
                                '<div class="col-md-9">'+
                                '<input type="text" name="orgName" class="form-control" value="'+data.org_name+'">'+
                                '</div>'+
                            '</div><br/>'+

                            '<div class="form-group">'+
                                '<label for="Department" class="col-md-3 control-label">Department</label>'+
                                '<div class="col-md-9">'+
                                  '<select name="selectDepartment" class="form-control" id="select">'+
                                    '<option value="CECS">CECS</option>'+
                                    '<option value="CABEIHM">CABEIHM</option>'+
                                  '</select>'+
                                '</div>'+
                            '</div><br/>'+

                            '<div class="form-group">'+
                                '<label for="Description" class="col-md-3 control-label">Description</label>'+
                                '<div class="col-md-9">'+
                                '<textarea name="textDescription" style="resize:none;" onkeypress="autoAdjust(this);" class="form-control">'+data.description+'</textarea>'+
                                '</div>'+
                            '</div><br/>';


            $('#title').text(data.org_name);
            $('#modalBody').html(groupInfo);
            $('#myModal').modal('show');
          }
        });
      });

      $('#showOrg').on('click','#viewDelete', function(){
        var org_id = $(this).attr('data-value');

          $.ajax({
            type: 'ajax',
            url: 'getDeleteInfo',
            data: {'org_id' : org_id},
            dataType: 'json',
            method: 'post',
            success: function(data){

               $('#deletemodalBody').html("Do you really want to delete <b>"+data.org_name+"</b> group?<input type='hidden' id='hiddenID' value='"+data.org_id+"'/>");
               $('#deleteModal').modal('show');
            }

          });
      });

      $('#myModal').on('click','#editUpdate',function(){
        $.ajax({
          type: 'ajax',
          url: 'updateOrg',
          method: 'post',
          data: $('#updateForm').serialize(),
          dataType:'json',
          success: function(data){
            if(data == true){
              $.notify({
                // options
                title: "<font style='font-size: 20px; font-weight: bold;'><span class='glyphicon glyphicon-warning-sign'></span>&nbsp;&nbsp;Notice</font>",
                message: '<br/><br/><font style="font-size: 16px;">Successfully Updated</font>',
                target: '_blank'
              },{
                // settings
                element: 'body',
                position: null,
                type: "success",
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
                delay: 2000,
                timer: 2000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                  enter: 'animated fadeInDown',
                  exit: 'animated fadeOutUp'
                }
              });
              loadOrganization();
              $('#myModal').modal('hide');
            }
          }
        });
      });

      $('#deleteModal').on('click', '#deleteBtn', function(){
        var orgID = $('#hiddenID').val();

        $.ajax({
          type:'ajax',
          url: 'deleteOrg',
          method: 'post',
          data: {'orgID': orgID},
          dataType: 'json',
          success: function(data){
            if(data == true){
              $.notify({
                // options
                title: "<font style='font-size: 20px; font-weight: bold;'><span class='glyphicon glyphicon-warning-sign'></span>&nbsp;&nbsp;Notice</font>",
                message: '<br/><br/><font style="font-size: 16px;">Successfully Deleted</font>',
                target: '_blank'
              },{
                // settings
                element: 'body',
                position: null,
                type: "success",
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
                delay: 2000,
                timer: 2000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                  enter: 'animated fadeInDown',
                  exit: 'animated fadeOutUp'
                }
              });
              loadOrganization();
              $('#deleteModal').modal('hide');
            }
          }
        });
      });

      // $('#myModal').on('click','#editUpdate',function(){
      //   $.ajax({
      //     type: 'ajax',
      //     url: 'updateOrg',
      //     method: 'post',
      //     data: $('#updateForm').serialize(),
      //     dataType:'json',
      //     success: function(data){
      //       if(data == true){
      //         $.notify({
      //           // options
      //           title: "<font style='font-size: 20px; font-weight: bold;'><span class='glyphicon glyphicon-warning-sign'></span>&nbsp;&nbsp;Notice</font>",
      //           message: '<br/><br/><font style="font-size: 16px;">Successfully Updated</font>',
      //           target: '_blank'
      //         },{
      //           // settings
      //           element: 'body',
      //           position: null,
      //           type: "success",
      //           allow_dismiss: true,
      //           newest_on_top: false,
      //           showProgressbar: false,
      //           placement: {
      //             from: "top",
      //             align: "center"
      //           },
      //           offset: 20,
      //           spacing: 10,
      //           z_index: 1031,
      //           delay: 2000,
      //           timer: 2000,
      //           url_target: '_blank',
      //           mouse_over: null,
      //           animate: {
      //             enter: 'animated fadeInDown',
      //             exit: 'animated fadeOutUp'
      //           }
      //         });
      //         loadOrganization();
      //         $('#myModal').modal('hide');
      //       }
      //     }
      //   });
      // });



  });
</script>
