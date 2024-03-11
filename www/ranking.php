<html>
	<head>	
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
	<body>
		<div id="main" style="overflow: scroll;">
			<a class="download" href="wyniki_export_csv.php" target="_blank">
			<button >Pobierz wyniki</button>
			</a>
			<form name='form' method='post' action='update.php'>
				<label for="team">add team:</label>
				<input type='text' name="team" placeholder="team name">
				<input type='submit' name="button" value="add">
				<table>
					<thead>
			<th>Usuń</th>
			<th>Nazwa Drużyny</th>
			<th>Wynik1</th>
			<th>Wynik2</th>
			<th>Wynik3</th>
			<th>Wynik4</th>
			<th>Wynik5</th>
		</thead>
		<tbody>
		<?php
		try {
			$con = mysqli_connect("mysql", $_POST['user']==null?"lol":$_POST['user'], $_POST['pass']==null?"lol":$_POST['pass'], "ranking");
			$sql = "SELECT * FROM wyniki";
			$i=1;
			echo "
				<input type='hidden' name='user' value='".$_POST['user']."'>
				<input type='hidden' name='pass' value='".$_POST['pass']."'>";
				
			foreach ($con->query($sql) as $row) {
				echo "<tr>";
				echo "<td><input type='checkbox' name='" . $row['NazwaUczestnika'] . "_POST'></td>";
				$id=0;
				$j=1;
				foreach ($row as $key => $value) {
					if ($id==0) {
						$id++;
						echo "<td><input type='text' name='name_" . $i . "' value='" . str_replace("~", " ", $row['NazwaUczestnika']) . "' readonly></td>";
						continue;
					}else{
						echo "<td><input max='12' min='0' step='.5' type='number' name='result".$j."_" . $i . "' value='".$value."'></td>";
					}
					$id++;
					$j++;
				}
				$j=1;
				$id=0;
				echo "</tr>";
				$i++;
			}
		} catch (\Throwable $th) {
			echo '<script>window.location.href = "index.php";</script>';	
		}
		?>
		</tbody>
	</table>
	<input type='submit' name='button' value='delete'>
	<input type='submit' name='button' value='update'>
</form>
</div>
</body>
<script>
	// export table to csv
	
</script>
</html>