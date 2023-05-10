<!doctype html>
<html lang="ca">
<head>
    <title>Gestor d'incidències</title>
    <link href="../assets/global.css" rel="stylesheet"/>
    <?php if ($mode == 'dark') :?>
    <link href="../assets/dark.css" rel="stylesheet"/>
    <?php endif;?>
</head>
<body>
<header>
    <h1>Gestor d'incidències</h1>
    <nav>
        <ul>
            <li>
                <a href="/">Inici</a>
            </li>
            <li>
                <a href="/register">Registre</a>
            </li>
            <li>
                <a href="/login">Inici de sessió</a>
            </li>
            <li>
                <a href="/logout">Tanca la sessió</a>
            </li>
            <li>
                <a href="/tickets-list">Incidències</a>
            </li>
            <li>
                Mode: <a href="/?mode=clar">clar</a> · <a href="/?mode=dark">oscur</a>
            </li>
            <li>
                <a href="/my-tickets-list">Les meues incidendies</a>
            </li>
        </ul>
    </nav>
</header>
<h2>Nou tiquet</h2>
<form method="post" action="tickets-new-process.php" enctype="multipart/form-data">

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
        <textarea name="message" id="message"><?=$data['message']?></textarea>
    </div>
    <div>
        <p>Fitxer addicional</p>
        <input type="file" name="screenshot"/>
    </div>
    <div>
        <input type="submit" value="Crear tiquet">
    </div>
</form>

</body>

</html>