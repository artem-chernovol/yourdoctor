<?php

namespace Core;

require_once APPLICATION_ROOT . '/Core/Auth.php';
require_once APPLICATION_ROOT . '/Core/Storage.php';
require_once APPLICATION_ROOT . '/Core/Escaper.php';
require_once APPLICATION_ROOT . '/Core/Developing.php';

/**
 * Class Content
 * @package Core
 */
class Content
{
	/** @var Content */
	private static $_instance = null;

	/**
	 * @return Content|null
	 */
	public static function getInstance()
	{
		if (self::$_instance === null) {
			self::$_instance = new Content();
		}

		return self::$_instance;
	}

	/** @var string */
	protected $_locale = null;

	protected $_translationMap = [
		'en' => [
			'_RUN_BUTTON_NAME_' => 'SHOW SIMILAR',
			'_SEARCH_INPUT_PLACEHOLDER_' => 'Search for movie',
			'_ADD_THIS_' => 'Tell about us',
			'_ADD_THIS_LIST_' => 'Share this list with',
			'_MESSAGE_CHOOSE_1_3_MOVIE_' => 'Select 1, 2 or 3 movies that you like',
			'_MESSAGE_CHECK_THE_RESULT_' => 'Add to Bookmarks and mark as Watched',
			'_MESSAGE_RUNNING_' => 'Working...',
			'_MESSAGE_AUTH_INVITATION_' => 'Sign In',
			'_SIGN_IN_' => 'Sign In',
			'_SIGN_OUT_' => 'Sign Out',
			'_BOOKMARKS_' => 'Bookmarks',
			'_WATCHED_' => 'Watched',
			'_PROFILE_' => 'Profile',
			'_HISTORY_' => 'History',
			'_READ_ME_' => 'Read me',
			'_ADD_TO_BOOKMARKS_' => 'Bookmark',
			'_VIEW_SIMILAR_' => 'View similar movies',
			'_MARK_AS_WATCHED_' => [
				'Watched',
				'Watched',
			],
			'_SEARCH_IN_WEB_' => '<span class="d">Search in </span>Google',
			'_PAGE_WAS_NOT_FOUND_' => 'Page not found',
			'_LOAD_MORE_' => 'SHOW MORE',
			'_SHOW_ALL_SEARCH_MOVIE_' => 'SHOW MORE',
			'_AUTH_INVITATION_RUN_' => '<strong>Sign In</strong> to prove that you are not a Robot. Your e-mail is not saved.',
			'_AUTH_INVITATION_SIGN_IN' => '<strong>Sign In</strong> to save your progress. Your e-mail is not saved.',
			'_NO_BOOKMARKS_' => 'No Bookmarks yet',
			'_NO_WATCHED_' => 'No Watched movies yet',
			'_WATCHED_HEADER_' => 'Watched movies',
			'_BOOKMARK_HEADER_' => 'Bookmarks',
			'_SIMILAR_MOVIES_HEADER_' => 'Movies similar to',
			'_START_OWN_SEARCH_' => 'Do own search',
			'series' => '(Series)',
			'miniSeries' => '(Mini-Series)',
			'tv' => '(TV)',
			'video' => '(Video)',
			'_BROWSERHAPPY_' => 'You are using an <strong>outdated</strong> browser. Please <a target="_blank" href="http://browsehappy.com/"><strong>upgrade your browser</strong></a> to improve your experience.',
			'_EN_' => 'En',
			'_RU_' => 'Ru',
			'_ARCHIVE_' => 'Archive',

			'_META_TITLE_MAIN_' => 'Similar movies based on Artificial Intelligence',
			'_META_TITLE_BOOKMARK_' => 'Bookmarks',
			'_META_TITLE_WATCHED_' => 'Watched movies',
			'_META_TITLE_PROFILE_' => 'Profile',
			'_META_TITLE_SIGN_IN_' => 'Sign In',
			'_META_TITLE_SIMILAR_MOVIES_' => 'Movies similar to ',
			'_META_DESCRIPTION_' => 'Select the movies that you like and we will recommend similar',
			'_META_KEYWORDS_' => 'Movies, Films, Recommendations, Suggestions, Artificial Intelligence, AI, Similar movies, Similar films',
		],
		'ru' => [
			'_RUN_BUTTON_NAME_' => 'ПОКАЗАТЬ ПОХОЖИЕ',
			'_SEARCH_INPUT_PLACEHOLDER_' => 'Поиск фильмов',
			'_ADD_THIS_' => 'Расскажите о нас',
			'_ADD_THIS_LIST_' => 'Поделиться этим списком',
			'_MESSAGE_CHOOSE_1_3_MOVIE_' => 'Выберите 1, 2 или 3 фильма',
			'_MESSAGE_CHECK_THE_RESULT_' => 'Сохраняйте в Закладки, отмечайте Просмотренные',
			'_MESSAGE_RUNNING_' => 'Поиск...',
			'_MESSAGE_AUTH_INVITATION_' => 'Войдите',
			'_SIGN_IN_' => 'Вход',
			'_SIGN_OUT_' => 'Выход',
			'_BOOKMARKS_' => 'Закладки',
			'_WATCHED_' => 'Просмотренные',
			'_PROFILE_' => 'Профиль',
			'_HISTORY_' => 'Архив',
			'_READ_ME_' => 'Прочти меня',
			'_ADD_TO_BOOKMARKS_' => 'В закладки',
			'_VIEW_SIMILAR_' => 'Показать подобные фильмы',
			'_MARK_AS_WATCHED_' => [
				'Смотрел',
				'Смотрела',
			],
			'_SEARCH_IN_WEB_' => '<span class="d">Искать в </span>Google',
			'_PAGE_WAS_NOT_FOUND_' => 'Страница не найдена',
			'_LOAD_MORE_' => 'ЗАГРУЗИТЬ ЕЩЕ',
			'_SHOW_ALL_SEARCH_MOVIE_' => 'ПОКАЗАТЬ ЕЩЕ',
			'_AUTH_INVITATION_RUN_' => '<strong>Войдите на сайт</strong> чтобы подтвердить что вы не Робот. Мы не сохраняем ваш e-mail.',
			'_AUTH_INVITATION_SIGN_IN' => '<strong>Войдите на сайт</strong> чтобы сохранить прогресс. Мы не сохраняем ваш e-mail.',
			'_NO_BOOKMARKS_' => 'Нет Закладок',
			'_NO_WATCHED_' => 'Нет Просмотренных фильмов',
			'_WATCHED_HEADER_' => 'Просмотренные фильмы',
			'_BOOKMARK_HEADER_' => 'Закладки',
			'_SIMILAR_MOVIES_HEADER_' => 'Фильмы похожие на',
			'_START_OWN_SEARCH_' => 'Новый поиск',
			'series' => '(Сериал)',
			'miniSeries' => '(Мини-Сериал)',
			'tv' => '(ТВ)',
			'video' => '(Видео)',
			'_BROWSERHAPPY_' => 'Вы используете <strong>устаревший</strong> браузер. Пожалуйста, <a target="_blank" href="http://browsehappy.com/"><strong>обновите ваш браузер</strong></a> для работы с сайтом.',

			'_EN_' => 'Англ',
			'_RU_' => 'Рус',
			'_ARCHIVE_' => 'Архив',

			'_META_TITLE_MAIN_' => 'Рекомендация фильмов на базе Искусственного Интеллекта',
			'_META_TITLE_BOOKMARK_' => 'Закладки',
			'_META_TITLE_WATCHED_' => 'Просмотренные фильмы',
			'_META_TITLE_PROFILE_' => 'Профиль',
			'_META_TITLE_SIGN_IN_' => 'Вход',
			'_META_TITLE_SIMILAR_MOVIES_' => 'Фильмы похожие на ',
			'_META_DESCRIPTION_' => 'Выберите фильмы которые вам интересны и мы покажем подобные',
			'_META_KEYWORDS_' => 'Кино, Фильмы, Рекоменации, Искусственный Интеллект, Подобные фильмы, Похожие фильмы',
		],
	];

	protected $_readMeMap = [
		'en' => [
			['MovieBot ', '&mdash; similar movie recommendations based on Artificial Intelligence.'],
			['How does it work? ', 'MovieBot evaluates the degree of similarity between those movies that you have selected and each movie in our database. You see sorted list and can add interesting to Bookmarks.'],
			['When to use? ', 'When you\'ve already watched all the movies that are recommended by other services or don\'t want to deal with Advanced search.'],
			['Why use it? ', 'Endless list of similar movies and minimum actions.'],
			['Sign In ', 'to save your progress and prove that you are not a Robot. Your e-mail is not saved.'],
			['Bookmarks. ', 'Interesting movies are always under your profile.'],
			['Watched. ', 'Watched movies will not be among the recommended movies.'],
		],
		'ru' => [
			['MovieBot ', '&mdash; рекомендация фильмов на базе Искусственного Интеллекта.'],
			['Как? ', 'MovieBot определяет степень схожести тех фильмов что вы выбрали с каждым фильмом в базе данных.'],
			['Когда? ', 'Когда вы уже смотрели рекомендованные другими сервисами фильмы и не хотите иметь дело с формами расширенного поиска.'],
			['Почему? ', 'Бесконечный список подобных фильмов и минимум ваших действий.'],
			['Войдите на сайт ', 'чтобы сохранить прогресс и подтвердить что вы не Робот. Мы не сохраняем ваш e-mail.'],
			['Закладки. ', 'Интересные фильмы всегда в вашем профайле.'],
			['Просмотренные. ', 'Просмотренные фильмы не будут попадать в списки рекомендованных.'],
		],

	];

	protected $_introMap = [
		'en' => [
			'Select the movies that you like, use <strong>Search for movie</strong>',
			'To see recommendations, click <strong>Show similar</strong>',
			'Sign In to prove that you are not a Robot. Your e-mail is not saved',
			'Add to <strong>Bookmarks</strong> and mark as <strong>Watched</strong>',
		],
		'ru' => [
			'Выберите фильмы которые вам интересны, используйте <strong>Поиск фильмов</strong>',
			'Нажмите <strong>Показать похожие</strong> чтобы увидеть рекомендации',
			'Войдите на сайт чтобы подтвердить что вы не Робот. Мы не сохраняем ваш e-mail',
			'Добавляйте в <strong>Закладки</strong> и отмечайте <strong>Просмотренные</strong>',
		],
	];

	/**
	 *
	 */
	function __construct()
	{
		$localeList = ['en', 'ru'];
		$locale = null;
		$url = $_SERVER['REQUEST_URI'];
		$this->_locale = 'en';

		foreach ($localeList as $locale_) {
			if (strpos($url, "/$locale_") === 0) {
				$this->_locale = $locale_;
				break;
			}
		}
	}

	/**
	 * @param $ident
	 * @param null $gender
	 *
	 * @return mixed
	 */
	public function translate($ident, $gender = null)
	{
		if (!empty($this->_translationMap[$this->getLocale()][$ident])) {
			if ($gender === null) {
				return $this->_translationMap[$this->getLocale()][$ident];
			} else {
				if ($gender == GENDER_FEMALE) {
					return $this->_translationMap[$this->getLocale()][$ident][1];
				} else {
					return $this->_translationMap[$this->getLocale()][$ident][0];
				}
			}
		}

		return $ident;
	}

	/**
	 * @return string
	 */
	public function getLocale()
	{
		return $this->_locale;
	}

	/**
	 * @return bool
	 */
	public function isAjax()
	{
		return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}

	/**
	 * @param null $endpoint
	 *
	 * @return string
	 */
	public function url($endpoint = null)
	{
		if (!$endpoint) {
			return '/' . $this->getLocale();
		} else {
			return '/' . $this->getLocale() . '/' . $endpoint;
		}
	}

	/**
	 * @return string
	 */
	public function renderMoviebotHeaderHtml()
	{
		$html =
			'<header><a class="project" href="' . $this->url() . '">MovieBot'
			. '</a><a class="logo" href="' . $this->url() . '"><img height="108" width="108" '
			. 'src="/images/logo.svg" alt="MovieBot" title="MovieBot"></a></header>';

		return $html;
	}

	/**
	 * @param $title
	 * @param bool|false $shouldSkipJs
	 * @param null $description
	 * @param null $keywords
	 *
	 * @return string
	 */
	public function renderHeadHtml($title, $shouldSkipJs = false, $description = null, $keywords = null)
	{
		if (!$description) {
			$description = Content::getInstance()->translate('_META_DESCRIPTION_');
		}

		if (!$keywords) {
			$keywords = Content::getInstance()->translate('_META_KEYWORDS_');
		}

		$html =
			'<meta charset="utf-8"><title>MovieBot - ' . $title . '</title>
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
			<meta property="og:type" content="website" />
			<meta property="og:url" content="http://moviebot.net" />
			<meta property="fb:app_id" content="560727890765625" />
			<meta property="og:title" content="MovieBot - ' . $title . '" />
			<meta property="og:site_name" content="MovieBot" />
			<meta property="og:description" content="' . $description . '" />
			<meta name="description" content="' . $description . '" />
			<meta name="keywords" content="' . $keywords . '" />
			<meta property="og:image" content="http://moviebot.net/images/logo-200.png" />
			<meta property="og:image:width" content="200" />
			<meta property="og:image:height" content="200" />
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
			<meta name="msapplication-tap-highlight" content="no" />

			<link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-icon-57x57.png">
			<link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-icon-60x60.png">
			<link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-icon-72x72.png">
			<link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-icon-76x76.png">
			<link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-icon-114x114.png">
			<link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-icon-120x120.png">
			<link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-icon-144x144.png">
			<link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-icon-152x152.png">
			<link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-icon-180x180.png">
			<link rel="icon" type="image/png" sizes="192x192"  href="/favicons/android-icon-192x192.png">
			<link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
			<link rel="icon" type="image/png" sizes="96x96" href="/favicons/favicon-96x96.png">
			<link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
			<link rel="manifest" href="/favicons/manifest.json">
			<meta name="msapplication-TileColor" content="#ffffff">
			<meta name="msapplication-TileImage" content="/favicons/ms-icon-144x144.png">
			<meta name="theme-color" content="#ffffff">
		';

		if (!$shouldSkipJs) {
			$html .= '<script src="//code.jquery.com/jquery-2.2.3.min.js"></script>
			<script src="//connect.facebook.net/en_US/all.js#xfbml=1&appId=560727890765625"></script>
			<script src="//apis.google.com/js/client.js"></script>
			<script src="/scripts/main.min.js"></script>
			';

			if (Content::getLocale() === 'ru') {
				$html .= '<script type="text/javascript" src="//vk.com/js/api/openapi.js?105"></script>';
			}
		}

		$html .= '<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&subset=latin,cyrillic" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet" type="text/css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="/styles/all.css" rel="stylesheet" type="text/css">
';

		return $html;
	}

	/**
	 * @return string
	 */
	public function renderCurrentUserInBarHtml()
	{
		$openConnectService = Auth::getInstance()->getCurrentUser()['openConnectService'];

		$icon = '';
		if ($openConnectService == 'facebook') {
			$icon = '<span class="fa fa-facebook-official"></span>';
		} elseif ($openConnectService == 'twitter') {
			$icon = '<span class="fa fa-twitter"></span>';
		} elseif ($openConnectService == 'vk') {
			$icon = '<span class="fa fa-vk"></span>';
		} elseif ($openConnectService == 'google') {
			$icon = '<span class="fa fa-google"></span>';
		}

		$html = '<div class="d icon">' . $icon . '</div><div class="d name">' . Content::getInstance()->translate('_PROFILE_') . '</div><div class="m icon fa fa-user"></div>';

		return $html;
	}

	/**
	 * @param $active
	 *
	 * @return string
	 */
	public function renderBarHtml($active)
	{
		if (Auth::getInstance()->getCurrentUserId()) {
			$guest = '';
			$bookmarkCount = Storage::getInstance()->mysqlSelectCount('bookmark', ['userId' => Auth::getInstance()->getCurrentUserId(),]);
			$watchedCount = Storage::getInstance()->mysqlSelectCount('watched', ['userId' => Auth::getInstance()->getCurrentUserId(),]);

			$currentUserHtml = '<a href="' . $this->url('profile') . '" id="currentUserInBar" class="item ' . ($active == 'profile' ? 'active' : '') . '">'
				. $this->renderCurrentUserInBarHtml() . '</a>';
		} else {
			$guest = ' guest';
			$bookmarkCount = false;
			$watchedCount = false;
			$currentUserHtml = '<a href="' . $this->url('sign-in') . '" id="currentUserInBar" class="item' . ($active == 'sign-in' ? ' active' : '') . '">'
				. '<div class="icon"><span class="fa fa-sign-in"></span></div>'
				. '<div class="name"><span class="d">' . $this->translate('_SIGN_IN_') . '</span></div></a>';
		}

		$html =
			'<div id="bar"><div class="contentWrapper">'
			// Logo in bar (left)
			. '<a href="' . $this->url() . '" id="logoInBar"><div><img style="vertical-align: middle" src="/images/logo.svg" height="30" width="30" alt="MovieBot" title="MovieBot"></div></a>'

			// Current user (right)
			. $currentUserHtml

			// Watched (right)
			. '<a href="' . $this->url('watched') . '" id="watchedInBar" class="item' . ($active == 'watched' ? ' active' : '') . $guest . '">'
			. '<div class="counter" id="watchedCount">' . $watchedCount . '</div>'
			. '<div class="name"><span class="d">' . $this->translate('_WATCHED_') . '</span><span class="fa fa-check-circle-o m colorRed"></span></div>'
			. '</a>'

			// Bookmarks (right)
			. '<a href="' . $this->url('bookmarks') . '" id="bookmarkInBar" class="item' . ($active == 'bookmark' ? ' active' : '') . $guest . '">'
			. '<div class="counter" id="bookmarkCount">' . $bookmarkCount . '</div>'
			. '<div class="name"><span class="d">' . $this->translate('_BOOKMARKS_') . '</span><span class="fa fa-star m colorGreen"></span></div></a>'

			// About (right)
			. '<a href="' . $this->url('read-me') . '" id="readMeInBar" class="item' . ($active == 'read-me' ? ' active' : '') . '">'
			. '<div class="icon"><span class="fa fa-question-circle-o"></span></div>'
			. '<div class="name"><span class="d">' . $this->translate('_READ_ME_') . '</span></div></a>'
			. '<div class="clear"></div></div></div>';

		return $html;
	}

	/**
	 * @return string
	 */
	public function renderFooterHtml()
	{
		$url = $_SERVER['REQUEST_URI'];
		$baseUrl = substr($url, 3, strlen($url) - 3);

		$enUrl = '/en' . $baseUrl;
		$ruUrl = '/ru' . $baseUrl;

		$html =
			'<footer>
	<div class="contentWrapper">
		<span>&copy;&nbsp;2016</span><a href="' . $enUrl . '">'
			. $this->translate('_EN_') . '</a><a href="' . $ruUrl . '">'
			. $this->translate('_RU_') . '</a><a href="' . $this->url('archive') . '">' . $this->translate('_ARCHIVE_') . '</a>
	</div>
</footer>
<script type="text/javascript">
	var addthis_config = addthis_config || {};
	var addthis_share = addthis_share || {};
	addthis_config.data_track_addressbar = false;
	addthis_config.data_track_clickback = false;
</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5758a223494df355"></script>';

		return $html;
	}

	/**
	 * @param $movieId
	 * @param $overview
	 * @param bool $isDetailed
	 *
	 * @return string
	 */
	public function renderMovieHtml($movieId, $overview, $isDetailed)
	{
		$movie = Storage::getInstance()->redisGetMovie($movieId);

		// Bookmarks
		if ($overview !== 'bookmark') {
			$isBookmarked = Storage::getInstance()->mysqlIsExisted('bookmark', $movieId, Auth::getInstance()->getCurrentUserId());
		} else {
			$isBookmarked = true;
		}

		$bookmarkHtml = '<a class="control bookmark" href="javascript:void(0)" data-movieid="' . $movieId . '">'
			. '<span class="fa fa-star-o"></span><span class="fa fa-star"></span>&nbsp;<span class="name">'
			. $this->translate('_ADD_TO_BOOKMARKS_')
			. '</span></a>';

		// Watched
		if ($overview !== 'watched') {
			$isWatched = Storage::getInstance()->mysqlIsExisted('watched', $movieId, Auth::getInstance()->getCurrentUserId());
		} else {
			$isWatched = true;
		}

		$gender = Auth::getInstance()->getCurrentUserId() ? Auth::getInstance()->getCurrentUser()['gender'] : GENDER_MALE;
		$watchedHtml = '<a class="control watched" href="javascript:void(0)" data-movieid="' . $movieId . '">'
			. '<span class="fa fa-circle-o"></span><span class="fa fa-check-circle-o"></span>&nbsp;<span class="name">'
			. $this->translate('_MARK_AS_WATCHED_', $gender)
			. '</span></a>';

		// Detailed
		$detailedHtml = '<a class="control detailed" href="javascript:void(0)">'
			. '<span class="fa fa-chevron-down"></span><span class="fa fa-chevron-up"></span></a>';

		// Genre
		$genreList = [];
		foreach ($movie['genreList'] as $genre_) {
			$genreList[] = '<span class="wsnw">' . $genre_ . '</span>';
		}
		$genre = implode('&nbsp;<span class="vS">|</span> ', $genreList);

		// Search in web
		$searchInWebUrl = 'https://www.google.com/search?q=' . Escaper::getInstance()->escapeHtmlAttr($movie['name'] . ' ' . $movie['year']);
		$searchInWebHtml = '<a class="control searchInWeb" target="_blank" href="' . $searchInWebUrl . '">'
			. '<span class="fa fa-external-link-square"></span>&nbsp;<span class="name">'
			. $this->translate('_SEARCH_IN_WEB_')
			. '</span></a>';

		// Faded movie in run

		$movieClass = '';
		if ($isBookmarked) {
			$movieClass .= 'bookmark ';
		}

		if ($isWatched) {
			$movieClass .= 'watched ';
		}

		if ($isDetailed) {
			$movieClass .= 'detailed ';
		}

		$controlListHtml = $bookmarkHtml . $watchedHtml . $detailedHtml;
		$detailedControlListHtml = $bookmarkHtml . $watchedHtml . $searchInWebHtml . $detailedHtml;

		$html =
			'<div class="movie ' . $movieClass . '"><div class="layout"><div class="left"><img src="'
			. Escaper::getInstance()->escapeHtmlAttr($movie['imageSrc'])
			. '" alt="' . Escaper::getInstance()->escapeHtmlAttr($movie['name'] . ' (' . $movie['year'] . ')') . '"'
			. '" title="' . Escaper::getInstance()->escapeHtmlAttr($movie['name'] . ' (' . $movie['year'] . ')') . '"'
			. '></div>
	<div class="right">
		<div class="title">' . Escaper::getInstance()->escapeHtml($movie['name'])
			. ($movie['type'] != 'movie' ? ('<span class="type">&nbsp;' . Content::getInstance()->translate($movie['type']) . '</span>') : '')
			. '<span class="year">&nbsp;' . Escaper::getInstance()->escapeHtml($movie['year']) . '</span>'
			. '</div>
		<div class="originalName">' . Escaper::getInstance()->escapeHtml($movie['originalName']) . '</div>'
			. (empty($movie['tagline']) ? '' : ('<div class="tagline">&laquo;' . Escaper::getInstance()->escapeHtml($movie['tagline']) . '&raquo;</div>'))
			. '<div class="ratingAndGenre"><div class="rating">' . round($movie['rate'] / 100, 2) . '</div><div class="genre">' . $genre . '</div></div>
		<div class="description">' . Escaper::getInstance()->escapeHtml($movie['description']) . '</div>'
			. '<div class="controlList">' . $controlListHtml . '<div class="clear"></div></div>
	</div>
	<div class="clear"></div></div>
	<div class="detailedControlList">' . $detailedControlListHtml . '<div class="clear"></div></div>
</div>';

		return $html;
	}

	/**
	 * @param $archiveId
	 * @param $movie1Id
	 * @param $movie2Id
	 * @param $movie3Id
	 *
	 * @return string
	 */
	public function renderArchiveHtml($archiveId, $movie1Id, $movie2Id, $movie3Id)
	{
		$count = 1;
		if ($movie2Id) {
			$count++;
		}

		if ($movie3Id) {
			$count++;
		}

		$html = '<div class="archive count' . $count . '"><div class="layout"><div class="left">';

		// 1
		$movie1 = Storage::getInstance()->redisGetMovie($movie1Id);
		$html .= '<img src="' . Escaper::getInstance()->escapeHtmlAttr($movie1['imageSrc'])
			. '" alt="' . Escaper::getInstance()->escapeHtmlAttr($movie1['name'] . ' (' . $movie1['year'] . ')')
			. '" title="' . Escaper::getInstance()->escapeHtmlAttr($movie1['name'] . ' (' . $movie1['year'] . ')') . '"'
			. '>';

		// 2
		if ($movie2Id) {
			$movie2 = Storage::getInstance()->redisGetMovie($movie2Id);
			$html .= '<img src="' . Escaper::getInstance()->escapeHtmlAttr($movie2['imageSrc'])
				. '" alt="' . Escaper::getInstance()->escapeHtmlAttr($movie2['name'] . ' (' . $movie2['year'] . ')')
				. '" title="' . Escaper::getInstance()->escapeHtmlAttr($movie2['name'] . ' (' . $movie2['year'] . ')') . '"'
				. '>';

		}

		// 3
		if ($movie3Id) {
			$movie3 = Storage::getInstance()->redisGetMovie($movie3Id);
			$html .= '<img src="' . Escaper::getInstance()->escapeHtmlAttr($movie3['imageSrc'])
				. '" alt="' . Escaper::getInstance()->escapeHtmlAttr($movie3['name'] . ' (' . $movie3['year'] . ')')
				. '" title="' . Escaper::getInstance()->escapeHtmlAttr($movie3['name'] . ' (' . $movie3['year'] . ')') . '"'
				. '>';

		}

		$html .= '</div><div class="right">';

		$nameList = [];
		$nameList[] = '<strong>' . Escaper::getInstance()->escapeHtml($movie1['name']) . '</strong>'
			. ($movie1['type'] != 'movie' ? ('<span class="type">&nbsp;' . Content::getInstance()->translate($movie1['type']) . '</span>') : '')
			. '<span class="year">&nbsp;' . Escaper::getInstance()->escapeHtml($movie1['year']) . '</span>';

		if ($movie2Id) {
			$nameList[] = '<strong>' . Escaper::getInstance()->escapeHtml($movie2['name']) . '</strong>'
				. ($movie2['type'] != 'movie' ? ('<span class="type">&nbsp;' . Content::getInstance()->translate($movie2['type']) . '</span>') : '')
				. '<span class="year">&nbsp;' . Escaper::getInstance()->escapeHtml($movie2['year']) . '</span>';
		}

		if ($movie3Id) {
			$nameList[] = '<strong>' . Escaper::getInstance()->escapeHtml($movie3['name']) . '</strong>'
				. ($movie3['type'] != 'movie' ? ('<span class="type">&nbsp;' . Content::getInstance()->translate($movie3['type']) . '</span>') : '')
				. '<span class="year">&nbsp;' . Escaper::getInstance()->escapeHtml($movie3['year']) . '</span>';
		}


		$html .= implode(', ', $nameList);
		$html .= '</div><div class="clear"></div></div>';

		$html .= '<div class="bottom"><a href="' . $this->url('similar-movies') . '?id=' . $archiveId
			. '"><span class="fa fa-chevron-right"></span>&nbsp;<span class="name">'
			. $this->translate('_VIEW_SIMILAR_')
			. '</span></a></div>';

		$html .= '</div>';

		return $html;
	}

	/**
	 * @param $movieId
	 *
	 * @return string
	 */
	public function renderInMovieInfoHtml($movieId)
	{
		$movie = Storage::getInstance()->redisGetMovie($movieId);

		// Genre
		$genreList = [];
		foreach ($movie['genreList'] as $genre_) {
			$genreList[] = '<span class="wsnw">' . $genre_ . '</span>';
		}
		$genre = implode('&nbsp;<span class="vS">|</span> ', $genreList);

		$html =
			'
			<a href="javascript:void(0)" class="cornerButton inMovieInfoCloseButton"><span class="fa fa-remove"></span></a>
			<div class="movie detailed">
				<div class="layout">
				<div class="left">
					<img src="' . Escaper::getInstance()->escapeHtmlAttr($movie['imageSrc']) . '" alt="' . Escaper::getInstance()->escapeHtmlAttr($movie['name'] . '(' . $movie['year'] . ')') . '">
				</div>
				<div class="right">
					<div class="title">' . Escaper::getInstance()->escapeHtml($movie['name'])
			. ($movie['type'] != 'movie' ? ('<span class="type">&nbsp;' . Content::getInstance()->translate($movie['type']) . '</span>') : '')
			. '<span class="year">&nbsp;' . Escaper::getInstance()->escapeHtml($movie['year']) . '</span>'
			. '</div>
					<div class="originalName">' . Escaper::getInstance()->escapeHtml($movie['originalName']) . '</div>'
			. (empty($movie['tagline']) ? '' : ('<div class="tagline">&laquo;' . Escaper::getInstance()->escapeHtml($movie['tagline']) . '&raquo;</div>'))
			. '<div class="ratingAndGenre"><div class="rating">' . round($movie['rate'] / 100, 2) . '</div><div class="genre">' . $genre . '</div></div>
		<div class="description">' . Escaper::getInstance()->escapeHtml($movie['description']) . '</div></div><div class="clear"></div></div></div></div>';

		return $html;
	}

	/**
	 * @return string
	 */
	public function renderUserBlockHtml()
	{
		$imageUrl = Auth::getInstance()->getCurrentUser()['imageUrl'];
		$openConnectService = Auth::getInstance()->getCurrentUser()['openConnectService'];

		$openConnect = '';
		if ($openConnectService == 'facebook') {
			$openConnect = '<span class="fa fa-facebook-official"></span>';
		} elseif ($openConnectService == 'google') {
			$openConnect = '<span class="fa fa-google"></span>';
		} elseif ($openConnectService == 'twitter') {
			$openConnect = '<span class="fa fa-twitter"></span>';
		} elseif ($openConnectService == 'vk') {
			$openConnect = '<span class="fa fa-vk"></span>';
		}

		$html = '
			<div id="userBlock">
				<div class="left"><div class="imageWrapper"><img style="display: none;" id="userBlockImage" src="' . $imageUrl . '"></div><div class="imageWrapper2"></div></div>
				<div class="right">
					<div class="name">' . $openConnect . '&nbsp;' . Auth::getInstance()->getCurrentUserName() . '</a>
					</div><div class="menu"><a href="' . $this->url('sign-out') . '"><span class="fa fa-sign-out"></span>&nbsp;' . Content::getInstance()->translate('_SIGN_OUT_') . '</a></div>
				</div>
				<div class="clear"></div>
			</div>';

		return $html;
	}

	/**
	 * @return string
	 */
	public function renderAfterOpeningBodyHtml()
	{
		$html = "<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-78459601-1', 'auto');
  ga('send', 'pageview');
</script><div id=\"fb-root\"></div>";

		$html .= '<!--[if lt IE 9]>
			<div class="browsehappy">' . Content::getInstance()->translate('_BROWSERHAPPY_') . '</div>
			<![endif]-->
		';

		$html .= '<div id="scrollUp" onclick="$(window).scrollTop(0);"><span class="fa fa-arrow-circle-o-up"></span></div>';

		return $html;
	}

	/**
	 * @return string
	 */
	public function renderReadMeHtml()
	{
		$html = '<div class="whiteBlock text">';

		foreach ($this->_readMeMap[$this->getLocale()] as $item) {
			$html .= '<p><strong>' . $item[0] . '</strong>' . $item[1] . '</p>';
		}

		$html .= '<p><a href="mailto:info.moviebot@gmail.com">info.moviebot@gmail.com</a></p>
		<div class="separator"></div>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="ARDYV28HKHRME">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
</div>';

		return $html;
	}

	/**
	 * @return string
	 */
	public function renderIntoHtml()
	{
		$html = '<h2>' . $this->translate('_META_DESCRIPTION_') . '</h2>';

		foreach ($this->_introMap[$this->getLocale()] as $item) {
			$html .= '<div class="li"><div class="circle"></div><div class="text">' . $item . '</div><div class="clear"></div></div>';
		}

		return $html;
	}

	/**
	 * @param $outVectorId
	 * @param $title
	 *
	 * @return string
	 */
	public function renderAddThisListHtml($outVectorId, $title)
	{
		$html =
			'<div class="addThisList">
	<div
		data-url="http://moviebot.net/similar-movies?id=' . $outVectorId . '"
		data-title="' . $title . '"
		class="addthis_toolbox addthis_default_style addthis_16x16_style">
		<a class="addthis_button_facebook"></a>
		<a class="addthis_button_twitter"></a>';
		if ($this->getLocale() == 'ru') {
			$html .= '<a class="addthis_button_vk"></a>';
		}

		$html .= '<a class="addthis_button_compact"></a>
	</div>
	<div>' . $this->translate('_ADD_THIS_LIST_') . '</div>
	<span class="clear"></span>
</div>';

		return $html;
	}

	/**
	 * @param $outVectorId
	 * @param null $movieList
	 *
	 * @return string
	 */
	public function makeTitleForSimilarList($outVectorId, $movieList = null)
	{
		$nameList = [];

		if (!$movieList) {
			$outVector = Storage::getInstance()->mysqlSelectOne('out_vector', null, ['outVectorId' => $outVectorId,]);
			if (!$outVector) {
				throw new \RuntimeException('List was not found');
			}

			$movieList[] = Storage::getInstance()->redisGetMovie($outVector['movie1Id']);
			if (!empty($outVector['movie2Id'])) {
				$movieList[] = Storage::getInstance()->redisGetMovie($outVector['movie2Id']);

			}

			if (!empty($outVector['movie3Id'])) {
				$movieList[] = Storage::getInstance()->redisGetMovie($outVector['movie3Id']);
			}
		}

		foreach ($movieList as $movie) {
			if ($movie) {
				$nameList[] = '«' . Escaper::getInstance()->escapeHtmlAttr($movie['name']) . '»';
			}
		}

		return $this->translate('_META_TITLE_SIMILAR_MOVIES_') . implode(', ', $nameList);
	}
}