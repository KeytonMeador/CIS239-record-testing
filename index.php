<?php
require __DIR__ . '/data/functions.php';
?>

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




?>
<hr>

<h2>Unit Test 3 — Insert</h2>
<?php
?>
<hr>


<!-- 
Expected Output (example)
Unit Test 1 — Formats

Formats: cd, 8 track, mp4, 45, 72
Unit Test 2 — Records JOIN

Kind of Blue — cd - $14.99
Abbey Road — 45 - $19.99
1989 (Taylor’s Version) — mp4 - $12.49
Unit Test 3 — Insert

Insert success: true, rows: 1
Newest: Demo Title — cd 
-->