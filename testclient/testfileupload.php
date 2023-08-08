<?php
?>
<form enctype="multipart/form-data" action="http://www.kodvin.com/abs/uploadpicfile" method="POST">
<!-- MAX_FILE_SIZE must precede the file input field -->
<input type="hidden" name="access_token" value="5a8530ea7256d" />
<!-- Name of input element determines name in $_FILES array -->
Send this file: <input name="avatarpicfile" type="file" />
<input type="submit" value="Send File" />
</form>
<?php 
?>
