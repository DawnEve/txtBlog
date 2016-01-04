<?php

class UserController extends Controller{
	function __construct(){
		parent::__construct();
	}

	function index($k){
		echo __method__;
	}

}