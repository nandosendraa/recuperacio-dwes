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
                <a href="login.php">Inici de sessió</a>
            </li>
            <li>
                <a href="logout.php">Tanca la sessió</a>
            </li>
            <li>
                <a href="tickets-list.php">Incidències</a>
            </li>
        </ul>
    </nav>
</header>
<h2>Login</h2>

<?php if (!empty($_SESSION['errors'])): ?>
    <ul>
        <?php foreach ($_SESSION['errors'] as $error) : ?>
            <li><?= $error ?></li>
        <?php endforeach ?>
    </ul>
<?php endif; ?>
<form action="login-process.php" method="post" novalidate>
    <div>
        <label for="username">Username</label>
        <input type="text"
               name="username" id="username"
               value="<?= $username ?>"
               placeholder="Username:" required>
    </div>
    <div>
        <label for="password">Contrasenya</label>
        <input type="password"
               name="password" id="password"
               value="<?= null ?? "" ?>"
               placeholder="Password:" required>
    </div>
    <input type="submit" value="Login">
</form>

