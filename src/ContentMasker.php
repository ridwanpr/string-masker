<?php

namespace Ridwan\StringMasker;

class ContentMasker
{
    /**
     * Mask specific words or phrases in a given text.
     *
     * @param string $text The text to mask.
     * @param array $options Masking options (e.g., 'mask' => '*', 'words' => ['bank account', 'password']).
     * @return string The masked text.
     */
    public static function maskContent(string $text, array $options = []): string
    {
        $mask = $options['mask'] ?? '*';
        $wordsToMask = $options['words'] ?? [];

        foreach ($wordsToMask as $word) {
            $maskedWord = str_repeat($mask, strlen($word));
            $text = str_replace($word, $maskedWord, $text);
        }

        return $text;
    }
}
