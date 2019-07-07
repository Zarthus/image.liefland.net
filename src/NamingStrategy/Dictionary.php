<?php
declare(strict_types=1);

class Dictionary implements NamingStrategyInterface
{
    public const WORD_COUNT_MIN = 2;
    public const WORD_COUNT_MAX = 5;
    public const WORD_MAXLEN = 12;
    public const PATH = '/usr/share/dict/words';

    public function generate(): string
    {
        if (!file_exists(self::PATH)) {
            throw new InvalidArgumentException('Cannot open file: ' . self::PATH);
        }

        $size = random_int(self::WORD_COUNT_MIN, self::WORD_COUNT_MAX);

        $words = [];
        $dict = file(self::PATH);
        $dictCount = \count($dict);

        do {
            $randomWordIndex = random_int(0, $dictCount);

            if (!isset($dict[$randomWordIndex])) {
                continue;
            }

            $word = ucwords(trim($dict[$randomWordIndex]));
            $word = $this->normalizeWord($word);
            if ($this->validateWord($word)) {
                $words[] = $word;
            }
        } while (count($words) !== $size);

        return implode('', $words);
    }

    private function validateWord(string $word): bool
    {
        if (mb_strlen($word) > self::WORD_MAXLEN) {
            return false;
        }

        return preg_match('/^[a-zA-Z]+$/', $word) !== false;
    }

    private function normalizeWord(string $word): string
    {
        return str_replace(["'"], '', $word);
    }
}
