<?php

namespace App\Helpers;

class StringHelper
{
    public static function truncate($text, $limit = 100)
    {
        return strlen($text) > $limit ? substr($text, 0, $limit) . '...' : $text;
    }
    /**
     * Limit string by word count.
     */
    public static function limitWords(string $string, int $words = 20, string $end = '...'): string
    {
        $wordArray = explode(' ', $string);
        return count($wordArray) > $words
            ? implode(' ', array_slice($wordArray, 0, $words)) . $end
            : $string;
    }

    /**
     * Convert a string to kebab-case.
     */
    public static function kebab(string $string): string
    {
        return strtolower(preg_replace('/[^A-Za-z0-9]+/', '-', trim($string)));
    }

    /**
     * Convert a string to snake_case.
     */
    public static function snake(string $string): string
    {
        return strtolower(preg_replace('/[^A-Za-z0-9]+/', '_', trim($string)));
    }

    /**
     * Generate a random string.
     * @throws RandomException
     */
    public static function random(int $length = 16): string
    {
        return bin2hex(random_bytes($length / 2));
    }

    /**
     * Check if string contains a substring.
     */
    public static function contains(string $haystack, string $needle): bool
    {
        return str_contains($haystack, $needle);
    }

    /**
     * Slugify a string (URL-friendly).
     */
    public static function slugify(string $string): string
    {
        return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', trim($string)));
    }

    /**
     * Capitalize the first character.
     */
    public static function capitalize(string $string): string
    {
        return ucfirst($string);
    }

    /**
     * Remove all HTML tags.
     */
    public static function stripTags(string $string): string
    {
        return strip_tags($string);
    }

    /**
     * Sanitize a string (remove HTML & special chars).
     */
    public static function sanitize(string $string): string
    {
        return htmlspecialchars(strip_tags($string), ENT_QUOTES, 'UTF-8');
    }
}
