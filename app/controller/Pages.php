<?php

class Pages extends Controller {
    private $api;

    public function __construct() {
    }

    public function index() {
        $data = [ 'title' => 'welcome'];
        $this->view('index', $data);
    }

}
