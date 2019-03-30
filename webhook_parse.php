<?php

function Parse_Tokens($tokens)
{
  $out = "";

  // do something with tokens //

  $out =  "Your eneter " . count($tokens) . " words : " . implode($tokens, " ");

  return $out;
}

?>
