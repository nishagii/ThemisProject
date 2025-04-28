<?php 
    
    class Paper {

        use Controller;

        public function index() {

            $this->view('crud/addPaper');
        }
    }