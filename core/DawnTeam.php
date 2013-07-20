<?php
/**
 * Galacticum team
 * 
 * @author Miguel Gonzalez <miguel-gonzalez@gmx.de>
 * @since 1.0
 * @version 1.0
 * @link http://my-reality.de Website of the author
 * @copyright (c) 2013, Miguel Gonzalez
 */
include_once 'team/TeamMember.php';
include_once 'team/TeamView.php';

class DawnTeam extends TeamView {
   
    public function __construct() {
        parent::__construct();
        
        // Miguel
        $miguel = new TeamMember('Miguel Gonzalez', 'Developer');
        $miguel->setEmail('miguel-gonzalez@gmx.de');
        $miguel->setWebsiteURL('http://my-reality.de');
        $miguel->addSocialNetwork(new SocialNetwork('twitter', 'https://twitter.com/tweetmyreality', 'Twitter'));
        $miguel->addSocialNetwork(new SocialNetwork('facebook', 'https://facebook.com/myrealityde', 'Facebook'));
        
        // Tristan
        $tristan = new TeamMember('Tristan Rust', 'Developer');
        $tristan->setEmail('tristan.rust@gmx.de');
        $tristan->setWebsiteURL('http://dawn.my-reality.de');
        $tristan->addSocialNetwork(new SocialNetwork('twitter', 'https://twitter.com/hawkx', 'Twitter'));
        $tristan->addSocialNetwork(new SocialNetwork('facebook', 'https://facebook.com/hawkx', 'Facebook'));
        
        $this->addMember($miguel);
        $this->addMember($tristan);
    }
}

?>
