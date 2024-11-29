<?php


class CalendarLawyer
{
    use Controller;

    public function index()
    {
        $this->view('/seniorCounsel/calendar');
    }
}
