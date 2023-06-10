<?php $__env->startSection('content'); ?>
<div id="body-div" class="card card-custom gutter-b">
 <div class="card-header">
  <div class="card-title">
   <h3 class="card-label">
   Tools
    <small>Assign Role</small>
   </h3>

  </div>
 </div>
 <div id="card-body" class="card-body">
     <div class="container">
         <form id="role-assign"  method="POST" action="/assign-role">
                    <?php echo csrf_field(); ?>
             <label>Users</label>
             <select class="custom-select form-control" name="users" id="user" onchange="getroles(this)" required>
                     <option value=""></option>
                 <?php $__currentLoopData = $user->GetUser(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($res->id); ?>" data-res="<?php echo e(json_encode($res)); ?>"><?php echo e($res->name); ?></option>\
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </select>
             <hr>
             <div class="row">
                 <div class="col-6">
                     <div class="row">
                        <input class="form-check-input"  type="checkbox" name="requester" id="requester" >
                        <label>Requester</label>
                     </div>
                     <div class="row">
                         <input class="form-check-input" type="checkbox" name="service" id="service" >
                         <label>Service Desk</label>
                     </div>
                     <div class="row">
                         <input class="form-check-input" type="checkbox" name="personnel" id="personnel" >
                         <label>Personnel</label>
                     </div>
                     <div class="row">
                         <input class="form-check-input" type="checkbox" name="approve" id="approve" >
                         <label>Approver</label>
                     </div>
                 </div>
                 <div class="col-6">
                     <div class="row">
                         <label>Permission</label>
                         <select class="custom-select form-control"  name="permission" id="permission" required>
                             <option value=""></option>
                             <option value="1">Admin</option>
                             <option value="2">User</option>
                         </select>
                     </div>
                 </div>
                 <hr>
             </div>
             <input type="hidden" value="" name="role_id" id="id">
             <input type="submit" value="Submit" class="btn btn-success">

         </form>
     </div>
 </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>
<?php if(isset($user->result)): ?>
Swal.fire(
  'Add Succeded',
  '<?php echo e($user->result); ?>',
  'success'
)
setTimeout(function() {
  window.location.href = "/user-role";
}, 1200);
<?php endif; ?>
<?php if(isset($user->error)): ?>
Swal.fire(
    'Failed',
    '<?php echo e($user->error); ?>',
    'error'
)
setTimeout(function() {
    // window.location.href = "/user-role";
}, 1200);
<?php endif; ?>
    function getroles(details){
        var selectedOption = details.options[details.selectedIndex];
        var resData = JSON.parse(selectedOption.getAttribute('data-res'));
        document.getElementById("requester").checked=resData.REQUESTER==1?true:false;
        document.getElementById("service").checked=resData.SERVICE_DESK==1?true:false;
        document.getElementById("personnel").checked=resData.PERSONNEL==1?true:false;
        document.getElementById("approve").checked=resData.APPROVER==1?true:false;
        document.getElementById("id").value=resData.Roles_id;
        document.getElementById("permission").value=resData.Permission_id;
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WAFT-app\resources\views/User/AssignRole.blade.php ENDPATH**/ ?>