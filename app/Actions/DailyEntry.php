<?php

namespace App\Actions;

class DailyEntry
{
    public function parseData(string $data): array
    {
        $data   = trim($data);
        $gameId = $this->getGameId($data);
        $score  = $this->getScore($data);
        $detail = $this->getDetail($data);

        return [$gameId, $score, $detail];
    }

    public function getGameId(string $data): string
    {
        return '#' . str($data)->betweenFirst('#', ' ')->toString();
    }

    public function getScore(string $data): string
    {
        return str(str($data)->explode('/')->reduce(function ($a, $b, $c) {
            if ($c == 0) {
                return str($b)->afterLast(' ')->toString();
            }

            return $a . '/' . str($b)->before(' ')->toString();
        }, ''))->replace('*', '');
    }

    public function getDetail(string $data): string
    {
        $detail = explode(PHP_EOL, $data);
        unset($detail[0]);
        unset($detail[1]);

        return trim(implode(PHP_EOL, $detail));
    }
}
