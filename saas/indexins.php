<?php include 'index0.php'; ?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $numb = $_POST["numb"];
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    if(empty($name)) {
        echo '<script>alert("Please enter the Name");';
        echo "setTimeout(function(){window.location.assign('indexd.php')},100)";
        echo '</script>';
        exit();
    }

    else {
        $name = test_input($name);
        if(!preg_match("/^[a-zA-Z ]*$/",$name)) {
            echo '<script>alert("Only letters and white spaces are allowed");';
            echo "setTimeout(function(){window.location.assign('indexd.php')},100)";
            echo '</script>';
            exit();
        }
    }     


    if(empty($email)) {
        echo '<script>alert("Please enter the Email");';
        echo "setTimeout(function(){window.location.assign('indexd.php')},100)";
        echo '</script>';
        exit();
    }

    else {
        $email = test_input($email);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script>alert("Please enter valid Email");';
            echo "setTimeout(function(){window.location.assign('indexd.php')},100)";
            echo '</script>';
            exit();
        }
    }     


    if(empty($numb)) {
        echo '<script>alert("Please enter the number");';
        echo "setTimeout(function(){window.location.assign('indexd.php')},100)";
        echo '</script>';
        exit();
    }

    else {
        $numb = test_input($numb);
        if(preg_match("/[a-zA-Z]/", $numb)) {
            echo '<script>alert("only Numbers are allowed");';
            echo "setTimeout(function(){window.location.assign('indexd.php')},100)";
            echo '</script>';
            exit();
        }
    }
}

$sql = "INSERT INTO users(id,name,phone,email) VALUES('1','$name','$numb','$email')";
    $result = mysqli_query($conn,$sql);
    if(!$result) {
        echo '<script>alert("Invalid query");';
        echo "setTimeout(function(){window.location.assign('indexd.php')},100)";
        echo '</script>';
    } 
    else {
        echo '<script>alert("New record is inserted into the table");';
        echo "setTimeout(function(){window.location.assign('indexd.php')},100)";
        echo '</script>';
    }

?>