<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
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
}
