<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__.'/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__.'/..');
$dotenv->load();

$sdk = new Aws\Sdk([
    'credentials' => [
        'key' => getenv('AWS_SDK_CREDENTIALS_KEY'),
        'secret' => getenv('AWS_SDK_CREDENTIALS_SECRET'),
    ],
    'region' => getenv('AWS_SDK_REGION'),
    'version' => 'latest',
]);

$dynamodb = $sdk->createDynamoDb();

$scanParams = [
    'TableName' => 'LogRoomsAllotment',
    'ExpressionAttributeValues' => [
        ':hotel_id' => ['N' => '40446'],
    ],
    'FilterExpression' => 'hotel_id = :hotel_id',
];

$results = $dynamodb->scan($scanParams);
dump($results);
