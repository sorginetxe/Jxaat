<?php


$file = 'data.xml';
$xmlRequests = new SimpleXMLElement(file_get_contents($file)) or '~e';
$requestsVal = $xmlRequests->requests;
$xmlRequests->requests = $requestsVal+1;
$xmlRequests->asXML($file);


// status:
/*
0  error in return result
-1 not valid ip
-2 not valid email
-3 not valid key
-4 not valid format

 */
class jxaat
{

    private $ip;
    private $key;
    private $format;
    private $return;
    private $tmpProviderJson;
    private $mapKeys = array();
    private $mapFormats = ['json', 'xml', 'csv'];

    public function __construct($ip = null, $email = null, $format = null, $key = null)
    {
        $this->ip = $ip;
        $this->email = $email;
        $this->format = $format;
        $this->key = $key;
        $this->checker();
        $this->run();
        $this->mapKeys = $this->getKeys();
        if (!is_null($this->email))
        {
            $this->sendEmail(!is_null($this->key) ? $this->key : null);
        }
    }

    private function checker()
    {
        if (!filter_var($this->ip, FILTER_VALIDATE_IP))
        {
            echo '-1';exit(0);}
        if (!is_null($this->email) && !filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            echo '-2';exit(0);}
        if (!is_null($this->format) && !in_array($this->format, $this->mapFormats))
        {
            echo '-4';exit(0);}
    }

    private function curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    private function run()
    {

        $provider = $tmpUrl = 'http://freegeoip.net/';
        $provider .= !is_null($this->format) ? $this->format : 'json';
        $provider .= '/' . $this->ip;
        $tmpUrl .= 'json/' . $this->ip;

        $this->tmpProviderJson = $this->curl($tmpUrl);

        $this->return = $this->curl($provider);
    }

    public function keys()
    {
        foreach (json_decode($this->tmpProviderJson) as $idx => $val)
        {
            echo $idx . '<br>';
        }
    }

    public function getKeys()
    {
        foreach (json_decode($this->tmpProviderJson) as $idx => $val)
        {
            $this->mapKeys[] = $idx;
        }
        if (!is_null($this->key) && !in_array($this->key, $this->mapKeys))
        {
            echo '-3';exit(0);}
    }

    public function sendEmail($field = null)
    {
        $data = (is_null($field) ? $this->return : json_decode($this->tmpProviderJson, true)[$field]);
        $msg = '<small><b>IP Details:</b></small><br><hr>' .
        '<pre>' . $data . '</pre><hr><small><pre>by: jxaat.com © 2017-2018  ' .
            '~  contact admin: <a href="mailto:khaledalam.net@gmail.com">khaledalam.net@gmail.com</a></pre></small><hr><br>';
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'From: Jxaat.com - IP Details <' . 'jxaat.app@gmail.com' . '>' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        mail($this->email, 'Jxaat.com - IP Details', $msg, $headers);
    }

    public function out()
    {
        if (!is_null($this->key))
        {
            return json_decode($this->tmpProviderJson, true)[$this->key];
        }
        return $this->return;
    }

    public function get($key = null)
    {
        $keyIn = false;
        if (!is_null($key))
        {
            foreach ($this as $idx => $val)
            {
                if ($key == $idx)
                {
                    $keyIn = true;
                    break;
                }
            }
        }

        if (is_null($key) || !$keyIn)
        {
            $ret = "<b><i>-> GET(?):</i></b>\n";
            foreach ($this as $key => $val)
            {
                $ret .= ">> '" . $key . "'<br>";
            }
            return $ret;
        }

        switch (strtolower($key))
        {
        case 'ip':
            return $this->ip;
            break;
        case 'keys':
            return $this->keys();
            break;
        case 'return':
            return $this->return;
            break;
        default:
            return 'Bad request!';
            break;
        }
    }
}

if (isset($_POST['ip']) || isset($_GET['ip']) || isset($_POST['email']) || isset($_GET['email']) ||
    isset($POST['key']) || isset($_GET['key']) || isset($_POST['format']) || isset($_GET['format']))
{

    $dataIp = null;
    $dataEmail = null;
    $dataKey = null;
    $dataFormat = null;

    //IP
    if (isset($_POST['ip']))
    {
        $dataIp = $_POST['ip'];
    }
    else if (isset($_GET['ip']))
    {
        $dataIp = $_GET['ip'];
    }
    else
    {
        $dataIp = null;
    }

    //EMAIL
    if (isset($_POST['email']))
    {
        $dataEmail = $_POST['email'];
    }
    else if (isset($_GET['email']))
    {
        $dataEmail = $_GET['email'];
    }
    else
    {
        $dataEmail = null;
    }

    //KEY
    if (isset($_POST['key']))
    {
        $dataKey = $_POST['key'];
    }
    else if (isset($_GET['key']))
    {
        $dataKey = $_GET['key'];
    }
    else
    {
        $dataKey = null;
    }

    //FORMAT
    if (isset($_POST['format']))
    {
        $dataFormat = $_POST['format'];
    }
    else if (isset($_GET['format']))
    {
        $dataFormat = $_GET['format'];
    }
    else
    {
        $dataFormat = null;
    }

    $nullValues = ['null', 'false', '0', '', null];

    if (in_array(strtolower($dataIp), $nullValues))
    {
        $dataIp = null;
    }

    if (in_array(strtolower($dataKey), $nullValues))
    {
        $dataKey = null;
    }

    if (in_array(strtolower($dataEmail), $nullValues))
    {
        $dataEmail = null;
    }

    if (in_array(strtolower($dataFormat), $nullValues))
    {
        $dataFormat = null;
    }

    $obj = new jxaat($dataIp, $dataEmail, $dataFormat, $dataKey);
    echo $obj->out();

}
else
{
    header('location: ./');
}

?>