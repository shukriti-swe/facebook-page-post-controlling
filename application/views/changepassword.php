<!DOCTYPE html>
<html lang="en">
<head>
  <title>fbpost</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <style>
      #xml_from{
          display:none;
      }
  </style>
</head>
<body>
<header class="bg-light p-2">
 <div class="container">
   <div class="d-flex align-items-center">
        <h3 class="m-0 me-2">Fb<span class="text-primary">Post</span></h3>
        <div class=" me-2 w-100 text-end">
            <a class="px-2 text-decoration-none" href="<?php echo base_url(); ?>allsettings">Home</a>
            <a class="px-3 text-decoration-none" href="<?php echo base_url(); ?>settings">Create Project</a>
        </div> 
        <div class="btn-group ms-auto">

          <button type="button" class="btn btn-primary dropdown-toggle rounded-pill" data-bs-toggle="dropdown" aria-expanded="false">
            Admin
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="<?php echo base_url(); ?>changepassword">Change Password</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url(); ?>">Logout</a></li>
          </ul>
        </div>
   </div>
 </div>
</header>

<div class="container mt-5 mb-4"  >
  <div class="row justify-content-center align-items-center "   style="min-height: 74vh;">
      <div class="col-6">
        <div class="card"> 
          <div class="card-body p-5">
             <form action="<?php echo base_url(); ?>changepassword" method="post">
              
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Old Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" name="old_pass">
                  <?php echo form_error('old_pass', '<div style="color:#ff0505" class="error">', '</div>'); ?>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">New Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" name="new_pass">
                  <?php echo form_error('new_pass', '<div style="color:#ff0505" class="error">', '</div>'); ?>
                </div>
                
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
              
          </div>
        </div>
      </div>
    </div>
</div>
 </div>
<footer class="bg-dark text-white p-3 text-center">
    Copyright © 2022 FbPost. All Rights Reserved.
</footer>
<script>
$( document ).ready(function() {
    $('#showhide').on('click',function(){
       $('#xml_from').toggle();
    })
});
</script>

</body>
</html>
