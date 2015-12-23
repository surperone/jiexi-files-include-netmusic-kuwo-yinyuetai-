<?php
/**
  * 获取音悦台视频高清下载地址
  * @author www.hello1995.com
  */
  
  $sid = 0;
function getYinyuetaiVideo($vid){
    $ch = curl_init();
    $srcURL = 'http://www.yinyuetai.com/api/info/get-video-urls?callback=callback&videoId=' . $vid;
    curl_setopt($ch, CURLOPT_URL, $srcURL);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:38.0) Gecko/20100101 Firefox/38.0'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $re = curl_exec($ch);
    curl_close($ch);
    //print_r($re);
    $regexp = "/(http:\/\/h(.*?)flv)/i";
    preg_match_all($regexp, $re, $realURL);
    //print_r($realURL[0]);
    return $realURL[0];
}

$vid = $_GET['id'];

if($vid != 0){
    $video = getYinyuetaiVideo($vid);
}  

?>

<!DOCTYPE html>
<html>
    <head>
        <title>音悦台视频</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    </head>
    <body>
    <h1>Yinyuetai Video</h1>
    <h3>简单易用 Easy To Use<br />第一步：获取视频编号 / Frist Step : Get Video ID<br />第二步：下载视频 / Last Step : Download FLV File</h3>
    <p>(0) http://v.yinyuetai.com/video/<b>337797</b><br/><br />(1) http://localhost/yinyuetai/index.php<b>?id=337797</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>下载。Download.</b></p>
    <h3>解析出地址：</h3>
    <p>说明：HC 普清 / HD 高清 / HE 超清</p>
    <?php
        echo $video[0]."<br />";    
        echo $video[1]."<br />";
        echo $video[2]."<br />";
    ?>
    <h3>Powered by <a href="http://www.hello1995.com/" target="_blank">Lin</a>.</h3>
    </body>
</html>