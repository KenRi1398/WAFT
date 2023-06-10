<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">

    <head>
        <meta charet="utf-8">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title>WAFT</title>
        <!-- Fonts -->
        <link rel="precnnet" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
        <link rel="canonical" href="https://keenthemes.com/metronic" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <!-- <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" type="text/css" /> -->
        <!--begin::Page Vendors Styles(used by this page)-->
        <link href="<?php echo e(asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <!--end::Page Vendors Styles-->
        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="<?php echo e(asset('assets/plugins/global/plugins.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/plugins/custom/prismjs/prismjs.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/css/style.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles-->
        <!--begin::Layout Themes(used by all pages)-->
        <link href="<?php echo e(asset('assets/css/themes/layout/header/base/light.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/css/themes/layout/header/menu/light.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/css/themes/layout/brand/dark.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/css/themes/layout/aside/dark.css')); ?>" rel="stylesheet" type="text/css" />
        <!--end::Layout Themes-->
        <link rel="shortcut icon" href="<?php echo e(asset('assets/media/logos/favicon.ico')); ?>" />
        <link href="<?php echo e(asset('datatables/datatables.min.css')); ?>" rel="stylesheet"/>


        <style>
          .swal2-show {
              justify-content: center !important;
              align-items: center !important;
          }
        </style>
    </head>

    <body class="antialiased">
        <nav id="navbar" style="position:fixed" class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">WAFT</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02"
                    aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor02">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link " href="#">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href=""></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href=""></a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <ul class="navbar-nav me-auto">
                          <li class="nav-item">

                          </li>
                          <li class="nav-item">
                            <p class="nav-link active"><i class='fas fa-user'></i> <?php echo e(session()->get("user")->name); ?>

                            </p>
                          </li>

                        </ul>

                    </div>
                </div>
            </div>
        </nav>

        <!-- side bar -->
<div id="sidebar" style="position:fixed" class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 200px;height:700px">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
    <li>
        <a href="/dashboard" class="nav-link text-white">
          <i class="fas fa-bars"></i>
          Dashboard
        </a>
      </li>
      <?php if(session()->get("user")->SERVICE_DESK==1): ?>
      <li class="nav nav-pills flex-column mb-auto">
        <a href="/inbox" class="nav-link text-white" aria-current="page">
        <i class="far fa-envelope"></i>
          Inbox
        </a>
      </li>
      <?php endif; ?>
       <?php if(session()->get("user")->REQUESTER==1): ?>
      <li class="nav nav-pills flex-column mb-auto">
        <a href="/create" class="nav-link text-white" aria-current="page">
          <i class="far fa-edit"></i>
          Create Ticket
        </a>
      </li>
        <li class="nav nav-pills flex-column mb-auto">
            <a href="/my-tickets" class="nav-link text-white" aria-current="page">
                <i class="fas fa-bell"></i>
                My Tickets
            </a>
        </li>


      <?php endif; ?>




      <?php if(session()->get("user")->PERSONNEL==1): ?>
      <li>
        <a href="/my-tasks" class="nav-link text-white">
        <i class="fas fa-book"></i>
          Task
        </a>
      </li>
        <?php endif; ?>
      <li>
        <a href="/tools" class="nav-link text-white">
          <i class="fas fa-cog"></i>
          Tools
        </a>
      </li>
        <?php if(session()->get("user")->Permission_id==1): ?>
      <li>
        <a href="/user" class="nav-link text-white">
            <i class="fas fa-user"></i>
            User
        </a>
      </li>
        <?php endif; ?>
    </ul>

    <hr>
    <div class="row">

      <a href="/logout" class="btn btn-success"><i class="fas fa-sign-out-alt"></i>Log Out</a>
    </div>

</div>
        <?php echo $__env->yieldContent('content'); ?>
        <!-- <script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/jquery-3.7.0.min.js')); ?>"></script>  -->
    <!--begin::Global Theme Bundle(used by all pages)-->
		<script src="<?php echo e(asset('assets/plugins/global/plugins.bundle.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/plugins/custom/prismjs/prismjs.bundle.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/js/scripts.bundle.js')); ?>"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Vendors(used by this page)-->
		<script src="<?php echo e(asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')); ?>"></script>
		<!--end::Page Vendors-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="<?php echo e(asset('assets/js/pages/widgets.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-3.7.0.js')); ?>"></script>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('datatables/datatables.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<!--end::Page Scripts-->
    </body>
     <script src="<?php echo e(asset('js/sweetalert2.js')); ?>"></script>
     <script src="<?php echo e(asset('js/axios.min.js')); ?>"></script>
    <?php echo $__env->yieldContent('script'); ?>
        <script>
            $(document).ready(function() {
                $('#sidebarToggle').click(function() {
                    $('#sidebarCollapse').collapse('toggle');
                });
            });
        </script>
    </html>
<?php /**PATH C:\xampp\htdocs\WAFT-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>