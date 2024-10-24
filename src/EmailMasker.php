<?php

namespace Ridwan\StringMasker;

class EmailMasker
{
    /**
     * Mask an email address based on specified rules.
     *
     * @param string $email The email address to mask.
     * @param array $options Masking options (e.g., 'local' => ['mask' => '*', 'start' => 0, 'length' => 3], 'domain' => ['mask' => '*', 'start' => 1, 'length' => 3], 'maskAll' => 'local').
     * @return string The masked email address.
     */
    public static function maskEmail(string $email, array $options = []): string
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email format.");
        }

        [$local, $domain] = explode('@', $email);

        $localOptions = $options['local'] ?? [
            'mask' => '*',
            'start' => 0,
            'length' => 1,
        ];

        $domainOptions = $options['domain'] ?? [
            'mask' => '*',
            'start' => 0,
            'length' => 1,
        ];

        $maskAll = $options['maskAll'] ?? null;

        if ($maskAll === 'local' || $maskAll === 'both') {
            $maskedLocal = str_repeat($localOptions['mask'], strlen($local));
        } else {
            $maskedLocal = self::maskString($local, $localOptions['mask'], $localOptions['start'], $localOptions['length']);
        }

        if ($maskAll === 'domain' || $maskAll === 'both') {
            $maskedDomain = str_repeat($domainOptions['mask'], strlen($domain));
        } else {
            $maskedDomain = self::maskString($domain, $domainOptions['mask'], $domainOptions['start'], $domainOptions['length']);
        }

        return "{$maskedLocal}@{$maskedDomain}";
    }

    /**
     * Mask a string based on specified rules.
     *
     * @param string $string The string to mask.
     * @param string $maskChar The character to use for masking.
     * @param int $start The starting position to begin masking.
     * @param int $length The number of characters to mask.
     * @return string The masked string.
     */
    private static function maskString(string $string, string $maskChar, int $start, int $length): string
    {
        $stringLength = strlen($string);

        if ($start < 0 || $length < 0 || $start > $stringLength) {
            throw new \InvalidArgumentException("Invalid mask parameters.");
        }

        $length = min($length, $stringLength - $start);

        return substr($string, 0, $start) . str_repeat($maskChar, $length) . substr($string, $start + $length);
    }
}
