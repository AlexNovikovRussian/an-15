<?php

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

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
}

});

$app->run();
