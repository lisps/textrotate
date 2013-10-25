<?php
/**
 * DokuWiki Plugin textrotate (Syntax Component) 
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  lisps    
 */

if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');
if (!defined('DOKU_LF')) define('DOKU_LF', "\n");
if (!defined('DOKU_TAB')) define('DOKU_TAB', "\t");
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

/*
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_textrotate extends DokuWiki_Syntax_Plugin {
    /*
     * What kind of syntax are we?
     */
    function getType() {return 'protected';	}

    /*
     * Where to sort in?
     */
    function getSort(){return 155;}

    /*
     * Paragraph Type
     */
    function getPType()	{return 'normal';}

    /*
     * Connect pattern to lexer
     */
    function connectTo($mode) {
	    //$this->Lexer->addSpecialPattern("<rotate[^>]*>",$mode,'plugin_rotate');
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
    function handle($match, $state, $pos, &$handler){

		switch ($state) {
			case DOKU_LEXER_ENTER :
				//$match=trim(substr($match,7,strlen($match)-7-1));
				//$opts["text"]=$match;
				return array($state, array(''));
				
			case DOKU_LEXER_UNMATCHED : 
				return array($state, $match);
			case DOKU_LEXER_EXIT :      
				return array($state, '');
		}
		return $array();
    }
        
    
    /*
     * Create output
     */
    function render($mode, &$renderer, $data)
	{
		global $INFO;
		
		list($state,$opt) = $data;
		if($state != DOKU_LEXER_UNMATCHED) return true;
		
		if($mode == 'metadata') return false;
		if($mode == 'xhtml') {
			//disable caching
			$basedir ='lib/images/tmp';
			$opt_r = explode('\\',$opt);
			//$renderer->doc .= '<span style="vertical-align:bottom;width:'.count($opt_r)*16 .'px;" >';
			foreach($opt_r as $opt){
				$text = trim(utf8_decode($opt));

				$img_name = sha1($text);
				$file = $basedir.'/'. $img_name .'.png';
				
				if(!file_exists($file)||true) {		
					@mkdir($basedir,777,true);
		
					$width = 15;			
					$height = strlen($text)*10;
					$img = ImageCreate($width, $height);
					
					$black = ImageColorAllocate($img, 0, 0, 0);
					$white = ImageColorAllocate($img, 255, 255, 255);
					$blau  = ImageColorAllocate($img, 0, 64, 128);
					
					ImageColorTransparent($img,$white);
					ImageFill($img, 0, 0, $white);
					
					
					$image_height = ImageSY($img);
					imagestringup($img, 5, 0, $height-5, $text, $black);
					ImagePNG($img,$file);
				
				}
				//".$renderer->_xmlEntities($opt)."
				
				$renderer->doc .="<img class='textrotate' src='$file' alt='adsf' >";
			}
			//$renderer->doc .="</span>";
			//$renderer->doc .="<div style='clear:both'></div>";
			
		}
		else {
			$renderer->doc .=str_replace('//',' ',$text);
		}
		return true;
	}
}

//Setup VIM: ex: et ts=4 enc=utf-8 :
