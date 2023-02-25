<!DOCTYPE html>
<html lang="en">
<head>
  <title>fbpost</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
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
        <td class="text-wrap"><?php 
        if($setting->status==1){
          echo "<p style='color:green;'><b>Running</b></p>";
        }elseif($setting->status==0){
          echo "<p style='color:red;'><b>Stopped</b></p>";
        }elseif($setting->status==3){
           echo "<p style='color:gray;'><b>Delete</b></p>";
        }
        
        ?></td>
        <td class="text-wrap"><?php  echo $setting->frequency; ?> Hour</td>
        <td class="text-wrap"><?php  echo $setting->app_id.'/'.$setting->fb_page_id; ?></td>
        <td>
        <a class="btn btn-sm btn-primary"  href="<?php echo base_url(); ?>view/<?php  echo $setting->id; ?>"><i class="fas fa-file-upload"></i></a>&nbsp;
        <a class="btn btn-sm btn-success" href="<?php echo base_url(); ?>edit-settings/<?php  echo $setting->id; ?>"><i class="fas fa-edit"></i></a>&nbsp;
        <a class="btn btn-sm btn-danger" href="<?php echo base_url(); ?>delete-settings/<?php  echo $setting->id; ?>"><i class="fas fa-trash-alt"></i></a>
        </td>
      </tr>

      <?php } ?>

    </tbody>
  </table>
        </div>
    </div>
</div>
<footer class="bg-dark text-white p-3 text-center">
    Copyright © 2022 FbPost. All Rights Reserved.
</footer>
</body>
</html>