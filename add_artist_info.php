<?php
include_once('connection.php');

$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

$artist_name = $data['artist_name'];
$album_title = $data['album_title'];

$dbcon->beginTransaction();
$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
    $stmt = $dbcon->prepare('INSERT INTO artists (Name) VALUES (:name)');
    $stmt->bindParam(':name', $artist_name, PDO::PARAM_STR);
    $stmt->execute();

    $artist_id = $dbcon->lastInsertId();

    $stmt = $dbcon->prepare('INSERT INTO albums (Title, ArtistId) VALUES (:title, :artist_id)');
    $stmt->bindParam(':title', $album_title, PDO::PARAM_STR);
    $stmt->bindParam(':artist_id', $artist_id, PDO::PARAM_INT);
    $stmt->execute();

    $dbcon->commit();
    echo 'Artisti lisätty';
} catch (PDOException $e) {
    $dbcon->rollBack();
    echo 'Error adding artist and album: ' . $e->getMessage();
}

?>
