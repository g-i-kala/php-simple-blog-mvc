<?php

namespace Core;

class CSRFValidator
{
    public static function generateCsrfToken(): string
    {

        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;

        $token_expire = time() + 1800;
        $_SESSION["csrf_token_expire"] = $token_expire;

        return $token;
    }

    public static function validateCsrfToken()
    {
        return !isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
    }

}
