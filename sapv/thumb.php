<?
session_start();
$raw = phpversion();
list($v_Upper,$v_Major,$v_Minor) = explode(".",$raw);

if (($v_Upper == 4 && $v_Major < 1) || $v_Upper < 4) {
	$_FILES = $HTTP_POST_FILES;
	$_ENV = $HTTP_ENV_VARS;
	$_GET = $HTTP_GET_VARS;
	$_POST = $HTTP_POST_VARS;
	$_COOKIE = $HTTP_COOKIE_VARS;
	$_SERVER = $HTTP_SERVER_VARS;
	$_SESSION = $HTTP_SESSION_VARS;
	$_FILES = $HTTP_POST_FILES;
}

if (!ini_get('register_globals')) {
	while(list($key,$value)=each($_FILES)) $GLOBALS[$key]=$value;
	while(list($key,$value)=each($_ENV)) $GLOBALS[$key]=$value;
	while(list($key,$value)=each($_GET)) $GLOBALS[$key]=$value;
	while(list($key,$value)=each($_POST)) $GLOBALS[$key]=$value;
	while(list($key,$value)=each($_COOKIE)) $GLOBALS[$key]=$value;
	while(list($key,$value)=each($_SERVER)) $GLOBALS[$key]=$value;
	while(list($key,$value)=@each($_SESSION)) $GLOBALS[$key]=$value;
	foreach($_FILES as $key => $value){
		$GLOBALS[$key]=$_FILES[$key]['tmp_name'];
		foreach($value as $ext => $value2){
			$key2 = $key."_".$ext;
			$GLOBALS[$key2]=$value2;
		}
	}
}
$ruta=$_GET['ruta'];
if(strtolower(substr($ruta,-3))=='jpg'){
	$fuente = @imagecreatefromjpeg($ruta); 
}elseif(strtolower(substr($ruta,-3))=='gif'){
	$fuente = @imagecreatefromgif($ruta); 
}elseif(strtolower(substr($ruta,-3))=='png'){
	$fuente = @imagecreatefrompng($ruta);
}
$imgAncho = imagesx ($fuente); 
$imgAlto =imagesy($fuente);
$width=$_GET['ancho'];
$height=$_GET['alto'];
	@$alto=($imgAlto*$ancho/$imgAncho);
    	if ($alto>$height){
    		$alto=$height;
    		@$ancho=($imgAncho*$alto/$imgAlto);
    	}


$imagen = imagecreatetruecolor($ancho,$alto); 
ImageCopyResampled($imagen,$fuente,0,0,0,0,$ancho,$alto,$imgAncho,$imgAlto);
header("Cache-Control: private, max-age=10800, pre-check=10800");
header("Pragma: private");
header("Expires: " . date(DATE_RFC822,strtotime(" 2 day")));
header("Content-type: image/Jpeg");
header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($thumbnail)) . ' GMT');
imageJpeg($imagen);
?> 