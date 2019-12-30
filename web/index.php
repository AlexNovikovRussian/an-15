<?php

require('../vendor/autoload.php');

use FormulaParser\FormulaParser;

$app = new Silex\Application();
$app['debug'] = true;

$app->get('/', function() use($app) {
  return "Hello, world!";
});

$app->post('/bot', function() use($app) {
  $data = json_decode(file_get_contents('php://input'));

  if($data == ""){
  	return "nioh";
  }

  if($data->secret != getenv("VK_SECRET_TOKEN") && $data->type != "confirmation"){
  	return "nioh";
  }

switch($data->type){
	case "confirmation":
		return getenv("VK_SERVER_AUTH_TOKEN");


	case "message_new":

		$m = "";

		try {
		    $parser = new FormulaParser($data->object->body, 3);
		    $result = $parser->getResult(); // [0 => 'done', 1 => 16.38]
		    $m = $result[1];
		} catch (\Exception $e) {
		   $m = $e->getMessage();
		}

		$params = array(
			"access_token" => getenv(VK_GROUP_TOKEN),
			"v" => "5.69",
			"user_id" => $data->object->user_id,
			"messaage" => $m
		);

		file_get_contents('https://api.vk.com/method/messages.send?' . http_build_query($params));

		return 'ok';
}

});

$app->run();
