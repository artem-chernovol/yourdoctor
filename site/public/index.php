<?php

define('APPLICATION_ROOT', realpath(dirname(__DIR__)));
define('DOCUMENT_ROOT', realpath(dirname(__DIR__ . '/public')));

define('ENVIERONMENT', 'local');
//define('ENVIERONMENT', 'development');

//
// LOCALIZATION
//

$localeList = ['en', 'ru'];
$locale = null;
$shouldRedirect = true;
$url = $_SERVER['REQUEST_URI'];

foreach ($localeList as $locale_) {
	if (strpos($url, "/$locale_") === 0) {
		$shouldRedirect = false;
		$locale = $locale_;
		break;
	}
}

if (!$locale) {
	if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
		$localeList_ = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
		foreach ($localeList_ as $locale_) {
			$locale2_ = substr($locale_, 0, 2);
			if (in_array($locale2_, $localeList)) {
				$locale = $locale2_;
				break;
			}
		}
	}
}

if (!$locale) {
	$locale = 'en';
}

if ($shouldRedirect) {
	$url = $url == '/' ? '' : $url;
	$url = '/' . $locale . $url;
	header('Location: ' . $url);
	exit;
}

//<?php echo \Core\Content::getInstance()->renderFooterHtml()
//require_once APPLICATION_ROOT . '/../Debug.php';
require_once APPLICATION_ROOT . '/core/Application.php';
require_once APPLICATION_ROOT . '/application/controller/Content.php';

Application::processRoute();
?>
<!DOCTYPE html >
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>YourDoctor</title>
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
		<link rel="stylesheet" href="/styles/reset.css">
		<link rel="stylesheet" href="/styles/main.css">
	</head>
	<body>
		<div id="contentAndHeader">
			<header>
				<div class="contentWrapper">
					<?php require_once APPLICATION_ROOT . '/application/view/menu.php' ?>
				</div>
			</header>
			<div id="content">
				<div class="contentWrapper">
					<?php Application::runController() ?>
				</div>
			</div>
			<div id="push"></div>
		</div>
		<footer>
			<div class="contentWrapper">
				2016
			</div>
		</footer>
	</body>
</html>