<?php

//Set Greeting 
$greeting="Hello, my name is";
$firstName = filter_input(INPUT_GET, "first", FILTER_SANITIZE_STRING);
$lastName = filter_input(INPUT_GET, "last", FILTER_SANITIZE_STRING);
$age =  filter_input(INPUT_GET, "age", FILTER_SANITIZE_NUMBER_INT);

//HTTP GET Request handler 
function handleHttpGet() {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Process GET data here (e.g., retrieve form input values)
        if(isset($_GET["first"]) && isset($_GET["last"]) && isset($_GET["age"]) ){
            $firstName=$_GET["first"];
            $lastName=$_GET["last"];
            $age=$_GET["age"];
            print_r($_GET);
            if(!empty($_GET["first"]) && !empty($_GET["last"]) && !empty($_GET["age"])){
                echo "<br>" . $firstName . " " . $lastName ." " . $age. "<br>"; 
            } else {
                echo "Missing some data in GET." ."<br>";
            }
        }
        else{
            echo "Data not set"."<br>";
        }
        echo "GET request received!";
    }
}


$firstName = filter_input(INPUT_POST, "first", FILTER_SANITIZE_STRING);
$lastName = filter_input(INPUT_POST, "last", FILTER_SANITIZE_STRING);
$age =  filter_input(INPUT_POST, "age", FILTER_SANITIZE_NUMBER_INT);
//HTTP POST Request handler 
function handleHttpPost() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Process POST data here (e.g., retrieve form input values)
        #POST
        if(isset($_POST["first"]) && isset($_POST["last"]) && isset($_POST["age"])){
            $firstName=$_POST["first"];
            $lastName=$_POST["last"];
            $age=$_POST["age"];
            print_r($_POST);
            if(!empty($_POST["first"]) && !empty($_POST["last"]) && !empty($_POST["age"])){
                echo "<br>" . $firstName . " " . $lastName ." " . $age. "<br>"; 
            } else {
                echo "Missing some data in GET." . "<br>";
            }   
        }
        else{
            echo "Data not set" . "<br>";
        }
        echo "POST request received!";
    }
}

// Check which button was clicked
if (isset($_POST['submit_post'])) {
    handleHttpPost();
} else if (isset($_GET['submit'])) {
    handleHttpGet();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Parameter</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <?php
        $message=" I am old enough to vote in the United states";
    ?>
    <main>
        <h1>Web Processor</h1>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" >
            <label for="first">First Name</label>
            <input type="text" id="first"name="first" autocomplete="off">
            <label for="last">Last Name </label>
            <input type="text" id="last" name="last" autocomplete="off">
            <label for="age">Age</label>
            <input type="text" id="age"name="age" autocomplete="off">
            <div>
                <button type="submit"name="submit">Submit</button>
                <button type="submit" name="submit_post"formmethod="POST">Submit Using PPost</button>
                <button type="reset">Reset</button>
            </div>
            <br><br>
            <div>
                <h2><?php echo $greeting . " " . $firstName ." ". $lastName; ?></h2>
                <h2><?php 
                   if($age >= 18)
                   {
                     echo "I  am {$age} years old and {$message}";
                   }
                   else{
                       $message=" I am not old enough to vote in the United States"; 
                       echo "I am {$age} years old and {$message}";
                   }
                ?></h2>
                <h2><?php
                //Calculates number of Days given an age by user from form
                 $currentYear = "2024"; // Replace with your desired year
                 $month = "02";   // Replace with your desired month (1-12)
                 $day = "10";     // Replace with your desired day (1-31)
                 $diffYear=abs($currentYear -$age);

                 $birthDate = "$diffYear-$month-$day"; // Replace with the actual birthdate in the yyyy-mm-dd format
                 $now = time();
                 $your_date = strtotime($birthDate);
                 $dateDiff = $now - $your_date;
                 $age_days = round($dateDiff / (60 * 60 * 24));
                 echo "Age in days: $age_days";
                ?></h2>
                <h2><?php
                //Added Today's Date
                    $currentDate=date("m-d-y");
                    echo "Today's date is {$currentDate}";
                ?></h2>
            </div>
        </form>
    </main>
</body>
</html>