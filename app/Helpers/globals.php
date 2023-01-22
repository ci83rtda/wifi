<?php



function validate6DigitNumeric($input) {
    if (preg_match("/^[0-9]{6}$/", $input)) {
        return true;
    } else {
        return false;
    }
}


function validateColombiaPhoneNumber($phoneNumber) {
    $pattern = '/^(3)[0-9]{9}$/';
    if (preg_match($pattern, $phoneNumber)) {
        return true;
    } else {
        return false;
    }
}
