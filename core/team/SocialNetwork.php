<?php
/**
 * Simple social network
 * 
 * @author Miguel Gonzalez <miguel-gonzalez@gmx.de>
 * @since 1.0
 * @version 1.0
 * @link http://my-reality.de Website of the author
 * @copyright (c) 2013, Miguel Gonzalez
 */
class SocialNetwork {
    
    // Name of the Network
    private $name;
    
    private $description;
    
    // URL
    private $profileURL;
    
    public function __construct($name, $profileURL, $description) {
        $this->name = $name;
        $this->profileURL = $profileURL;
        $this->description = $description;
    }
    
    
    public function __toString() {
        $string = '<a class="social_network ' . $this->name . '"
                      href="' . $this->profileURL . '">' . $this->description . '</a>';
        
        return $string;
    }
}
?>
