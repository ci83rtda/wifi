<?php



function validate6DigitNumeric($input) {
    if (preg_match("/^[0-9]{6}$/", $input)) {
        return true;
    } else {
        return false;
    }
}


