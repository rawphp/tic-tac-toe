<?php

namespace App\Commands;

use App\Game;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\View;
use LaravelZero\Framework\Commands\Command;

class PlayCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'play';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Play tick-tack-toe game';

    public function handle(): int
    {
        $playing = true;

        $game = new Game();

        do {
            $this->info($game->getBoard());

            $positions = array_diff([1, 2, 3, 4, 5, 6, 7, 8, 9], array_keys($game->getUsedPositions()));

            $nextPlayer = $game->getPlayerTurn();

            $this->info("\nPlayer $nextPlayer turn:");
            $value = $this->choice('What is your selection?', $positions);

            $winner = $game->play($value);

            if (count($positions) === 1) {
                $playing = false;
            }

            if ($winner !== null) {
                $this->info($game->getBoard());
                $this->info('');
                $this->info('*************************');
                $this->info("\t$winner WINS!");
                $this->info('*************************');

                return self::SUCCESS;
            }
        } while ($playing);

        return self::SUCCESS;
    }

    protected function printGameBoard(): void
    {
        $this->line("| | | |\n+-+-+-+\n| | | |\n+-+-+-+\n| | | |");
    }
}
