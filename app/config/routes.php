<?php
$app->get('/', '\App\Controller\BlogController:home');

$app->get('/task/create', '\App\Controller\TaskController:create');
$app->get('/task/run', '\App\Controller\TaskController:run');
/*
$app->get('/ccreate', function ($request, $response) {

  $task = new PushTask('/queue',['name' => 'queue', 'action' => 'send_reminder']);

  //$task_name = $task->add('kopet');
  //echo 'create task: '.$task_name ;

  $queue = new PushQueue('kopet');
  $e = $queue->addTasks([$task]);
  $e = implode(',',$e);
  return 'Task added: '.$e;

});

$app->post('/queue', function ($request, $response) {

  $msg = 'kopet';
  $url = 'https://hooks.slack.com/services/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';
  $data = ['text' => $msg];
  $headers = "Content-Type: application/json";
  $context = [
      'http' => [
          'method' => 'POST',
          'header' => $headers,
          'content' => json_encode($data),
      ]
  ];
  $context = stream_context_create($context);
  return file_get_contents($url, false, $context);

});
*/
$app->get('/cron', function ($request, $response) {


});

?>
