<?php

class Pages extends Controller {
    private $api;
    public function __construct() {
        $this->api = new HttpModule('https://seedxxx-backend.herokuapp.com');
    }

    public function index() {
       // $result = $this->api->Http('GET', '/xvideos/all');
        $data = [ 'title' => 'welcome', 'api' => '$result','blade' => 'Hello From Blade' ];
        $this->view('index', $data);
    }

    public function about() {
        $this->view('about');
    }
}
