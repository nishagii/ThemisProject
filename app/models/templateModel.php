<?php

    class templateModel{
        use Database;

        protected $table = 'templates';

        public function getAll() {
            $query = "SELECT * FROM $this->table ORDER BY id DESC";
            return $this->query($query);
        }
    }
?>