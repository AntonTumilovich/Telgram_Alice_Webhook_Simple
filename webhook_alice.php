<?php

  include_once 'classes_alice.php';
  include_once 'webhook_parse.php';


  $is_user_logined = false;

  $user_name = "";
  $user_email = "";
  $tokens = array();
  $client_id = "";
  $user_id = "";



  $data_req = array();
  $data_session = array();
  $data_msg = "";
  $data_nlu = array();
  $data_tokens = array();
  $data_token_count = 0;

  $data_meta = array();
  $data_client_id = "";

  $data_msg_new = false;
  $data_msg_id = "";
  $data_msg_sess_id = "";
  $data_msg_skill_id = "";

  $original_utterance = "";




function Send_Out($user_id, $out_text, $out_tts = "", $is_end = false)
{
  global $data_msg_sess_id;

  ///// GENERATE BASE OF OUT //////
    $Data_Out = new Alice_Data_Out();
    $Data_Out->response = new Alice_Response();
    $Data_Out->session = new Alice_Session();
  ///// GENERATE BASE OF OUT End //////

  ///// OUT MSG GENERATE /////
  $Data_Out->session->session_id = $data_msg_sess_id;;
  $Data_Out->session->user_id = $user_id;

  $Data_Out->response->text = $out_text;
  $Data_Out->response->tts = $out_tts;

  if (strlen($out_tts) < 1) {$Data_Out->response->tts = $out_text;}

  $Data_Out->response->end_session = $is_end;


  header('Content-Type: application/json');
  print(json_encode($Data_Out, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT));

  die();
}





$data = json_decode(trim(file_get_contents('php://input')), true);



//// Parse in msg ////
if (isset($data['request']))
{

//original_utterance


  if (isset($data['meta']))
  {
    $data_meta = $data['meta'];
    if (isset($data_meta['client_id'])) {$client_id = $data_meta['client_id'];}
  }

  if (isset($data['request']))
  {
    $data_req = $data['request'];

    if (isset($data_req['original_utterance']))
    {
      $original_utterance = $data_req['original_utterance'];
    }


    if (isset($data_req['command'])) {$data_msg = $data_req['command'];}
    if (isset($data_req['nlu']))
    {
      $data_nlu = $data_req['nlu'];
      if (isset($data_nlu['tokens'])) {$tokens = $data_nlu['tokens'];}
//      $data_token_count = count($data_tokens);
    }
  }
  if (isset($data['session']))
  {
    $data_session = $data['session'];
    if (isset($data_session['new'])) {$data_msg_new = $data_session['new'];}
    if (isset($data_session['message_id'])) {$data_msg_id = $data_session['message_id'];}
    if (isset($data_session['session_id'])) {$data_msg_sess_id = $data_session['session_id'];}
    if (isset($data_session['skill_id'])) {$skill_id = $data_session['skill_id'];}
    if (isset($data_session['user_id'])) {$user_id = $data_session['user_id'];}
  }
}

//// Parse in msg End////

  if (strpos($tokens[0], "ping") > -1)     {Send_Out("pong", "", true);}



  $Out_Str = Parse_Tokens($tokens);

  Send_Out($user_id, $Out_Str);





?>
