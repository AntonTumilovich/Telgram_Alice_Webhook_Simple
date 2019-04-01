<?php

  include_once 'webhook_class.php';


  $Yandex_Alice_Cli = new Yandex_Alice_Cli_Class();

  $Webhook = new Webhook_Class();

  $Webhook->Set_Type('yandex_alice');
  $Webhook->Get_Data();
  $Webhook->Parse_Data();
  $Webhook->Parse_Tokens();

  if ($Webhook->is_Out())
  {
    $Yandex_Alice_Cli->Set_Sess_Id($Webhook->data_msg_sess_id);
    $Yandex_Alice_Cli->Send($Webhook->user_id, $Webhook->out_msg);
  }

?>
