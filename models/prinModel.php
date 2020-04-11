<?php
    class prinModel{
        protected function get_view_model($view)
        {
            $whiteList = ["cligestion","pergestion","perlist","persearch","evegestion","evelist",
                        "cuida","cuidalist","clilist","udper","dataper","home","udeve"];

            if (in_array($view, $whiteList)) {
                if (is_file("./view/content/".$view."-view.php")) {
                    $content = "./view/content/".$view."-view.php";
                } else {
                    $content = "login";
                }
                
            } elseif($view=="login") {
                $content = "login";
            }
            elseif ($view=="index") {
                $content = "landingPage";
            }
            elseif ($view=="register") {
                $content = "register";
            }
            else {
                $content = "login";
            }
            return $content;
            
        }
    }