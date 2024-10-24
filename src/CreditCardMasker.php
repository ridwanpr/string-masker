<?php

namespace Ridwan\StringMasker;

class CreditCardMasker
{
    /**
     * Mask a given credit card number based on specified rules.
     *
     * @param string $cardNumber The credit card number to mask.
     * @param array $options Masking options (e.g., 'maskAll' => true, 'mask' => '*', 'positions' => [1, 2, 5], 'showDashes' => true).
     * @return string The masked credit card number.
     */
    public static function maskCardNumber(string $cardNumber, array $options = []): string
    {
        $mask = $options['mask'] ?? '*';
        $maskAll = $options['maskAll'] ?? false;
        $positions = $options['positions'] ?? [];
        $showDashes = $options['showDashes'] ?? false;

        $normalizedCardNumber = preg_replace('/\D/', '', $cardNumber);

        if ($maskAll) {
            return str_repeat($mask, strlen($normalizedCardNumber));
        }

        $cardArray = str_split($normalizedCardNumber);

        foreach ($positions as $position) {
            if (isset($cardArray[$position])) {
                $cardArray[$position] = $mask;
            }
        }

        $maskedCardNumber = implode('', $cardArray);

        if ($showDashes) {
            $maskedCardNumber = implode('-', str_split($maskedCardNumber, 4));
        }

        return $maskedCardNumber;
    }
}
