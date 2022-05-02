
<html>

<head><title>The craziest Harry Poter website</title>

</head>


<body style="background-color:lightpink">

<h1 style="text-align: center">The craziest Harryyyy Poter website</h1>
<
<style>
    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>
<p style="text-align: center"> <img src="https://e-pistolas.org/img/movies/74/voldemorts-disfigured-face-explained.jpg" width="350" height="150" alt="HarryPoter" ></p>

<p style="text-align: center">
    <a href="addfile.php">Click here to load file</a><br>
    <br> <a href="addmagicact.php">Click here to add new magic act to database</a><br>
    <br> <a href="Show_Character_Connections.php">Click here to see character connections</a>
</p>
<?php


// Connecting to the database
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
echo "<center>";
echo "<table border=\"2\">";

echo "<tr><tr><th colspan='3'>Harry Poter Statistic</th></tr></tr>";
echo "<tr><th>Not Only Student</th><th>Longest Magic Word</th><th>Most Beloved Non Wizard</th></tr>";


$sql ="SELECT *
        FROM areStudent
                    ";

$result=sqlsrv_query($conn,$sql);
if ($result === false)
{
    echo "problem 1<br>";
    die(print_r(sqlsrv_errors(), true));
}
$rs= sqlsrv_fetch_array($result);
$first = $rs['cName'];

$sql = "select md.magicWord
from MoreDiffculeThen4 md
where DATALENGTH(md.magicWord) = (
    select themaxlengh
    from longetword
    )
";
$result=sqlsrv_query($conn,$sql);
if ($result === false)
{
    echo "problem 1<br>";
    die(print_r(sqlsrv_errors(), true));
}
$rs= sqlsrv_fetch_array($result);
$second = $rs['magicWord'];




$sql= "select *
           from  mostbeloved      
";
$result=sqlsrv_query($conn,$sql);
$rs= sqlsrv_fetch_array($result);
if ($result === false)
{
    echo "problem 2<br>";
    die(print_r(sqlsrv_errors(), true));
}

$tree = $rs['cName2'];


echo "<tr><td>$first</td><td>$second</td><td>$tree</td></tr>";
echo "</table>"


?>
</body>
</html>
