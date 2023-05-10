<!doctype html>
<html lang="ca">
<head>
    <title>Gestor d'incidències</title>
    <link href="../assets/global.css" rel="stylesheet"/>
</head>
<body>
<header>
    <h1>Gestor d'incidències</h1>
    <nav>
        <ul>
            <li>
                <a href="index.php">Inici</a>
            </li>
            <li>
                <a href="register.php">Registre</a>
            </li>
            <li>
                <a href="login.php">Inici de sessió</a>
            </li>
            <li>
                <a href="logout.php">Tanca la sessió</a>
            </li>
            <li>
                <a href="tickets-list.php">Incidències</a>
            </li>
            <li>
                <a href="my-tickets-list.php">Les meues incidendies</a>
            </li>
        </ul>
    </nav>
</header>
<main>
    <section>
        <h2>Tiquets</h2>
        <table>
            <tr>
                <th>id</th>
                <th>títol</th>
                <th>descripció</th>
                <th>data de creació</th>
                <th>estat</th>
            </tr>
            <?php foreach ($tickets as $ticket): ?>
                <tr>
                    <td><?= $ticket["id"] ?></td>
                    <td><?= $ticket["title"] ?></td>
                    <td><?= $ticket["message"] ?></td>
                    <td><?= $ticket["created"] ?></td>
                    <td><?= $ticket["status_id"] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
</main>
</body>

</html>

