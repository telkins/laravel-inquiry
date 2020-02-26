<?php

namespace Telkins\LaravelInquiry\Tests\TestClasses;

use Telkins\LaravelInquiry\Details;

class WhichScoreIsBestDetails extends Details
{
    protected $inquiryClass = WhichScoreIsBest::class;

    public $game;
    public $scoreA;
    public $scoreB;

    public function forGame(Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function scoreA(int $scoreA): self
    {
        $this->scoreA = $scoreA;

        return $this;
    }

    public function scoreB(int $scoreB): self
    {
        $this->scoreB = $scoreB;

        return $this;
    }
}
