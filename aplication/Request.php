<?php

class Request{
    private $_controlador;
    private $_metodo;
    private $_argumentos;
/**
 * [__construct description]
 */
    public function __construct(){
        if (isset($_GET['url'])) {
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            $url = array_filter($url);

            $this->_controlador = strtolower(array_shift($url));
            $this->_metodo = strtolower(array_shift($url));
            $this->_argumentos = $url;

        }
        if (!$this->_controlador) {
            $this->_controlador = DEFAULT_CONTROLLER;
       }
       if (!$this->_metodo) {
            $this->_metodo = "index";
       }
       if (!$this->_argumentos) {
            $this->_argumentos = array();
       }

    }
/**
 * [getControlador description]
 * @return [type] [description]
 */
    public function getControlador(){
		return $this->_controlador;
	}
/**
 * [getMetodo description]
 * @return [type] [description]
 */
	public function getMetodo(){
		return $this->_metodo;
	}
/**
 * [getArgs description]
 * @return [type] [description]
 */
	public function getArgs(){
		return $this->_argumentos;
	}

}