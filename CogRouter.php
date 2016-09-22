<?php
/**
 * Cog Router Core
 * Version 1.0.1
 * Part of Cog Framework
 * 
 * Copyright (c) 2016 Ray Radin
 * All rights reserved
 *
 * @link cogframework.com/docs/router
 */
namespace Cog\Router;

class Core{
	protected $routes;
	protected $file;
	public $cached;
	
	final public function __construct($file=null,array $routes=[[],[]]){
		$this->routes=$routes;
		if(isset($file)){
			if(is_file($file.'.cache'))
				if(filemtime($file)<filemtime($file.'.cache')){
					$this->routes=include($file.'.cache');
					$this->cached=true;
					return;
				}
			$this->file=$file;
		}
	}
	final public function save(){
		if(isset($this->file))
			if(file_put_contents($this->file.'.cache','<?php return '.var_export($this->routes,true).';',LOCK_EX)){
				$this->file=null;
				$this->cached=true;
			}
		return $this;
	}
	final public function add($methods,$path,$handler,array $params=[]){
		if(!$this->cached){
			if(is_int($path)){
				$this->routes[0][$path]=[$methods,$handler,$params];
			}elseif(count($p=explode('/',$path))>1){
				$routes=$this->routes[1];
				if($this->addRoute($methods,$p,$handler,$params,$routes)) $this->routes[1]=$routes;
				else $this->routes[0][$path]=[$methods,$handler,$params];
			}
		}
		return $this;
	}
	private function addRoute($methods,$p,$handler,$params,&$routes){
		for($i=1,$labels=[];;$i++)
			if(isset($p[$i]))
				if(preg_match('/^{([^:]*):?(.*)}$/',$p[$i],$x))
					if($x[2]=='*'){ $labels[]=$x[1]; $routes['/2']=[$methods,$handler,$params,$labels]; return $labels; }
					else{ $labels[]=$x[1]; $routes=&$routes['/1']; }
				elseif($p[$i]=='*'){ $labels[]=''; $routes['/2']=[$methods,$handler,$params,$labels]; return $labels; }
				else $routes=&$routes[$p[$i]];
			else{ $routes['/']=[$methods,$handler,$params,$labels]; return $labels; }
	}
	final public function find($path){
		if(isset($this->routes[0][$path]))return$this->routes[0][$path];elseif(!$this->routes[1])return;
		$v=[];
		if($r=$this->findRoute(1,explode('/',$path),$this->routes[1],$v))return[$r[0],$r[1],array_combine($r[3],$v)+$r[2]];
	}
	private function findRoute($i,$p,$routes,&$values){
		if(isset($p[$i])){
			if(isset($routes[$p[$i]])&&($result=$this->findRoute($i+1,$p,$routes[$p[$i]],$values))) return $result;
			if(isset($routes['/1'])){ $values[]=$p[$i]; if($result=$this->findRoute($i+1,$p,$routes['/1'],$values)) return $result; array_pop($values); }
			if(isset($routes['/2'])){ $values[]=array_slice($p,$i); return $routes['/2']; }
		}elseif(isset($routes['/'])) return $routes['/'];
	}
}
