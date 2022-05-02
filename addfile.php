<html>
<head> <title>Upload a file </title> </head>

<body style="background-color:lightpink">

<h1 style="font-size:250%;text-align: center;"> Load Data </h1>
<h2 style="text-align: center">Press on the relevant button in order to  load data of a specific file</h2><br>



<?php
if (isset($_POST["submit_char"])) {
    $server = "tcp:techniondbcourse01.database.windows.net,1433";
    $user = "shenhav0ofir";
    $pass = "Qwerty12!";
    $database = "shenhav0ofir";
    $c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
    sqlsrv_configure('WarningsReturnAsErrors', 0);
    $conn = sqlsrv_connect($server, $c);
    if ($conn === false) {
        echo "error";
        die(print_r(sqlsrv_errors(), true));
    }
    $file = $_FILES['csv']['tmp_name'];
    $succes = 0;
    $row = 1;
    if (($handle = fopen($file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

            if ($row == 1) {
                $row++;
                continue;}
            $row++;
            $sql = "INSERT INTO Character (cName,role,hairColor) VALUES
        ('" . addslashes($data[0])."','".addslashes($data[1])."',
                     '".addslashes($data[2])."');";
            $totall++;
            $result = sqlsrv_query($conn, $sql);
            if ($result != false)
                $succes +=1 ;

        }
        fclose($handle);
    }
    $howmanyfaild= $row-$succes;
    echo "<p> Number of the fail tuples uploads:$howmanyfaild</p>";
    echo "<p> Number of the success tuples uploads:$succes</p>";

}
?>


<?php
if (isset($_POST["submit_wizard"])) {
    $server = "tcp:techniondbcourse01.database.windows.net,1433";
    $user = "shenhav0ofir";
    $pass = "Qwerty12!";
    $database = "shenhav0ofir";
    $c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
    sqlsrv_configure('WarningsReturnAsErrors', 0);
    $conn = sqlsrv_connect($server, $c);
    $result = '';
    if ($conn === false) {
        echo "error";
        die(print_r(sqlsrv_errors(), true));
    }
    $file = $_FILES['csv']['tmp_name'];
    $succes = 0;
    $row = 1;
    if (($handle = fopen($file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

            if ($row == 1) {
                $row++;
                continue;}
            $row++;
            $sql = "INSERT INTO Wizard(cName,wandID) VALUES
        ('" . addslashes($data[0])."','".addslashes($data[1])."' );";
            $result = sqlsrv_query($conn, $sql);
            if ($result!= false)
                $succes +=1 ;

        }
        fclose($handle);
    }

    $howmanyfaild= $row-$succes;
    echo "<p> Number of the fail tuples uploads:$howmanyfaild</p>";
    echo "<p> Number of the success tuples uploads:$succes</p>";

}
?>

<?php
if (isset($_POST["submit_relationship"])) {
    $server = "tcp:techniondbcourse01.database.windows.net,1433";
    $user = "shenhav0ofir";
    $pass = "Qwerty12!";
    $database = "shenhav0ofir";
    $c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
    sqlsrv_configure('WarningsReturnAsErrors', 0);
    $conn = sqlsrv_connect($server, $c);
    if ($conn === false) {
        echo "error";
        die(print_r(sqlsrv_errors(), true));
    }
    $file = $_FILES['csv']['tmp_name'];
    $succes = 0;
    $row = 1;
    if (($handle = fopen($file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

            if ($row == 1) {
                $row++;
                continue;}
            $row++;
            $sql = "INSERT INTO Relationship (cName1,cName2,rType) VALUES
        ('" . addslashes($data[0])."','".addslashes($data[1])."',
                     '".addslashes($data[2])."');";
            $result = sqlsrv_query($conn, $sql);
            if ($result != false)
                $succes +=1 ;

        }
        fclose($handle);
    }

    $howmanyfaild= $row-$succes;
    echo "<p> Number of the fail tuples uploads:$howmanyfaild</p>";
    echo "<p> Number of the success tuples uploads:$succes</p>";

}
?>



<?php
if (isset($_POST["submitspell"])) {
    $server = "tcp:techniondbcourse01.database.windows.net,1433";
    $user = "shenhav0ofir";
    $pass = "Qwerty12!";
    $database = "shenhav0ofir";
    $c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
    sqlsrv_configure('WarningsReturnAsErrors', 0);
    $conn = sqlsrv_connect($server, $c);
    if ($conn === false) {
        echo "error";
        die(print_r(sqlsrv_errors(), true));
    }
    $file = $_FILES['csv']['tmp_name'];
    $succes = 0;
    $row = 1;
    if (($handle = fopen($file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

            if ($row == 1) {
                $row++;
                continue;}
            $row++;
            $sql = "INSERT INTO Spell (magicWord,description,difLevel) VALUES
        ('" . addslashes($data[0])."','".addslashes($data[1])."',
                     '".addslashes($data[2])."');";
            $result = sqlsrv_query($conn, $sql);
            if ($result != false)
                $succes +=1 ;

        }
        fclose($handle);
    }

    $howmanyfaild= $row-$succes;
    echo "<p> Number of the fail tuples uploads:$howmanyfaild</p>";
    echo "<p> Number of the success tuples uploads:$succes</p>";

}
?>
<h2 style="text-align: center">Character data:<br> Please choose your file</h2>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
    <p style="text-align: center">
        <input name="csv" type="file" id="csv" />
        <input type="submit" name="submit_char" value="submit" />

</form>
<h2 style="text-align: center"> Wizard data:<br> Please choose your file</h2>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
    <p style="text-align: center">
        <input name="csv" type="file" id="csv" />
        <input type="submit" name="submit_wizard" value="submit" />
    </p>
</form>

<h2 style="text-align: center"> Relationship data:<br> Please choose your file</h2>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
    <p style="text-align: center">
        <input name="csv" type="file" id="csv" />
        <input type="submit" name="submit_relationship" value="submit" />
    </p>
</form>
<h2 style="text-align: center"> Spells:<br> Please choose your file</h2>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
    <p style="text-align: center">
        <input name="csv" type="file" id="csv" />
        <input type="submit" name="submitspell" value="submit" />
    </p>
</form>


<p style="text-align: center"> <a href="index.php">Back to main page</a> </p>

</body>
</html>