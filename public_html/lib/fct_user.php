<?php

function areLoginsValid($name, $pwd, $pwd_confirmation)
{
    $result = false;
    if (isNameValid($name) && isPasswordValid($pwd, $pwd_confirmation)) {
        $result = true;
    }

    return $result;
}

function isNameValid($name)
{
    $length = strlen($name);

    $result = false;
    if ($length >= 2 && $length <= 16) {
        $result = true;
    }

    return $result;
}

function isPasswordValid($pwd, $pwd_confirmation)
{
    $result = false;
    if (equalPassword($pwd, $pwd_confirmation) && caractPassword($pwd)) {
        $result = true;
    }

    return $result;
}

function equalPassword($pwd, $pwd_confirmation)
{
    return $pwd == $pwd_confirmation;
}

function caractPassword($pwd)
{
    $length = lengthPassword($pwd);
    $maj = false;
    $min = false;
    $number = false;

    for ($i = 0; $i < strlen($pwd); $i++) {
        $caract = $pwd[$i];

        // Compare les codes ASCII
        if ($caract >= "A" && $caract <= "Z") {
            $maj = true;
        }

        // Compare les codes ASCII
        if ($caract >= "a" && $caract <= "z") {
            $min = true;
        }

        // Compare les codes ASCII
        if ($caract >= "0" && $caract <= "9") {
            $number = true;
        }
    }

    return $length && $maj && $min && $number;
}

function lengthPassword($pwd)
{
    $length = strlen($pwd);

    $result = false;
    if ($length >= 8 && $length <= 100) {
        $result = true;
    }

    return $result;
}

?>