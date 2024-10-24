<?php

namespace Ridwan\StringMasker;

class PhoneMasker
{
    /**
     * Mask a given phone number based on specified rules.
     *
     * @param string $phone The phone number to mask.
     * @param array $options Masking options (e.g., 'maskAll' => true, 'mask' => '*', 'positions' => [1, 3, 5]).
     * @return string The masked phone number.
     */
    public static function maskPhone(string $phone, array $options = []): string
    {
        $mask = $options['mask'] ?? '*';
        $maskAll = $options['maskAll'] ?? false;
        $positions = $options['positions'] ?? [];

        $normalizedPhone = preg_replace('/\D/', '', $phone);

        if ($maskAll) {
            return str_repeat($mask, strlen($normalizedPhone));
        }

        $phoneArray = str_split($normalizedPhone);
        foreach ($positions as $position) {
            if (isset($phoneArray[$position])) {
                $phoneArray[$position] = $mask;
            }
        }

        return implode('', $phoneArray);
    }
}
