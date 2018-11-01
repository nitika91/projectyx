<?php
require 'vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();

$params = [

    'index' => 'autocomplete',

    'type'  => 'autocomplete',

    'id'    => '1',

    'body'  => ['address' => ['hello','helloworld','hellouniverse','hell']],

];

$response = $client->index($params);

print_r($response);
