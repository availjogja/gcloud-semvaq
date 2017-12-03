<?php
namespace App\Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use google\appengine\api\taskqueue\PushTask;
use google\appengine\api\taskqueue\PushQueue;

final class TaskController {


  public function create(Request $request, Response $response){

    $task1 = new PushTask('/task/run',['name' => 'run', 'action' => 'send_reminder']);
    $task2 = new PushTask('/task/run',['name' => 'run', 'action' => 'send_reminder']);

    $queue = new PushQueue('kopet');
    $e = $queue->addTasks([$task1,$task2]);
	$res = [
		'status' => 'success',
		'tasks' => $e
	];
    $response = $response
      ->withAddedHeader('Access-Control-Allow-Methods','POST, GET, OPTIONS')
      ->withAddedHeader('Access-Control-Allow-Origin','*');

    $r = $response->withJson($e);
    return $r;

  }

  public function run(Request $request, Response $response){
	return 'task ok';
  }

}
