<?php 


class _404
{
	use Controller;
	
	public function index()
	{
		// Load the view with data
		$this->view('/404');
	}
}
