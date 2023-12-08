<?php

namespace App;

class Game
{
    private array $usedPositions = [];
    private string $playerTurn = 'X';

    public function __construct(array $startingUsedPositions = [], string $nextPlayer = 'X')
    {
        $this->usedPositions = $startingUsedPositions;
        $this->playerTurn = $nextPlayer;
    }

    public function getUsedPositions(): array
    {
        return $this->usedPositions;
    }

    public function getPlayerTurn(): string
    {
        return $this->playerTurn;
    }

    public function play(int $position): string|null
    {
        $this->usedPositions[$position] = $this->playerTurn;
        $this->playerTurn = $this->playerTurn === 'X' ? 'O' : 'X';

        return $this->checkWinningPositions();
    }

    public function getBoard(): string
    {
        $board = '|';
        $i = 0;

        while ($i < 9) {
            if (in_array($i + 1, array_keys($this->usedPositions))) {
                $board .= $this->usedPositions[$i + 1] . '|';
            } else {
                $cell = $i + 1;
                $cell = ' ';
                $board .= "$cell|";
            }

            $lineEndPositions = [7, 23];

            if (in_array(strlen($board), $lineEndPositions)) {
                $board .= PHP_EOL . '+-+-+-+' . PHP_EOL . '|';
            }

            $i++;
        }

        return $board;
    }

    protected function checkWinningPositions(): string|null
    {
        $winningPositions = [
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9],
            [1, 4, 7],
            [2, 5, 8],
            [3, 6, 9],
            [1, 5, 9],
            [3, 5, 7],
        ];

        $players = ['X', 'O'];

        foreach ($players as $player) {
            foreach ($winningPositions as $positions) {
                $positionsTaken = 0;

                foreach ($positions as $position) {
                    // check for used position
                    if (in_array($position, array_keys($this->usedPositions))) {
                        // check if $player has taken the position
                        if ($this->usedPositions[$position] === $player) {
                            $positionsTaken++;
                        }
                    }

                    if ($positionsTaken >= 3) {
                        return $player;
                    }
                }
            }
        }

        return null;
    }
}
