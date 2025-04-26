<?php

class _403
{
    use Controller;

    public function index()
    {
        http_response_code(403); // Set the HTTP response code to 403
        $this->view('403');
    }
}