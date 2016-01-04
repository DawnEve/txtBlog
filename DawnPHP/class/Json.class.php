<?php

class Json{

	/**
		get string from file
	*/
	static function get($topic){
		$filename='data/menu/' . $topic . '.json';
		if(file_exists($filename)){
			return file_get_contents( $filename );
		}else{
			return false;
		}
	}
	
	
	/**
		set string to file//todo
	*/
	static function set($arr,$file){
		file_put_contents( 'data/menu/' . $file . '.json', json_encode($arr) );
	}
	
	/**
		string to json//todo
	*/
	static function obj($topic){
		return file_get_contents( 'data/' . $topic . '.json');
	}


}