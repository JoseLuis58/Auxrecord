<?php
    require_once "./models/prinModel.php";
    class prinController extends prinModel{

        public function get_template_controller()
        {
            return require_once "./view/template.php";
        }

        public function get_view_controller()
        {
            if (isset($_GET['views'])) {
                $url = explode("/",$_GET['views']);
                $answer = prinModel::get_view_model($url[0]);
            }
            else {
                $answer = "landingPage";
            }
            return $answer;
        }
    }