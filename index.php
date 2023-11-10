<!DOCTYPE html>
<html lang="cs-cz">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <script src="https://unpkg.com/htmx.org@1.9.8"></script>
  <title>Návštěvní kniha</title>
</head>

<body>
  <form action="./send.php" method="post">
    <label for="name">Jméno</label>
    <input type="text" name="name" id="name" required>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
    <label for="message">Zpráva</label>
    <textarea name="message" id="message" cols="30" rows="10" style="resize: none" required></textarea>
    <input type="submit" value="Odeslat">
  </form>
  <?php
    if($_GET["res"] == 1){
      echo "<p>Zpráva byla úspěšně odeslána</p>";
    }
  ?>
</body>

</html>