<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/canvasjs.min.js"></script>
	<script src="js/api_url.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
			border-radius: 5px;
	        background-color: #f2f2f2;
			margin: 30px 0;
	    }
	    table {
	        font-family: arial, sans-serif;
	        border-collapse: collapse;
	        margin: auto;
	        width: 30%;
	    }
	    td{
	        border: none;
	        text-align: center;
	        padding: 8px;
	        font-family: "Courier New", Courier, monospace;
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

	<!-- FUNCTIONS -->
	<script>
		function parseResponseForChart(result, i){
			var timestamp = result[i].timestamp;
			var dateTime = new Date(timestamp*1000);
			var price;
			if (typeof result[i].eur !== "undefined") {
				price = result[i].eur;
			} else if (typeof result[i].usd !== "undefined") {
				price = result[i].usd;
			} else if (typeof result[i].gbp !== "undefined") {
				price = result[i].gbp;
			}
			dataPoints.push({x: dateTime, y: parseFloat(price)});
		}

		function loadChart() {
			var chart = new CanvasJS.Chart("chartContainer", {
				animationEnabled: true,
				theme: "light2",
				title: {
					text: ""
				},
				axisX: {
					valueFormatString: "DD.MM. HH:mm",
				},
				axisY: {
					title: "",
					titleFontSize: 20,
					includeZero: false
				},
				data: [{
					type: "spline",
					dataPoints: dataPoints
				}]
			});
			chart.render();
		}
	</script>

	<!-- FORM PROCESSING-->
	<script>
		var dataPoints = [];
	    //klic, ki se izvede ob oddaji obrazca
	    $(document).ready(function(){
	        $("#form").submit(function(){
	            $.ajax({
	                url: $API_URL,
	                type : "GET",
	                dataType : 'json',
	                data : $("#form").serialize(),
	                success : function(result) {
						parseResponseForChart(result, 4); //oldest data
						parseResponseForChart(result, 3);
						parseResponseForChart(result, 2);
						parseResponseForChart(result, 1);
						parseResponseForChart(result, 0); //current price

						// console.log(result); //debug
						// console.log(dataPoints); //debug

						loadChart();
						dataPoints.length = 0; //clear contents of an array
	                }
	            })
	        });
	    });
    </script>

</head>
<body>

	<p class="w3-center">
        <a href="index.php">
            <button>Go to TABLE</button>
        </a>
    </p>

	<!-- FORM -->
	<div>
        <table>
            <tr>
                <td colspan="2">
                    <form id="form" onsubmit="event.preventDefault();" method="get">
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
        </table>
    </div>

	<!-- CHART -->
	<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
</body>
</html>
