## CMF / CMS Joostina 2.0.*

## Требования:
* php > 5.3
* mysql >  5.1
* расширения php - mb_string, pcre


## Документация по исходному коду проекта и использованию API
* Статичная документация: http://xboston.github.com/joostina-docs
* Поддержка: http://forum.joostina.ru


## Файловая структура системы:
```
/admin - каталог доступа к панели управления
/app - каталог размещения пользовательских данных и расширений
	-/attachments - каталог для загруженных файлов
	-/components - каталог размещения компонентов системы
	-/modules - каталог модулей
	-/plugins - каталог расширений базового функционала системы
	-/templates - каталог шаблонов
	-/vendors - каталог расширений системы от сторонних разработчиков
/cache - каталог кеша
	-/tmp - каталог размещения временных файлов
/core - систмный каталог файлов ядра
	-/libraries - каталог системных библиотек
/docs - каталог документации на систему
/install - каталог установки системы
/media - каталог системных медиа файлов
	-/css - каталог CSS стилей
	-/images - каталог системных изображений
	-/js - каталог системных javascript файлов
	-/swf - каталог флеш-файлов
```

## Лицензия
Released under the [MIT license](http://www.opensource.org/licenses/MIT).