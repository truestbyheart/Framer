<?php

/*
 * Base contoller
 * Loads the models and views
 */

class Controller {
    /**
     * This functions loads the model.
     * @param $model
     * @return an instance of the model
     */
    public function model($model) {
        require_once '../app/models' . $model . '.php';
        return new $model();
    }

    /**
     * this function loads the view file.
     * @param $view
     * @param array $data
     */
    public function view($view, $data = []) {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die("View doesn't exists");
        }
    }

}
