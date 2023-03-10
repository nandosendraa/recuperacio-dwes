<!doctype html>
<html lang="ca">
<head>
    <title>Gestor d'incidències</title>
    <link href="assets/global.css" rel="stylesheet"/>
    <?php if ($mode == 'dark') :?>
    <link href="assets/dark.css" rel="stylesheet"/>
    <?php endif;?>
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
            <li>
                Mode: <a href="index.php?mode=clar">clar</a> · <a href="index.php?mode=dark">oscur</a>
            </li>
        </ul>
    </nav>
</header>
<h2>Nou tiquet</h2>
<form method="post" action="tickets-new-process.php">

    <?php if (!empty($message)) :?>
        <h3><?=$message?></h3>
    <?php endif ?>
    <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif; ?>

    <div>
        <label for="title">Title</label>
        <input id="title" type="text" name="title" value=<?=$data['title']?>>
    </div>

    <div>
        <label for="email">Correu electrònic</label>
        <input id="email" type="text" name="email" value=<?=$data['email']?>>
    </div>

    <div>
        <label for="message">Missatge</label>
        <textarea name="message" id="message" placeholder=<?=$data['message']?>></textarea>
    </div>
    <div>
        <p>Fitxer addicional</p>
        <input type="file" name="img"/>
    </div>
    <div>
        <input type="submit" value="Crear tiquet">
    </div>
</form>

</body>

</html>