<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements MinkContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am on :arg1
     */
    public function iAmOn($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I enter :arg1 in the search bar :arg2
     */
    public function iEnterInTheSearchBar($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When I click the :arg1 button
     */
    public function iClickTheButton($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I am redirected to :arg1 and :arg2 should contain the generated word cloud for Drake.
     */
    public function iAmRedirectedToAndShouldContainTheGeneratedWordCloudForDrake($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then :arg1 is refreshed
     */
    public function isRefreshed($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the :arg1 of the word cloud should read :arg2
     */
    public function theOfTheWordCloudShouldRead($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then the word cloud should be updated
     */
    public function theWordCloudShouldBeUpdated()
    {
        throw new PendingException();
    }

    /**
     * @Given the title above the word cloud is for :arg1
     */
    public function theTitleAboveTheWordCloudIsFor($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I enter :arg1 in the searchbar :arg2
     */
    public function iEnterInTheSearchbar2($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then A :arg1 should appear
     */
    public function aShouldAppear($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then Artist names in that :arg1 should begin with :arg2
     */
    public function artistNamesInThatShouldBeginWith($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given the word cloud did load
     */
    public function theWordCloudDidLoad()
    {
        throw new PendingException();
    }

    /**
     * @When I click on a :arg1 from the word cloud
     */
    public function iClickOnAFromTheWordCloud($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should be on :arg1 for the selected :arg2
     */
    public function iShouldBeOnForTheSelected($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then A :arg1 with Facebook's sharing functionality should pop up
     */
    public function aWithFacebookSSharingFunctionalityShouldPopUp($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then Artist names in that :arg1 should begin with the :arg2
     */
    public function artistNamesInThatShouldBeginWithThe($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given I am on :arg1 for a given :arg2 and :arg3
     */
    public function iAmOnForAGivenAnd($arg1, $arg2, $arg3)
    {
        throw new PendingException();
    }

    /**
     * @Then the :arg1 should be a heading near the top of the page
     */
    public function theShouldBeAHeadingNearTheTopOfThePage($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the first column of the results table should contain decreasing numbers
     */
    public function theFirstColumnOfTheResultsTableShouldContainDecreasingNumbers()
    {
        throw new PendingException();
    }

    /**
     * @Given I am on :arg1 for a given song
     */
    public function iAmOnForAGivenSong($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the lyrics for the song should be displayed correctly
     */
    public function theLyricsForTheSongShouldBeDisplayedCorrectly()
    {
        throw new PendingException();
    }

    /**
     * @Then the lyrics for the song should be displayed correcly and any occurence of the selected :arg1 should be highlighted
     */
    public function theLyricsForTheSongShouldBeDisplayedCorreclyAndAnyOccurenceOfTheSelectedShouldBeHighlighted($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I click on a :arg1 from the :arg2 table
     */
    public function iClickOnAFromTheTable($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then I am redirected to :arg1 for the selected :arg2
     */
    public function iAmRedirectedToForTheSelected($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given I am on :arg1 for a given :arg2
     */
    public function iAmOnForAGiven($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then the artist column in the results table should somehow include the :arg1 as the writer or a collaborator
     */
    public function theArtistColumnInTheResultsTableShouldSomehowIncludeTheAsTheWriterOrACollaborator($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I click on the button with the :arg1 in it
     */
    public function iClickOnTheButtonWithTheInIt($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I am redirected to :arg1 for the specified :arg2
     */
    public function iAmRedirectedToForTheSpecified($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then the lyrics for the song should be displayed correctly and formatted correctly
     */
    public function theLyricsForTheSongShouldBeDisplayedCorrectlyAndFormattedCorrectly()
    {
        throw new PendingException();
    }
}
