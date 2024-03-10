<?php
// FILEPATH: /X:/xampp/htdocs/wyniki_raw.php
// Connect to the database
				echo "<div class='bod'>";
					try {
						$con = mysqli_connect("mysql", "wyniki", "wyniki", "ranking");
						$sql = "SELECT * FROM `wyniki` ORDER BY (`Wynik1`+`Wynik2`+`Wynik3`+`Wynik4`+`Wynik5`) DESC";
						$rowid=1;
						foreach ($con->query($sql) as $row) {
							echo "<div class='row'>";
							$sum = 0;
							foreach ($row as $key => $value) {
								if ($key == "NazwaUczestnika") {
									$value = str_replace("~", " ", $value);
									echo "<div style='width: 100%;text-align:left;padding-left: 10px;' class='cell'><span style='width:3ch;display:inline-block;'>" .$rowid++.".</span>".$value . "</div>";
								}
								//write regex to match Wynik*
								if (preg_match("/Wynik[0-9]/", $key)) {
									echo "<div class='cell'>" . $value . "</div>";
									$sum += $value;
								}
							}
							echo "<div class='cell'>" . $sum . "</div>";
							echo "</div >";
						}
					} catch (\Throwable $th) {
						//throw $th;
					}
				echo "</div>";
// Close the database connection
$con->close();
// Return the data as HTML



?>
