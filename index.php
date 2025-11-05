<?php
require __DIR__ . '/data/functions.php';
include __DIR__ . '/components/nav.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Store</title>
    <link rel="stylesheet" href="assets/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <h2>Unit Test 1 — Formats</h2>
    <?php
    $formats = formats_all();
    $format_names = [];
    foreach ($formats as $f) {
        $format_names[] = $f['name'];
    }
    $out = '';
    foreach ($format_names as $i => $name) {
        if ($i > 0) $out .= ', ';
        $out .= $name;
    }
    echo 'Formats: ' . $out;
    ?>
    <hr>

    <h2>Unit Test 2 — Records JOIN</h2>
    <?php
    $records = records_all();
    $lines = [];
    for ($i = 0; $i < 3 && $i < count($records); $i++) {
        $r = $records[$i];
        $lines[] = "{$r['title']} — {$r['format_name']} - \${$r['price']}";
    }
    foreach ($lines as $line) {
        echo $line . "\n";
    }
    ?>
    <hr>

    <h2>Unit Test 3 — Insert</h2>
    <?php
    $insert_data = [
        'title' => 'Demo Title',
        'format_id' => 1,
        'artist' => 'Demo Artist',
        'price' => 9.99
    ];

    record_insert();
    $records = records_all();
    $newest = $records[0];
    echo " \n Newest: {$newest['title']} - {$newest['format_name']}";

    ?>
    <hr>

</body>

<!-- Routing — All views on index.php

    Read a view value from the URL. Default to list.
    Read a hidden action from the form on POST. When it is create, insert the record then set view to created.
    Based on view, include the matching partial from partials/.
-->

<?php
$view = $_GET['view'] ?? 'list';
$action = $_POST['action'] ?? '';
if ($action === 'create') {
    record_insert();
    $view = 'created';
}
?>

<body class="bg-light">
    <div class="container py-4">
        <?php
        if ($view === 'list') {
            include __DIR__ . '/partials/records-list.php';
        } elseif ($view === 'create') {
            include __DIR__ . '/partials/record-form.php';
        } elseif ($view === 'created') {
            include __DIR__ . '/partials/record-created.php';
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>