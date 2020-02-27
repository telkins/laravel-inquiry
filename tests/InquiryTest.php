<?php

namespace Telkins\LaravelInquiry\Tests;

use PHPUnit\Framework\TestCase;
use Telkins\LaravelInquiry\Tests\TestClasses\Game;
use Telkins\LaravelInquiry\Tests\TestClasses\WhichScoreIsBest;
use Telkins\LaravelInquiry\Tests\TestClasses\WhichScoreIsBestDetails;
use Telkins\LaravelInquiry\Tests\TestClasses\WhichScoreIsBestExplicit;

class InquiryTest extends TestCase
{
    /** @test */
    public function asking_question_returns_details_object()
    {
        $this->assertInstanceOf(WhichScoreIsBestDetails::class, WhichScoreIsBest::ask());
    }

    /** @test */
    public function asking_question_returns_details_object_explicit()
    {
        $this->assertInstanceOf(WhichScoreIsBestDetails::class, WhichScoreIsBestExplicit::ask());
    }

    /**
     * @test
     * @dataProvider provideInputOutput
     */
    public function inquiries_return_expected_response($game, $scoreA, $scoreB, $expected)
    {
        $answer = WhichScoreIsBest::ask()
            ->forGame($game)
            ->scoreA($scoreA)
            ->scoreB($scoreB)
            ->answer();

        $this->assertSame($expected, $answer);
    }

    /**
     * @test
     * @dataProvider provideInputOutput
     */
    public function inquiries_return_expected_response_explicit($game, $scoreA, $scoreB, $expected)
    {
        $answer = WhichScoreIsBestExplicit::ask()
            ->forGame($game)
            ->scoreA($scoreA)
            ->scoreB($scoreB)
            ->answer();

        $this->assertSame($expected, $answer);
    }

    public function provideInputOutput()
    {
        return [
            [
                new Game('Game Title', 'high-score-wins'),
                10,
                1,
                10,
            ],
            [
                new Game('Game Title', 'high-score-wins'),
                1,
                10,
                10,
            ],
            [
                new Game('Game Title', 'high-score-wins'),
                10,
                10,
                null,
            ],
            [
                new Game('Game Title', 'low-score-wins'),
                10,
                1,
                1,
            ],
            [
                new Game('Game Title', 'low-score-wins'),
                1,
                10,
                1,
            ],
            [
                new Game('Game Title', 'low-score-wins'),
                10,
                10,
                null,
            ],
        ];
    }

    /** @test */
    public function it_can_get_answers_for_different_details()
    {
        $highGame = new Game('Game Title', 'high-score-wins');
        $lowGame = new Game('Game Title', 'low-score-wins');

        $details = WhichScoreIsBest::ask();

        $details->forGame($highGame)
            ->scoreA(10)
            ->scoreB(1);
        
        $highAnswer = $details->answer();

        $lowAnswer = $details->forGame($lowGame)->answer();

        $this->assertSame(10, $highAnswer);
        $this->assertSame(1, $lowAnswer);
    }

    /** @test */
    public function it_can_get_answers_for_different_details_explicit()
    {
        $highGame = new Game('Game Title', 'high-score-wins');
        $lowGame = new Game('Game Title', 'low-score-wins');

        $details = WhichScoreIsBestExplicit::ask();

        $details->forGame($highGame)
            ->scoreA(10)
            ->scoreB(1);
        
        $highAnswer = $details->answer();

        $lowAnswer = $details->forGame($lowGame)->answer();

        $this->assertSame(10, $highAnswer);
        $this->assertSame(1, $lowAnswer);
    }
}
