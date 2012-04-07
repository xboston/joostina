<?php

/**
 * @package   Joostina
 * @copyright Авторские права (C) 2007-2010 Joostina team. Все права защищены.
 * @license   Лицензия http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, или help/license.php
 * Joostina! - свободное программное обеспечение распространяемое по условиям лицензии GNU/GPL
 * Для получения информации о используемых расширениях и замечаний об авторском праве, смотрите файл help/copyright.php.
 */
// запрет прямого доступа
defined('_JOOS_CORE') or die();

/**
 * Для вывода визуального редактора Redactor
 * http://imperavi.com/redactor/
 *
 * @version    1.0
 * @package    Plugins
 * @subpackage joosEditor
 * @category   Editor
 * @author     Joostina Team <info@joostina.ru>
 * @copyright  (C) 2007-2012 Joostina Team
 * @license    MIT License http://www.opensource.org/licenses/mit-license.php
 * Информация об авторах и лицензиях стороннего кода в составе Joostina CMS: docs/copyrights
 *
 * */
class editorRedactor {

	public static function init() {

		joosDocument::instance()
				->add_css(JPATH_APP_PLUGINS_SITE . '/editors/redactor/css/redactor.css')
				->add_js_file(JPATH_APP_PLUGINS_SITE . '/editors/redactor/redactor.js');
	}

	public static function display($name, $content, $hiddenField, $width, $height, $col, $row, $params) {

		/**
		 *  tiny: только кнопки изменения стиля текста (жирный, наклонный, подчеркнутый, перечеркнутый, subscript, superscript)
		 * compact: тоже, что и tiny + сохранить, отмена/повтор, выравнивание, списки, ссылки, полноэкранный режим
		 * normal: compact + копировать/вставить, цвета, отступы, элементы, изображения
		 * complete: normal + форматирование, размер и стиль шрифта
		 * maxi: complete + таблицы
		 */
		$toolbar = isset($params['toolbar']) ? $params['toolbar'] : 'maxi';

		$code_on_ready = <<< EOD
		$(document).ready(function() {
			$('#$name').redactor();
		});
EOD;
		joosDocument::instance()->add_js_code($code_on_ready);
		return '<textarea name="' . $hiddenField . '" id="' . $hiddenField . '" cols="' . $col . '" rows="' . $row . '" style="width:' . $width . ';height:' . $height . ';">' . $content . '</textarea>';
	}

	public static function get_content($name, $params = array()) {
		return isset($params['js_wrap']) ? joosHtml::js_code('$(\'#' . $name . '\').elrte("updateSource");') : '$(\'#' . $name . '\').elrte("updateSource");';
	}

}