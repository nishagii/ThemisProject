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

     }