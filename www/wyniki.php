<html>

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="Page-Enter" content="blendTrans(Duration=1.0)">
	<meta http-equiv="Page-Exit" content="blendTrans(Duration=1.0)">
	<link rel="stylesheet" type="text/css" href="main.css">
	<style>
		img {
			width: 100%;
		}
	</style>
</head>

<body>
	<!-- <body onload="setTimeout(`window.location.href = 'wyniki_.php'`, 2000);"> -->
	<div id="header"><img src="banner.svg" id="banner"></div>
	<div id="content">
		<div>
			<h1>Tablica Wyników</h1>
		</div>
		<div id="cnt">
			<div class="table">
				<?php
				echo "<div class='head'>";
					$headers = ["Nazwa&nbsp;Drużyny", "Drony", "Wieża", "Tabu", "Fizyka", "VR", "suma"];
					foreach ($headers as $key => $value) {
					echo "<div ";
					if ($key == 0) {
						echo " style='width: 100%;text-align:left;padding-left: 10px;'";
					}
					echo " class='cell'>" . $value . "</div>";
					}
				echo "</div>";
				?>
				<div id="paste-here"></div>
				</div>
			</div>
		</div>
		<div id="footer">
			<img src="sponsors.png" alt="sponsorzy" style="width:100%">
		</div>
</body>
<script>
	//parse the results
	function parseResults(data) {
		let results = data.split("\n");
		let headers = results[0].split(",");
		let html = "<div class='head'>";
		headers.forEach((header) => {
			html += "<div class='cell'>" + header + "</div>";
		});
		html += "</div>";
		html += "<div class='bod'>";
		for (let i = 1; i < results.length; i++) {
			let row = results[i].split(",");
			html += "<div class='row'>";
			let sum = 0;
			for (let j = 0; j < row.length; j++) {
				if (j == 0) {
					html += "<div class='cell'>" + row[j] + "</div>";
				} else {
					html += "<div class='cell'>" + row[j] + "</div>";
					sum += parseInt(row[j]);
				}
			}
			html += "<div class='cell'>" + sum + "</div>";
			html += "</div>";
		}
		html += "</div>";
		return html;
	}
	//every 10 seconds fetch the get request
	function fetchResults() {
		fetch("wyniki_raw.php").then((response) => {
			return response.text();
		}).then((data) => {
			document.getElementById("paste-here").innerHTML = data;
		});
	}
	//fetch the results
	setInterval(fetchResults, 500);
</script>

</html>