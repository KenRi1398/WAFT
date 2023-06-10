<?php $__env->startSection('content'); ?>
<div id="body-div" class="card card-custom gutter-b">
 <div class="card-header">
  <div class="card-title">
   <h3 class="card-label">
   Tools
    <small>Add Issue</small>
   </h3>

  </div>
 </div>
 <div id="card-body" class="card-body">

 <form method="POST" action="/add-issue">
            <?php echo csrf_field(); ?>
            <div class="row">
                <label>Issue Name:</label>
              <input class="form-control" name="issue_name" id="" type="text" />
            </div>
            <div class="row">
                <label>Classification :</label>
               <select class="custom-select form-control" id="class_id" name="class_id" required="true">
                    <?php $__currentLoopData = $classification->GetClassification(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($res->id); ?>"><?php echo e($res->class_name); ?></option>\
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

                <input type="submit" value="Add" class="btn btn-primary" />
        </form>
 </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>
<?php if(isset($issue->result)): ?>
Swal.fire(
  'Add Succeded',
  '<?php echo e($issue->result); ?>',
  'success'
)
setTimeout(function() {
  window.location.href = "/tools-issue";
}, 1200);

<?php endif; ?>
<?php if(isset($issue->error)): ?>
Swal.fire(
  'Error',
  '<?php echo e($issue->error); ?>',
  'Error'
)
setTimeout(function() {
  window.location.href = "/tools-issue";
}, 1200);

<?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WAFT-app\resources\views/Tools/AddIssue.blade.php ENDPATH**/ ?>