<?php 
 /**
  * main controller class
  */
  
class Controller{
    //this is to load all views
    public function view($view, $data = array()){
        extract($data);//this extract data passed from the models
        if(file_exists("app/views/$view.view.php")){
            require ("app/views/$view.view.php");
        }else{
            require ("app/views/404.view.php");
        }
    }
    //this is to load all models
    public function load_model($model){
        $model = ucfirst($model);
        if(file_exists("../app/models/$model.php")){
            require("../app/models/$model.php");
            return $model = new $model;
        }
        return false;
    }

    //this is to redirect all links
    public function redirect($link){
        header("Location: ".HOME."/".trim($link,"/"));
        die;
    }
}
  