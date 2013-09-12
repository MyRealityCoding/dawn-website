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
        $('#canvas').css('opacity', 0)
        .animate({
            opacity : '1.0'
        }, 4000);
        
         $('#banner').css('opacity', 0)
        .animate({
            opacity : '1.0'
        }, 2000);
        
        $('.progress').css('opacity', 0)
        .animate({
                   opacity : '1.0'
               }, 1500);
</script>";

$sound = '<script type="text/javascript">
            function play() {
     
            if (window.HTMLAudioElement) {
              var snd = new Audio("");

              if(snd.canPlayType("audio/mp3")) {
                snd = new Audio("dawn.mp3");
              }

              snd.play();
            }
            }
            play();
          </script>';

$layout->setTitle('Rise of the dead');
$layout->addContent('<img id="banner" src="webroot/img/banner.png" />');
$layout->addContent($progress);
$layout->addContent($sound);
$layout->render();
?>
