<?php
/**
 * @group plugin_textrotate
 * @group plugins
 */
class plugin_textrotate_syntax_test extends DokuWikiTest {

    protected $pluginsEnabled = array(
        'textrotate'
    );
    public function setup() {
        parent::setup();
        $this->_createPages();
    }

    
    public function test_basic_syntax() {
        $xhtml = p_wiki_xhtml('test:plugin_textrotate');
        
        $this->assertContains('<img class="textrotate" src="lib/images/tmp/', $xhtml);

    }
    
    protected function _createPages() {
        saveWikiText('test:plugin_textrotate', '!!textrotate!!', 'test');

    }
}
