<?php
/**
 * Created by PhpStorm.
 * User: lihb
 * Date: 4/27/16
 * Time: 11:16 AM
 */
error_reporting(E_ALL ^ E_DEPRECATED);
$openid = $_GET["openid"];
$data = $_GET["data"];
$dataJson=json_decode($data);
echo $openid.">>".$dataJson->nianling.">>>".$data;
$con = mysql_connect("localhost", "root", "lihb123456");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("test", $con);

//$result = mysql_query("SELECT * FROM m6 WHERE openid='" . $openid . "'");
//$row = mysql_fetch_array($result);
//if (!empty($row)) {
//    mysql_query("update m6 set xingbie=" . $dataJson->xingbie.",nianling=".$dataJson->nianling.",shengao=".$dataJson->shengao.",xuexing=".$dataJson->xuexing.",xingzuo='".$dataJson->xingzuo."',zeou=".$dataJson->zeou.",avator='".$dataJson->avator."' WHERE openid='" . $openid."'");
//} else {
    mysql_query("INSERT INTO m6 (openid, xingbie,nianling,shengao,xuexing,xingzuo,zeou,avator) VALUES ('" . $openid . "'," . $dataJson->xingbie. ",".$dataJson->nianling.",".$dataJson->shengao.",".$dataJson->xuexing.",'".$dataJson->xingzuo."',".$dataJson->zeou.",'".$dataJson->avator."')");
//}
//echo "update m6 set xingbie=" . $dataJson->xingbie.",nianling=".$dataJson->nianling.",shengao=".$dataJson->shengao.",xuexing=".$dataJson->xuexing.",xingzuo='".$dataJson->xingzuo."',zeou=".$dataJson->zeou.",avator=".$dataJson->avator." WHERE openid='" . $openid."'";
mysql_close($con);