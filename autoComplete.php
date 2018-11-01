<?php

try{
/*	require 'vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();

$params = [
    'index' => 'autocomplete',
    'type' => 'autocomplete',
    'id' => '1'
];

$response = $client->get($params);
//$array = $response['_source']['address'];
 */


$request = new HttpRequest();
$request->setUrl('http://localhost:9200/autocomplete/autocomplete/1');
$request->setMethod(HTTP_METH_GET);

$request->setHeaders(array(
  'postman-token' => 'a7f4cdf3-479d-3c15-bb65-6c51a5b874ed',
  'cache-control' => 'no-cache'
));

try {
  $response = $request->send();

  $data= $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}


$array  = $data['_source']['address'];//array('hello','helloworld', 'miniclip','michael jackson','million','milky way');
$input  = urldecode($_GET['word']); //Get input word/phrase (decode in case of spaces etc.)
$length = strlen($input);           //Get length of input word

$returned = preg_grep('/^(['.$input.']{'.$length.'}.*)$/i', $array); //Find matches in $array and return as array
$returned = array_values($returned);                                //Re-index from 0

echo json_encode($returned);

} catch (Exception $e){
	echo $e->getTraceAsString();
}
