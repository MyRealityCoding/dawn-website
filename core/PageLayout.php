<?php
/* Basic layout class for displaying a proper generated layout. To display it
 * correctly, use the render function of tis class.
 * 
 * @author Miguel Gonzalez <miguel-gonzalez@gmx.de>
 * @since 1.0
 * @version 1.0
 * @link http://my-reality.de Website of the author
 * @copyright (c) 2012, Miguel Gonzalez
 */
abstract class PageLayout {
    
    // Content of the layout
    private $content = '';
    
    // Javascript files (without ending .js)    
    private $scripts = array();
    
    // CSS files (without ending .css)
    private $styles = array();
    
    // Page icon
    private $icon = 'favicon.png';
    
    // Title for layout
    private $titleForLayout = 'Basic Layout';
    
    // Webroot
    private $webroot = 'webroot/';
    
    // Paths
    private $imagePath = '';
    private $scriptPath = '';
    private $filePath = '';
    private $stylePath = '';
    
    
    
    
    /**
     * Constructor
     */
    function __construct() {
        $this->setImagePath($this->webroot . 'img/');
        $this->setScriptPath($this->webroot . 'js/');
        $this->setFilePath($this->webroot . 'files/');
        $this->setStylePath($this->webroot . 'css/');
    }    
    
    
    
    public function setFilePath($path) {
        $this->filePath = $path;
    }
    
    
    
    public function setScriptPath($path) {
        $this->scriptPath = $path;
    }
    
    
    
    public function setStylePath($path) {
        $this->stylePath = $path;
    }
    
    
    
    public function setImagePath($path) {
        $this->imagePath = $path;
    }
    
    
    
    public function setIcon($icon) {
        $this->icon = $icon;
    }
    
    
    
    public function setStyles($styles) {
        $this->styles = $styles;
    }
    
    
    
    public function addStyle($style) {
        $this->styles[] = $style;
    }
    
    
    
    public function setScripts($scripts) {
        $this->scripts = $scripts;
    }
    
    
    public function addScript($script) {
        $this->scripts[] = $script;
    }
    
    
    
    public function setTitle($title) {
        $this->titleForLayout = $title;
    }
    
    
    
    public function addContent($content) {
        $this->content .= $content;
    }
    
    
    
    protected abstract function generateTemplate($content);
    
    protected function generateDocType() {
        return '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" ' 
             . '"http://www.w3.org/TR/html4/strict.dtd">';
    }
    
    
    
    function render() {
        $result = $this->generateDocType();
        $result .= '<html>
                       <head>
                          <title>' . $this->titleForLayout . '</title>
                          <link  rel="icon" type="image/png" href="' . $this->imagePath . $this->icon . '"/>';

        foreach ($this->scripts as $script) {            
            $result .= '<script type="text/javascript" src="' . $this->scriptPath . $script . '.js"></script>';           
        }
        
        foreach ($this->styles as $style) {
            $result .= '<link rel="stylesheet" href="' . $this->stylePath . $style . '.css" type = "text/css"/>';  
        }
                 
        $result .= '  </head>
                       <body>
                          ' . $this->generateTemplate($this->content) . '
                       </body>
                    </html>';
         
         echo $result;
    }
    

}
 ?>