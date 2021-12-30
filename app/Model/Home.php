<?php 

    namespace app\Model;

    Class Home 
    {
        private $page;
        private $user;

        public function __construct($page) {
            $this->page = $page;
        }


        public function getPage() {

            return $this->page;
        }

        public function getUser() {

            return $this->user ?? false;
        }
    }
