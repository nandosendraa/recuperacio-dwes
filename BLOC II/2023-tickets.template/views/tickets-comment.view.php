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
    <h2>Comentaris d'aquest ticket</h2>
    <?php if($comentaris):?>
    <ul>
    <?php foreach ($comentaris as $comentari): ?>
        <li><?=$comentari['msg']?></li>
    <?php endforeach;?>
    </ul>
    <?php else:?>
        <p>No hi ha cap comentari d'aquest ticket</p>
    <?php endif;?>

    <h2>Informacio del ticket</h2>
    <p>ID: <?=$data['id']?></p>
    <p>Titol: <?=$data['title']?></p>
    <p>Missatge: <?=$data['message']?></p>
    <p>Correu: <?=$data['email']?></p>
    <p>Creat el dia: <?=$data['created']?></p>

    <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif; ?>

    <h2>Nou comentari</h2>
    <form method="get" action="tickets-new-comment.php">
        <label for="message">Missatge: </label>
        <input type="text" name="message" id="message">
        <label for="date">Data: </label>
        <input type="date" name="date" id="date">
        <br>
        <button type="submit">Crear</button>
    </form>
</main>
</body>

</html>