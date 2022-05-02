<html>
<head>
    <title> New Application </title>
    <style>
        body
        {
            background-color: LightGray;
            font-family:verdana
        }
    </style>
</head>
<body style="text-align: center;color:SlateBlue;">
<h1 style="font-family":verdana >New magic act</h1><br>

<h2 style="font-family":verdana >Fill Magic Acts Details</h2>
<form style="display: inline-block" name="magic" method="post">
    <table border="0" cellpadding="5" style="margin-left:auto; margin-right:auto;">
        <tr>
            <td>Wizard Name:</td>
            <td><textarea name="wizardName" Rows="5" cols="60" maxlength="100" required></textarea></td>
        </tr>
        <tr>
            <td>spell Name:</td>
            <td><textarea name="magicWord"  Rows="5" cols="60" maxlength="100" > </textarea></td>
        </tr>

        </table>
    <input name="submit" type="submit" value="Send">
    <br/><br/>
    <input type="reset" value="reset">
        </form>

<?php

$server = "tcp:techniondbcourse01.database.windows.net,1433";
$user = "shenhav0ofir";
$pass = "Qwerty12!";
$database = "shenhav0ofir";
$c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
sqlsrv_configure('WarningsReturnAsErrors', 0);
$conn = sqlsrv_connect($server, $c);
if($conn === false)
{
    echo "error";
    die(print_r(sqlsrv_errors(), true));

}
if (isset($_POST["submit"])) {
    $hisname = $_POST["wizardName"];
    $spell = $_POST['magicWord'];
    $sql = "Select * FROM Wizard
           where cName='$hisname'";
    $thewizardthatfit = sqlsrv_query($conn, $sql);
    $wizardecectince = sqlsrv_fetch_array($thewizardthatfit, SQLSRV_FETCH_ASSOC);
    $sql="SELECT *
           from Spell
           where magicWord='$spell'";
    $themagicthatfit = sqlsrv_query($conn, $sql);
    if ($wizardecectince['cName']) {
        $magicecectince = sqlsrv_fetch_array( $themagicthatfit, SQLSRV_FETCH_ASSOC);
        if ($magicecectince['magicWord']) {
            $datetime = date("Y-m-d h:i:s");
            $sql ="INSERT INTO MDate(dateVal) VALUES
             ( '$datetime');";
            $result=sqlsrv_query($conn, $sql);
            if ($result===false){
                echo "Something went wrong! Please check you information and try again<br>";
                die(print_r(sqlsrv_errors(), true));
            }

            $sql = "INSERT INTO Performed(cName,magicWord,dateVal) 
             VALUES  
            ('$hisname',
            '$spell ',
            '$datetime');";
            $result=sqlsrv_query($conn, $sql);
            echo "<h5>The magic Acts have added to the data base Successfully</h5>";
            $sql = "select cName2
                    from  Relationship r
                    where  cName1='$hisname'
                    AND     rType='Hate' 
                    order by NEWID()";

            $randomopent = sqlsrv_query($conn, $sql);
            $ceckifexict = sqlsrv_fetch_array($randomopent, SQLSRV_FETCH_ASSOC);
            $thehated = $ceckifexict['cName2'];
            $sql = "Select *
                     FROM Spell
                     order by NEWID()";
            $randomSpell = sqlsrv_query($conn, $sql);
            $ceckifexict = sqlsrv_fetch_array($randomSpell, SQLSRV_FETCH_ASSOC);
            $thehatedspell = $ceckifexict['magicWord'];
            $sql = "INSERT INTO Performed(cName,magicWord,dateVal) 
              VALUES 
            ('$thehated',
            '$thehatedspell',
            '$datetime');";
             $result=sqlsrv_query($conn, $sql);
            if ($result===false){
                echo "Something went wrong! Please check you information and try again<br>";
                die(print_r(sqlsrv_errors(), true));
            }
            echo "<h3>$hisname performed the spell- $spell</h3>";
            echo "</br><h3>$thehated performed the spell $thehatedspell</h3></br>";
            $thefirst = $magicecectince ['difLevel'];
            $thesecond = $ceckifexict['difLevel'];

            if ($thefirst > $thesecond)
                echo "<h3>$hisname won!</h3>";
            else if($thefirst < $thesecond)
                echo "<h3>$thehated won!</h3>";
            else
                echo "<h3>No one wins</h3>";
        } else {
            echo "<h5>Couldn't add the Magic Acts. <br/> you need to insert spell that exict.</h5>";
        }
    } else {
        echo "<h5>Couldn't add the Magic Acts. <br/> you need to insert wizard that exict.</h5>";
    }

}
?>
<a href="index.php">Return to main page</a>
</body>
</html>
