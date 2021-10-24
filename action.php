<?php
/**
 * DokuWiki Plugin textrotate (Action Component) 
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  lisps  
 * @author  peterfromearth  
 */

class action_plugin_textrotate extends DokuWiki_Action_Plugin {
	/**
	 * Register the eventhandlers
	 */
	function register(Doku_Event_Handler $controller) {
		$controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'insert_button', array ());
		
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
