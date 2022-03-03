<?php
if(!defined('MODX_BASE_PATH')) {die('What are you doing? Get out of here!');}

//параметры
$files = isset($files) ? $files : ''; // Список файлов (css, scss, less)
$minify = isset($minify) ? $minify : '1'; //сжимать и минифицировать файлы
$folder = isset($folder) ? $folder : ''; // папка для сгенерированных стилей по умолчанию в корень
$inhtml = isset($inhtml) ? $inhtml : '0'; // разместить сразу в HTML в тегах <style></style>
//$inline = isset($inline) ? $inline : ''; // инлайн код стилей
//$parse = isset($parse) ? $parse : '0'; //обрабатывать ли теги MODX

//Обрабатываем файлы, преобразовываем less и scss
$filesArr = explode(',', str_replace('\n', '', $files));
foreach ($filesArr as $key => $value) {
	$file = MODX_BASE_PATH . trim($value);
	$fileinfo = pathinfo($file);
	$v[$key] =  filemtime($file);
	switch ($fileinfo['extension']) {
		case 'css':
		$filesForMin[$key] = $file;
		break;
		/*case 'less':
		require_once(MODX_BASE_PATH. "assets/snippets/cssjs/less.inc.php");
		$less = new lessc;
		$less->checkedCompile($file, $folder.$fileinfo['filename'].'.css');
		$filesForMin[$key] = $folder.$fileinfo['filename'].'.css';
		break;*/
	}
}
if ($minify == '1') {
	include_once(MODX_BASE_PATH. "assets/snippets/cssjs/class.magic-min.php");
	$minified = new Minifier();
	$min = $minified->merge( MODX_BASE_PATH.$folder.'styles.min.css', 'css', $filesForMin );
	if ($inhtml){
		return '<style>'. file_get_contents($modx->getConfig('base_path').$folder.'styles.min.css') .'</style>';
		}
	else return '<link rel="stylesheet" href="'.$modx->config['site_url'].$folder.'styles.min.css?v='.substr(md5(max($v)),0,3).'" />';
}else{
	$links = '';
	foreach ($filesArr as $key => $value) {
		if ($inhtml){
			$links .= '<style>'.file_get_contents($modx->getConfig('base_path').trim($value)).'</style>';
			}
		else $links .= '<link rel="stylesheet" href="'.$modx->config['site_url'].trim($value).'?v='.substr(md5($v[$key]),0,3).'" />';
	}
	return $links;
}
?>
