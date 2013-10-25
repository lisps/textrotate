/**
 * DokuWiki Plugin textrotate (JavaScript Component) 
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  lisps    
 */
jQuery(document).ready(function(){
	jQuery('.textrotate').parent('td,th').css('vertical-align','bottom');
	jQuery('.textrotate').parent('td,th').css('padding','0px');
	jQuery('.textrotate').each(function(e){
		count = jQuery(jQuery(this).parent().children()).size();
		jQuery(this).parent().css('width',count*18 +'px');
	})
});
