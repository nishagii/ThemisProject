<?php

class JudgmentsYearwiseModel
{
    use Database;

    public function getAllJudgments()
    {
        $query = "SELECT * FROM judgmentsyearwise ORDER BY date DESC";
        return $this->query($query);
    }
}
?>
