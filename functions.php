<?php
require_once __DIR__ . '/db.php';
/* 
formats_all(): array

Return an array id and name from formats, ordered by name.

On index.php, label output as Unit Test 1 — Formats and print the returned formats
    cd, 8 track, mp4, 45, 728 
*/
function formats_all(): array
{
    $pdo = get_pdo();
    $stmt = $pdo->query('SELECT id, name FROM formats ORDER BY name ASC');
    return $stmt->fetchAll();
}


/* 
records_all(): array

Use a prepared SELECT with a JOIN so each record shows title, artist, price, and format name.

On index.php, label output as Unit Test 2 — Records JOIN and print first 3 lines like:
    Abbey Road — 45 - $19.99
*/
function records_all(): array
{
    $pdo = get_pdo();
    $stmt = $pdo->query('SELECT records.title, records.artist, records.price, formats.name AS format_name FROM records JOIN formats ON records.format_id = formats.id ORDER BY records.id DESC');
    return $stmt->fetchAll();
}

/*
record_insert(): void
Create these variables inside the function for now: $title, $artist, $price, $format_id.

Use a prepared INSERT with named placeholders (:title, :artist, etc.).

After execution, check how many rows were affected with $stmt->rowCount(). It returns the number of rows changed — if one record was added, it should be 1.

On index.php, label output as Unit Test 3 — Insert and echo something like:
    Insert success: true, rows: 1
    
Then call records_all() again to confirm your new record appears at the top.
*/

function record_insert(): void
{
    $title = 'Demo Title';
    $artist = 'Demo Artist';
    $price = 9.99;
    $format_id = 1;

    $pdo = get_pdo();
    $stmt = $pdo->prepare('INSERT INTO records (title, artist, price, format_id) VALUES (:title, :artist, :price, :format_id)');

    $stmt->execute([
        'title' => $title,
        'artist' => $artist,
        'price' => $price,
        'format_id' => $format_id
    ]);

    if ($stmt->rowCount() === 1) {
        echo "Insert success: true, rows: 1";
    } else {
        echo "Insert success: false, rows: 0";
    }

    $records = records_all();
}
