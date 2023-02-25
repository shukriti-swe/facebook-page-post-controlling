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



<div class="container mt-5">
  <div class="row">
    <div class="col-md-8 offset-md-2">
        <form action="<?php echo base_url(); ?>changepage/<?php echo $id; ?>" method="post">
            <div class="mb-3">
              <h1 style="text-align: center;">Create a Project of "<?=$project_name?>"</h1>
                <div class="form-group">
                <label for="exampleFormControlSelect1">Select a page that you want to post</label>
                <select class="form-control" name="page" id="exampleFormControlSelect1" required>
                <option>Select page</option>
                <?php foreach($data as $page){?>
                <option value="<?php echo $page['id']; ?>"><?php echo $page['name']; ?></option>
                <?php }?>
                </select>
                </div>
            </div>
      
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
  </div>
</div>

</body>
</html>
