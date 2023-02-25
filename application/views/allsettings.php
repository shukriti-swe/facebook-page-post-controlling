<!DOCTYPE html>
<html lang="en">
<head>
  <title>fbpost</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <style>

.modal_button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Float cancel and delete buttons and add an equal width */
.cancelbtn, .deletebtn {
  float: left;
  width: 50%;
}

/* Add a color to the cancel button */
.cancelbtn {
  background-color: #ccc;
  color: black;
}

/* Add a color to the delete button */
.deletebtn {
  background-color: #f44336;
}

/* Add padding and center-align text to the container */
.container {
  padding: 16px;
  text-align: center;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #76767259;
  padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 35%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
 
/* The Modal Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and delete button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .deletebtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<header class="bg-light p-2">
 <div class="container">
   <div class="d-flex align-items-center">
        <h3 class="m-0 me-2">Fb<span class="text-primary">Post</span></h3>
        <div class=" me-2 w-100 text-end">
            <a class="px-2 text-decoration-none" href="<?php echo base_url('home'); ?>">Home</a>
            <a class="px-3 text-decoration-none" href="<?php echo base_url(); ?>settings">Create Project</a>
        </div> 
        <div class="btn-group ms-auto">

          <button type="button" class="btn btn-primary dropdown-toggle rounded-pill" data-bs-toggle="dropdown" aria-expanded="false">
            Admin
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            
            <li><a class="dropdown-item" href="<?php echo base_url(); ?>changepassword">Change Password</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url(); ?>logout">Logout</a></li>
          </ul>
        </div>
   </div>
 </div>
</header>
<div class="container mt-5" style="min-height: 74vh;">
     
      <?php if($this->session->flashdata('success')):?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?php echo $this->session->flashdata('success');?></strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif ?>

      <?php if($this->session->flashdata('success_login')):?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <p style="text-align: center;font-weight:bold;"><?php echo $this->session->flashdata('success_login');?></p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif ?>

      <?php if($this->session->flashdata('change_pass')):?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <p style="text-align: center;font-weight:bold;"><?php echo $this->session->flashdata('change_pass');?></p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif ?>
      
 


    <div class="row">
        <div class="col-md-12 table-responsive">
            <h4>All Project</h4>
        <table class="table table-hover">
    <thead>
      <tr>
        <th>Project name</th>
        <th>Status</th>
        <th>Frequency</th>
        <th>FB api/Id</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
<?php foreach ($settings as $setting){?>
      <tr>
        <td class="text-wrap"><?php  echo $setting->project_name; ?></td>
       <td class="text-wrap" style="width: 400px;"><?php 
        if($setting->status==1){
          echo "<p style='color:green;'><b>Running</b></p>";
        }elseif($setting->status==0){
          echo "<p style='color:red;'><b>Stopped</b></p>";
        }elseif($setting->status==3){
           echo "<p style='color:gray;'><b>Delete</b></p>";
        }elseif($setting->status==4){
          echo "<p style='color:red;'><b>".$setting->error_message."</b></p>";
       }
        
        ?></td>
        <td class="text-wrap"><?php  echo $setting->frequency; ?> Hour</td>
        <td class="text-wrap"><?php  echo $setting->app_id.'/'.$setting->fb_page_id; ?></td>
        <td>
        <a class="btn btn-sm btn-primary"  href="<?php echo base_url(); ?>view/<?php  echo $setting->id; ?>"><i class="fas fa-file-upload"></i></a>&nbsp;
        <a class="btn btn-sm btn-success" href="<?php echo base_url(); ?>edit-settings/<?php  echo $setting->id; ?>"><i class="fas fa-edit"></i></a>&nbsp;
        <a class="btn btn-sm btn-danger" onclick="document.getElementById('id01').style.display='block'"><i class="fas fa-trash-alt"></i></a>
        </td>
      </tr>

      <?php } ?>

    </tbody>
  </table>
        </div>
    </div>
</div>
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
  <form class="modal-content" action="/action_page.php">
    <div class="container">
      <h1>Delete Project</h1>
      <p>Are you sure you want to delete your project?</p>
    
      <div class="clearfix">
        <a type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn modal_button">Cancel</a>
        <a type="button" href="<?php echo base_url(); ?>delete-settings/<?php  echo $setting->id; ?>" class="deletebtn modal_button">Delete</a>
      </div>
    </div>
  </form>
</div>
<footer class="bg-dark text-white p-3 text-center">
    Copyright © 2022 FbPost. All Rights Reserved.
</footer>
  <script>
  var modal = document.getElementById('id01');
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
  </script>
</body>
</html>