<div id="main">
	<img src="/images/main.png">
	<h1>Ваш врач дерматолог</h1>
	<h2>Земляной Сергей Владимирович</h2>
	<div id="menu">
		<?php if (Application::$route == '/'): ?>
			<span class="paddingRight10px"></span><a class="item active" href="/">Главная
				<i class="fa fa-user-md"></i>
			</a>
			<span class="paddingRight10px"></span><a class="item" href="/services">Услуги
				<i class="fa fa-medkit"></i>
			</a>
			<span class="paddingRight10px"></span><a class="item" href="/contacts">Контакты
				<i class="fa fa-phone"></i>
			</a>
			<span class="paddingRight10px"></span><a class="item" href="https://www.facebook.com/fz.novik?fref=ts" target="_blank">Facebook
				<i class="fa fa-facebook"></i>
			</a>
		<?php endif ?>
		<?php if (Application::$route == '/services'): ?>
			<span class="paddingRight10px"></span><a class="item" href="/">Главная
				<i class="fa fa-user-md"></i>
			</a>
			<span class="paddingRight10px"></span><a class="item active" href="/services">Услуги
				<i class="fa fa-medkit"></i>
			</a>
			<span class="paddingRight10px"></span><a class="item" href="/contacts">Контакты
				<i class="fa fa-phone"></i>
			</a>
			<span class="paddingRight10px"></span><a class="item" href="https://www.facebook.com/fz.novik?fref=ts" target="_blank">Facebook
				<i class="fa fa-facebook"></i>
			</a>
		<?php endif ?>
		<?php if (Application::$route == '/contacts'): ?>
			<span class="paddingRight10px"></span><a class="item" href="/">Главная
				<i class="fa fa-user-md"></i>
			</a>
			<span class="paddingRight10px"></span><a class="item" href="/services">Услуги
				<i class="fa fa-medkit"></i>
			</a>
			<span class="paddingRight10px"></span><a class="item active" href="/contacts">Контакты
				<i class="fa fa-phone"></i>
			</a>
			<span class="paddingRight10px"></span><a class="item" href="https://www.facebook.com/fz.novik?fref=ts" target="_blank">Facebook
				<i class="fa fa-facebook"></i>
			</a>
		<?php endif ?>
	</div>
</div>
<div class="clear"></div>