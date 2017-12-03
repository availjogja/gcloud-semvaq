<?php
namespace App\Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use google\appengine\api\taskqueue\PushTask;
use google\appengine\api\taskqueue\PushQueue;

final class TaskController {


  public function create(Request $request, Response $response){


    $task = new PushTask('/queue',['name' => 'queue', 'action' => 'send_reminder']);

    //$task_name = $task->add('kopet');
    //echo 'create task: '.$task_name ;

    $queue = new PushQueue('kopet');
    $e = $queue->addTasks([$task]);

    $response = $response
      ->withAddedHeader('Access-Control-Allow-Methods','POST, GET, OPTIONS')
      ->withAddedHeader('Access-Control-Allow-Origin','*');

    $r = $response->withJson($e);
    return $r;

  }

}
