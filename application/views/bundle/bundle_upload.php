<!-- insert_data_view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data Form</title>
</head>
<body>
    <h2>Insert Data Form</h2>
    <?php echo form_open('your_controller/insert_data'); ?>
        <label for="id">ID:</label>
        <input type="text" name="id" id="id"><br>

        <label for="schid">School ID:</label>
        <select name="schid" id="schid">
            <?php foreach ($schid_options as $id => $name): ?>
                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="programid">Program ID:</label>
        <select name="programid" id="programid">
            <?php foreach ($programid_options as $id => $name): ?>
                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="sectionid">Section ID:</label>
        <select name="sectionid" id="sectionid">
            <?php foreach ($sectionid_options as $id => $name): ?>
                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select><br>

        <!-- Add select menus for other "id" fields -->

        <input type="submit" value="Submit">
    <?php echo form_close(); ?>
</body>
</html>
