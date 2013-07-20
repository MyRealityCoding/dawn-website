<?php
/**
 * Single progress element
 * 
 * @author Miguel Gonzalez <miguel-gonzalez@gmx.de>
 * @since 1.0
 * @version 1.0
 * @link http://my-reality.de Website of the author
 * @copyright (c) 2012, Miguel Gonzalez
 */
class ProgressElement {
    
    private $name;
    
    private $percentage;
    
    function __construct($name, $percentage) {
        $this->setName($name);
        $this->setPercentage($percentage);
    }
    
    
    function __toString() {
        
        $classes = '';
        
        if ($this->percentage >= 100.0) {
            $classes .= ' done';
        } else if ($this->percentage <= 0.0) {
            $classes .= ' undone';
        } else {
            $classes .= ' active';
        }
        
        $width = $this->percentage;
        
        if ($width < 0) {
            $width = 0;
        } else if ($width > 100.0) {
            $width = 100.0;
        }
        
        return '<td class="progress_element' . $classes . '" id="' 
                . $this->name . '"><div class="content" style="width:' . $width . '%"></div>' 
              . $this->name . '</td>';
    }
    
    
    public function setName($name) {
        $this->name = $name;
    }
    
    
    public function setPercentage($percentage) {
        $this->percentage = $percentage;
    }
    
    
    public function setColor($color) {
        $this->color = $color;
    }
    
}

?>
