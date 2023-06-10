<?php $__env->startSection('content'); ?>
<div id="body-div" class="card card-custom gutter-b">
 <div class="card-header">
  <div class="card-title">
   <h3 class="card-label">
    Create Ticket
    <small>Create ticket Request</small>
   </h3>
  </div>
 </div>
 <div id="card-body" class="card-body">
    <form  id="ticket-from" method="POST"  onsubmit="submitRoles(event)">
            <?php echo csrf_field(); ?>
            <div class="row">
                <label for="name">Requester Name:</label>
                <input class="form-control" name="name" id="name" type="text" required="true"/>
            </div>
            <div class="row">
                <label>Position:</label>
                <input class="form-control" name="position" id="position" type="text"  required="true"/>
            </div>
            <div class="row">
                <label>Branch/Department :</label>
               <select class="custom-select form-control" id="branch_department" name="branch_department" required="true" >
                   <option value=""></option>
                    <?php $__currentLoopData = $department->getDepartment(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($res->requester==1): ?>
                        <option value="<?php echo e($res->id); ?>"><?php echo e($res->department_name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

            </div>
            <div class="row">
                <label>Company Email:</label>
                <input class="form-control" name="company_email" id="company_email" type="email"  required="true"/>
            </div>
            <!--  -->
            <hr>
            <!--  -->
             <div class="row">
                <label>Address Ticket to:</label>
                <select class="custom-select form-control" id="addressto" name="addressto" required="true" onchange="onchangedepartment()">
                    <option value=""></option>
                    <?php $__currentLoopData = $department->getDepartment(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($res->receiver==1): ?>
                        <option value="<?php echo e($res->id); ?>"><?php echo e($res->department_name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                 <input class="form-control" id="branch_department_name" name="branch_department_name"  type="hidden" />
            </div>
             <div class="row">
                <label>Subject:</label>
                <input class="form-control" name="subject" id="subject" type="text" required="true"/>
            </div>

             <div class="row">
                <label>Attachment:</label>
                <input class="form-control" name="attachment" id="attachment" type="file" />
            </div>
             <div class="row">
                <label>Request Description:</label>
                <textarea class="form-control" name="description" id="description" type="email" required="true"></textarea>
            </div>
                <input type="submit" value="Add" class="btn btn-primary" />
        </form>

 </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<script>
    let form = document.getElementById("ticket-from");
    let overlay = document.body;

    function submitRoles(event){
        event.preventDefault(); // Prevent form submission
        var form = event.target; // Get the form element
        var formData = new FormData(form); // Get form data

        axios.post('/add-ticket', formData)
            .then(function(response) {
                console.log(response);
                Swal.fire(
                    'Add Succeded',
                    response,
                    'success'
                );
                form.reset();
            })
            .catch(function(error) {
                console.log(error);
            });
        overlay.style.display = 'block';
    }
    function onchangedepartment(){
        let dep = document.getElementById("addressto");
        let depname = document.getElementById("branch_department_name");
        let selectedOption = dep.options[dep.selectedIndex];


        depname.value=selectedOption.text;;


    }



</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WAFT-app\resources\views/Ticket/Create.blade.php ENDPATH**/ ?>