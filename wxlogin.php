<?php
header("Content-type: text/html; charset=utf-8");
$openid='';
$username='';
$img='';
//if($_COOKIE['v5uid']){
//$openid=$_COOKIE['v5uid'];
//$username=$_COOKIE['v5username'];
//$img=$_COOKIE['v5img'];
//}else{
$code = $_GET['code'];
$state = $_GET['state'];
$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxce0069199bab04f5&secret=5c7224c72e602a57eaa431556391c7a6&code=' . $code . '&grant_type=authorization_code';
$result = null;
try {
    $result = curlGet($url);
    $obj = json_decode($result);
    $getInfoUrl = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $obj->access_token . "&openid=" . $obj->openid;
//微信返回值
    $userObj = json_decode(curlGet($getInfoUrl));
} catch (Exception $e) {
    echo $e->getTraceAsString();

}
//echo $userObj->openid;die;
//echo $userObj->openid;die;
$openid=$userObj->openid;
$username=urlencode(str_replace(array("'", "\\"), array(''), $userObj->nickname));
$img=$userObj->headimgurl;
setcookie('v5uid',$userObj->openid,time()+3*24*60*60);
//setcookie('v5uid',"18612055774",time()+3*24*60*60);
setcookie('v5username',$username,time()+3*24*60*60);
setcookie('v5img',$img,time()+3*24*60*60);
header("Location: http://www.wexue.top/m6/index.html?avator=".$img);
//}

function curlGet($url, $method = 'get', $data = '')
{
    $ch = curl_init();
    $header = "Accept-Charset: utf-8";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $temp = curl_exec($ch);
    return $temp;
}
?>