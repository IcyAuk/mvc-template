<?php

class Home
{
    use Controller;
    public function index()
    {
        $data['username'] = empty($_SESSION['user']) ? 'User' : $_SESSION['user']->email;
        $this->view('home',$data);
    }
}

