<?php
/**
 * Progress bar in order to show the current working progress
 * 
 * @author Miguel Gonzalez <miguel-gonzalez@gmx.de>
 * @since 1.0
 * @version 1.0
 * @link http://my-reality.de Website of the author
 * @copyright (c) 2012, Miguel Gonzalez
 */
include_once('ProgressElement.php');

class ProgressBar {
    
    protected $elements;
    
    function __construct() {        

    }
    
    
    function __toString() {
        $content = '<table class="progress_bar" border="0" cellspacing="0" cellpadding="0">';
        
        foreach ($this->elements as &$element) {
            $content .= $element;
        }
        
        $content .= '</table>';
        
        return $content;
    }
    
    
    public function getElement($id) {
        return $this->elements[$id];
    }
    
    
    public function addElement($name, $percentage) {
        $this->elements[strtolower($name)] = new ProgressElement($name, $percentage);
    }
}

?>
