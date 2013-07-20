<?php
/**
 * Team view in order to generate a table of content
 * 
 * @author Miguel Gonzalez <miguel-gonzalez@gmx.de>
 * @since 1.0
 * @version 1.0
 * @link http://my-reality.de Website of the author
 * @copyright (c) 2013, Miguel Gonzalez
 */
include_once 'TeamMember.php';

class TeamView {
    
    // Team members
    private $teamMembers = array();
    
    public function __construct() {
        
    }
    
    
    public function addMember(TeamMember $member) {
        $this->teamMembers[] = $member;
    }
    
    
    public function __toString() {
        $string = '<div class="team_members">';
        foreach ($this->teamMembers as &$member) {
            $string .= $member;
        }
        $string .= '</div>';
        
        return $string;
    }
}
?>
