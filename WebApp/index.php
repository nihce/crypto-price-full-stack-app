<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/api_url.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    input[type=submit]:hover {
        background-color: #45a049;
    }
    form {
        border-radius: 10px;
        background-color: #f2f2f2;
        padding: 40px;
    }
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        margin: auto;
        width: 85%;
    }
    td {
        border: 2px solid #dddddd;
        text-align: center;
        padding: 8px;
        font-family: "Courier New", Courier, monospace;
    }
    h2 {
        padding: 20px;
    }
    button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    </style>

    <script>
    //klic, ki se izvede ob oddaji obrazca na LEVI
    $(document).ready(function(){
        $("#Lform").submit(function(){
            $.ajax({
                url: $API_URL,
                type : "GET",
                dataType : 'json',
                data : $("#Lform").serialize(),
                success : function(result) {
                    //trenutna cena
                    var timestamp = result[0].timestamp;
                    var dateTime = new Date(timestamp*1000);
                    var formatted = dateTime.toGMTString();
                    $("#L0timestamp").text(formatted);
                    $("#L0price").text(result[0].eur);
                    $("#L0price").text(result[0].usd);
                    $("#L0price").text(result[0].gbp);
                    //predzadnja cena
                    var timestamp = result[1].timestamp;
                    var dateTime = new Date(timestamp*1000);
                    var formatted = dateTime.toGMTString();
                    $("#L1timestamp").text(formatted);
                    $("#L1price").text(result[1].eur);
                    $("#L1price").text(result[1].usd);
                    $("#L1price").text(result[1].gbp);
                    //
                    var timestamp = result[2].timestamp;
                    var dateTime = new Date(timestamp*1000);
                    var formatted = dateTime.toGMTString();
                    $("#L2timestamp").text(formatted);
                    $("#L2price").text(result[2].eur);
                    $("#L2price").text(result[2].usd);
                    $("#L2price").text(result[2].gbp);
                    //
                    var timestamp = result[3].timestamp;
                    var dateTime = new Date(timestamp*1000);
                    var formatted = dateTime.toGMTString();
                    $("#L3timestamp").text(formatted);
                    $("#L3price").text(result[3].eur);
                    $("#L3price").text(result[3].usd);
                    $("#L3price").text(result[3].gbp);
                    //5. cena iz baze (najstarejsa prikazana cena)
                    var timestamp = result[4].timestamp;
                    var dateTime = new Date(timestamp*1000);
                    var formatted = dateTime.toGMTString();
                    $("#L4timestamp").text(formatted);
                    $("#L4price").text(result[4].eur);
                    $("#L4price").text(result[4].usd);
                    $("#L4price").text(result[4].gbp);
                }
            })
        });
    });

    //klic, ki se izvede ob oddaji obrazca na DESNI
    $(document).ready(function(){
        $("#Dform").submit(function(){
            $.ajax({
                url: $API_URL,
                type : "GET",
                dataType : 'json',
                data : $("#Dform").serialize(),
                success : function(result) {
                    //trenutna cena
                    var timestamp = result[0].timestamp;
                    var dateTime = new Date(timestamp*1000);
                    var formatted = dateTime.toGMTString();
                    $("#D0timestamp").text(formatted);
                    $("#D0price").text(result[0].eur);
                    $("#D0price").text(result[0].usd);
                    $("#D0price").text(result[0].gbp);
                    //predzadnja cena
                    var timestamp = result[1].timestamp;
                    var dateTime = new Date(timestamp*1000);
                    var formatted = dateTime.toGMTString();
                    $("#D1timestamp").text(formatted);
                    $("#D1price").text(result[1].eur);
                    $("#D1price").text(result[1].usd);
                    $("#D1price").text(result[1].gbp);
                    //
                    var timestamp = result[2].timestamp;
                    var dateTime = new Date(timestamp*1000);
                    var formatted = dateTime.toGMTString();
                    $("#D2timestamp").text(formatted);
                    $("#D2price").text(result[2].eur);
                    $("#D2price").text(result[2].usd);
                    $("#D2price").text(result[2].gbp);
                    //
                    var timestamp = result[3].timestamp;
                    var dateTime = new Date(timestamp*1000);
                    var formatted = dateTime.toGMTString();
                    $("#D3timestamp").text(formatted);
                    $("#D3price").text(result[3].eur);
                    $("#D3price").text(result[3].usd);
                    $("#D3price").text(result[3].gbp);
                    //5. cena iz baze (najstarejsa prikazana cena)
                    var timestamp = result[4].timestamp;
                    var dateTime = new Date(timestamp*1000);
                    var formatted = dateTime.toGMTString();
                    $("#D4timestamp").text(formatted);
                    $("#D4price").text(result[4].eur);
                    $("#D4price").text(result[4].usd);
                    $("#D4price").text(result[4].gbp);
                }
            })
        });
    });
    </script>
</head>

<body>
    <h2 class="w3-wide w3-center">Cryptocurrency Price API Client</h2>

    <p class="w3-center">
        <a href="chart.php">
            <button>Go to CHART</button>
        </a>
    </p>

    <div>
        <table>
            <tr>
                <td colspan="2">
                    <form id="Lform" onsubmit="event.preventDefault();" method="get">
                        <label>Cryptocurrency</label>
                        <select id="cryptocurrency" name="cryptocurrency">
                            <option value="BTC">BTC</option>
                            <option value="ETH">ETH</option>
                        </select>

                        <label>FIAT currency</label>
                        <select id="fiat" name="fiat">
                            <option value="EUR">EUR</option>
                            <option value="USD">USD</option>
                            <option value="GBP">GBP</option>
                        </select>

                        <input type="submit" value="SHOW">
                    </form>
                </td>
                <td colspan="2">
                    <form id="Dform" onsubmit="event.preventDefault();" method="get">
                        <label>Cryptocurrency</label>
                        <select id="cryptocurrency" name="cryptocurrency">
                            <option value="BTC">BTC</option>
                            <option value="ETH">ETH</option>
                        </select>

                        <label>FIAT currency</label>
                        <select id="fiat" name="fiat">
                            <option value="EUR">EUR</option>
                            <option value="USD">USD</option>
                            <option value="GBP">GBP</option>
                        </select>

                        <input type="submit" value="SHOW">
                    </form>
                </td>
            </tr>
            <tr style="font-size: 1.2em;">
                <td id="L0timestamp"></td>
                <td id="L0price"></td>
                <td id="D0timestamp"></td>
                <td id="D0price"></td>
            </tr>
            <tr>
                <td id="L1timestamp"></td>
                <td id="L1price"></td>
                <td id="D1timestamp"></td>
                <td id="D1price"></td>
            </tr>
            <tr>
                <td id="L2timestamp"></td>
                <td id="L2price"></td>
                <td id="D2timestamp"></td>
                <td id="D2price"></td>
            </tr>
            <tr>
                <td id="L3timestamp"></td>
                <td id="L3price"></td>
                <td id="D3timestamp"></td>
                <td id="D3price"></td>
            </tr>
            <tr>
                <td id="L4timestamp"></td>
                <td id="L4price"></td>
                <td id="D4timestamp"></td>
                <td id="D4price"></td>
            </tr>
        </table>
    </div>

</body>
</html>
