<?php
/*
 * Base controller loads models and views
 * 
 */
 
class Controller{
	
	//Load model
	public function model($model){
		//require model file
		require_once '../app/model/'.$model.'.php';
		//instanciranje modela
		return new $model();
		
	}
	
	//Load view
	public function view($view,$data=array()){
		
		if(file_exists('../app/view/'.$view.'.php')){
			require_once '../app/view/'.$view.'.php';
		}else{
			die('View does not exists');
		}
		
	}
	
}