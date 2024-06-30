<?php

session_start();

require_once("Captcha.php");

function generateCaptcha(){
    $captcha = new Captcha();
    $_SESSION['captcha_code'] = $captcha->getCode();
    $captcha->render();
}

function validateCaptcha($userInput){
    if(isset($_SESSION['captcha_code'])){
        @$result = (strtolower($userInput) === strtolower($_SESSION['captcha_code']));
        unset($_SESSION['captcha_code']);
        return $result;
    }
    return false;
}

