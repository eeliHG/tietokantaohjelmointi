<?php
$artist_id = $_GET['artist_id'];
include_once('connection.php');
$dbcon->beginTransaction();

try {
    $stmt = $dbcon->prepare('DELETE FROM invoice_items WHERE TrackId IN (SELECT TrackId FROM tracks WHERE AlbumId IN (SELECT AlbumId FROM albums WHERE ArtistId = :artist_id))');
    $stmt->bindParam(':artist_id', $artist_id, PDO::PARAM_INT);
    $stmt->execute();

    $stmt = $dbcon->prepare('DELETE FROM playlist_track WHERE TrackId IN (SELECT TrackId FROM tracks WHERE AlbumId IN (SELECT AlbumId FROM albums WHERE ArtistId = :artist_id))');
    $stmt->bindParam(':artist_id', $artist_id, PDO::PARAM_INT);
    $stmt->execute();

    $stmt = $dbcon->prepare('DELETE FROM tracks WHERE AlbumId IN (SELECT AlbumId FROM albums WHERE ArtistId = :artist_id)');
    $stmt->bindParam(':artist_id', $artist_id, PDO::PARAM_INT);
    $stmt->execute();

    $stmt = $dbcon->prepare('DELETE FROM albums WHERE ArtistId = :artist_id');
    $stmt->bindParam(':artist_id', $artist_id, PDO::PARAM_INT);
    $stmt->execute();

    $stmt = $dbcon->prepare('DELETE FROM artists WHERE ArtistId = :artist_id');
    $stmt->bindParam(':artist_id', $artist_id, PDO::PARAM_INT);
    $stmt->execute();

    $dbcon->commit();

    echo 'Artisti poistettu';
} catch (PDOException $e) {
    // Jos ilmenee ongelmia suoritetaan rollback
    $dbcon->rollBack();
    echo 'Tapahtui virhe: ' . $e->getMessage();
}
