<?php

/**
 * @package   Joostina
 * @copyright Авторские права (C) 2007-2010 Joostina team. Все права защищены.
 * @license   Лицензия http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, или help/license.php
 * Joostina! - свободное программное обеспечение распространяемое по условиям лицензии GNU/GPL
 * Для получения информации о используемых расширениях и замечаний об авторском праве, смотрите файл help/copyright.php.
 */
// запрет прямого доступа
defined( '_JOOS_CORE' ) or die();

class elrteEditor {

	public static function init() {

		joosHtml::load_jquery();
		joosHtml::load_jquery_ui();

		joosDocument::instance()
				->add_css( JPATH_SITE_PLUGINS . '/editors/elrte/css/smoothness/jquery-ui-1.8.7.custom.css' )
				->add_css( JPATH_SITE_PLUGINS . '/editors/elrte/css/elrte.css' )
				->add_js_file( JPATH_SITE_PLUGINS . '/editors/elrte/js/elrte.js' )
				->add_js_file( JPATH_SITE_PLUGINS . '/editors/elrte/js/i18n/elrte.ru.js' );

	}

	public static function display( $name , $content , $hiddenField , $width , $height , $col , $row , $params ) {

		/**
		 *  tiny: только кнопки изменения стиля текста (жирный, наклонный, подчеркнутый, перечеркнутый, subscript, superscript)
		 * compact: тоже, что и tiny + сохранить, отмена/повтор, выравнивание, списки, ссылки, полноэкранный режим
		 * normal: compact + копировать/вставить, цвета, отступы, элементы, изображения
		 * complete: normal + форматирование, размер и стиль шрифта
		 * maxi: complete + таблицы
		 */
		$toolbar       = isset( $params['toolbar'] ) ? $params['toolbar'] : 'complete';

		$code_on_ready = <<< EOD
	elRTE.prototype.filter.prototype.replaceTags = false;

		$().ready(function() {
			$('#$name').elrte({
				cssClass : 'el-rte',
				lang     : 'ru',
				height   : '$height',
				width: '$width',
				toolbar  : '$toolbar',
				fmAllow: true,
				fmOpen: function(callback) {
					$('<div id="finder" />').elfinder({
						url : '/ajax.index.php?option=finder',
						lang : 'ru',
						view : 'icons',
						dialog : { width : 900, modal : true, title : 'elFinder - менеджер файлов' },
						closeOnEditorCallback : true,
						editorCallback : callback,
						places: '',
						placesFirst : false
					})
				}

				//cssfiles : ['css/elrte-inner.css']
			});
		});
EOD;
		joosDocument::instance()->add_js_code( $code_on_ready );
		return '<div id="finder"></div><textarea name="' . $hiddenField . '" id="' . $hiddenField . '" cols="' . $col . '" rows="' . $row . '" style="width:' . $width . ';height:' . $height . ';">' . $content . '</textarea>';
	}

	public static function get_content( $name , $params = array () ) {
		return isset( $params['js_wrap'] ) ? joosHtml::js_code( '$(\'#' . $name . '\').elrte("updateSource");' ) : '$(\'#' . $name . '\').elrte("updateSource");';
	}

}