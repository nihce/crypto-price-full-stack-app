<?php
    include_once 'includes/dbhandler.inc.php'; //parametri za povezavo do DB

    //samodejno izvajanje skripte vsake $secondsToRefresh sekund
    $url = $_SERVER['PHP_SELF'];
    // $secondsToRefresh = 5;
    // header("Refresh: $secondsToRefresh; URL=$url"); //to osvezi stran vsakih $secondsToRefresh

    $currentDate = date_create();
    $currentTimestamp = date_timestamp_get($currentDate);
    echo "$currentTimestamp";

    /*
    API klic na coinapi.io z metodo GET -> BTC (GBP,USD,EUR)
    */
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://rest.coinapi.io/v1/exchangerate/BTC?filter_asset_id=GBP,USD,EUR");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    $headers = array();
    //use only one of the keys below
    $headers[] = "X-Coinapi-Key: E18EE924-9652-4580-A22A-0CF09846FD8A";
    // $headers[] = "X-Coinapi-Key: 73034021-0EBC-493D-8A00-E0F138111F41";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    $json = json_decode($response, true);

    /*
    TEST CODE
    */
    //var_dump($json); //to izpise celoten response
    // echo $json['asset_id_base'];echo "<br>"; //BTC
    // echo $json['rates'][0]['rate'];echo "<br>"; //GBP
    // echo $json['rates'][1]['rate'];echo "<br>"; //EUR
    // echo $json['rates'][2]['rate'];echo "<br>"; //USD
    // echo "<br>";
    // echo "<br>";

    //parsing JSON into local variables
    $EUR = $USD = $GBP = -1;
    for ($i=0; $i<3; $i++) {
        switch ($json['rates'][$i]['asset_id_quote']) {
            case "EUR":
                $EUR = $json['rates'][$i]['rate'];
                break;
            case "USD":
                $USD = $json['rates'][$i]['rate'];
                break;
            case "GBP":
                $GBP = $json['rates'][$i]['rate'];
                break;
        }
    }

    //write fetched data in DB table = BTC
    $sqlInsert = "INSERT INTO `BTC` (`id`, `timestamp`, `eur`, `usd`, `gbp`) VALUES (NULL, '$currentTimestamp', '$EUR', '$USD', '$GBP');";
    $result = mysqli_query($conn, $sqlInsert);




    /*
    API klic na coinapi.io z metodo GET -> ETH (GBP,USD,EUR)
    */
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://rest.coinapi.io/v1/exchangerate/ETH?filter_asset_id=GBP,USD,EUR");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    $headers = array();
    //use only one of the keys below
    $headers[] = "X-Coinapi-Key: E18EE924-9652-4580-A22A-0CF09846FD8A";
    // $headers[] = "X-Coinapi-Key: 73034021-0EBC-493D-8A00-E0F138111F41";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    $json = json_decode($response, true);

    //parsing JSON into local variables
    $EUR = $USD = $GBP = -1;
    for ($i=0; $i<3; $i++) {
        switch ($json['rates'][$i]['asset_id_quote']) {
            case "EUR":
                $EUR = $json['rates'][$i]['rate'];
                break;
            case "USD":
                $USD = $json['rates'][$i]['rate'];
                break;
            case "GBP":
                $GBP = $json['rates'][$i]['rate'];
                break;
        }
    }

    //write fetched data in DB table = ETH
    $sqlInsert = "INSERT INTO `ETH` (`id`, `timestamp`, `eur`, `usd`, `gbp`) VALUES (NULL, '$currentTimestamp', '$EUR', '$USD', '$GBP');";
    $result = mysqli_query($conn, $sqlInsert);
