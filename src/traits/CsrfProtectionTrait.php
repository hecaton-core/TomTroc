<?php

// Trait pour la vérification des tokens CSRF
trait CsrfProtectionTrait
{
    private function verifyCsrfToken(): void
    {
        $token = $_POST['csrf_token'] ?? '';

        if (empty($_SESSION['csrf_token'])
            || !is_string($token)
            || !hash_equals($_SESSION['csrf_token'], $token)) {
                http_response_code(403);
                exit('Requête non-autorisée.');
            }
    }
}