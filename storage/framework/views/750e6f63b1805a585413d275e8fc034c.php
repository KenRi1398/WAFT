<?php $__env->startSection('content'); ?>
  <div id="body-div" class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    My Task
                    <small>Tasked Assigned</small>
                </h3>
            </div>
        </div>
        <div class="card-body">
        <div class="row">
            <div class="col-5">
            <select class="custom-select form-control" onchange="changestate(this.value)">
                <option value="0">All</option>
                <?php $__currentLoopData = $status->GetStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($res->id!==1): ?>
                        <option value="<?php echo e($res->id); ?>"><?php echo e($res->state); ?></option>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            </div>
        </div>
        <!-- Modal -->
            <table id="tickets" class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 200px">Subject</th>
                        <th style="width: 90px">Priority</th>
                        <th>Classification</th>
                        <th>Time Elapsed</th>
                        <?php if(session()->get("user")->Permission_id==1): ?>
                            <th>Assignee</th>
                        <?php endif; ?>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table data goes here -->
                </tbody>
            </table>
        </div>
</div>
  
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sml" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Status Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <form action="/update-tasks" method="post">
              <?php echo csrf_field(); ?>
              <h1><div id="subject"></div></h1>
              <label>Status</label>
              <select class="custom-select form-control" id="status" name="status">
                  <?php $__currentLoopData = $status->GetStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                      <?php if($res->id!==1 && ($res->id!==2 || session()->get("user")->Permission_id==1)): ?>
                      <option value="<?php echo e($res->id); ?>"><?php echo e($res->state); ?></option>
                      <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <label>Remarks</label>
              <textarea style="height: 200px" class="form-control" name="remarks">
              </textarea>
              <input id="ticket_id" name="id"  type="hidden">
              <input id="userlog_token" name="userlog_token"  type="hidden">
              <input style="margin-left: 40%;margin-right: 50%;margin-top: 5%" type="submit" class="btn btn-success" value="Update">
          </form>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

  <div class="modal fade" id="transmital" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Transfer Task</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="/transmital-tasks" method="post">
                      <?php echo csrf_field(); ?>
                      <label>Assigned</label>
                      <select class="custom-select form-control" name="uid">
                          <?php $__currentLoopData = $user->GetEmployees(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($res->id); ?>"><?php echo e($res->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>

                      <input id="ticket_id" name="ticket_id"  type="hidden">
                      <input style="margin-left: 40%;margin-right: 50%;margin-top: 5%" type="submit" class="btn btn-success" value="Transfer">
                  </form>

              </div>
              <div class="modal-footer">
                  <button  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>
    let state=1;
    let data=[];
    let permission=<?php echo e(session()->get("user")->Permission_id); ?>;

    let table=$('#tickets').DataTable({
            "scrollY":"400px",
            "scrollCollapse":true,
            "paging":false,
            "searching": true,
            "destroy":true,
            "rowCallback": function(row, data) {
            // Get the value of the data field for the row
            var priority = data.Priority_Lvl;

            // Apply the desired background color based on the value
            if (priority === "Normal") {
                $(row).css("background-color", "#81B622");
            } else if (priority === "Urgent") {
                $(row).css("background-color", "#F28C28");
            } else if (priority === "Critical") {
                $(row).css("background-color", "#cd5c5c");
            }
                switch (data.state){

                    case "Closed":
                        $(row).css("background-color", "white");
                        break;
                }
        },
            columns: [
                { data: null,
                    render: function (data, type, row) {
                        return "<h3>"+data.ticket_subject+"</h3>";
                    }
                },
                { "data": null,
                    "render": function (data, type, row) {


                        switch (data.Priority_Lvl) {
                            case "Normal":
                                return "<td style='background-color: yellow !important;'>"+data.Priority_Lvl+"</td>";
                                break;
                            case "Urgent":
                                return data.Priority_Lvl;
                                break;
                            case "Critical":
                                return data.Priority_Lvl;
                                break;
                        }
                    }
                },
                { data: "class_name" },
                {
                    data: null,
                    render: function (data, type, row) {
                        let current_date=new Date();
                        let ticket_date=new Date(data.updated_at);
                        return current_date.getDate()-ticket_date.getDate() +" day/s";
                    }
                },
                { data: null,
                    render: function (data, type, row) {
                       switch (data.state){
                           case "Open":
                               return"<p style='color: darkgreen'>"+data.state+"</p>";
                               break;
                           case "on going":
                               return"<p style='color: blue'>"+data.state+"</p>";
                               break;
                           case "on hold":
                               return"<p style='color: yellow'>"+data.state+"</p>";
                               break;
                           case "Pending For":
                               return"<p style='color: orange'>"+data.state+"</p>";
                               break;
                           case "Canceled":
                               return"<p style='color: gray'>"+data.state+"</p>";
                               break;
                           case "Closed":
                               return"<p style='color: red'>"+data.state+"</p>";
                               break;
                       }
                    }

                },
                <?php if(session()->get("user")->Permission_id==1): ?>
                    { data: "assignee" },
                <?php endif; ?>
                { data: null,
                    render: function ( data, type, row ) {
                        let permission=<?php echo e(session()->get("user")->Permission_id); ?>;
                        let status=data.state!="Closed" || permission==1?"<a href='' onclick='getTicketID( "+JSON.stringify(data)+")' data-toggle='modal' data-target='#exampleModal' class='btn btn-icon btn-light-danger'><i class='fas fa-plus-circle'></i></a>" :"";
                        let transmittal= data.state=="Closed"?"":"<a   data-toggle='modal' data-target='#transmital' class='btn btn-icon btn-light-success'><i onclick='getTicketID( "+JSON.stringify(data)+")' class='fas fa-retweet'></i></a>";
                        let info="<a href='' class='btn btn-icon btn-light-warning'><i class='fas fa-exclamation'></i></a>";

                        let btn=status+transmittal+info;
                        return btn;
                    }
                }
            ]
        });
    $(document).ready(async function ()  {
        let url="";
        if (permission==1) {
            url = "/api/get-tasks/0/<?php echo e(session()->get("user")->Department_id); ?>";
        }else {
            url = "/api/get-tasks/<?php echo e(session()->get("user")->id); ?>/0";
        }

       await axios.get(url)
            .then(function (response){
                data=response.data;
                table.search('').columns().search('').clear().draw();
                table.rows.add(response.data).draw(true);
            })
            .catch(function (error) {
            });
    })

    function changestate(state){
        let filtered = [];
        if(state==0){
            filtered=data;
        }else {
            for (let row in data) {
                if (data[row].status_id == state) {
                    filtered.push(data[row]);
                }
            }
        }
        table.search('').columns().search('').clear().draw();
        table.rows.add(filtered).draw(true);



    }
    function getTicketID(data1) {
        document.getElementById("ticket_id").value=data1.id;
        document.getElementById("subject").innerHTML=data1.ticket_subject;
        document.getElementById("status").value=data1.status_id;
        document.getElementById("userlog_token").value=data1.last_userlog_token;
    }

    <?php if(isset($ticket->result)): ?>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Transfer Successful',
    })
    setTimeout(function() {
        // window.location.href = "/my-tasks";
    }, 1200);
    <?php endif; ?>
    <?php if(isset($ticket->error)): ?>
    Swal.fire({
        icon: 'Error',
        title: 'Failed',
        text: '<?php echo e($ticket->error); ?>',
    })
    setTimeout(function() {
        // window.location.href = "/my-tasks";
    }, 1200);
    <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WAFT-app\resources\views/Ticket/Task.blade.php ENDPATH**/ ?>