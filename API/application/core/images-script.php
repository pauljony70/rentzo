<?php
if($_POST['submit'] =='Download')
{
$url = $_POST['url'];
$path = parse_url($url, PHP_URL_PATH);
$segments = explode('/', rtrim($path, '/'));
$dest= end($segments);

$result = download($url,$dest);
if (!$result)
{
  throw new Exception('Download error...');
}
else
{
echo "Files downloaded Successfully";
}
}
	function download($file_source, $file_target) {
    $rh = fopen($file_source, 'rb');
    $wh = fopen($file_target, 'w+b');
    if (!$rh || !$wh) {
        return false;
    }

    while (!feof($rh)) {
        if (fwrite($wh, fread($rh, 4096)) === FALSE) {
           // return false;
			echo '1 MB File Data Written!<br>';

        }
        echo ' ';
        flush();
    }

    fclose($rh);
    fclose($wh);

    return true;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>File Downloader</title>
</head>
<body>

<style type="text/css">
  #butt {
	padding: 5px 10px;
	background: #DAECF4;
	color: #000000;
	text-align: center;
	border-radius: 4px;
	-webkit-border-radius: 5px;
	text-decoration: none;
	border: thin solid #94C0D2;
	cursor: pointer;
  }
</style>

<form action="" method="post">
  <p>Enter url with http://: 
    <input name="url" type="text" size="50"/>
  </p>
  <p>
    <input type="submit" name="submit" id="butt" value="Download" />
<a href="index.php" id="butt">Back</a>
  </p>
</form>
</body>
</html>