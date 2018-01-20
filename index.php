<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once './Controller/mysqlConnection.php';
        $mysqlConnection = new mysqlConnection();
        $connection = $mysqlConnection->connect();
        $dbname = 'fepes861_fepespa';

        $test_query = "SHOW TABLES FROM $dbname";
        $result = mysqli_query($connection,$test_query);
        $tblCnt = 0;
        while ($tbl = mysqli_fetch_array($result)) {
            $tblCnt++;
            echo $tbl[0]."<br />\n";
        }
        if (!$tblCnt) {
            echo "There are no tables<br />\n";
        } else {
            echo "There are $tblCnt tables<br />\n";
        }
        ?>
    </body>
</html>