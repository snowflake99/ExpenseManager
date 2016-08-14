<?php
    // Unblock to display detail error message
    // ini_set('display_errors',1);
    // error_reporting(E_ALL);

    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        // The file name
        $fileName = $_FILES["uploadFilename"]["name"];
        // File in the PHP tmp folder
        $fileTmpLoc = $_FILES["uploadFilename"]["tmp_name"];
        // The type of file it is
        $fileType = $_FILES["uploadFilename"]["type"];
        // File size in bytes
        $fileSize = $_FILES["uploadFilename"]["size"];
        // 0 for false... and 1 for true
        $fileErrorMsg = $_FILES["uploadFilename"]["error"]; 

        // if file not chosen
        if (!$fileTmpLoc) { 
            echo "ERROR: Please browse for a file before uploading.";
            exit();
        }

        if (is_uploaded_file($fileTmpLoc)) {
            $sql="SELECT id FROM _users WHERE username='$_SESSION[username]'";

            if (PHP_VERSION_ID < $VER_PHP_7_0)  {
                $result=mysql_query($sql);
                while ($row = mysql_fetch_array($result)) {
                    $usrId = $row{'id'};
                }
            } else {
                $result=mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    $usrId = $row{'id'};
                }
            }

            $table = $usrId.preg_replace('/\\.[^.\\s]{3,4}$/', '', $fileName);

            if (PHP_VERSION_ID < $VER_PHP_7_0)  {
                $result = mysql_query("SHOW TABLES LIKE '".$table."'");
                $nRow = mysql_num_rows($result);
            } else {
                $result = mysqli_query($conn, "SHOW TABLES LIKE '".$table."'");
                $nRow = mysqli_num_rows($result);
            }

            if($nRow != 1)   {
                // Table does not exist!, create it
                $sql = "create table $table (idx int not null auto_increment, 
                                             edate date not null, 
                                             category varchar(32), 
                                             description varchar(255), 
                                             amount float, 
                        Primary key(idx))";
            } else {
                // Table will not be truncated instead appended
                //$sql = "TRUNCATE TABLE $table";
            }

            if (PHP_VERSION_ID < $VER_PHP_7_0)  {
                $result = mysql_query($sql);
            } else {
                $result = mysqli_query($conn, $sql);
            }

            //Import uploaded file to Database
            $handle = fopen($fileTmpLoc, "r");

            while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
                // If all the fields are empty continue with next row
                if ($data[0] === "" &&
                    $data[1] === "" &&
                    $data[2] === "" &&
                    $data[3] === "")
                    continue;

                // Consider the previous date if current row does not have date
                if ($data[0] !== "")
                    $Date = $data[0]; 
                // Convert the amount field to float
                $value = floatval($data[3]);
                
                $import="INSERT INTO $table (edate,category,description,amount) 
                                     VALUES ('$Date','$data[1]','$data[2]','$value')";

                if (PHP_VERSION_ID < $VER_PHP_7_0)  {
                    mysql_query($import) or die(mysql_error());
                } else {
                    mysqli_query($conn, $import) or die(mysqli_error($conn));
                }
            }

            fclose($handle);

            print "Import done";
        }
    }

?>
