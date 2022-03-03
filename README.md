CcsJs-for-Evolution
=====================
Component CssJs for MODX Evolution

Описание
----------
Сниппеты основанны на компоненте MinifyX под MODX EVO, решат вопрос работы с файлами ститей и скриптов.
- Обновление версии файла (основанной на дате последнего обновления)
- Минификация файлов
- Соединение всех файлов в 1.


Установка
----------
- Установить через Extras или PackageManager
- Ручная установка: залить на сервер папку Assets, создать 2 сниппета js и css с кодом из файлов(istall/assets/snippets)

Пример вызова
----------


	[!css? &files=`assets/templates/tpl/css/bootstrap.css,
				   assets/js/prettify/prettify.css`
		   &minify=`1`!]

	[!js? &files=`assets/js/jquery-1.8.3.min.js,
				  assets/templates/tpl/js/modernizr.custom.28468.js,
				  assets/js/jquery.validate.js,
				  assets/js/jquery.form.min.js,
				  assets/js/prettify/prettify.js`
		  &minify=`1`!]



Параметры сниппета
-------
- **files** Список файлов с CSS стилями, которые нужно включить в конечный файл и сжать
- **minify** - сжимать и обьеденять файлик
- **inhtml** - разместить сразу в HTML, в тегах <style></style>
- **folder** в какую папку сохранять сжатый файл. По умолчанию корень сайта

TODO
-------
- Добавить обработку LESS
- Добавить обработку SASS
- Добавить обработку inline css и js
