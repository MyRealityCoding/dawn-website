<?php
/**
 * Single team member
 * 
 * @author Miguel Gonzalez <miguel-gonzalez@gmx.de>
 * @since 1.0
 * @version 1.0
 * @link http://my-reality.de Website of the author
 * @copyright (c) 2013, Miguel Gonzalez
 */
include_once 'SocialNetwork.php';

class TeamMember {
    
    // Name of the member
    private $name;
    
    // Website of the member
    private $websiteURL;
    
    // Email address
    private $email;
    
    // Social Networks
    private $socialNetworks;
    
    // Job
    private $job;
    
    
    public function __construct($name, $job) {
        $this->name = $name;
        $this->job = $job;
        $this->websiteURL = '';
        $this->email = '';
        $this->socialNetworks = array();
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function setWebsiteURL($url) {
        $this->websiteURL = $url;
    }
    
    
    public function addSocialNetwork(SocialNetwork $network) {
        $this->socialNetworks[] = $network;
    }
    
    public function __toString() {
        $string = '<div class="member">';
        $string .= '<div class="name">' . $this->name . '</div>';
        $string .= '<div class="job ' . strtolower($this->job) . '">' . $this->job . '</div>';
        $string .= '<div class="image">' . $this->getGravatar() . '</div>';
        if (!empty($this->email)) {
            $string .= '<div class="link"><a class="email" href="mailto:' . $this->email . '">Email</a></div>';
        }
        
        if (!empty($this->websiteURL)) {
            $string .= '<div class="link"><a class="website" href="' . $this->websiteURL . '">Website</a></div>';
        }
        foreach ($this->socialNetworks as &$network) {
            $string .= '<div class="link">' . $network . '</div>';
        }
        
        $string .= '</div>';
        return $string;
    }
    
    
    private function getGravatar() {
        $hash = md5(strtolower(trim($this->email)));        
        return '<img src="http://www.gravatar.com/avatar/' . $hash . '" />';
    }
}
?>
