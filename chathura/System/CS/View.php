<?php

namespace CS;

/**
 * Class View
 * @package CS
 */
class View {

    private $_file;

    public function __construct($name, $action)
    {
        $this->_file = APPLICATION_PATH . '/App/View/' . $name . '/' . $action . '.phtml';
    }

    public function render($data = array())
    {
        extract($data);
        ob_start();
        include($this->_file);
        ob_end_flush();
    }
} 