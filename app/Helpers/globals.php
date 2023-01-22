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


function validateColombiaIdNumber($idNumber) {
    $pattern = '/^[1-9][0-9]{7}$/';
    if (preg_match($pattern, $idNumber)) {
        $total = 0;
        $digits = str_split($idNumber);
        for ($i = 0; $i < 8; $i++) {
            $total += ($digits[$i] * (2 ** $i));
        }
        $verificationDigit = $total % 11;
        if ($verificationDigit == 10) {
            $verificationDigit = 0;
        }
        if ($verificationDigit == $digits[8]) {
            return true;
        }
    }
    return false;
}
