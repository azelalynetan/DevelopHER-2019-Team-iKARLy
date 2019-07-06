<html>
<head>
    <title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('game/do_upload');?>

<input type="file" name="charfile"/>

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>