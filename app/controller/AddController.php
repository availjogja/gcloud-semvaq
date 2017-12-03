<?php
namespace App\Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \MongoDB as Mongo;
use \Predis as Predis;

final class AddController {

  public function kiwot(Request $request, Response $response){

    echo '<!DOCTYPE html>
    <html>
    <body>

    <form method="post" enctype="multipart/form-data">
      category: <input type="text" name="category" value=""/><br/>
      domain: <input type="text" name="domain" value=""/><br/>
      kiwot:<br/> <textarea name="kiwot" cols="75" rows="15"></textarea><br/>
      <input type="submit" value="Hajar"/>
    </form>

    </body>
    </html>';


    if(isset($_POST)){

      $redis = new Predis\Client($_SERVER['REDIS']);

      $category = $_POST['category'];
      $domain = $_POST['domain'];

      //gilingan kiwot
      $kiwot = explode("\n",$_POST['kiwot']);
      $kiwot = array_unique($kiwot);

      $ec = [];
      foreach($kiwot as $c){
        $kws = explode(' ',$c);
        $c = trim($c);
        if(count($kws)>2){

          $id = sha1($c);
          $ee = [
            '_id' => $id,
            'title' => $c,
            'category' => $_POST['category'],
            'domain' => $_POST['domain'],
            'added' => date('Y-m-d H:i:s'),
            'status' => 'available'
          ];
          //$ec[] = $redis->set('kiwot_'.$id,json_encode($ee));
          $ec[] = $redis->lpush('key_'.$_POST['domain'], (json_encode($ee)));

        }
      }

      echo '<pre>';
      print_r($ec);

    }

    return '';
  }

  public function mongokiwot(Request $request, Response $response){

    echo '<!DOCTYPE html>
    <html>
    <body>

    <form method="post" enctype="multipart/form-data">
      category: <input type="text" name="category" value=""/><br/>
      domain: <input type="text" name="domain" value=""/><br/>
      kiwot:<br/> <textarea name="kiwot" cols="75" rows="15"></textarea><br/>
      <input type="submit" value="Hajar"/>
    </form>

    </body>
    </html>';

    if(isset($_POST)){

      $mongo = new Mongo\Client($_SERVER['MONGODB']);
      $db = basename($_SERVER['MONGODB']);

      $category = $_POST['category'];
      $domain = $_POST['domain'];

      //gilingan kiwot
      $kiwot = explode("\n",$_POST['kiwot']);
      $kiwot = array_unique($kiwot);

      $ec = [];
      foreach($kiwot as $c){
        $kws = explode(' ',$c);
        $c = trim($c);
        if(count($kws)>2){

          $id = sha1($c);
          $f = $mongo->$db->kiwots->findOne(['_id' => $id]);
          if($f){

          }else{

            $ee = [
              '_id' => $id,
              'title' => $c,
              'category' => $_POST['category'],
              'domain' => $_POST['domain'],
              'added' => date('Y-m-d H:i:s'),
              'status' => 'available'
            ];

            //insert to db
            $rt = $mongo->$db->kiwots->insertOne($ee);
            $ee['res'] = $rt->getInsertedId();
            $ec[] = $ee;

          }

        }
      }

      echo '<pre>';
      print_r($ec);

    }

    return '';
  }

}
