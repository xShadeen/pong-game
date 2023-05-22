<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body class="main_page">
    <?php
function __autoload($class_name) {
include "../Class/".$class_name . '.php' ;
}
$reg = new Register_new ;
$reg->_read();
// $reg->_write();
echo $reg->_save();
echo '<p><form class="form" action="../index.php">
    <input type="submit" value="Home page" />
    </form></p>' ;
?>
    </body>
</html>