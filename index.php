<?php
require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);



if (
  !empty($_POST['firstname'])
  && !empty($_POST['lastname'])
  && (strlen($_POST['firstname']) <= 45)
  && (strlen($_POST['lastname']) <= 45)
) {
  $firstname = str_replace(' ', '', $_POST['firstname']);
  $lastname = str_replace(' ', '', $_POST['lastname']);

  $query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
  $statement = $pdo->prepare($query);

  $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
  $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

  $statement->execute();

  header('Location: index.php');
}


$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($friends as $friend => $value) {
  echo "<li>$value[firstname] $value[lastname]</li>";
}

echo "<br>";

?>

<!-- $query = "INSERT INTO friend (firstname, lastname) VALUES ('Chandler', 'Bing')";
 $statement = $pdo->exec($query);

 $query = "SELECT * FROM friend";
 $statement = $pdo->query($query);
 $friends = $statement->fetchAll();

 var_dump($friends); -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajoute un friend</title>
</head>

<body>
  <form action="" method="post">
    <label for="firstname">Prénom</label>
    <input type="text" id="firstname" name="firstname">
    <label for="lastname">Nom</label>
    <input type="text" id="lastname" name="lastname">
    <input type="submit" value="Ajouter">
  </form>
</body>

</html>