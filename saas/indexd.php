<?php include 'db.php';  ?>

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
    <title>Dashboard</title>
</head>
<body id="doc">
    <div class="container">
        <header class="text-center" style="background-color: white;">
            <h2>DASHBOARD OF USERS</h2>
        </header><br><br>
    <div class="table-responsive" style="width:100%; font-size: 20px;">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Last Call</th>
                </tr>
</thead>
                <?php
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($conn, $sql);
                    $result = mysqli_fetch_array($result);
                   
                    
                ?>
                            <tbody>
                            <tr>
                                <td> <?php echo $row["id"]; ?>    </td>
                                <td> <?php echo $row["name"]; ?>  </td>
                                <td> <?php echo $row["email"]; ?> </td>
                                <td> <?php echo $row["phone"]; ?> </td>
                             </tr>
                            </tbody>

                
                        
                  
             
            
        </table>
    </div>
    </div>
</body>
</html>

