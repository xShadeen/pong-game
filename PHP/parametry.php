<!DOCTYPE html>
<html>
    <head>
        <title>Pong game</title>
        <link rel="stylesheet" href="../style.css">
        
    </head>
    <body class="main_page">
    <canvas id="canvas" hidden="true" ></canvas>
    <script src="../script.js"></script>
    <div id="div">
    <?php
require '../Vendor/vendor/autoload.php';
include '../Vendor/rest/mongo.php';
session_start();
$db = new db();
$data = $db->select();
echo 'Your saved parameters: <br><br>';
foreach($data as $row){
    if($row["login"] == $_SESSION['login']){
        echo "<p>Computer speed = ".$row["computerSpeed"]."<br>";
        echo "Ball speed = ".$row["ballSpeed"]."<br>";
        $compSpeed = $row["computerSpeed"];
        $ballSpeed = $row["ballSpeed"];
        echo '<button onclick="game('.$compSpeed.','.$ballSpeed.');hideDiv()"> Load parameters</button><br></p>'; 
    }
}
?>
<button onclick="location.href='../index.php'">Home page</button>
</div>
<script>
function hideDiv() {
  document.getElementById("div").style.display = "none";
}
</script>
</body>
</html>

