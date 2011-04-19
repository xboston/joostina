<?php

/**
 * @package Joostina
 * @copyright Авторские права (C) 2007-2010 Joostina team. Все права защищены.
 * @license Лицензия http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, или help/license.php
 * Joostina! - свободное программное обеспечение распространяемое по условиям лицензии GNU/GPL
 * Для получения информации о используемых расширениях и замечаний об авторском праве, смотрите файл help/copyright.php.
 */
// запрет прямого доступа
defined('_JOOS_CORE') or die();

/**
 * Информация о версии
 * @package Joostina
 */
class joosVersion {

	public static
	/** @var строка CMS */
	$CMS = 'Joostina',
	/** @var версия */
	$CMS_ver = 'X',
	/** @var int Номер сборки */
	$BUILD = '$: 1***',
	/** @var string Дата */
	$RELDATE = '15:04:2011',
	/** @var string Время */
	$RELTIME = 'xx:xx:xx',
	/** @var string Текст авторских прав */
	$COPYRIGHT = 'Авторские права &copy; 2007-2011 Joostina Team. Все права защищены.',
	/** @var string URL */
	$URL = '<a href="http://www.joostina.ru" target="_blank" title="Система создания и управления сайтами Joostina CMS">Joostina!</a> - бесплатное и свободное программное обеспечение для создания сайтов, распространяемое по лицензии GNU/GPL.',
	/** @var string ссылки на сайты поддержки */
	$SUPPORT = 'Поддержка: <a href="http://forum.joostina.ru" target="_blank" title="Официальный форум CMS Joostina">forum.joostina.ru</a>';

	// получение переменных окружения информации осистеме
	public static function get($name) {
		return self::$$name;
	}

}