<?php

 class Pages extends Controller{
 	
 	public function __construct(){
 		
 	}
 	
 	public function index(){
 		//difoltna metoda u difotnom kontroleru kad se ukuca samo domen da izbaci na stranu
 		$data= array(
 		'title'=>'SharePosts'
 		);
 		$this->view('index',$data);
 	}
 	
 	public function about(){
 		$data= array(
 		'title'=>'About us',
 		'description'=>'App to share posts with other users'
 		);
 		$this->view('pages/about',$data);
 	}
 	
}

?>