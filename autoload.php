<?php

spl_autoload_register(function ($className) {
    include dirname(__FILE__) . '/src/' . str_replace('\\', '/', $className) . '.php';
});
