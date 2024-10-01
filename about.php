<?php
session_start(); 

if (!isset($_SESSION['name'])) {
    header("Location: home.php"); 
    exit();
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style> 
        body {
             margin: 0; 
            height: 100vh; 
            background-image: url('back.png');
            background-size: cover; 
            background-repeat: no-repeat; 
            background-position: center; 
            color: #ffffff; 
        } 
        .back {
            background-color: #495057;
            padding: 5px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);     
        }
        .class-body {
            color: #000; 
        }
        .text-center{
            color: #000; 
        }
    </style>
</head>

<body>

<div class="container mt-5">
    <h1 class="text-center">User Details</h1>
    <div class="back"> 
        <div class="card">
            <div class="card-body class-body"> 
                <p><strong>Name:</strong> <?php echo $_SESSION['name']; ?></p>
                <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
                <p><strong>Phone:</strong> <?php echo $_SESSION['phone']; ?></p>
                <p><strong>Gender:</strong> <?php echo $_SESSION['gender']; ?></p>
                <p><strong>Country:</strong> <?php echo $_SESSION['country']; ?></p>
                <p><strong>Skills:</strong> <?php echo $_SESSION['skills']; ?></p>
                <p><strong>Biography:</strong> <?php echo $_SESSION['biography']; ?></p>
            </div>
        </div>
    
        <div class="text-center mt-4">
            <a href="home.php" class="btn btn-primary">Back to Registration</a>
        </div>
    </div>
</div>

</body>
</html>
