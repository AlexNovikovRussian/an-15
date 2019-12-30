<?php

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

$app->get('/', function() use($app){
	return "Hello, world!"
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
		$params = array(
			"access_token" => getenv(VK_GROUP_TOKEN),
			"v" => "5.69",
			"user_id" => ""
}

});

$app->run();
