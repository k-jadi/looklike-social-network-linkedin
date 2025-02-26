<?PHP 
session_start();
$nouveau_nombre_likes = 0;

$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');
$likes = $bdd->prepare('SELECT * FROM likes WHERE id_post = ? AND id_liker = ?');
$likes->execute(array($_GET['id_post'], $_GET['id_liker']));
$nombre_likes = $likes->rowCount();

if ($nombre_likes == 0) {
    $incrementer_likes = $bdd->prepare('INSERT INTO likes(id_post,id_liker) VALUES(?,?)');
    $incrementer_likes->execute(array($_GET['id_post'], $_GET['id_liker']));
}

$total_nombre_likes = $bdd->prepare('SELECT * FROM likes WHERE id_post=? ');
$total_nombre_likes->execute(array($_GET['id_post']));
$nouveau_nombre_likes = $total_nombre_likes->rowCount();


$res = ["nbr_likes" => $nouveau_nombre_likes];
echo json_encode($res);

