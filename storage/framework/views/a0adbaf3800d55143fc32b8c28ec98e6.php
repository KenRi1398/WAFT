<?php $__env->startSection('content'); ?>
  <div id="body-div" class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    Inbox
                    <small>Ticket Request</small>
                </h3>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <select class="custom-select form-control" onchange="changestate(this.value)">
                        <option value="0">All</option>
                        <option value="1">Assigned</option>
                        <option value="2">UnAssigned</option>


                    </select>
                </div>
            </div>
            <table id="tickets" class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width:150px">Action</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Assigned to</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tfoot>
                <tr>
                    <th style="width:150px">Action</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Assigned to</th>
                    <th>Update</th>
                </tr>
                </tfoot>

            </table>
        </div>
</div>
<div class="modal fade" id="TicketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" id="modal-body" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST"  id="ticket-form" onsubmit="submitTicket(event)" action="/update-ticket">
            <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-1">
                <label>Name:</label>
            </div>
            <div class="col-4">
                <input class="form-control" id="modal-name" name="name" type="text" required/>
            </div>
            <div class="col-2">
                <label>Assignee:</label>
            </div>
            <div class="col-5">
               <select class="custom-select form-control" name="employee" required>
                   <option value=""></option>
                    <?php $__currentLoopData = $user->GetEmployees(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($res->id); ?>"><?php echo e($res->name); ?></option>\
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

        </div>
        <div class="row">
            <div class="col-1">
                <label>Position:</label>
            </div>
            <div class="col-4">
                <input class="form-control" id="modal-pos" name="name" type="text" required/>
            </div>
            <div class="col-2">
                <label>Classification:</label>
            </div>
            <div class="col-5">
                <select class="custom-select form-control" name="class" id="class" onchange="getissue(this.value)" required>
                    <option value=""></option>
                    <?php $__currentLoopData = $class->GetClassification(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($res->id); ?>"><?php echo e($res->class_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

        </div>
         <div class="row">
            <div class="col-1">
                <label>CC*:</label>
            </div>
            <div class="col-4">
                <input class="form-control" name="name" id="cc-email" type="text"   />
            </div>
             <div class="col-1">
                 <i title="Popover Header" data-bs-toggle="popover" data-bs-content="Some content inside the popover" class="fas fa-info-circle"></i>
             </div>

            <div class="col-1">
                <label>Issue:</label>
            </div>
            <div class="col-5">
                <select class="custom-select form-control" name="issue" id="issue" required>
                </select>
            </div>

        </div>
        <div class="row">
            <div class="col-1">
                <label>Company Email:</label>
            </div>
            <div class="col-4">
                <input class="form-control" name="name" id="modal-email" type="text" required/>
            </div>
            <div style="display: block;visibility: hidden" class="col-2" id="system_description">
                <label>System Description:</label>
            </div>
            <div style="display: block;visibility: hidden" class="col-5" id="system_description_input">
                <select class="custom-select form-control" name="system" >
                </select>
            </div>


        </div>
         <div class="row">
            <div class="col-1">
                <label>Branch/ Dept.:</label>
            </div>
            <div class="col-4">
                <input class="form-control" id="modal-dept" name="branch/dep" type="text" required />
            </div>
            <div class="col-2">
                <label>Priority:</label>
            </div>
            <div class="col-5">
                 <select class="custom-select form-control" name="priority" required>
                     <option value=""></option>
                    <?php $__currentLoopData = $priority->GetPriority(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($res->id); ?>"><?php echo e($res->Priority_Lvl); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-1">
                <label>Subject:<label>
            </div>
            <div class="col-4">
                <input class="form-control" id="modal-subject" name="name" type="text" required/>
            </div>
            <div class="col-2">
                <label>Status</label>
            </div>
            <div class="col-5">
                 <select class="custom-select  form-control" name="status" required>
                     <option value=""></option>
                    <?php $__currentLoopData = $status->GetStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(($res->id!=1 &&  $res->id!=3 ) && ($res->id!=4 &&  $res->id!=7) ): ?>
                        <option value="<?php echo e($res->id); ?>"><?php echo e($res->state); ?>

                         <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
         <div class="row">
            <div class="col-2">
                <label>Description:<label>
            </div>
            <div class="col-10">
                <textarea class="form-control" id="modal-descript" name="descrip" type="text" required>
                </textarea>
            </div>
        </div>

          <input class="form-control" id="modal-id" name="id" type="hidden" />
           <input style="margin-left:45%;margin-right: 50%;" class="btn btn-success" type="submit" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fas fa-times'></i></button>
      </div>
    </div>
  </div>
</div>

  <div class="modal fade" id="INFO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" id="modal-body" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ticket Info</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <button onclick="test122()" >X</button>

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
    let form = document.getElementById("ticket-form");
    // let display=document.getElementById("");
    let ccemails=document.getElementById("cc-email");
    let email=document.getElementById("modal-email");

    let overlay = document.body;
    let ccs=null;
    let data=[];
    // datatable

       let table= $('#tickets').DataTable({
            "scrollY":"400px",
            "scrollCollapse":true,
            "paging":false,
            "searching": true,
            columns: [
                { data: null,
                    render: function ( data, type, row ) {
                        let btn= data.state=="New"?"<div class='col-2'><a href='' data-toggle='modal' data-target='#TicketModal' onclick='modal("+JSON.stringify(data)+")' class='btn btn-icon btn-light-danger'><i class='fas fa-plus-circle'></i></a></div>":"";

                        return "<div class='row'>"
                            +"<div class='col-2'></div>"
                            <?php if(session()->get("user")->SERVICE_DESK==1): ?>
                            +btn
                            <?php endif; ?>
                            +"<div class='col-2'><a href='' data-toggle='modal' data-target='#INFO' class='btn btn-icon btn-light-warning'><i class='fas fa-exclamation'></i></a></div>"
                            +"</div>";
                    }
                },
                { data: null,
                    render: function ( data, type, row ) {
                        return "<h4><bold>"+data.ticket_subject+"</bold></h4>"+
                            "<div><small>From:"+data.requester+"</small></div>"+
                            "<div>Requested By:"+data.name+"</div>";
                    }
                },
                { data: "state"},
                { data: null,
                    render: function ( data, type, row ) {
                        let assgned=data.assignee==null?"<p style='color: red'>Unassigned</p>":data.assignee;
                        return assgned;
                    }
                },
                { data: "updated_at"}
            ]
        });



    $(document).ready(async function () {
        await axios.get('/api/get-tickets/<?php echo e(session()->get("user")->Department_id); ?>')
            .then(function (response){
                data=response.data;
                table.search('').columns().search('').clear().draw();
                table.rows.add(response.data).draw(true);
            })
            .catch(function (error) {
            });
    });
    function  changestate(state){
        let filtered = [];
        switch (state) {
            case "0":
                filtered=data;
                break;
            case "1":
                for (let row in data) {
                    if (data[row].assignee_id != null) {
                        filtered.push(data[row]);
                    }
                }
                break;
            case "2":
                for (let row in data) {
                    if (data[row].assignee_id == null) {
                        filtered.push(data[row]);
                    }
                }
                console.log(data);
                break;



        }


        table.search('').columns().search('').clear().draw();
        table.rows.add(filtered).draw(true);

    }
    function modal(data){
        document.getElementById("modal-name").value=data.name;
        document.getElementById("modal-pos").value=data.position;
        document.getElementById("modal-email").value="<?php echo e(session()->get('user')->email); ?>";
        document.getElementById("modal-dept").value=data.requester;
        document.getElementById("modal-subject").value=data.ticket_subject;
        document.getElementById("modal-descript").value=data.ticket_description;
        document.getElementById("modal-id").value=data.id;

    }

    function getissue(classes){
        var issue=<?php echo $issue->GetIssue(); ?>;
        var depid=<?php echo e(session()->get("user")->Department_id); ?>;
        var options = "";

          issue.forEach(function (item) {
            if (classes == item.class_id) {
              options += '<option value="' + item.id + '">' + item.issue_name + '</option>';
            }
          });

          document.getElementById("issue").innerHTML = options;
          if(classes==4 && depid==1){
              document.getElementById("system_description").style.visibility="visible";
              document.getElementById("system_description").style.display="block";
              document.getElementById("system_description_input").style.visibility="visible";
              document.getElementById("system_description_input").style.display="block";
          }else{
              document.getElementById("system_description").style.visibility="hidden";
              document.getElementById("system_description").style.display="none";
              document.getElementById("system_description_input").style.visibility="hidden";
              document.getElementById("system_description_input").style.display="none";
          }
    }
   function verifyemail(){
       let mail=ccemails.value;
       let verify = mail.includes("@");
       let verify1 = mail.includes(",");

       if (verify || mail=="") {

               ccs=mail==""?1:mail;

           axios.post("/send-mail/"+ccs+"/"+email.value)
               .then(function (response) {
               })
               .catch(function (error) {
               });
           return true
       }else{
           Swal.fire({
               icon: 'error',
               text: 'Please enter a Email @',
           })
        return false;
       }


   }
    function submitTicket(event){
        event.preventDefault(); // Prevent form submission
        let form = event.target; // Get the form element
        overlay.style.display = 'block';
        let formData = new FormData(form); // Get form data

        let myModal=new bootstrap.Modal(document.getElementById('TicketModal'));

        if(verifyemail()) {
            axios.post('/update-ticket', formData)
                .then(function (response) {
                    console.log(response);
                    Swal.fire(
                        'Add Succeded',
                        response.data,
                        'success',
                    );

                    // myModal.hide();
                })
                .catch(function (error) {
                    Swal.fire(
                        'Request Failed',
                        error,
                        'error'
                    );
                    console.log(error);
                });
        }
        $('#TicketModal').modal('hide');
         axios.get('/api/get-tickets/<?php echo e(session()->get("user")->Department_id); ?>')
            .then(function (response){
                data=response.data;
                table.search('').columns().search('').clear().draw();
                table.rows.add(response.data).draw(true);
            })
            .catch(function (error) {
            });

    }
    function test122(){
        // $('#INFO').modal('hide');
        // let modal = document.getElementById('INFO');

        $('#modal-body').modal('hide');
    }

    let popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    let popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WAFT-app\resources\views/Ticket/Inbox.blade.php ENDPATH**/ ?>