<?php $__env->startSection('content'); ?>
<div id="body-div" class="card card-custom gutter-b">
 <div class="card-header">
  <div class="card-title">
   <h3 class="card-label">
   Tools
    <small>Tools page</small>
   </h3>


  </div>
 </div>
 <div id="card-body" class="card-body">
     <a href="/tools-department" class="btn btn-primary">Departments</a>
     <a href="/tools-classification" class="btn btn-primary">Classification</a>
     <a href="/tools-issue" class="btn btn-primary">Issue</a>
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
  window.location.href = "/add-department";
}, 1200);

<?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WAFT-app\resources\views/Tools/Tools.blade.php ENDPATH**/ ?>