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

<div class="container mt-5 mb-4"   style="min-height: 74vh;">
  <div class="row">
    <div class="col-md-10 offset-md-1">
    <h3 style="text-align:center;text-decoration:underline;">Project of "<?=$setting->project_name?>"<a href="<?=$_SERVER['HTTP_REFERER']?>" style="float: right;color:blue;"><i class="fas fa-arrow-alt-circle-left"></i></a></h3>
       
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
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 offset-md-1">
    <p><a href="javascript:void(0)" id="showhide">Add XML</a></p>

    <?php if($this->session->flashdata('error')):?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong><?php echo $this->session->flashdata('error');?></strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif ?>
      <?php if($this->session->flashdata('success')):?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?php echo $this->session->flashdata('success');?></strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif ?>

      <?php if($this->session->flashdata('faild')):?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong><?php echo $this->session->flashdata('faild');?></strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif ?>

      <?php if($this->session->flashdata('xml_faild')):?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong><?php echo $this->session->flashdata('xml_faild');?></strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif ?>

		<div id="body">
		<form id="xml_from" action="<?php echo base_url();?>uploadxmlfile/<?php echo $id ?>" method="post"  enctype="multipart/form-data">
			<div class="error"></div>
			<p>Upload XML File</p>
			<br>
			<label for="fileSelect">Filename:</label>
			<input type="file" name="xmlfile" id="fileSelect">
			<input type="submit" name="submit" value="Upload">
		</form>

    </div>
  </div>


  <div class="row">
    <div class="col-md-10 offset-md-1">
       
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
