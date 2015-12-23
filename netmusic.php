<?php
/**
  * 获取网易云音乐歌曲下载地址
  * @author www.hello1995.com
  */
  
  $sid = 0;
function getWangyiyunMusic($sid){
    $ch = curl_init();
    $srcURL = 'http://music.163.com/api/song/detail/?id=' . $sid . '&ids=%5B' . $sid . '%5D';
    curl_setopt($ch, CURLOPT_URL, $srcURL);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:38.0) Gecko/20100101 Firefox/38.0'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $re = curl_exec($ch);
    curl_close($ch);
    //print_r($re);
    $regexp = "/(http:\/\/m(.*?).mp3)/i";
    preg_match($regexp, $re, $realURL);
    //print_r($realURL);
    return $realURL[0];
}

$sid = $_GET['id'];
if($sid != 0){
    header('HTTP/1.1 301 Moved Permanently');
    header('User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:38.0) Gecko/20100101 Firefox/38.0'); //不知道有没有用。。。
    header('Referer: http://music.163.com/'); 
    header('Content-type: application/octet-stream'); 
    header('Location: '.getWangyiyunMusic($sid));
    exit; 
}  

?>

<!DOCTYPE html>
<html>
    <head>
        <title>网易云音乐</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    </head>
    <body>
    <h1>网易云音乐 Wangyiyun Music</h1>
    <h3>简单易用 Easy To Use<br />第一步：获取歌曲编号 / Frist Step : Get Song ID<br />第二步：下载歌曲 / Last Step : Download MP3 File</h3>
    <p>(0) http://music.163.com/#/song?id=30053956<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>复制歌曲编号 30053956。30053956 is song id.Copy it.</b><br />(1) http://localhost/wangyi/?id=30053956<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>下载。Download.</b></p>
    <h3>Powered by <a href="http://www.hello1995.com/" target="_blank">Lin</a>.</h3>
    </body>
</html>