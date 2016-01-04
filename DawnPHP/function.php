<?php
//functions
/**
	排错函数，会终止函数
*/
function debug($s,$d=false){
	echo '<pre>';
	if($d){
		var_dump($s);
	}else{
		print_r($s);
	}
	echo '</pre>';
	die();
}

/**
	同名函数
*/
function dump($s,$d=false){
	echo '<pre>';
	if($d){
		var_dump($s);
	}else{
		print_r($s);
	}
	echo '</pre>';
}