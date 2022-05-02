<html>
<head>
    <style>
        table, th, td {
            border: 1px solid black;
        },
    </style>
</head>
<body style="background-color:lightpink">


<h1 style="font-size:250%;text-align: center;"> Character Connections </h1>
<h2 style="text-align: center">Press on the relevant Character Name:</h2><br>



    <form align="center" style="display: inline-block" name="magic" method="post">
        <p style="text-align: center">
        <table align="center">
            <tr>
                <td>Character Name:</td>
                <td>
                    <select name="character" required>
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
                        $sql="SELECT cName FROM Character";
                        $result = sqlsrv_query($conn, $sql);
                        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
                        {
                            echo "<option value='";
                            echo $row['cName'];
                            echo "'>";
                            echo $row['cName'];
                            echo "</option>";
                        }
                        ?>
                    </select></td>
            </tr>
        </table>
        <br/>



        <input name="submit" type="submit" value="Send">
        <br/><br/>
        <input type="reset" value="reset">
    </form>

<table align='center'>
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
        $character = $_POST["character"];;
        $sql1 = "SELECT cName2
                  FROM Relationship
                  WHERE rType ='Love'
                   AND cName1 = '$character'
                   AND cName2 IN(
                                SELECT cName1
                                FROM Relationship
                                WHERE rType ='Love'
                                  AND cName2 = '$character')
                 order by cName2 asc";
        $result = sqlsrv_query($conn, $sql1);
        echo "<tr><th>Friends of the $character;</th></tr>";
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        $friend = $row['cName2'];
                        echo"<tr><td> $friend </td></tr>";
                    }

 ?>

        </tr>
    </table>
    <br/>





<table align='center'>
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
        $thecharacter = $_POST["character"];
    $sql2 = "SELECT cName2
        FROM Relationship
        WHERE rType ='Hate'
           AND cName1 = '$thecharacter'
            AND cName2 IN(
        SELECT cName1
        FROM Relationship
        WHERE rType ='Hate'
          AND cName2 = '$thecharacter')
        order by cName2 asc";
    $result = sqlsrv_query($conn, $sql2);
    echo "<tr><th>Nemesis of $thecharacter</th></tr>";
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $friend = $row['cName2'];
        echo"<tr><td> $friend </td></tr>";
    }
    ?>
    </table>
    <br/>
    <table align='center'>
    <?php
    $thecharacter = $_POST["character"];
    $sql3 = "SELECT cName2
            FROM (SELECT cName2
                            FROM Relationship
                            WHERE rType ='Love'
                              AND cName1 = '$character'
                              AND cName2 IN(
                                SELECT cName1
                                FROM Relationship
                                WHERE rType ='Love'
                                  AND cName2 = '$character')
            WHERE cName2 IN(SELECT P2.cName
                            FROM Performed P1, Performed P2
                            WHERE P1.magicWord = P2.magicWord
                            AND P1.cName = ' $thecharacter'
                            AND p2.cName=loveeachother.cName2
        
            order by cName2 asc";
    $result = sqlsrv_query($conn, $sql3);
    echo "<tr><th>BFF of $thecharacter</th></tr>";
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $friend = $row['cName2'];
        echo"<tr><td> $friend </td></tr>";
    }



?>
    </table>
<p style="text-align: center"> <a href="index.php">Back to main page</a> </p>
</body>
</html>
