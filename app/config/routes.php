<?php
/*
  Home
*/
$app->get('/', '\App\Controller\BlogController:home');

/*
  Task Queue
*/
$app->get('/task/create', '\App\Controller\TaskController:create');
$app->get('/task/run', '\App\Controller\TaskController:run');

/*
  Cronjob
*/
$app->get('/cron', '\App\Controller\CronController:home');

?>
