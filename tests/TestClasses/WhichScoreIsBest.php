<?php

namespace Telkins\LaravelInquiry\Tests\TestClasses;

use Telkins\LaravelInquiry\Inquiry;
use Telkins\LaravelInquiry\Contracts\Details;

class WhichScoreIsBest extends Inquiry
{
    protected static $detailsClass = WhichScoreIsBestDetails::class;

    public function answer(Details $details)
    {
        if ($details->scoreA === $details->scoreB) {
            return null;
        }

        if ($details->game->scoring === 'high-score-wins') {
            return max($details->scoreA, $details->scoreB);
        }

        return min($details->scoreA, $details->scoreB);
    }
}
