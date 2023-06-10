<!DOCTYPE html>
<htm lang="<?php echo e(app()->getlocale()); ?>">

    <head>
        <meta chart="utf-8">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title>Laravel</title>
        <!-- Fonts -->
        <link rel="precnnet" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

        <link rel="canonical" href="https://keenthemes.com/metronic" />
        <!--begin::Fonts-->
        <!--end::Fonts-->
        <!-- <link href="<?php echo e(asset('css/app.css')); ?>" re="stylesheet" type="text/css" /> -->
        <link href="<?php echo e(asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/css/pages/login/login-3.css')); ?>" rel="stylesheet" type="text/css" />
        <!--end::Page Vendors Styles-->
        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="<?php echo e(asset('assets/plugins/global/plugins.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/plugis/custom/prismjs/prismjs.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/css/style.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles-->
        <!--begin::Layout Themes(used by all pages)-->
        <link href="<?php echo e(asset('assets/css/themes/layout/header/menu/light.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/css/themes/layout/header/menu/light.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/css/themes/layout/brand/dark.css')); ?>" rel="stylesheet" type="text/css" />
         <link href="<?php echo e(asset('assets/css/themes/layout/aside/dark.css')); ?>" rel="stylesheet" type="text/css" />
        <!--end::Layout Themes-->
        <link rel="shortcut icon" href="<?php echo e(asset('asses/media/logos/favicon.ico')); ?>" />
        <style>
            body{
            background-color:#3F4254;
            }
        </style>

   <body>
    <div id="login" class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <div>Login</div>
            </div>
        </div>
        <div id="card-body" class="card-body">
            <form method="POST" action="/authenticate">
            <?php echo csrf_field(); ?>
            <div class="row">
                <label for="name">Email</label>
                <input class="form-control" name="email" id="email" type="email" />
            </div>
           
            <div class="row">
                <label>Password:</label>
                <input class="form-control" name="password" id="password" type="password" />
            </div>
          
            
            
                <input id="lgn-btn" type="submit" value="Add" class="btn btn-primary" />
        </form>
        

        </div>
        </div>

		<!--end::Main-->
		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>

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
        <script src="<?php echo e(asset('js/sweetalert2.js')); ?>"></script>
        <!--end::Page Scripts-->

</body>


<script>
<?php if(isset($user->result)): ?>
    Swal.fire(
    'Success',
    'Login Successful',
    'success'
    )
    setTimeout(function() {
   window.location.href = "/dashboard";
}, 1500); 
    
<?php endif; ?>
<?php if(isset($user->error)): ?>
    Swal.fire(
    'Error',
    '<?php echo e($user->error); ?>',
    'error'
    )
    setTimeout(function() {
    window.location.href = "/";
}, 1500); 
    
<?php endif; ?>
</script>

<footer>
<footer>

</html>
<?php /**PATH C:\xampp\htdocs\WAFT-app\resources\views/welcome.blade.php ENDPATH**/ ?>