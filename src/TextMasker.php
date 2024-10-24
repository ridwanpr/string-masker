<?php

namespace Ridwan\StringMasker;

class TextMasker
{
    /**
     * Mask a given text based on specified rules, maintaining specified separators.
     *
     * @param string $text The text to mask.
     * @param array $options Masking options (e.g., 'maskAll' => true, 'mask' => '*', 'positions' => [1, 3, 5], 'separators' => [' ', ',', '.', '-']).
     * @return string The masked text.
     */
    public static function maskText(string $text, array $options = []): string
    {
        $mask = $options['mask'] ?? '*';
        $maskAll = $options['maskAll'] ?? false;
        $positions = $options['positions'] ?? [];
        $separators = $options['separators'] ?? [' ', ',', '.', '-'];

        if ($maskAll) {
            return str_repeat($mask, strlen($text));
        }

        $textArray = str_split($text);

        $separatorSet = array_flip($separators);

        foreach ($positions as $position) {
            if (isset($textArray[$position]) && !isset($separatorSet[$textArray[$position]])) {
                $textArray[$position] = $mask; // Mask only if not included in separator
            }
        }

        return implode('', $textArray);
    }
}
