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

  <div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
      <div class="col-6">
        <div class="card"> 
          <div class="card-body p-5">

            <?php if($this->session->flashdata('invalid')):?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><?php echo $this->session->flashdata('invalid');?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif ?>

            <?php if($this->session->flashdata('logout')):?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><?php echo $this->session->flashdata('logout');?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif ?>

             <form action="<?php echo base_url(); ?>" method="post">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                  <?php echo form_error('email', '<div style="color:#ff0505" class="error">', '</div>'); ?>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                  <?php echo form_error('password', '<div style="color:#ff0505" class="error">', '</div>'); ?>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
              
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
