<?php 

    namespace app\View;

    Class Home extends Base 
    {
        protected $model;
        protected $controller;

        public function __construct($model, $controller) {
            $this->model = $model;
            $this->controller = $controller;
        }

        public function content() {

            $html = '
                Rendering Home View
            ';

            return $html;
        }
    }
