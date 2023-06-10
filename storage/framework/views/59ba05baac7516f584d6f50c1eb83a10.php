<?php $__env->startSection('content'); ?>
  <div id="body-div" class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    My Ticket
                    <small>Tickets Created</small>
                </h3>
            </div>
        </div>
        <div class="card-body">
        <!-- Modal -->
            <table id="tickets" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table data goes here -->
                </tbody>
            </table>
        </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>
    $(document).ready(function () {
        $('#tickets').DataTable({
            "scrollY":"400px",
            "scrollCollapse":false,
            "paging":true,
            "searching": true,
            "ajax": {
                url: '/api/my-tickets/<?php echo e(session()->get("user")->id); ?>', // Replace with the actual API endpoint
                method: 'GET',
                dataType: 'json',
                dataSrc: function(response) {
                    return response; // Return the array of ticket objects from the API response
                }
            },
            columns: [
            { data: null,
                render: function ( data, type, row ) {
                    return "<h4><bold>"+row.ticket_subject+"</bold></h4>"+
                            "<div><small>From:"+row.requester+"</small></div>"+
                            "<div>Requested By:"+row.name+"</div>";
                }
            },
            { data: "state"},
            { data: null,
                 render: function ( data, type, row ) {
                    return "Now";
                }
            }
        ]
        });
    });
    function modal(data){
        document.getElementById("modal-name").value="<?php echo e(session()->get('user')->name); ?>";
        document.getElementById("modal-pos").value=data.position;
        document.getElementById("modal-email").value="<?php echo e(session()->get('user')->email); ?>";
        document.getElementById("modal-dept").value=data.requester;
        document.getElementById("modal-subject").value=data.ticket_subject;
        document.getElementById("modal-descript").value=data.ticket_description;
        document.getElementById("modal-id").value=data.id;

    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WAFT-app\resources\views/Ticket/MyTickets.blade.php ENDPATH**/ ?>