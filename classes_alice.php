<?php


class Alice_Session
{
  public $session_id = "";
  public $message_id = 0;
  public $user_id = "";
}

class Alice_Button
{
  public $title = "";
  public $payload;
  public $url = "";
  public $hide = false;
}




class Alice_Response
{
  public $text = "";
  public $tts = "";
  public $buttons;
  public $end_session = true;

  public function __construct()
  {
//    $buttons = new Alice_Button
  }
}

class Alice_Data_Out
{
  public $response;
  public $session;
  public $version = "1.0";

  public function __construct()
  {
    $response = new Alice_Response();
    $session = new Alice_Session();
  }
}

class Alice_Payload
{

}

?>
