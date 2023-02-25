<!DOCTYPE html>
<html lang="en">
<head>
  <title>fbpost</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>


		<div class="container mt-5">
		<div class="row">
		<div class="col-md-10 offset-md-1">
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

		<div id="body">
		<form action="<?php echo base_url();?>uploadxmlfile" method="post" enctype="multipart/form-data">
			<div class="error"></div>
			<h2>Upload XML File</h2>
			<br>
			<label for="fileSelect">Filename:</label>
			<input type="file" name="xmlfile" id="fileSelect">
			<input type="submit" name="submit" value="Upload">
		</form>
		</div>
		</div>
		</div>
		</div>

</body>
</html>
