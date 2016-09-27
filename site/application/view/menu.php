<div id="menu">
	<?php if (Application::$route == '/'): ?>
		<a class="item active" href="/">Главная</a>
		<a class="item" href="/services">Услуги</a>
		<a class="item" href="/contacts">Контакты</a>
		<a id="facebook" target="_blank" href="https://www.facebook.com/fz.novik?fref=ts" class="fa fa-facebook-square"></a>
	<?php endif ?>
	<?php if (Application::$route == '/services'): ?>
		<a class="item" href="/">Главная</a>
		<a class="item active" href="/services">Услуги</a>
		<a class="item" href="/contacts">Контакты</a>
		<a id="facebook" target="_blank" href="https://www.facebook.com/fz.novik?fref=ts" class="fa fa-facebook-square"></a>
	<?php endif ?>
	<?php if (Application::$route == '/contacts'): ?>
		<a class="item" href="/">Главная</a>
		<a class="item" href="/services">Услуги</a>
		<a class="item active" href="/contacts">Контакты</a>
		<a id="facebook" target="_blank" href="https://www.facebook.com/fz.novik?fref=ts" class="fa fa-facebook-square"></a>
	<?php endif ?>
</div>
<div class="clear"></div>