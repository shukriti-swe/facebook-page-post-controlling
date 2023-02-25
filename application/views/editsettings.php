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
            <a class="px-2 text-decoration-none" href="<?php echo base_url(); ?>home">Home</a>
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

<div class="container mb-5 mt-5"  style="min-height: 74vh;">
  <div class="row">
    <div class="col-md-8 offset-md-2">
     
      <h1 style="text-align:center;text-decoration:underline;"> Overview<a href="<?php echo base_url(); ?>home"" style="float: right;color:blue;"><i class="fas fa-arrow-alt-circle-left"></i></a></h1>
    
       
        <p class="mb-0"><b>Total Process : <?php echo $alldata; ?></b></p>
        <p class="mb-0"><b>process complete : <?php echo $process; ?></b></p>
        <p class="mb-0"><b>Process remaining : <?php echo ($alldata - $process) ; ?></b></p>
        <div style="display: flex;"> <b>status</b> : <?php 
        if($setting->status==1){
          echo " <p style='color:green;'><b> Running</b></p>";
        }elseif($setting->status==0){
          echo " <p style='color:red;'><b> Stopped</b></p>";
        }elseif($setting->status==3){
           echo " <p style='color:gray;'><b> Delete</b></p>";
        }elseif($setting->status==4){
          echo "<p style='color:red;'><b>".$setting->error_message."</b></p>";
       }
        
        ?></div>
       

        
        <form action="<?php echo base_url(); ?>edit-settings/<?php echo $setting->id; ?>" method="post">
        <div class="mb-3">
            <label for="project_name" class="form-label">Project Name</label>
            <input type="text" class="form-control" value="<?php echo $setting->project_name; ?>" id="project_name" name="project_name">
        </div>
        <div class="mb-3">
            <label for="fb_user_access_token" class="form-label">FB user access token</label>
            <input type="text" class="form-control" value="<?php echo $setting->fb_user_access_token; ?>" id="fb_user_access_token" name="fb_user_access_token">
        </div>
        <div class="mb-3">
            <label for="app_id" class="form-label">App id</label>
            <input type="text" class="form-control" value="<?php echo $setting->app_id; ?>" id="app_id" name="app_id">
        </div>
        <div class="mb-3">
            <label for="app_secret" class="form-label">App secret</label>
            <input type="text" class="form-control" value="<?php echo $setting->app_secret; ?>" id="app_secret" name="app_secret">
        </div>

        <div class="mb-3">
          <label for="app_secret" class="form-label">status</label>
          <select class="form-control"  name="status" id="status">
            <option value="1" <?php if($setting->status==1){echo "selected";} ?>>Running</option>
            <option value="0" <?php if($setting->status==0){echo "selected";} ?>>Stop</option>
            <option value="3" <?php if($setting->status==3){echo "selected";} ?>>Delete</option>
            <option value="4" <?php if($setting->status==4){echo "selected";} ?>>occurred error</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="app_secret" class="form-label">Frequency</label>
          <select class="form-control" name="frequency" id="frequency">
           <option value="0.1" <?php echo ($setting->frequency == 0.1 ? 'selected':''); ?>>0.1</option>
            <option value="2" <?php echo ($setting->frequency == 2 ? 'selected':''); ?>>2</option>
            <option value="3" <?php echo ($setting->frequency == 3 ? 'selected':''); ?>>3</option>
            <option value="4" <?php echo ($setting->frequency == 4 ? 'selected':''); ?>>4</option>
            <option value="5" <?php echo ($setting->frequency == 5 ? 'selected':''); ?>>5</option>
            <option value="6" <?php echo ($setting->frequency == 6 ? 'selected':''); ?>>6</option>
            <option value="7" <?php echo ($setting->frequency == 7 ? 'selected':''); ?>>7</option>
            <option value="8" <?php echo ($setting->frequency == 8 ? 'selected':''); ?>>8</option>
            <option value="9" <?php echo ($setting->frequency == 9 ? 'selected':''); ?>>9</option>
            <option value="10" <?php echo ($setting->frequency == 10 ? 'selected':''); ?>>10</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    </div>
  </div>
    
  
</div>
<footer class="bg-dark text-white p-3 text-center">
    Copyright © 2022 FbPost. All Rights Reserved.
</footer>
</body>
</html>
