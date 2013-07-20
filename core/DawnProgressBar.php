<?php
/**
 * Progress bar in order to show the current working progress of Dawn
 * 
 * @author Miguel Gonzalez <miguel-gonzalez@gmx.de>
 * @since 1.0
 * @version 1.0
 * @link http://my-reality.de Website of the author
 * @copyright (c) 2013, Miguel Gonzalez
 */
include_once('progress-bar/ProgressBar.php');

class DawnProgressBar extends ProgressBar {
    
    
     function __construct($metaData) {
        parent::__construct();
        $this->addElement('Dev', 0.0);
        $this->addElement('Release', 0.0);
        $this->initFromMeta($metaData);
    }
    
    private function initFromMeta($metaData) {

        foreach ($this->elements as $key => $value) {
            $id = strtolower($metaData['APP_PHASE']);
            
            if ($key == $id) {
                        
                $value->setPercentage((float)$metaData['APP_PHASE_PROGRESS']);
                break;
            } else {
                $value->setPercentage(100);
            }
        }
    }
}

?>
