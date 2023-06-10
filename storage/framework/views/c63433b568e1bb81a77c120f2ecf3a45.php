<?php $__env->startSection('content'); ?>
    <div id="body-div" class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    Users
                    <small>User Pages</small>
                </h3>
            </div>
        </div>
        <div id="card-body" class="card-body">
            <!-- Modal -->
            <table id="users" class="table table-bordered">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Gmail</th>
                        <th>Department/Branch</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <!-- Table data goes here -->
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="roles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <form id="role-assign" onsubmit="submitRoles(event)">
                        <?php echo csrf_field(); ?>
                        <nav id="name"></nav>
                        <hr>
                        <div class="row">
                            <div style="float: left;margin-left: 30px" class="col-5">
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
                            <div style="float: left"  class="col-5">
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
                        <input type="hidden" value="" name="users" id="uid">
                        <input type="submit" value="Submit" class="btn btn-success">

                    </form>

                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        // Prevent form submission
        function submitRoles(event){
            event.preventDefault(); // Prevent form submission
            var form = event.target; // Get the form element
            var formData = new FormData(form); // Get form data

            axios.post('/assign-role', formData)
                .then(function(response) {
                    console.log(response);
                    Swal.fire(
                        'Add Succeded',
                        response,
                        'success'
                    )
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        $(document).ready(function () {
            $('#users').DataTable({
                "scrollY":"340px",
                "scrollCollapse":true,
                "paging":false,
                "searching": true,
                data:  <?php echo e($user->GetUser()); ?>,
                columns: [
                    { data: "name"},
                    { data: "email"},
                    { data: "department_name"},
                    {  data: null,
                        render: function ( data, type, row ) {
                            if(row.Roles_id==null) {
                                return "<a  data-toggle='modal' onclick='getroles("+JSON.stringify(data)+")' data-target='#roles' class='btn btn-warning'>New</a>";
                            }else{
                                return "<a  data-toggle='modal' onclick='getroles("+JSON.stringify(data)+")' data-target='#roles' class='btn btn-success'>Assigned</a>";
                            }
                        }}
                ]
            });
        });
        function getroles(resData){

            document.getElementById("requester").checked=resData.REQUESTER==1?true:false;
            document.getElementById("service").checked=resData.SERVICE_DESK==1?true:false;
            document.getElementById("personnel").checked=resData.PERSONNEL==1?true:false;
            document.getElementById("approve").checked=resData.APPROVER==1?true:false;
            document.getElementById("id").value=resData.Roles_id;
            document.getElementById("permission").value=resData.Permission_id;
            document.getElementById("uid").value=resData.id;
            document.getElementById("name").innerHTML=resData.name;
        }

    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WAFT-app\resources\views/User/User.blade.php ENDPATH**/ ?>