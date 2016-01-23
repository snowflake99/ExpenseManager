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
            $result=mysql_query($sql);
            
            while ($row = mysql_fetch_array($result)) {
                $usrId = $row{'id'};
            }

            $table = $usrId.preg_replace('/\\.[^.\\s]{3,4}$/', '', $fileName);

            if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$table."'")) != 1)   {
                // Table does not exist!, create it
                $sql = "create table $table (idx int not null auto_increment, 
                                             edate date not null, 
                                             category varchar(32), 
                                             description varchar(255), 
                                             amount float, 
                        Primary key(idx))";
            } else {
                $sql = "TRUNCATE TABLE $table";
            }

            $result = mysql_query($sql);

            //Import uploaded file to Database
            $handle = fopen($fileTmpLoc, "r");

            while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
                $value = floatval($data[3]);
                
                $import="INSERT INTO $table (edate,category,description,amount) 
                                     VALUES ('$data[0]','$data[1]','$data[2]','$value')";

                mysql_query($import) or die(mysql_error());
            }

            fclose($handle);

            print "Import done";
        }
    }

?>
