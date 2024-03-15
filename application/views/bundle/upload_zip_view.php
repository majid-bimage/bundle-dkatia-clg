<!-- insert_data_view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Zip File</title>
    <style>
        label{
            margin-right:1rem;
        }
        div{
            padding:1rem;
        }
        select{
            padding:0 1rem 0 1rem;
        }
    </style>
</head>
<body>
    <h2>Upload Zip File</h2>
    <?php echo form_open_multipart('BundleController/upload_zip'); ?>
    <div>
        <label for="schid">School ID:</label>
        <select name="schid" id="schid">
            <?php
            foreach ($schid_options as $option): ?>
                <option value="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        </div>

        <div>

        <label for="programid">Program ID:</label>
        <select name="programid" id="programid">
            <?php foreach ($programid_options as $option): ?>
                <option value="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        </div>

        <div>

        <label for="sectionid">Section ID:</label>
        <select name="sectionid" id="sectionid">
            <?php foreach ($sectionid_options as $option): ?>
                <option value="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        </div>

        <div>

        <label for="examid">Exam ID:</label>
        <select name="examid" id="examid">
            <?php foreach ($examid_options as $option): ?>
                <option value="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        </div>

        <div>

        <label for="subjectid">Subject ID:</label>
        <select name="subjectid" id="subjectid">
            <?php foreach ($subjectid_options as $option): ?>
                <option value="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        </div>

        <div>

        <label for="bundlepath">Bundle Path:</label>
        <input type="file" name="zip_file"><br>
        <div>

        <label for="status">Status:</label>
        <select name="status" id="status">
            <?php foreach ($status as $option): ?>
                <option value="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        </div>

        <!-- <div>

        <label for="createdby">Created By:</label>
        <input type="text" name="createdby" id="createdby"><br>
        </div>

        <div>

        <label for="createddatetime">Created Date Time:</label>
        <input type="text" name="createddatetime" id="createddatetime"><br>
        </div> -->

        <div>

        <input type="submit" value="Submit">
            </div>
    <?php echo form_close(); ?>
</body>
</html>
