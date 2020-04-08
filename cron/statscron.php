<?php
/* скрипт для выполнения кроном в конце каждого дня */
require __DIR__ . '../vendor/autoload.php';

use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;

// Создаем в базе запись с датой следующего дня
Stats::createNewDay(date("d.m.y", strtotime("+1 day")));

// Инициализируем клиент
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '../credentials.json');
$client = new Google_Client;
$client->useApplicationDefaultCredentials();
$client->setApplicationName("Test task");
$client->setScopes(['https://www.googleapis.com/auth/drive', 'https://spreadsheets.google.com/feeds']);

if ($client->isAccessTokenExpired()) {
    $client->refreshTokenWithAssertion();
}

$accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
ServiceRequestFactory::setInstance(
    new DefaultServiceRequest($accessToken)
);

// Получаем документ для редактирования
$spreadsheet = (new Google\Spreadsheet\SpreadsheetService)
    ->getSpreadsheetFeed()
    ->getByTitle('Table');
$worksheets = $spreadsheet->getWorksheetFeed()->getEntries();
$worksheet = $worksheets[0];

// Добавляем заголовки
$listFeed = $worksheet->getListFeed();
$cellFeed = $worksheet->getCellFeed();
$cellFeed->editCell(1, 1, 'дата');
$cellFeed->editCell(1, 2, "добавлено");
$cellFeed->editCell(1, 3, "удалено");

// Получаем статистику за сегодняшний день из базы
$row = Stats::getByDate(date("d.m.y"));

// Вставляем запись в документ
$listFeed->insert([
    'дата' => $row[0],
    'добавлено' => $row[1],
    'удалено' => $row[2],
]);
