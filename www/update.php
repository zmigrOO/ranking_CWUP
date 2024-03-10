<?php
$con = mysqli_connect("mysql", $_POST['user'], $_POST['pass'], "ranking");
$sql1 = "SELECT NazwaUczestnika FROM wyniki";
$team = "";
if (isset($_POST['team'])) {
	$team = str_replace(" ", "~", $_POST['team']);
}

switch ($_POST['button']) {
	case 'update':
		$count = 1;
		foreach ($con->query($sql1) as $row) {
			$con->query("UPDATE `wyniki` SET `Wynik1`='" . $_POST['result1_' . $count] . "',Wynik2='" . $_POST['result2_' . $count] . "',Wynik3='" . $_POST['result3_' . $count] . "' ,Wynik4='" . $_POST['result4_' . $count] . "' ,Wynik5='" . $_POST['result5_' . $count] . "' WHERE `wyniki`.`NazwaUczestnika`='" . str_replace(" ", "~", $_POST['name_' . $count]) . "';");
			// UPDATE `wyniki` SET `Wynik1` = '4', `Wynik2` = '5', `Wynik3` = '6' WHERE `wyniki`.`Id` = 20
			$count++;
		}
		break;
	case 'delete':
		foreach ($con->query($sql1) as $team) {
			if (isset($_POST[$team['NazwaUczestnika']."_POST"])){
				$con->query("DELETE FROM `wyniki` WHERE `wyniki`.`NazwaUczestnika` = '" . $team['NazwaUczestnika'] . "';");
			}
		}
		break;
	case 'add':
		// select count(*) from wyniki where NazwaUczestnika=$_POST['team'] as a single row
		$a = $con->query("SELECT count(*) FROM wyniki WHERE NazwaUczestnika='" . $team . "';");
		// if a > 0 then echo "team already exists"
		if(!$a->fetch_assoc()['count(*)'] > 0){
			if($team){
				$con->query("INSERT INTO `wyniki` (`NazwaUczestnika`) VALUES ('" . $team . "');");
			}
		}
		break;
}
echo '<form method="post" name="form" action="ranking.php">
<input type="hidden" name="user" value="' . $_POST['user'] . '"></input>
<input type="hidden" name="pass" value="' . $_POST['pass'] . '"></input>
</form>
<script>window.onload = function(){
	document.forms["form"].submit();
  }</script>';
