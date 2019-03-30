<?php

  include_once 'webhook_parse.php';

  $tg_bot_token = "_____YOUR_BOT_TOKEN_____";


  $tokens = array();
  $user_id = "";





function Send_Out($user_id, $text, $is_end = true)
{
  global $tg_bot_token;
  if (strlen($user_id) < 1 || strlen($text) < 1) {return;}
  $json = file_get_contents('https://api.telegram.org/bot' . $tg_bot_token . '/sendMessage?chat_id=' . $user_id . '&text=' . $text);
}



$request = file_get_contents('php://input');
$request = json_decode($request, TRUE);

if (!$request)
{
  die();
    // Some Error output (request is not valid JSON)
}
else if (!isset($request['update_id']) || !isset($request['message']))
{
  die();
    // Some Error output (request has not message)
}
else
{
  $user_id = $request['message']['from']['id'];
  $msg_user_name = $request['message']['from']['first_name'];
  $msg_user_last_name = $request['message']['from']['last_name'];
  $msg_user_nick_name = $request['message']['from']['username'];
  $msg_chat_id = $request['message']['chat']['id'];
  $msg_text = $request['message']['text'];


  $msg_text = mb_strtolower($msg_text, 'UTF-8');


  $tokens = explode(" ", $msg_text);
}


  /////// PARSING ///////


  $Out_Str = Parse_Tokens($tokens);

  Send_Out($user_id, $Out_Str);



?>
