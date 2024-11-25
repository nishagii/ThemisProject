<?php
class TestController
{
    public function index()
    {
        echo "Test Controller Works!";
    }

    public function show($id)
    {
        echo "You passed ID: " . htmlspecialchars($id);
    }
}


?>