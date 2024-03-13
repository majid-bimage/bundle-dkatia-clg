<!-- upload_form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Multiple Files</title>
</head>
<body>
    <h2>Upload Multiple Files</h2>
    <form action="<?php echo base_url('BundleController/do_upload'); ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="userfiles[]" multiple>
        <input type="submit" value="Upload">
    </form>
</body>
</html>
