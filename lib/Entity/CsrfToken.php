<?php

namespace iFrame\Entity;

class CsrfToken
{
    public function generateCsrfToken(): string
    {
        return bin2hex(random_bytes(32));
    }

    public function isCsrfTokenValid(string $token): bool
    {
        if(session_status() !== PHP_SESSION_ACTIVE) {
            throw new \RuntimeException('Session not started');
        }

        return hash_equals($_SESSION['csrf_token'], $token);
    }
}
