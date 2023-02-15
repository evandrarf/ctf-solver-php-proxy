<?php
function str_rot_pass($str, $key, $decrypt = false)
{

  // if key happens to be shorter than the data
  $key_len = strlen($key);

  $result = str_repeat(' ', strlen($str));

  for ($i = 0; $i < strlen($str); $i++) {

    if ($decrypt) {
      $ascii = ord($str[$i]) - ord($key[$i % $key_len]);
    } else {
      $ascii = ord($str[$i]) + ord($key[$i % $key_len]);
    }

    $result[$i] = chr($ascii);
  }

  return $result;
}
function base64_url_encode($input)
{
  // = at the end is just padding to make the length of the str divisible by 4
  return rtrim(strtr(base64_encode($input), '+/', '-_'), '=');
}

function base64_url_decode($input)
{
  return base64_decode(str_pad(strtr($input, '-_', '+/'), strlen($input) % 4, '=', STR_PAD_RIGHT));
}

function url_encrypt($url, $key = false)
{


  $url = str_rot_pass($url, $key);


  return  base64_url_encode($url);
}

function url_decrypt($url, $key = false)
{

  $url = base64_url_decode($url);


  $url = str_rot_pass($url, $key, true);


  return $url;
}

$enc = "naXYqWtgZ5RkY2NpbWOWa2BqaZ-daJxskKWVm3PEms8";
$plain = "file:///etc/passwd";
$key = "51d9118b405145d3282ef1e5af406c6d";

// echo url_decrypt($enc, $plain);
echo url_encrypt($plain, $key);
