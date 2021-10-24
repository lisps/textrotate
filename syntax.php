<?php
/**
 * DokuWiki Plugin textrotate (Syntax Component) 
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  lisps
 * @author  peterfromearth    
 */

class syntax_plugin_textrotate extends DokuWiki_Syntax_Plugin {
    
    public function getType(){ return 'formatting'; }
    public function getAllowedTypes() { return array('formatting', 'substition', 'disabled'); }
    public function getSort(){ return 66; }

    /*
     * Connect pattern to lexer
     */
    function connectTo($mode) {
		$this->Lexer->addEntryPattern(
		'!!(?=.*!!)',
		$mode,
		'plugin_textrotate'
		);
	}
	
	function postConnect() {
		$this->Lexer->addExitPattern(
		'!!',
		'plugin_textrotate'
		);
	}

    /*
     * Handle the matches
     */
    function handle($match, $state, $pos, Doku_Handler $handler){

		switch ($state) {
			case DOKU_LEXER_ENTER :
			    return [$state, ''];
			case DOKU_LEXER_UNMATCHED : 
				return [$state, $match];
			case DOKU_LEXER_EXIT :      
				return [$state, ''];
		}
		return [];
    }
    
    /*
     * Create output
     */
    function render($mode, Doku_Renderer $renderer, $data)
	{
		list($state, $opt) = $data;
		
		if($mode != 'xhtml') return false;
		switch ($state) {
		    case DOKU_LEXER_ENTER :
		        if($mode === 'xhtml') {
		          $renderer->doc .= "<span class='plugin_textrotate_rotated'>";
		        }
		        break;
		        
		    case DOKU_LEXER_UNMATCHED :
		        $renderer->doc .= $renderer->_xmlEntities($opt); 
		        break;
		    case DOKU_LEXER_EXIT :
		        if($mode === 'xhtml') {
		          $renderer->doc .= '</span>';
		        }
		        break;
		}
		return true;
	}
}

