<html>

<head>
  <title>Zaloguj się</title>
  <meta charset="UTF-8" />
  <meta http-equiv="pragma" content="no-cache" />
  <meta http-equiv="expires" content="-1" />
  <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
  <div id="main">
    <div id="form">
      <img id="logo" style="height:auto;width:100%" src="main_logo.svg" style="width:100%;height:auto"><br><br>
      <form method="post" action="ranking.php">
        <input type="text" placeholder="Login" name="user"></input>
        <input type="password" placeholder="Hasło" name="pass"></input>
        <input id="bttn" type="submit" value="Zaloguj"></input>
      </form>
      <a id="link" href="wyniki.php">Sprawdź Wyniki</a>
    </div>
  </div>
</body>

</html>