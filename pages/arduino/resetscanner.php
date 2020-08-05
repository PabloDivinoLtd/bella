<?php
    <?php
    $servername = "localhost";
    $dbname = "patients";
    $username = "root";
    $password = "";
    $api_key_value = "tPmAT5Ab3j7F9";
    $api_key= $status = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $api_key = test_input($_POST["api_key"]);
        if($api_key == $api_key_value) {
            $status = test_input($_POST["status"]);
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "update scannerstatus set status = '" . $status . "' where id = 1";
            if ($conn->query($sql) === TRUE) {
                header('addfinger.php?status=true');
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
        else {
            echo "Wrong API Key provided.";
        }

    }
    else {
        echo "No data posted with HTTP POST.";
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    ?>
?>