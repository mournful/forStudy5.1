<?php
require_once 'vendor/autoload.php';

$result = '';

if (isset($_GET['adr'])) {
    $api = new \Yandex\Geo\Api();
    $api->setQuery($_GET['adr']);
    $api
        ->setLang(\Yandex\Geo\Api::LANG_RU) // локаль ответа
        ->load();
    $response = $api->getResponse();
    $collection = $response->getList();
    foreach ($collection as $item) {
        $result = 'Адрес: ' . $item->getAddress();
        $result .= '<br>';
        $result .= 'Широта:' . $item->getLatitude() .
            ' --- Долгота:' . $item->getLongitude();
        $result .= '<hr>';
    }
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yandex geo</title>
</head>
<body>
<h2>Поиск координат по адресу</h2>
<form name="ya" method="get">
    <label>Введите адрес:</label>
    <input type="text" name="adr">
    <input type="submit" value="Найти">
</form>
<hr>
<p>
    <?= $result; ?>
</p>
</body>
</html>
