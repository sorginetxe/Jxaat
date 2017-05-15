<?php
$file = 'data.xml';
$xmlRequests = new SimpleXMLElement(file_get_contents($file)) or '~e';
$requestsVal = $xmlRequests->requests;
$hitsVal = $xmlRequests->hits;
$docVal = $xmlRequests->doc;
$xmlRequests->hits = $hitsVal + 1;
$xmlRequests->asXML($file);
?>
<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>
        <title>Jxaat.com - Home</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" type="text/css" href="asserts/css/style.css"/>
        <link rel="shortcut icon" type="image/x-icon" href="asserts/img/jxaat.png" />
    </head>
    <body>
        <div align="center">
            <div class="menu">
                <a href="./"><span class="fa fa-exchange"> Home</span></a> . <a href="javascript:void(0)" id="doc">Documentation</a> . <a href="javascript:void(0)" id="codes">Codes</a> . <a href="https://www.paypal.me/khaledalam" target="_blank">Donate</a> . <a href="https://twitter.com/jxaat" target="_blank">@jxaat</a> . <small><i  class="fa fa-send" id="requests"> <?=$requestsVal?></i> requests sent</small> . <small><i  class="fa fa-eye" id="requests"> <?=$hitsVal?></i> hits</small>
            </div>
            <form action="" method="POST">
                <small style="text-align: left; font-size: 12px;">
            <a href="http://jxaat.com/jxaat.php?ip=<?=$_SERVER["REMOTE_ADDR"]?>&email=khaledalam.net@gmail.com" target="_blank">http://jxaat.com/jxaat.php?ip=<?=$_SERVER["REMOTE_ADDR"]?>&email=khaledalam.net@gmail.com</a></small>
            <hr>
            <input type="text" name="ip" placeholder="Write any IP Address" autofocus/> 
                
                <div style="float: right;" > 
                <span type="button" id="btn" class="btn btn-info btn-sm">Submit <img class="hideDiv loaderGif" src="asserts/img/loading.gif" width="20"></span>
                <span type="button" id="btn" class="btn btn-info btn-sm" onclick="reset()">Reset</span>
                </div>
                
                <div style="float: left;" >
                     <small><i>ex. your ip:</i> <span class="fa fa-eye" onclick="myIp($('#myIp').text())"> <span id="myIp"><?=$_SERVER["REMOTE_ADDR"]?></span></span></small>
                </div>
                

               
            </form>
            <p class="error hideDiv"><span class="fa fa-close"></span> Non-valid IP Address</p>
            <p class="success hideDiv"></p>
        </div>
        <div align="center" class="doc">
            <h3> Documentation <span class="fa fa-close" onclick="tog($('div[class*=doc]'));"></span></h3>
        <pre><b>Some Uses:</b><br>- View or send your current geo location (latitude and longitude) to email<br>- View or send your website visitors ip details to your email instantly</pre>
    <pre><b>Request URL:</b> http://jxaat.com/jxaat.php</pre>
<pre><b>Format:</b> JSON, CSV, XML | <b>Methods:</b> [POST], [GET]</pre>
<pre><b>Parameters :</b> ip= , email= , format= , key=</pre>
<pre><b>Data:</b><br>   / Time Zone<br>  /  Host Name<br> /   City<br>/    Country<br>\    Network<br> \   Region<br>  \  Location (Lat/Long)<br>   \ Metro Code</pre>
<pre><b>Limits:</b> ~ 10,000 requests per hour</pre>
<pre><b>Error Codes:</b><br> 0 error in return result<br>-1 not valid ip<br>-2 not valid email<br>-3 not valid key<br>-4 not valid format
</pre>
</div>
<div align="center" class="codes">
<h3> Codes <span class="fa fa-close" onclick="tog($('div[class*=codes]'));"></span></h3>
<pre><b>Required Files:</b><br>- jquery : https://code.jquery.com/jquery-3.2.1.min.js<br>- sender.js : https://rawgit.com/khaledalam/Jxaat/master/sender.js<br><i>Send AJAX Request using:</i><b>sendRequest(ip, email, format, key)</b></pre>
<pre><b>Send your ip details to admin email:</b><br><br><div style="text-shadow: 0.5px 0.1px red;">http://jxaat.com/jxaat.php?ip=<?=$_SERVER["REMOTE_ADDR"]?>&email=khaledalam.net@gmail.com</div></pre>
<pre><b>Keys:</b><br>   / 'ip'<br>  /  'country_code'<br> /   'region_name'<br>/    'city'<br>\    'zip_code'<br> \   'time_zone'<br>  \  'latitude'<br>   \ 'metro_code'</pre>
</div>
<script src="asserts/js/jquery.min.js"></script>
<script src="asserts/js/script.js"></script>
<script>
// sendRequest( '', null , 'csv',  'country_code');
</script>
</body>
</html>