<?php
if($_COOKIE['v5uidv']){
  header("Location: http://www.wexue.top/m6/login.php#start");
}else{
  header("Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxce0069199bab04f5&redirect_uri=".urlencode('http://www.wexue.top/m6/login.php')."&response_type=code&scope=snsapi_userinfo&state=".$origin."#wechat_redirect");
}
?>
<html>
<head>
  <script type="text/javascript" src="http://pingjs.qq.com/h5/stats.js" name="MTAH5" sid="500152041"></script>
</head>
</html>
