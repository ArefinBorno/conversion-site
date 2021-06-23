<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

    <h2 style="color:#FF0000">Page 1 [Home]</h2>
    <h2 style="color:#FF0000">Conversion Site</h2>
    <a href="home.php">1.Home</a>
    <a href="conversion-rate.html">2.Conversion Rate</a>
    <a href="history.php">3.History</a>
    <br><br>
    <h2 style="color:#FF0000">Converter:</h2>

    <?php
    define("filepath", "history.txt");

    $result=$value=$category="";
    $valueErr=$categoryErr="";
    $flag = false;
    $successfulMessage = $errorMessage = "";

    if($_SERVER['REQUEST_METHOD']=="POST"){
    if(empty($_POST['value'])){
        $valueErr="Please enter the value to be converted";
        $flag = true;
    }else{
        if(!preg_match('/^[0-9]*$/', $_POST['value'])){
            $valueErr="Please enter a number";
            $flag = true;
        }else{
            $value=$_POST['value'];}
      }

    if(!empty($_POST['category'])&&empty($valueErr)){
        $category=$_POST['category'];
        if($category=='Feet to Inch'){
          $result=feet_to_inch($value);
      }else{
        $result=inch_to_feet($value);
      }
    }else{
        $categoryErr="Conversion method required";
        $flag = true;
      }
    }

    function feet_to_inch($data){
        $data=$data*12;
        return $data;
    }

    function inch_to_feet($data){
        $data=$data/12;
        return $data;
    }


    if(!$flag) {
        $fileData = read();
        
         if(empty($fileData)) {
        $data[] = array("category" => $category, "value" => $value,"result"=>$result);
        }
        else {
        $data[] = json_decode($fileData);
        array_push($data, array("category" => $category, "value" => $value,"result"=>$result));
        }
        
         $data_encode = json_encode($data);
        write("");
        $res = write($data_encode);
        if($res) {
        $successfulMessage = "Sucessfully saved.";
        }
        else {
        $errorMessage = "Error while saving.";
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
        
     function write($content) {
    $file = fopen(filepath, "w");
    $fw = fwrite($file, $content . "\n");
    fclose($file);
    return $fw;
    }

    ?>



    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        Category:
        <select name="category">
        <option>Select an option</option>
        <option <?php if($category == 'Feet to Inch') { echo " selected";}?> value="Feet to Inch">Feet to Inch</option>
            
        <option <?php if($category == 'Inch to Feet') { echo " selected";}?> value="Inch to Feet">Inch to Feet</option>
    </select>
    <br>
    <br> 

    Value:<input type="text" name="value" value="<?php echo $value;?>">
    <span style="color:#FF0000"><?php echo $valueErr;?></span>
    <br><br>
    Result:<input type="text" name="result" value="<?php echo $result;?>">
    <br><br>
    <input type="submit" name="submit" value="Submit">
    <br><br>
    

    </form>
    
    <span style="color: green"><?php echo $successfulMessage; ?></span>
    <span style="color: red"><?php echo $errorMessage; ?></span>


</body>
</html>