<?php $__env->startSection('content'); ?>
<div id="body-div" class="card card-custom gutter-b">
 <div class="card-header">
  <div class="card-title">
   <h3 class="card-label">
   Tools
    <small>Add Ticket Classification</small>
   </h3>

  </div>
 </div>
 <div id="card-body" class="card-body">

 <form method="POST" onsubmit="submitRoles(event)"  action="/add-classification">
            <?php echo csrf_field(); ?>
            <div class="row">
                <label>Classification Name:</label>
              <input class="form-control" name="class_name" id="" type="text" />
            </div>
            <div class="row">
                <label>Description :</label>
               <textarea name="description" class="form-control"></textarea>
            </div>
            <?php if(session()->get("user")->Permission_id==1): ?>
             <div class="row">
                <label>Department:</label>
               <select class="custom-select form-control" id="department_id" name="department_id" required="true">
                    <?php $__currentLoopData = $department->getDepartment(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($res->id); ?>"><?php echo e($res->department_name); ?></option>\
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <?php endif; ?>

                <input type="submit" value="Add" class="btn btn-primary" />
        </form>
 </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>
<?php if(isset($classification->result)): ?>
Swal.fire(
  'Add Succeded',
  '<?php echo e($classification->result); ?>',
  'success'
)
setTimeout(function() {
  window.location.href = "/tools-classification";
}, 1500);

<?php endif; ?>
<?php if(isset($classification->error)): ?>
Swal.fire(
  'Error',
  'Add Classification Failed',
  'error'
)
setTimeout(function() {
  window.location.href = "/tools-classification";
}, 1500);

<?php endif; ?>
let form = document.getElementById("ticket-from");
let overlay = document.body;

function submitRoles(event){
    event.preventDefault(); // Prevent form submission
    overlay.style.display = 'block';
    var form = event.target; // Get the form element
    var formData = new FormData(form); // Get form data

    axios.post('/add-classification', formData)
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
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WAFT-app\resources\views/Tools/AddClassification.blade.php ENDPATH**/ ?>