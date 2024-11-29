<?php


class CalendarJunior
{
    use Controller;

    public function index()
    {
        $this->view('/juniorCounsel/calendar');
    }
}
