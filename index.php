<?php
session_start();
include "db.php";

global $db;
$query = $db->prepare("SELECT * FROM categorie");
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

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
<?php
if (isset($_SESSION['message'])){
    echo $_SESSION['message'];
}
?>
<table>
<thead>
<tr>
    <th scope="col">Naam</th>
    <th scope="col">Update</th>
    <th scope="col">Delete</th>
</tr>
</thead>
<tbody>
    <?php foreach ($categories as $category) : ?>
    <tr>
        <td><?= $category['naam'] ?></td>
        <td><a href="update.php?id=<?= $category['id'] ?>">Update</a></td>
        <td><a href="delete.php?id=<?=$category['id']?>">Delete</a></td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>
</body>
</html>
