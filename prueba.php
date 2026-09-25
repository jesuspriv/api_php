<?php

const API_URL = "https://whenisthenextmcufilm.com/api";

$ch = curl_init(API_URL);

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CAINFO => "C:\\php-8.5.11\\extras\\ssl\\cacert.pem",
]);

$result = curl_exec($ch);

if ($result === false) {
    die("ERROR CURL: " . curl_error($ch));
}

$data = json_decode($result, true);

if ($data === null) {
    die("ERROR JSON: " . json_last_error_msg());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
    >

    <style>
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        main {
            width: min(100%, 700px);
            text-align: center;
        }

        article {
            margin: 0 auto;
        }

        img {
            display: block;
            margin: 0 auto 1rem;
        }
    </style>

    <title>Próxima película de Marvel</title>
</head>

<body>

    <main>
        <h1>Próxima producción de Marvel</h1>

        <article>
            <h2><?= $data["title"] ?></h2>

            <img
                src="<?= $data["poster_url"] ?>"
                alt="Póster de <?= $data["title"] ?>"
                width="300"
            >

            <p>
                <?= $data["overview"] ?>
            </p>

            <p>
                <strong>Fecha de estreno:</strong>
                <?= $data["release_date"] ?>
            </p>

            <p>
                <strong>Tipo:</strong>
                <?= $data["type"] ?>
            </p>

            <p>
                <strong>Faltan:</strong>
                <?= $data["days_until"] ?> días
            </p>
        </article>
    </main>
</body>
</html>