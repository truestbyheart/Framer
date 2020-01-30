<?php
Use eftec\bladeone\BladeOne;

/*
 * Base Controller
 * Loads the models and views
 */

class Controller{
    private $blade;
    private $Views;
    private $cache;

    /**
     * This functions loads the models.
     * @param $model
     * @return an instance of the models
     */
    public function model($model) {
        require_once APPROOT. '/app/models/' . $model . '.php';
        return new $model();
    }

    /**
     * This function loads the views file.
     * @param $view
     * @param array $data
     * @throws Exception
     */
    public function view($view, $data = []) {
        if (file_exists(APPROOT . '/views/' . $view . '.blade.php')) {
            $this->Views = APPROOT. '/views';
            $this->cache = APPROOT.'/cache';
            $this->blade = new BladeOne($this->Views, $this->cache, BladeOne::MODE_AUTO);
            echo $this->blade->run($view, $data);
        } else {
            die("View doesn't exists");
        }
    }

}
