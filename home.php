<?php
session_start(); 

$Names = ""; $name = "";
$Emails = ""; $email = "";
$Pass = ""; $password = "";
$confirmpass = ""; $confirmPassword = "";
$gend = ""; $gender = "";
$Phones = ""; $phone = "";
$countryrr = ""; $country = "";
$skillsrr = ""; $skills = array();
$biographyrr = ""; $biography = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $Names = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $Names = "Only letters and spaces are allowed";
        }
    }

    if (empty($_POST["email"])) {
        $Emails = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $Emails = "Invalid email format";
        }
    }

    if (empty($_POST["password"])) {
        $Pass = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        if (strlen($password) < 8 || !preg_match("/[A-Za-z]/", $password) || !preg_match("/[0-9]/", $password) || !preg_match("/[A-Z]/", $password)) {
            $Pass = "Password must be at least 8 characters long, include at least 1 uppercase letter, and contain both letters and numbers.";
        }
    }

    if (empty($_POST["confirm-password"])) {
        $confirmpass = "Please confirm your password.";
    } else {
        $confirmPassword = test_input($_POST["confirm-password"]);
        if ($confirmPassword !== $password) {
            $confirmpass = "Passwords do not match.";
        }
    }

    if (empty($_POST["gender"])) {
        $gend = "Gender is required.";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    if (empty($_POST["phone"])) {
        $Phones = "Phone is required";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^09[0-9]{9}$/", $phone)) {
            $Phones = "Phone number must start with 09 and contain exactly 11 digits.";
        }
    }

    if (empty($_POST["country"])) {
        $countryErr = "Please select a country.";
    } else {
        $country = test_input($_POST["country"]);
    }

    if (empty($_POST["skills"])) {
        $skillsErr = "Please select at least one skill.";
    } else {
        $skills = $_POST["skills"];
    }

    if (empty($_POST["biography"])) {
        $biographyErr = "Biography is required.";
    } elseif (strlen($_POST["biography"]) > 200) {
        $biographyErr = "Biography must be 200 characters or less.";
    } else {
        $biography = test_input($_POST["biography"]);
    }

    if (empty($Names) && empty($Emails) && empty($Pass) && empty($confirmpass) && empty($Phones) && empty($gend) && empty($countryrr) && empty($skillsrr) && empty($biographyrr)) {
       
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['gender'] = $gender;
        $_SESSION['country'] = $country;
        $_SESSION['skills'] = implode(", ", $skills); 
        $_SESSION['biography'] = $biography;

  
        header("Location: about.php");
        exit(); 
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      
      body {
    margin: 0; 
    height: 100vh; 
    background-image: url('front.jpg'); 
    background-size: cover; 
    background-repeat: no-repeat; 
    background-position: center; 
    background-attachment: fixed; 
    
    color: #ffffff; 
}

        body {
            background-color: #ffffff; 
       
            color: #000; 
        }
        
        input[type="text"], 
        input[type="password"], 
        textarea, 
        select {
            background-color: #f0f0f0; 
            color: #000; 
            border: 2px solid #4a90e2; 
            border-radius: 5px; 
        }

        input[type="text"]:focus, 
        input[type="password"]:focus, 
        textarea:focus, 
        select:focus {
            border-color: #007bff; 
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); 
        }
        .form {
            background-color: #ffffff; 
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }
        
        .back {
            background-color: #fae811;
            padding: 5px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);     
        }
        .front {
            background-color: #070bf5;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="front">
                <div class="back">
                    <div class="form">
                        <h2 class="text-center mb-4">Registration</h2>
                        
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control <?php echo !empty($Names) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?php echo $name; ?>">
                                <div class="invalid-feedback"><?php echo $Names; ?></div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control <?php echo !empty($Emails) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo $email; ?>">
                                <div class="invalid-feedback"><?php echo $Emails; ?></div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Gender</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input <?php echo !empty($gend) ? 'is-invalid' : ''; ?>" type="radio" name="gender" id="male" value="male" <?php if ($gender == "male") echo "checked"; ?>>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input <?php echo !empty($gend) ? 'is-invalid' : ''; ?>" type="radio" name="gender" id="female" value="female" <?php if ($gender == "female") echo "checked"; ?>>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="invalid-feedback d-block"><?php echo $gend; ?></div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control <?php echo !empty($Phones) ? 'is-invalid' : ''; ?>" id="phone" name="phone" placeholder="09XXXXXXXXX" value="<?php echo $phone; ?>">
                                <div class="invalid-feedback"><?php echo $Phones; ?></div>
                            </div>

                            <div class="mb-3">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-select <?php echo !empty($countryrr) ? 'is-invalid' : ''; ?>" id="country" name="country">
                                    <option value="">Select a country</option>
                                    <option value="USA" <?php if ($country == "USA") echo "selected"; ?>>USA</option>
                                    <option value="Canada" <?php if ($country == "Canada") echo "selected"; ?>>Canada</option>
                                    <option value="UK" <?php if ($country == "UK") echo "selected"; ?>>UK</option>
                                    <option value="Australia" <?php if ($country == "Australia") echo "selected"; ?>>Australia</option>
                                    <option value="Philippines" <?php if ($country == "Philippines") echo "selected"; ?>>Philippines</option>
                                </select>
                                <div class="invalid-feedback"><?php echo $countryrr; ?></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Skills</label><br>
                                <div class="form-check">
                                    <input class="form-check-input <?php echo !empty($skillsrr) ? 'is-invalid' : ''; ?>" type="checkbox" name="skills[]" value="Creativity" id="creativity" <?php if (in_array("Creativity", $skills)) echo "checked"; ?>>
                                    <label class="form-check-label" for="creativity">Creativity</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input <?php echo !empty($skillsrr) ? 'is-invalid' : ''; ?>" type="checkbox" name="skills[]" value="Time Management" id="time management" <?php if (in_array("Time Management", $skills)) echo "checked"; ?>>
                                    <label class="form-check-label" for="time management">Time Management</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input <?php echo !empty($skillsrr) ? 'is-invalid' : ''; ?>" type="checkbox" name="skills[]" value="Communication" id="communication" <?php if (in_array("Communication", $skills)) echo "checked"; ?>>
                                    <label class="form-check-label" for="communication">Communication</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input <?php echo !empty($skillsrr) ? 'is-invalid' : ''; ?>" type="checkbox" name="skills[]" value="Leadership" id="creativity" <?php if (in_array("Leadership", $skills)) echo "checked"; ?>>
                                    <label class="form-check-label" for="leadership">Leadership</label>
                                </div>
                                <div class="invalid-feedback d-block"><?php echo $skillsrr; ?></div>
                            </div>

                            <div class="mb-3">
                                <label for="biography" class="form-label">Biography</label>
                                <textarea class="form-control <?php echo !empty($biographyrr) ? 'is-invalid' : ''; ?>" id="biography" name="biography" rows="3" maxlength="200"><?php echo $biography; ?></textarea>
                                <div class="invalid-feedback"><?php echo $biographyrr; ?></div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control <?php echo !empty($Pass) ? 'is-invalid' : ''; ?>" id="password" name="password">
                                <div class="invalid-feedback"><?php echo $Pass; ?></div>
                            </div>

                            <div class="mb-3">
                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control <?php echo !empty($confirmpass) ? 'is-invalid' : ''; ?>" id="confirm-password" name="confirm-password">
                                <div class="invalid-feedback"><?php echo $confirmpass; ?></div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
