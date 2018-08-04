<?php

namespace TMBCCodingChallenge\View;

class View{

    public function load($vars){

        // CSS
        $vars['css'] = file_get_contents( __DIR__ . '/Templates/style.css');

        // Extract variables and pass them to template
        extract($vars);
        include(  __DIR__ . '/Templates/index.php');
    }
}
