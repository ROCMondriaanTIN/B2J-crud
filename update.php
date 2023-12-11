<?php
include 'db.php';
global $db;

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id){
    $query = $db->prepare("SELECT * FROM categorie WHERE id = :id");
    $query->bindParam('id', $id);
    $query->execute();
    $category = $query->fetch(PDO::FETCH_ASSOC);
} else{
    die('404 item not found');
}

if (isset($_POST['submit'])){
    if (!empty($_POST['name']) && !empty($_POST['img'])){
        $updateQuery = $db->prepare("UPDATE categorie SET naam = :naam, img = :img WHERE id = :id");
        $updateQuery->bindParam('naam', $_POST['name']);
        $updateQuery->bindParam('img', $_POST['img']);
        $updateQuery->bindParam('id', $id);
        if ($updateQuery->execute()){
            header('location: index.php');
        } else{
            $alert = "Er is iets mis gegaan met het updaten";
        }
    } else{
        $alert = "U heeft niet alles ingevuld";
    }
} else{
    $alert = "";
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form method="post">
    <label for="name">Naam</label>
    <input type="text" name="name" id="name" value="<?= $category['naam'] ?>"><br>
    <label for="img">Foto</label>
    <input type="text" name="img" id="img" value="<?= $category['img'] ?>"><br>
    <button name="submit">Verzenden</button>
</form>
<?= $alert ?>
</body>
</html>
