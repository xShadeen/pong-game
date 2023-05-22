

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
$user = new Register_new;
echo $user->_logout() ;
echo '<p><form class="form" action="../index.php">
    <input type="submit" value="Main page" />
    </form></p>' ;
?>
    </body>
</html>