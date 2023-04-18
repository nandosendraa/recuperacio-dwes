<!doctype html>
<html lang="ca">
<head>
    <title>Gestor d'incidències</title>
    <link href="assets/global.css" rel="stylesheet"/>
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
    <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif; ?>
    <h2>Nou usuari</h2>
    <form method="post" action="register.php">
        <label for="user">Usuari: </label>
        <input type="text" name="user" id="user">
        <label for="password">Contrasenya: </label>
        <input type="password" name="password" id="password">
        <br>
        <button type="submit">Crear</button>
    </form>
</main>
</body>
</html>
