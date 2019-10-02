<?php
$strAccessToken = "3VJF5BXc0eoPkGCLsWmj7CvqB2U1JLLfI25J9naN/6tUrAVN/S+fi4bVjeIrw+gZSGIW+zhyZYIW80umuyJITU8UYj28Ci7BM3Lvd1M148HZHJSuJnF3hYU4eZ1j4GLal2GOCWDCyHzOovclshEuWQdB04t89/1O/w1cDnyilFU=";
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
$_userId = $arrJson['events'][0]['source']['userId'];
$_msg = $arrJson['events'][0]['message']['text'];
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";


file_put_contents('data.json', $_msg);

if($arrJson['events'][0]['message']['text'] == "Hello"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "This is your id ".$arrJson['events'][0]['source']['userId'];
  $strUrl = "https://api.line.me/v2/bot/message/reply";
}else if($arrJson['events'][0]['message']['text'] == "Open" || $arrJson['events'][0]['message']['text'] == "open" || $arrJson['events'][0]['message']['text'] == "On" || $arrJson['events'][0]['message']['text'] == "on" || $arrJson['events'][0]['message']['text'] == "O"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "เปิดประตูให้แล้วค่ะ ยินดีต้อนรับสู่บริษัท Grand ATS";
  $strUrl = "https://api.line.me/v2/bot/message/reply";
}else if($arrJson['events'][0]['message']['text'] == "Close" || $arrJson['events'][0]['message']['text'] == "close" || $arrJson['events'][0]['message']['text'] == "Off" || $arrJson['events'][0]['message']['text'] == "off" || $arrJson['events'][0]['message']['text'] == "C"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "ปิดประตูให้แล้วค่ะ";
  $strUrl = "https://api.line.me/v2/bot/message/reply";
}else{
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "^^";
  $strUrl = "https://api.line.me/v2/bot/message/reply";
}
 
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);
?>
