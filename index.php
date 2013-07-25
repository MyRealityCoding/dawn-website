<?php

include_once ('core/core.php');


$progress = '<div class="progress"><div class="loading">Loading progress...</div></div>';
$progress .= "<script type='text/javascript'>
        $('.progress').icebearProgress({
            datasource : 'proxy.php?url=https://raw.github.com/MyRealityCoding/dawn/master/meta.json',
            duration : 2500,
            onEnterPhase : function(element) {
            
                element.find('.ui-progressbar-value').css({
                      borderRight : '1px solid #3f0e21'
                });
                

                element.find('.caption').animate({
                    color : '#ac5f3d'
                }, 650);
            },
            onLeavePhase : function(element) {
            
                element.find('.ui-progressbar-value').css({
                        borderRight : 'none'
                });
                
                element.css({
                    
                });

                element.find('.caption').animate({
                    color : '#000'
                }, 1000);
            }
        });
        </script>";

$layout->setTitle('Rise of the dead');
$layout->addContent('<img id="banner" src="webroot/img/banner.png" />');
$layout->addContent($progress);
$layout->render();
?>
