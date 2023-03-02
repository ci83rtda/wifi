<?php



function validate6DigitNumeric($input) {
    if (preg_match("/^[0-9]{6}$/", $input)) {
        return true;
    } else {
        return false;
    }
}


function validateColombiaPhoneNumber($phoneNumber) {
    // Remove any non-numeric characters from the number
    $phoneNumber = preg_replace("/[^0-9]/", "", $phoneNumber);

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


function generateEasyToRememberAlphaNumeric() {
    $patterns = array("ABC", "DEF", "GHI", "JKL", "MNO", "PQR", "STU", "VWX", "YZA");

    // Generate a random pattern
    $pattern = $patterns[array_rand($patterns)];

    // Generate two random numbers between 0 and 9
    $number1 = rand(0, 9);
    $number2 = rand(0, 9);

    // Generate a random letter between A and Z
    $letter = chr(rand(65, 90));

    // Combine the pattern, numbers, and letter to create the final alpha-numeric
    $final_alpha_numeric = $pattern . $number1 . $letter . $number2;

    // Return the final alpha-numeric
    return $final_alpha_numeric;
}


function generateEasyToRememberNumber() {
    // Define a list of easy-to-remember numbers
    $numbers = array(111111, 222222, 333333, 444444, 555555,
        666666, 777777, 888888, 999999);

    // Generate a random 6-digit number between 100000 and 999999
    do {
        $number = rand(100000, 999999);
    } while (in_array($number, $numbers));

    // Return the unique number
    return $number;
}
