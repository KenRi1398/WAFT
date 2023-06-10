<?php $__env->startSection('content'); ?>
<div id="body-div" class="card card-custom gutter-b">
 <div class="card-header">
  <div class="card-title">
   <h3 class="card-label">
   Tools
    <small>Add Department</small>
   </h3>

  </div>
 </div>
 <div id="card-body" class="card-body">

 <form method="POST"  onsubmit="submitRoles(event)" >
            <?php echo csrf_field(); ?>
            <div class="row">
                <label for="name">Name:</label>
                <input class="form-control" name="name" id="name" type="text" />
            </div>

            <div class="row">
                <label>Receiver:</label>
              <select class="custom-select form-control" id="receiver" name="receiver">
                    <option value="1">True</option>
                    <option value="0">False</option>
                </select>
            </div>
            <div class="row">
                <label>Requester :</label>
               <select class="custom-select form-control" id="requester" name="requester">
                    <option value="1">True</option>
                    <option value="0">False</option>
                </select>
            </div>
            <div class="row">
                <label>Branch:</label>
                <select class="custom-select form-control" id="branch" name="branch">
                    <option value="1">Tagum</option>
                    <option value="2">Panabo</option>
                    <option value="3">Panabo</option>
                </select>
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
        overlay.style.display = 'block';
        var form = event.target; // Get the form element
        var formData = new FormData(form); // Get form data

        axios.post('/add-department', formData)
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
<?php if(isset($department->result)): ?>
Swal.fire(
  'Add Succeded',
  '<?php echo e($department->result); ?>',
  'success'
)
setTimeout(function() {
  window.location.href = "/tools-department";
}, 1500);

<?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WAFT-app\resources\views/Tools/AddDepartment.blade.php ENDPATH**/ ?>