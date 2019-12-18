<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/Templates/css/style.css">
    <title>Persons</title>
</head>
<body>

<h1>Список персон максимального возраста "<?php /** @var \View\View $data */
    echo $data['maxAge']; ?>"</h1>

<table>
    <tr>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Возраст</th>
    </tr>
    <?php
    foreach($data['persons'] as $persons) : ?>
        <tr>
            <td><?php echo $persons->lastname; ?></td>
            <td><?php echo $persons->firstname; ?></td>
            <td><?php echo $persons->age; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<hr>

</body>
</html>
