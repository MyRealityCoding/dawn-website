<?php
/* Layout for the project "Galacticum"
 * 
 * @author Miguel Gonzalez <miguel-gonzalez@gmx.de>
 * @since 1.0
 * @version 1.0
 * @link http://my-reality.de Website of the author
 * @copyright (c) 2012, Miguel Gonzalez
 */
include_once('PageLayout.php');

class DawnLayout extends PageLayout {
    
    function __construct() {
        parent::__construct();
        $this->addStyle('content');
        $this->addStyle('progress-bar');
        $this->addStyle('team-view');
    }
    
    
    
    public function setTitle($title) {
        parent::setTitle('Dawn - ' . $title);
    }
    
    
    /**
     * Template structure for the galacticum website
     */
    protected function generateTemplate($content) {
        
        $links = array(
            array(
                'label' => 'Play',
                'href' => 'index.php',
                'class' => 'play'
            ),
            array(
                'label' => 'About',
                'href' => '/',
                'class' => 'about'
            ),
            array(
                'label' => 'Patchnotes',
                'href' => '/patchnotes',
                'class' => 'patchnotes'
            )
        );
        
        $result = '<div id="wrapper">
                      <div id="center_container">
                         <div id="banner"></div>                         
                         <div id="main_menu">' . $this->generateMainMenu($links) . '</div>
                         <div id="content">' . $content . '</div>
                         <div id="footer">' . $this->generateFooterMenu() . '</div>
                      </div>
                   </div>';
        return $result;
    }
    
    
    
    private function generateMainMenu($links) {
        
        $result = '<ul>';
        
        foreach ($links as $link) {
            if (isset($link['class']) && !empty($link['class'])) {
                $result .= '<li><a href="' . $link['href'] . '" class="' . $link['class'] . '">' . $link['label'] . '</a></li>';
            } else {
                $result .= '<li><a href="' . $link['href'] . '">' . $link['label'] . '</a></li>';
            }            
        }
        
        $result .= '</ul>';
        return $result;
    }
    
    
    
    private function generateFooterMenu() {
        $links = '<a href="impressum.php">Impressum</a>';
        $links .= '<a href="http://my-reality.de">Blog</a>';
        return 'Design by Miguel Gonzalez, &copy; 2013' . $links;
    }
}
?>
