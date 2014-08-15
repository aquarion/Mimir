<?PHP


?>
<form enctype="multipart/form-data" action="/mysterious/import" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <!-- Name of input element determines name in $_FILES array -->
    Send this file: <input name="import" type="file" />
    <input type="submit" value="Send File" />
</form>
<?PHP
