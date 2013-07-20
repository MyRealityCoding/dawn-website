<?php
function getMetaData($url) {
    
     $xml = simplexml_load_file($url);

     $data = array();
     
     for ($i = 0; $i < count($xml->string); ++$i) {
         $id = '';
         foreach($xml->string[$i]->attributes() as $a => $b) {
            
            if ($a == 'id') {
                $id = (string)$b;
                break;
            }
        }
       
        $data[$id] = (string)$xml->string[$i];
        
     }
     
     return $data;
}


function parseChanges($file) {
    $parsedHtml = '<div class="changes"><h2>Changes</h2>';    
    $xml = simplexml_load_file($file);
    for ($i = 0; $i < count($xml->patch); ++$i) {
        
        $parsedHtml .= '<div class="patch">';
        
        foreach($xml->patch[$i]->attributes() as $a => $b) {
            if ($a == "version") {
                $parsedHtml .= '<div class="version">Version ' . $b . '</div>';
            }
        }
        
        $parsedHtml .= '<ul>';
        $categories = $xml->patch[$i]->category;
        for ($x = 0; $x < count($categories); ++$x) {
            $category = $categories[$x];
            foreach($category[$x]->attributes() as $name => $value) {
            if ($name == "name") {
                $parsedHtml .= '<li class="version">' . $value . '<ul>';
                
                // Show the single items
                for ($s = 0; $s < count($category->item); ++$s) {
                    $parsedHtml .= '<li class="';
                    $item = $category->item[$s];
                    foreach ($item->attributes() as $key => $itemClass) {
                        if ($key == "type") {
                            $parsedHtml .= $itemClass . ' ';
                        }
                    }
                    
                    $parsedHtml .= '">' . $category->item[$s] . '</li>';
                }
                
                $parsedHtml .= '</ul></li>';
            }
        }
        }
         $parsedHtml .= '</ul>';
        $parsedHtml .= '</div>';
    }
    
    $parsedHtml .= '</div>';
    
    return $parsedHtml;
}
?>
