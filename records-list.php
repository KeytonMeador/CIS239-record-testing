<?php
/* 
List Partial — records-list.php
    Call records_all() and render a table matching the visual above.
    Escape all visible text with an HTML escaping function to prevent XSS. Why: user-provided values should never be rendered raw in HTML.
*/
$records = records_all();
?>

<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Artist</th>
            <th>Format</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($records as $record): ?>
            <tr>
                <td><?= htmlspecialchars($record['title']) ?></td>
                <td><?= htmlspecialchars($record['artist']) ?></td>
                <td><?= htmlspecialchars($record['format_name']) ?></td>
                <td><?= htmlspecialchars($record['price']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>