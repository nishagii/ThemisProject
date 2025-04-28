<?php
     class PaperModel {

        use Model;
        protected $table = 'paper';
        
        public function save($data) {

            $query = "INSERT INTO {$this->table} 
                        (subject, paper)
                        VALUES
                        (:subject, :paper)";
            
            $params = ['subject' => $data['subject'],
                        'paper' => $data['paper']
                    ];

            return $this->query($query, $params);
        }

        public function getAll() {

            $query = "SELECT * FROM {$this->table} ORDER BY paperID DESC";

            return $this->query($query);
        }

        public function getPaperByID($paperID) {

            $query = "SELECT * FROM {$this->table} WHERE paperID = :paperID";
            $params = ['paperID' => $paperID];

            return $this->query($query, $params);
            
        }

        public function deletePap($paperID) {

            $query = "DELETE FROM {$this->table} WHERE paperID = :paperID";
            $params = ['paperID' => $paperID];

            return $this->query($query, $params);
        }

     }