<?php 

    class HomeworkModel {

        use Model;
        protected $table = 'homework';

        public function save($data) {

            //if im using a key word i have tomescape it using `` or i can just not use it

            $query = "INSERT INTO {$this->table}
                    (subject, `desc`, deadlineDate, deadlineTime, priority)
                    VALUES
                    (:subject, :desc, :deadlineDate, :deadlineTime, :priority)";

            $params = [
                'subject' => $data['subject'],
                'desc' => $data['desc'],
                'deadlineDate' => $data['deadlineDate'],
                'deadlineTime' => $data['deadlineTime'],
                'priority' => $data['priority'],
            ];

            return $this->query($query, $params);
        }

        public function getAll() {

            $query = "SELECT * FROM {$this->table} ORDER BY homeworkID DESC";
            return $this->query($query);
        }

        public function deleteHomework($homeworkID) {

            $query = "DELETE FROM {$this->table} WHERE homeworkID = :homeworkID";

            $params = ['homeworkID' => $homeworkID];
            return $this->query($query, $params);
        }

        public function getHomeworkByID($homeworkID) {

            $query = "SELECT * FROM {$this->table} WHERE homeworkID = :homeworkID";

            $params = ['homeworkID' => $homeworkID];
            return $this->query($query, $params);
        }

        public function updateHomeworkByID($data) {

            $query = "UPDATE {$this->table}
                        SET `subject` = :subject,
                            `desc` = :desc,
                            deadlineDate = :deadlineDate,
                            deadlineTime = :deadlineTime,
                            priority = :priority
                            WHERE homeworkID = :homeworkID";

            $params = ['homeworkID' => $data['homeworkID'],
                        'subject' => $data['subject'],
                        'desc' => $data['desc'],
                        'deadlineDate' => $data['deadlineDate'] ,
                        'deadlineTime' => $data['deadlineTime'],
                        'priority' => $data['priority']
                    ];
            return $this->query($query, $params);
        }
    }