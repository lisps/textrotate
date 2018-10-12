<?php
/**
 * DokuWiki Plugin textrotate (Action Component) 
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  lisps    
 */

if (!defined('DOKU_INC')) die();

class action_plugin_textrotate extends DokuWiki_Action_Plugin {
	/**
	 * Register the eventhandlers
	 */
	function register(Doku_Event_Handler $controller) {
		$controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'insert_button', array ());
		
		if(!function_exists('ImageCreate')) {
		    msg('plugin textrotate: install image php-gd package', -1, '', '', MSG_ADMINS_ONLY);
		}
	}
	
	/**
	 * Inserts the toolbar button
	 */
	function insert_button(Doku_Event $event, $param) {
		$event->data[] = array(	
			'type'	=> 'format',
			'title'	=> 'Vertikaler Text generieren',
			'icon'	=> '../../plugins/textrotate/textrotate.png',
			'sample'=> 'Vertikaler Text',
			'open'	=> '!!',
			'close'	=>'!!',
			'insert'=>'',
		);
	}
}
