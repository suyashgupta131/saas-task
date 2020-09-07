<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<button type="button" class="btn btn-success btn-lg fix shack" data-toggle="modal" data-target="#myModal">
        <span class="glyphicon glyphicon-earphone sp" style="font-size: 40px;"></span>
    </button> 
    <!-- <div style="position: fixed; bottom: 0; right: 0; color: white; font-size: 30px; margin: 5px;">Request for Call</div> -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div role="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#callNow" class="nav-link" aria-controls="uploadTab" role="tab" data-toggle="tab">Call Now</a>
    
                            </li>
                            <li role="presentation"><a href="#requestCall" aria-controls="browseTab" class="nav-link" role="tab" data-toggle="tab">Request a Call</a>
    
                            </li>
                            <div class="panel rounded"></div>
                        </ul>
                        
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="callNow">
                                <div class="innerContent">
                                    
                                    <div class="container">
                                        <form class="form-inline" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                                <input id="num" type="text" class="form-control input-lg" name="num" placeholder="Enter the Number..">
                                            </div>
                                            <button type="submit" class="btn btn-info btn-lg callButton">Call</button>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="requestCall">
                                <div class="innerContent">
                                    <form method="POST" id="myform" action="indexins.php">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input id="name" type="text" class="form-control input-lg" name="name" placeholder="Enter your Name">
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                            <input id="email" type="text" class="form-control input-lg" name="email" placeholder="Enter your Email">
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                            <input id="numb" type="text" class="form-control input-lg" name="numb" placeholder="Enter your number">
                                        </div>
                                        <br>
                                        <input type="submit" id="submit" class="btn btn-info btn-lg center-block" value="Submit"> 
                                    </form>         
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
     $num = '';
    if($_SERVER["REQUEST_METHOD"] == "POST" ) {
        if(empty($_POST["num"])) {
            echo '<script>alert("Please enter the number");</script>';
        }

        else {
            $num = test_input($_POST["num"]);
            if(preg_match("/[a-zA-Z]/", $num)) {
                echo '<script>alert("Please enter the number");</script>';
            }
            else {
                echo '<a href="tel:+91 '.$num.'">Call '. $num.'</a>';
                
            }
        }
    }
?>
</body>
</html>