<?php


class CalendarClient
{
    use Controller;

    public function index()
    {
        $this->view('/client/calendar');
    }
}
