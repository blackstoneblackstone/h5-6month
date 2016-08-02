<?php
header("Content-type: text/html; charset=utf-8");
error_reporting(E_ALL || ~E_NOTICE); //显示除去 E_NOTICE 之外的所有错误信息
$openid = '';
$username = '';
$img = '';
try {
    if ($_COOKIE['v5uidv']) {
        $openid = $_COOKIE['v5uidv'];
        $img = $_COOKIE['v5img'];
    } else {
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
        $openid = $userObj->openid;
        $username = urlencode(str_replace(array("'", "\\"), array(''), $userObj->nickname));
        $img = $userObj->headimgurl;
        setcookie('v5uidv', $userObj->openid, time() + 3 * 24 * 60 * 60);
//setcookie('v5uid',"18612055774",time()+3*24*60*60);
        setcookie('v5img', $img, time() + 3 * 24 * 60 * 60);
//header("Location: http://www.wexue.top/m6/index.html?avator=".$img);
    }
} catch (Exception $e) {

}
$wxParams = curlGet("http://www.wexue.top/m6/weixinjs.php?url=" . base64_encode('http://www.wexue.top' . $_SERVER["REQUEST_URI"]));
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
<html>
<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1,initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>大兴人择偶标准大调查</title>
    <link href="css/index.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <script type="text/javascript" src="js/zepto.min.js"></script>
</head>
<body>
<script>
    var openid = '<?php echo $openid?>';
    var avator = '<?php echo $img?>';
    var xingzuomimi = "chunv";
    $("body").css("width", window.screen.availWidth);
</script>
<div class="logo">
    <img src="images/logo.png">
</div>
<!--<iframe src="2048JD/index.html"-->
<!--        style="border: solid 0 #fff82b;width:100%;height:100%;position: fixed;top: 0px;right: 0px;left: 0px;bottom: 0px;">-->
<!--</iframe>-->
<div id="loading">
    <div class="load an-3"></div>
    <div id="loadText" style="font-size: 20px">loading...</div>
</div>

<div id="impress">
    <div id="start" class="step slide" data-x="0" data-y="0" data-z="0" data-scale="1">
        <img class="title" src="images/title.jpg">
        <img class="o an-1" src="images/o1.png" style="top : 805px;left: 720px;">
        <img class="o an-1" src="images/o2.png" style="top: 610px;left: 420px;">
        <img class="o an-1" src="images/o3.png" style="top: 805px;left: 125px;">
        <img class="o an-1" src="images/o4.png" style="top: 1040px;left: 125px;">
        <img class="o an-1" src="images/o5.png" style="top: 1040px;left: 720px;">
        <img class="o an-1" src="images/o6.png" style="top: 1240px;left: 420px;">
        <div class="avator" id="start1">
            <span style="font-size: 350px;" class="hidden" id="daojishi">3</span>

            <img src="<?php echo $img; ?>" id="sa">
        </div>
    </div>
    <div id="xingbie" class="step" data-x="2000" data-y="5000" data-z="-2000" data-rotate-x="-120" data-rotate-y="50"
         data-scale="1">
        <img src="images/s-title.png" class="vtitle" style="height: 200px">
        <div class="xb" id="xb-n" style="background-color: rgba(255,255,255,0)">
            <div id="xb-n-g" class="xb hidden" style="position: absolute;">
                <img src="images/dui.png" style="height: 400px;margin-top: 50px;">
            </div>
            <img src="images/s-man.jpg" style="height:400px;margin-top: 50px;">
        </div>
        <div class="xb" id="xb-v" style="background-color: rgba(255,255,255,0)">
            <div id="xb-v-g" class="xb hidden" style="position: absolute;">
                <img src="images/dui.png" style="height: 400px;margin-top: 50px;">
            </div>
            <img src="images/s-wman.jpg" style="height:400px;margin-top: 50px;">
        </div>
    </div>
    <div id="nianling" class="step slide" data-x="2000" data-y="-2000" data-z="-100" data-scale="1">
        <img src="images/nl-title.png" style="height:200px;margin-left: 100px;">

        <div style="float: left;width: 50%;margin-top: 50px;">
            <img id="nlXm" src="images/xm.png" style="float:left;height: 1200px;margin-left: 100px;">
        </div>
        <div style="float:right;width: 50%;margin-top: 200px;font-size: 50px;">
            请选择你的年龄?
            <br>
            <img id="nlUp" src="images/up.png" style="height: 60px;margin-top: 150px;">
            <br>
            <span id="nl" style="display: inline-block;font-weight:bolder;height: 200px;font-size: 200px;width: 250px;">
                20
            </span>
            <span style="color: #ff1b02;position: absolute;margin-top: 150px;">岁</span>
            <br>
            <img id="nlDown" src="images/down.png" style="height: 60px">
            <br>
            <botton id="nl-next" style="width: 200px;margin-top: 150px;font-size: 50px;height: 80px;"
                    class="btn-success">确定
            </botton>
        </div>
    </div>
    <div id="shengao" class="step" data-x="-2000" data-y="-3000" data-z="-300" data-scale="2">
        <img src="images/sg-title.png" style="width: 70%;height: auto;">
        <div style="width: 100%;margin-top: 50px;position: absolute;bottom: 300px;">
            <img id="sgRen" src="images/shengaon.png" style="float: left;margin-left: 150px;height: 550px">
            <img id="sg-biao" src="images/biao.png"
                 style="position: absolute;right: 20px;padding-left:150px;padding-top:200px;padding-right:150px;bottom:467.302px;height: 100px;z-index: 11;">
            <img src="images/shengaochi.png" id="sgc"
                 style="height: 1000px;position: absolute;right:200px;bottom: 0px;z-index: 10;">
            <span id="sg-text" style="position: absolute;right:350px;bottom:500px;height: 100px">160cm</span>
        </div>
        <botton id="sg-next"
                style="position: absolute;right: 300px;bottom: 50px;font-size: 50px;height: 80px;width: 300px;"
                class="btn-success">确定
        </botton>
    </div>
    <div id="xuexing" class="step slide" data-x="3000" data-y="-2000" data-z="-100">
        <img src="images/xx-title-top.png" style="width: 70%;height: auto;">
        <div id="xx-a" style="position: absolute;top:200px;left:180px;">
            <div id="xx-a-dui" class="xx-d hidden" style="position: absolute;">
                <img src="images/dui.png" style="height: 300px;margin-top: 50px;">
            </div>
            <img src="images/xa.png">
        </div>
        <div id="xx-b" style="position: absolute;top:200px;right:180px;">
            <div id="xx-b-dui" class="xx-d hidden" style="position: absolute;">
                <img src="images/dui.png" style="height: 300px;margin-top: 50px;">
            </div>
            <img src="images/xb.png">
        </div>
        <div id="xx-ab" style="position: absolute;top:910px;left:90px;">
            <div id="xx-ab-dui" class="xx-d hidden" style="position: absolute;">
                <img src="images/dui.png" style="height: 300px;margin-top: 50px;">
            </div>
            <img src="images/xab.png">
        </div>
        <div id="xx-o" style="position: absolute;top:910px;right: 90px;">
            <div id="xx-o-dui" class="xx-d hidden" style="position: absolute;">
                <img src="images/dui.png" style="height: 300px;margin-top: 50px;">
            </div>
            <img src="images/xo.png">
        </div>
        <img style="margin-top:400px;" src="images/xx-title.jpg">
    </div>
    <div id="xingzuo" class="step" data-x="5000" data-y="-3000" data-z="-400" data-rotate="" data-scale="1">
        <img src="images/x-title.png" class="vtitle" style="height: 120px">

        <div class="xz">
            <table style="margin: 50px auto;">
                <tr>
                    <td>
                        <div class="td-dui">
                            <img src="images/dui.png" style="height: 150px;margin-top: 50px;">
                        </div>
                        <img class="xb-img" src="images/baiyang.png"></td>
                    <td>
                        <div class="td-dui">
                            <img src="images/dui.png" style="height: 150px;margin-top: 50px;">
                        </div>
                        <img class="xb-img" src="images/jinniu.png"></td>
                    <td>
                        <div class="td-dui">
                            <img src="images/dui.png" style="height: 150px;margin-top: 50px;">
                        </div>
                        <img class="xb-img" src="images/shuangzi.png"></td>
                </tr>
                <tr>
                    <td>
                        <div class="td-dui">
                            <img src="images/dui.png" style="height: 150px;margin-top: 50px;">
                        </div>
                        <img class="xb-img" src="images/juxie.png"></td>
                    <td>
                        <div class="td-dui">
                            <img src="images/dui.png" style="height: 150px;margin-top: 50px;">
                        </div>
                        <img class="xb-img" src="images/shizi.png"></td>
                    <td>
                        <div class="td-dui">
                            <img src="images/dui.png" style="height: 150px;margin-top: 50px;">
                        </div>
                        <img class="xb-img" src="images/chunv.png"></td>
                </tr>
                <tr>
                    <td>
                        <div class="td-dui">
                            <img src="images/dui.png" style="height: 150px;margin-top: 50px;">
                        </div>
                        <img class="xb-img" src="images/tianping.png"></td>
                    <td>
                        <div class="td-dui">
                            <img src="images/dui.png" style="height: 150px;margin-top: 50px;">
                        </div>
                        <img class="xb-img" src="images/tianxie.png"></td>
                    <td>
                        <div class="td-dui">
                            <img src="images/dui.png" style="height: 150px;margin-top: 50px;">
                        </div>
                        <img class="xb-img" src="images/sheshou.png"></td>
                </tr>
                <tr>
                    <td>
                        <div class="td-dui">
                            <img src="images/dui.png" style="height: 150px;margin-top: 50px;">
                        </div>
                        <img class="xb-img" src="images/mojie.png"></td>
                    <td>
                        <div class="td-dui">
                            <img src="images/dui.png" style="height: 150px;margin-top: 50px;">
                        </div>
                        <img class="xb-img" src="images/shuiping.png"></td>
                    <td>
                        <div class="td-dui">
                            <img src="images/dui.png" style="height: 150px;margin-top: 50px;">
                        </div>
                        <img class="xb-img" src="images/shuangyu.png"></td>
                </tr>
            </table>
        </div>
    </div>
    <div id="question" class="step" data-x="-5000" data-y="-5000" data-z="-3000" data-rotate="" data-scale="2">
        <img class="vtitle" src="images/z-title.png">
        <img src="images/zo-t.png" style="height: 100px;margin-top: 100px;">
        <div class="qc">
            <div class="qc-1" id="qc-1">
                <div id="qc-dui-1" class="hidden"
                     style="height: 100%;width: 50%;position:absolute;border-top-left-radius: 100px;border-top-right-radius:100px;background-color: rgba(255,255,255,.6)">
                    <img src="images/dui.png" style="height: 150px;margin-top: 200px;">
                </div>
                <img id="zo-r1" src="images/zhuang.png">
            </div>
            <div class="qc-2" id="qc-2">
                <div id="qc-dui-2" class="hidden"
                     style="height: 100%;width: 50%;position:absolute;border-top-left-radius: 100px;border-top-right-radius:100px;background-color: rgba(255,255,255,.6)">
                    <img src="images/dui.png" style="height: 150px;margin-top: 200px;">
                </div>
                <img id="zo-r2" src="images/shengaon.png">
            </div>
        </div>
    </div>


    <div id="finish" class="step" data-x="-50000" data-y="-50000" data-z="20" data-rotate="" data-scale="2">
        <img class="vtitle" src="images/finish.png" style="height: 150px">
        <div>
            <div class="o an-1" id="fn-xb" style="top:505px;left: 720px;color: green;font-size: 50px;">帅哥</div>
            <div class="o an-1" id="fn-nl" style="top: 310px;left: 420px;color: #ffbd1c;font-size: 50px;">21岁</div>
            <div class="o an-1" id="fn-sg" style="top: 505px;left: 125px;color: #ff3dc3;font-size: 50px;">180CM</div>
            <div class="o an-1" id="fn-xz" style="top: 740px;left: 125px;color: #5c5bff;font-size: 50px;">白羊座</div>
            <div class="o an-1" id="fn-xx" style="top: 740px;left: 720px;color: #ffa0b0;font-size: 50px;">O型血</div>
            <div class="o an-1" id="fn-zo" style="top: 840px;left: 420px;color: #14175a">大胸妹</div>
        </div>
        <div class="avator" style="height: 250px;width: 250px;margin-top: 250px;border: solid #cccccc 10px">
            <img src="<?php echo $img; ?>" style="height: 250px;width: 250px;">
        </div>
        <br>
        <img id="again" src="images/again.png"
             style="background-color: #31b0d5;margin-top: 200px;border-color: #269abc;font-size: 50px;height: 100px;width: 250px;">
        <img id="submit" src="images/submit.png"
             style="margin-left:100px;font-size: 50px;height: 100px;width: 250px;">

        <div id="success" class="hidden" style="text-align:center;height: 1200px;top:0px;position: absolute;width:100%;background:url(images/bg.png) repeat;" class="">
            <img src="images/success-title.png" style="width: 80%;height: auto;margin-top: 300px;">
            <div style="margin-top: 200px;width:100%;">
                <img src="images/success-t.png" style="width:100%;height: auto;">
            </div>
            <img id="close" src="images/s-x.png" style="margin-top: 150px;width:200px;height: auto;">
        </div>
    </div>




    <!--<div id="ing" class="step" data-x="3500" data-y="-850" data-rotate="270" data-scale="6">-->

    <!--</div>-->

    <!--<div id="imagination" class="step" data-x="6700" data-y="-300" data-scale="6">-->
    <!--</div>-->

    <!--<div id="source" class="step" data-x="6300" data-y="2000" data-rotate="20" data-scale="4">-->

    <!--</div>-->

    <!--<div id="one-more-thing" class="step" data-x="6000" data-y="4000" data-scale="2">-->


    <!--</div>-->

    <!--<div id="its-in-3d" class="step" data-x="6200" data-y="4300" data-z="-100" data-rotate-x="-40" data-rotate-y="10"-->
    <!--data-scale="2">-->

    <!--</div>-->


    <!--<div id="overview" class="step" data-x="3000" data-y="1500" data-scale="10">-->


    <!--</div>-->

</div>


<script type="text/javascript" src="js/touch-0.2.14.min.js"></script>
<script type="text/javascript" src="js/preloadjs-NEXT.combined.js"></script>
<script type="text/javascript" src="js/impress.js"></script>
<script type="text/javascript" src="js/jweixin-1.0.0.js"></script>
<script type="text/javascript" src="js/start.js"></script>
<script type="text/javascript" src="http://pingjs.qq.com/h5/stats.js" name="MTAH5" sid="500152041"></script>
<script type="text/javascript">
    wx.config(
        <?php echo $wxParams;?>
    );
    wx.ready(function () {
        wx.onMenuShareTimeline({
            title: '大兴人择偶标准大调查,看脸还是看胸?', // 分享标题
            link: 'http://www.wexue.top/m6/index.php', // 分享链接
            imgUrl: 'http://www.wexue.top/m6/images/' + xingzuomimi + '.png', // 分享图标
            success: function () {
                MtaH5.clickStat('shareCircle');
            },
            cancel: function () {
            }
        });
        wx.onMenuShareAppMessage({
            title: '大兴人择偶标准大调查,看脸还是看胸?', // 分享标题
            desc: '写调查,领奖品,看十二星座的择偶观', // 分享描述
            link: 'http://www.wexue.top/m6/index.php', // 分享链接
            imgUrl: 'http://www.wexue.top/m6/images/' + xingzuomimi + '.png', // 分享图标
            type: 'link', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                MtaH5.clickStat('shareFriend');
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
    });
</script>
</body>

</html>
