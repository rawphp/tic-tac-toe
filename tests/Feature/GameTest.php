<?php

use App\Game;
use function PHPUnit\Framework\assertInstanceOf;

test('can launch game', function () {
    $game = new Game();

    assertInstanceOf(Game::class, $game);
});

test('can output fresh game board', function () {
    $game = new Game();

    expect($game->getBoard())->toEqual(
        <<<PHP
| | | |
+-+-+-+
| | | |
+-+-+-+
| | | |
PHP
    );
});

test('can start the game with first position', function () {
    $game = new Game();

    $game->play(5);

    expect($game->getBoard())->toEqual(
        <<<PHP
| | | |
+-+-+-+
| |X| |
+-+-+-+
| | | |
PHP
    );
});

test('second move', function () {
    $game = new Game([5 => 'X'], 'O');

    $game->play(1);

    expect($game->getBoard())->toEqual(
        <<<PHP
|O| | |
+-+-+-+
| |X| |
+-+-+-+
| | | |
PHP
    );
});

test('third move', function () {
    $game = new Game([5 => 'X', 1 => 'O'], 'X');

    $game->play(3);

    expect($game->getBoard())->toEqual(
        <<<PHP
|O| |X|
+-+-+-+
| |X| |
+-+-+-+
| | | |
PHP
    );
});

test('fourth move', function () {
    $game = new Game([5 => 'X', 1 => 'O', 3 => 'X'], 'O');

    $game->play(9);

    expect($game->getBoard())->toEqual(
        <<<PHP
|O| |X|
+-+-+-+
| |X| |
+-+-+-+
| | |O|
PHP
    );
});

test('winning X move', function () {
    $game = new Game([5 => 'X', 1 => 'O', 3 => 'X', 9 => 'O'], 'X');

    $winner = $game->play(7);

    expect($winner)->toEqual('X');

    expect($game->getBoard())->toEqual(
        <<<PHP
|O| |X|
+-+-+-+
| |X| |
+-+-+-+
|X| |O|
PHP
    );
});

test('winning move 1', function () {
    $game = new Game([1 => 'X', 2 => 'X', 5 => 'O', 7 => 'O', 9 => 'O'], 'X');

    $winner = $game->play(3);

    expect($winner)->toEqual('X');

    expect($game->getBoard())->toEqual(
        <<<PHP
|X|X|X|
+-+-+-+
| |O| |
+-+-+-+
|O| |O|
PHP
    );
});

test('winning move 2', function () {
    $game = new Game([4 => 'O', 5 => 'O', 1 => 'X', 3 => 'X', 7 => 'X', 9 => 'X'], 'O');

    $winner = $game->play(6);

    expect($winner)->toEqual('O');

    expect($game->getBoard())->toEqual(
        <<<PHP
|X| |X|
+-+-+-+
|O|O|O|
+-+-+-+
|X| |X|
PHP
    );
});

test('winning move 3', function () {
    $game = new Game([7 => 'X', 8 => 'X', 1 => 'O', 3 => 'O', 4 => 'O'], 'X');

    $winner = $game->play(9);

    expect($winner)->toEqual('X');

    expect($game->getBoard())->toEqual(
        <<<PHP
|O| |O|
+-+-+-+
|O| | |
+-+-+-+
|X|X|X|
PHP
    );
});

test('winning move 4', function () {
    $game = new Game([1 => 'O', 4 => 'O', 3 => 'X', 8 => 'X', 9 => 'X'], 'O');

    $winner = $game->play(7);

    expect($winner)->toEqual('O');

    expect($game->getBoard())->toEqual(
        <<<PHP
|O| |X|
+-+-+-+
|O| | |
+-+-+-+
|O|X|X|
PHP
    );
});

test('winning move 5', function () {
    $game = new Game([2 => 'X', 5 => 'X', 1 => 'O', 3 => 'O', 4 => 'O'], 'X');

    $winner = $game->play(8);

    expect($winner)->toEqual('X');

    expect($game->getBoard())->toEqual(
        <<<PHP
|O|X|O|
+-+-+-+
|O|X| |
+-+-+-+
| |X| |
PHP
    );
});

test('winning move 6', function () {
    $game = new Game([3 => 'O', 6 => 'O', 1 => 'X', 4 => 'X', 5 => 'X'], 'O');

    $winner = $game->play(9);

    expect($winner)->toEqual('O');

    expect($game->getBoard())->toEqual(
        <<<PHP
|X| |O|
+-+-+-+
|X|X|O|
+-+-+-+
| | |O|
PHP
    );
});

test('winning move 7', function () {
    $game = new Game([1 => 'X', 5 => 'X', 3 => 'O', 6 => 'O'], 'X');

    $winner = $game->play(9);

    expect($winner)->toEqual('X');

    expect($game->getBoard())->toEqual(
        <<<PHP
|X| |O|
+-+-+-+
| |X|O|
+-+-+-+
| | |X|
PHP
    );
});

test('winning move 8', function () {
    $game = new Game([3 => 'O', 5 => 'O', 6 => 'X', 9 => 'X'], 'O');

    $winner = $game->play(7);

    expect($winner)->toEqual('O');

    expect($game->getBoard())->toEqual(
        <<<PHP
| | |O|
+-+-+-+
| |O|X|
+-+-+-+
|O| |X|
PHP
    );
});
