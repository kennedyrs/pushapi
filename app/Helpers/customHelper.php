<?php

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;


if (!function_exists('notificationOneSignal')) {
  function notificationOneSignal($playId, $title, $mensagem)
  {


    $title = utf8_encode($title);
    $mensagem = utf8_encode($mensagem);
    #$playId = json_encode($playId);
    #dd($title);
    #$mensagem = (string)json_encode($mensagem);

    try {
     $client = new GuzzleHttpClient();

     $headings = array(
      "en" => $title,
      "pt" => $title
    );

     $content = array(
      "en" => $mensagem,
      "pt" => $mensagem
    );

     $fields = array(
      'app_id' => env('ONESIGNAL_APP_ID'),
      'include_player_ids' => array($playId),
      'headings' => $headings,
      'contents' => $content
    );

     $fields = json_encode($fields);
  

     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
       'Authorization: Basic ODMzYjY0YjctNjg0ZC00M2RlLWFiY2EtYTRkMDY0YzNjNDU2'));
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
     curl_setopt($ch, CURLOPT_HEADER, FALSE);
     curl_setopt($ch, CURLOPT_POST, TRUE);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

     #return $fields;
     $response = curl_exec($ch);
     curl_close($ch);

     return $response;
   } catch (Exception $e) {
      return $e;
   }
   
 }
}