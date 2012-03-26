<?php

// запрет прямого доступа
defined('_JOOS_CORE') or die();

/**
  * Библиотека работы с сессиями
 * Системная библиотека
 *
 * @version    1.0
 * @package    Libraries
 * @subpackage Libraries
 * @subpackage Session
 * @category   Libraries
 * @author     Joostina Team <info@joostina.ru>
 * @copyright  (C) 2007-2012 Joostina Team
 * @license    MIT License http://www.opensource.org/licenses/mit-license.php
 * Информация об авторах и лицензиях стороннего кода в составе Joostina CMS: docs/copyrights
 *
 * */
class joosSession {

	private static $_userstate = null;

	private static function start() {
		if (!isset($_SESSION)) {
			$session_name = self::get_session_name();

			session_name($session_name);
			session_start();
		}
	}

	/**
	 * Получение уникального названия сессии для пользователя
	 *
	 * @return string
	 */
	public static function get_session_name() {

		$user_ip = joosRequest::user_ip();
		$user_browser = joosRequest::server('HTTP_USER_AGENT');

		return joosCSRF::hash($user_ip . $user_browser);
	}

	public static function get($key, $default = null) {
		self::start();
		return joosRequest::session($key, $default);
	}

	public static function set($key, $value) {
		self::start();
		return $_SESSION[$key] = $value;
	}

	public static function session_cookie_name() {
		$syte = str_replace(array('http://', 'https://'), '', JPATH_SITE);
		return md5('site' . $syte);
	}

	public static function session_cookie_value($id = null) {
		$type = joosConfig::get2('session', 'type', 3);
		$browser =  isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'none';

		switch ($type) {
			case 2:
				$value = md5($id . $_SERVER['REMOTE_ADDR']);
				break;

			case 1:
				// slightly reduced security - 3rd level IP authentication for those behind IP Proxy
				$remote_addr = explode('.', $_SERVER['REMOTE_ADDR']);
				$ip = $remote_addr[0] . '.' . $remote_addr[1] . '.' . $remote_addr[2];
				$value = joosCSRF::hash($id . $ip . $browser);
				break;

			default:
				$ip = $_SERVER['REMOTE_ADDR'];
				$value = joosCSRF::hash($id . $ip . $browser);
				break;
		}

		return $value;
	}

	public static function init_user_state() {

		if (self::$_userstate === null && isset($_SESSION['session_userstate'])) {
			self::$_userstate = &$_SESSION['session_userstate'];
		} else {
			self::$_userstate = null;
		}
	}

	public static function get_user_state_from_request($var_name, $req_name, $var_default = null) {
		if (is_array(self::$_userstate)) {
			if (isset($_REQUEST[$req_name])) {
				self::set_user_state($var_name, $_REQUEST[$req_name]);
			} elseif (!isset(self::$_userstate[$var_name])) {
				self::set_user_state($var_name, $var_default);
			}

			self::$_userstate[$var_name] = joosInputFilter::instance()->process(self::$_userstate[$var_name]);
			return self::$_userstate[$var_name];
		} else {
			return null;
		}
	}

	private static function set_user_state($var_name, $var_value) {
		// TODO сюда надо isset
		if (is_array(self::$_userstate)) {
			self::$_userstate[$var_name] = $var_value;
		}
	}

}
