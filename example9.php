
<?php
//--------------ส่วนของการดาวโหลด (download.php)----------------------------
$name = trim($_GET['name']).'.png';
$file = $_GET['file'];
header("Content-Description: File Transfer");
header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=".$name);
@readfile($file);
exit;
//--------------------------------------------------------
?>



<!--                         index                                 -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php
$urlcontent = qr_loadUrl( 'https://www.bnk48.com/index.php?page=members' ); //ดึงข้อมูลจากเว็บโดยใช้ Curl
$html = urldecode($urlcontent);
$link_name = array();
$name_bnk = array();
$link_ex = explode('background-image: url(',$html); //ตัดคำเพื่อเอา path ของรูป
$name = explode('<div class="nameMem">',$html); //ตัดคำเพื่อเอา path ของชื่อ

for($i = 1;$i<count($link_ex);$i++){
	$link_name[] = explode(')',$link_ex[$i]);
	$name_bnk[]  = explode('              ',$name[$i]);
}
$path="https://www.bnk48.com/";
for($j = 1;$j<count($link_ex);$j++){
  if (isset($link_name[$j][0])) {
	echo '<a href="download.php?name='.$name_bnk[$j][1].'&file='.$path.'/'.$link_name[$j][0].'">'.$name_bnk[$j][1].'</a><br>';

  }

}
?>
</body>
</html>
<?php
function qr_loadUrl( $url ) { // ฟังก์ชั่น curl return html ของ  url นั้นกลับมา
	if(is_callable( 'curl_init' )) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$data = curl_exec($ch);
		curl_close($ch);
	}
	if( empty($data) || !is_callable('curl_init') ) {
		$opts = array('http'=>array('header' => 'Connection: close'));
		$context = stream_context_create($opts);
		$headers = get_headers($url);
		$httpcode = substr($headers[0], 9, 3);
		if( $httpcode == '200' )
			$data = file_get_contents($url, false, $context);
		else{
			$data = '{"div":"Error ' . $httpcode . ': Invalid Url<br />"}';
		}
	}
	return $data;
}
//--------------------------------------------------------------------
?>
