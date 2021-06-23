<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2 style="color:#FF0000">Page 3 [Home]</h2>
    <h2 style="color:#FF0000">Conversion Site</h2>
    <a href="home.php">1.Home</a>
    <a href="conversion-rate.html">2.Conversion Rate</a>
    <a href="history.php">3.History</a>

    <?php
    define("filepath", "history.txt");
$fileData = read();

 if(empty($fileData)) {
echo "No history to show";
}
else {
    $i=1;
    $data = json_decode($fileData);
foreach($data as $x => $x_value) {
     var_dump($x_value);
//     echo $i.".";
//   echo  $x . " " . $x_value;
//    echo "<br>";
  }
}

function read() {
    $file = fopen(filepath, "r");
    $fz = filesize(filepath);
    $fr = "";
    if($fz > 0) {
    $fr = fread($file, $fz);
    }
    fclose($file);
    return $fr;
    }
    ?>
    
    <br><br>
    <h2 style="color:#FF0000">Conversion History:</h2>
    
</body>
</html>