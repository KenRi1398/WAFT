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
     <form method="POST" action="/add-department">
                <?php echo csrf_field(); ?>
     </form>
 </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WAFT-app\resources\views/Tools/AssignRole.blade.php ENDPATH**/ ?>