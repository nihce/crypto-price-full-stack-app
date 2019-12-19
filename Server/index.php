<?php
    include_once 'includes/dbhandler.inc.php'; //parametri za povezavo do DB

    if ($_SERVER["REQUEST_METHOD"]=="GET") {
        switch ($_GET['cryptocurrency']) {
            case "BTC":
                $db_table = 'BTC';
                break;
            case "ETH":
                $db_table = 'ETH';
                break;
        }
        switch ($_GET['fiat']) {
            case "EUR":
                $db_column_fiat = 'eur';
                break;
            case "USD":
                $db_column_fiat = 'usd';
                break;
            case "GBP":
                $db_column_fiat = 'gbp';
                break;
        }

        if (isset($db_table) && isset($db_column_fiat)) {
            $sql = "SELECT `timestamp`, `" . $db_column_fiat . "` FROM `" . $db_table . "` ORDER BY `id` DESC LIMIT 5;";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $json = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    //echo $row['timestamp'] . " => " . $row[$db_column_fiat] . "<br>";
                    $json[] = $row;
                }
            }
        }
        echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
