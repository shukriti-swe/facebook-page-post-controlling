<!DOCTYPE html>
<html lang="en">
<head>
  <title>fbpost</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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

<div class="container mt-5"   style="min-height: 74vh;">
  <div class="row">
    <div class="col-md-8 offset-md-2">
       
        <h1 style="text-align: center;">Create a new project</h1>
       


        <form action="<?php echo base_url(); ?>settings" method="post">
        <div class="mb-3">
            <label for="project_name" class="form-label">Project Name</label>
            <input type="text" class="form-control"  id="project_name" name="project_name" >
            <?php echo form_error('project_name', '<div style="color:red; class="error">', '</div>'); ?>
        </div>
        <div class="mb-3">
            <label for="fb_user_access_token" class="form-label">FB user access token</label>
            <input type="text" class="form-control"  id="fb_user_access_token" name="fb_user_access_token">
            <?php echo form_error('fb_user_access_token', '<div style="color:red; class="error">', '</div>'); ?>
        </div>
        <div class="mb-3">
            <label for="app_id" class="form-label">App id</label>
            <input type="text" class="form-control" id="app_id" name="app_id">
            <?php echo form_error('app_id', '<div style="color:red; class="error">', '</div>'); ?>
        </div>
        <div class="mb-3">
            <label for="app_secret" class="form-label">App secret</label>
            <input type="text" class="form-control"  id="app_secret" name="app_secret">
            <?php echo form_error('app_secret', '<div style="color:red; class="error">', '</div>'); ?>
        </div>
        <div class="mb-3">
          <label for="app_secret" class="form-label">Status</label>
          <select class="form-control"  name="status" id="status">
          <option value="">---select one---</option>  
            <option value="1">Start</option>
            <option value="0">Stop</option>
            <option value="3">Delete</option>
          </select>
          <?php echo form_error('status', '<div style="color:red;" class="error">', '</div>'); ?>
        </div>

        <div class="mb-3">
          <label for="app_secret" class="form-label">Frequency</label>
          <select class="form-control" name="frequency" id="frequency">
          <option value="">---select one---</option> 
            <option value="0.1">0.1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
          </select>
          <?php echo form_error('frequency', '<div style="color:red; class="error">', '</div>'); ?>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
  </div>
    
  <div class="row mt-5">
  <div class="col-md-8 offset-md-2">

    <div id="doc_info">
<h4>Graph API For Auto Post To Your Facebook Pages</h4>
<p><b>To obtain Facebook App ID and App Secret</b></p>
   <p>1.Create a Business type Facebook App by following the link below.  <a href="https://developers.facebook.com/apps/">https://developers.facebook.com/apps/</a> </p>

   <img class="img-fluid mb-3" src="./uploads/img/1.png" alt="">
<p>2.Fill the App details as shown in the image below then, Create the App.</p>
<img class="img-fluid mb-3" src="./uploads/img/2.png" alt="">
<p>3.After creating the App you can find App ID and App Secret in App Dashboard >> Settings >> Basic as shown in the image below.</p>
<img class="img-fluid mb-3" src="./uploads/img/3.png" alt="">
<p><b>To obtain the User Access Token for the App that you just created</b></p>
<p>1.Click on the link below to go to Facebook's Graph API Explorer. <a href="https://developers.facebook.com/tools/explorer/">https://developers.facebook.com/tools/explorer/</a></p>
<p>2.Select the App that you just created and then select required permissions. The required permissions for publishing content to your facebook page are pages_show_list, pages_read_engagement, pages_manage_posts.</p>
<p>3.Select the type of token that you want to generate. In this case you need User Access Token.</p>
<p>4.After selecting the App, the required permissions and the required access token you can click on Generate Access Token to generate the required access token.</p>
<img class="img-fluid mb-3" src="./uploads/img/4.png" alt="">
    </div>

        </div>
    </div>

</div>
<footer class="bg-dark text-white p-3 text-center">
    Copyright © 2022 FbPost. All Rights Reserved.
</footer>
</body>
</html>
