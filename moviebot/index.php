<?php

session_start();

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

//
// HERE: Common enter point
//

//require_once __DIR__ . '/../Debug.php';

define('APPLICATION_ROOT', realpath(__DIR__ . '/../application'));
require_once APPLICATION_ROOT . '/Core/Logger.php';
\Core\Logger::getInstance()->registerHandlers();

// Check, if current request is not main page, run routing
if ($_SERVER['REQUEST_METHOD'] !== 'GET' || ($_SERVER['REQUEST_URI'] !== '/en' && $_SERVER['REQUEST_URI'] !== '/ru')) {
	require_once APPLICATION_ROOT . '/Core/Application.php';
	\Core\Application::getInstance()->runEndpointAndDie();
}

require_once APPLICATION_ROOT . '/Core/Content.php';
require_once APPLICATION_ROOT . '/Core/Auth.php';
require_once APPLICATION_ROOT . '/Core/Escaper.php';

?>
<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
	<head>
		<?php echo \Core\Content::getInstance()->renderHeadHtml(\Core\Content::getInstance()->translate('_META_TITLE_MAIN_')) ?>
	</head>
	<body data-config="<?php echo \Core\Escaper::getInstance()->escapeHtmlAttr(json_encode([
		'csrf' => \Core\Auth::getInstance()->makeCsrf(),
		'locale' => \Core\Content::getInstance()->getLocale(),
		'currentUserId' => \Core\Auth::getInstance()->getCurrentUserId(),
		'translation' => [
			'_MESSAGE_CHOOSE_1_3_MOVIE_' => \Core\Content::getInstance()->translate('_MESSAGE_CHOOSE_1_3_MOVIE_'),
			'_MESSAGE_RUNNING_' => \Core\Content::getInstance()->translate('_MESSAGE_RUNNING_'),
			'_MESSAGE_CHECK_THE_RESULT_' => \Core\Content::getInstance()->translate('_MESSAGE_CHECK_THE_RESULT_'),
			'_MESSAGE_AUTH_INVITATION_' => \Core\Content::getInstance()->translate('_MESSAGE_AUTH_INVITATION_'),
			'_SHOW_ALL_SEARCH_MOVIE_' => \Core\Content::getInstance()->translate('_SHOW_ALL_SEARCH_MOVIE_'),
		],
		'app' => [
			'facebookId' => \Core\Auth::getInstance()->getFacebookApp()['id'],
			'googleId' => \Core\Auth::getInstance()->getGoogleApp()['id'],
			'vkId' => \Core\Auth::getInstance()->getVkApp()['id'],
		],
	])) ?>">
		<?php echo \Core\Content::getInstance()->renderAfterOpeningBodyHtml() ?>
		<div id="wrapper">
			<?php echo \Core\Content::getInstance()->renderBarHtml(null) ?>
			<div class="contentWrapper">
				<div id="top">
					<?php echo \Core\Content::getInstance()->renderMoviebotHeaderHtml() ?>
					<div id="inMovieListWrapper" style="display: none;">
						<div id="inMovieLabelWrapper">
							<div class="inMovieLabel num1">
								<span class="cornerButton"><span class="fa fa-remove"></span></span>
								<span class="cornerButton left"><span class="fa fa-info-circle"></span></span>
								1
							</div>
							<div class="inMovieLabel num2">
								<span class="cornerButton"><span class="fa fa-remove"></span></span>
								<span class="cornerButton left"><span class="fa fa-info-circle"></span></span>
								2
							</div>
							<div class="inMovieLabel num3">
								<span class="cornerButton"><span class="fa fa-remove"></span></span>
								<span class="cornerButton left"><span class="fa fa-info-circle"></span></span>
								3
							</div>
						</div>
						<div id="inMovieList"></div>
					</div>
				</div>

				<div id="message"><?php echo \Core\Content::getInstance()->translate('_MESSAGE_CHOOSE_1_3_MOVIE_') ?></div>

				<div id="searchForm">
					<a id="clearSearchInputButton" style="display: none;" href="javascript:void(0)" class="fa fa-remove"></a>
					<input
						tabindex="1"
						id="searchInput"
						class="active"
						type="text"
						name="search"
						value=""
						placeholder="<?php echo \Core\Content::getInstance()->translate('_SEARCH_INPUT_PLACEHOLDER_') ?>">
					<a href="javascript:void(0)" tabindex="2" id="runButton"><?php echo \Core\Content::getInstance()->translate('_RUN_BUTTON_NAME_') ?></a>
					<div id="addThis">
						<div class="d text"><?php echo \Core\Content::getInstance()->translate('_ADD_THIS_') ?></div>
						<div
							data-url="http://moviebot.net"
							class="addthis_toolbox addthis_default_style addthis_32x32_style">
							<a class="addthis_button_facebook"></a>
							<a class="addthis_button_twitter"></a>
							<?php if (\Core\Content::getInstance()->getLocale() == 'ru'): ?>
								<a class="addthis_button_vk"></a>
							<?php endif ?>
							<a class="addthis_button_compact"></a>
						</div>
					</div>
					<div id="searchMovieList" style="display: none;"></div>
				</div>

				<div id="content">
					<div id="signIn" class="whiteBlock" style="display: none;">
						<div><?php echo \Core\Content::getInstance()->translate('_AUTH_INVITATION_RUN_') ?></div>
						<div class="openConnectServiceList">
							<a data-r="" href="javascript:void(0)" id="facebookSignIn"><span class="fa fa-facebook-official"></span></a>
							<a data-r="" href="javascript:void(0)" id="googleSignIn"><span class="fa fa-google-plus"></span></a>
							<?php if (\Core\Content::getInstance()->getLocale() == 'ru'): ?>
								<a data-r="" href="javascript:void(0)" id="vkSignIn"><span class="fa fa-vk"></span></a>
							<?php endif ?>
						</div>
					</div>
					<div id="loader" style="display: none;"></div>
					<div id="intro" class="whiteBlock">
						<?php echo \Core\Content::getInstance()->renderIntoHtml() ?>
					</div>
					<div id="mainMovieListWrapper" class="run"></div>
				</div>
			</div>
			<div id="push"></div>
		</div>
		<?php echo \Core\Content::getInstance()->renderFooterHtml() ?>
	</body>
</html>
