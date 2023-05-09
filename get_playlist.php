<?php
include_once('connection.php');

if (isset($_GET['playlist_id'])) {
    $playlist_id = $_GET['playlist_id'];

    try {
        $stmt = $dbcon->prepare("SELECT tracks.Name, artists.Name FROM tracks
        INNER JOIN playlist_track ON tracks.TrackId = playlist_track.TrackId
        INNER JOIN playlists ON playlist_track.PlaylistId = playlists.PlaylistId
        INNER JOIN albums ON tracks.AlbumId = albums.AlbumId
        INNER JOIN artists ON albums.ArtistId = artists.ArtistId
        WHERE playlists.PlaylistId = :playlist_id ");
        $stmt->bindParam(':playlist_id', $playlist_id);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            echo "Kappale: " . $row[0] . "<br>";
            echo "Säveltäjä: " . $row[1] . "<br><br>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "error: Väärä ID";
}
?>
