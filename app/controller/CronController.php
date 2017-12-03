<?php
namespace App\Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

final class CronController {


  public function home(Request $request, Response $response){
	
  
  $msg = 'iki kronjot @'.date('Y-m-d H:i:s');
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
  $result = file_get_contents($url, false, $context);

    $r = $response->withJson(result);
    return $r;

  }


}
