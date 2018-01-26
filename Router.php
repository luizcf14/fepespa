<?php
class Router{
	private $request;
	public function __construct($request){
		$this->request = $request;
	}
	public function get($route, $file){
		$uri = trim( $this->request, "/" );
		$uri = explode("/", $uri);
		if($uri[0] == trim($route, "/")){
			array_shift($uri);
			$args = $uri;
			require $file . '.php';
		}
	}
	
		public function getView($route, $file){
		$uri = trim( $this->request, "/" );
		$uri = explode("/", $uri);
		if($uri[0] == trim($route, "/")){
			array_shift($uri);
			$args = $uri;
			require_once 'View/template/header.php';
			require $file . '.php';
		}
	}
}