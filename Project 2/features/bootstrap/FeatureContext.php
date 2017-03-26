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
     * @Given I am on the paper details page
     */
    public function iAmOnThePaperDetailsPage()
    {
        throw new PendingException();
    }

    /**
     * @When I click an author
     */
    public function iClickAnAuthor()
    {
        throw new PendingException();
    }

    /**
     * @Then I am on the word cloud page
     */
    public function iAmOnTheWordCloudPage()
    {
        throw new PendingException();
    }

    /**
     * @When I click a word
     */
    public function iClickAWord()
    {
        throw new PendingException();
    }

    /**
     * @Then I am on the paper listings page
     */
    public function iAmOnThePaperListingsPage()
    {
        throw new PendingException();
    }

    /**
     * @Then the author is the same for each paper
     */
    public function theAuthorIsTheSameForEachPaper()
    {
        throw new PendingException();
    }

    /**
     * @Given I am on the search page
     */
    public function iAmOnTheSearchPage()
    {
        throw new PendingException();
    }

    /**
     * @When I enter a search term
     */
    public function iEnterASearchTerm()
    {
        throw new PendingException();
    }

    /**
     * @When I click search
     */
    public function iClickSearch()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see a loading status bar
     */
    public function iShouldSeeALoadingStatusBar()
    {
        throw new PendingException();
    }

    /**
     * @Then if I wait some time, I should see a word cloud image
     */
    public function ifIWaitSomeTimeIShouldSeeAWordCloudImage()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see an input field for number of papers referenced
     */
    public function iShouldSeeAnInputFieldForNumberOfPapersReferenced()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see a search input field
     */
    public function iShouldSeeASearchInputField()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see a dropdown of search history
     */
    public function iShouldSeeADropdownOfSearchHistory()
    {
        throw new PendingException();
    }

    /**
     * @When I click a paper's title
     */
    public function iClickAPaperSTitle()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see the abstract
     */
    public function iShouldSeeTheAbstract()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see a download link
     */
    public function iShouldSeeADownloadLink()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see a download link for each paper
     */
    public function iShouldSeeADownloadLinkForEachPaper()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see a bibtext link for each paper
     */
    public function iShouldSeeABibtextLinkForEachPaper()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see an author link for each paper
     */
    public function iShouldSeeAnAuthorLinkForEachPaper()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see a conference name for each paper
     */
    public function iShouldSeeAConferenceNameForEachPaper()
    {
        throw new PendingException();
    }

    /**
     * @When I click on a number of boxes' check boxes for each paper
     */
    public function iClickOnANumberOfBoxesCheckBoxesForEachPaper()
    {
        throw new PendingException();
    }

    /**
     * @When I click regenerate word cloud
     */
    public function iClickRegenerateWordCloud()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see a word cloud image
     */
    public function iShouldSeeAWordCloudImage()
    {
        throw new PendingException();
    }

    /**
     * @Given I enter a number of papers
     */
    public function iEnterANumberOfPapers()
    {
        throw new PendingException();
    }

    /**
     * @When I click on a word from the word cloud image
     */
    public function iClickOnAWordFromTheWordCloudImage()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see one result
     */
    public function iShouldSeeOneResult()
    {
        throw new PendingException();
    }

    /**
     * @Then all listings' titles should have the word in it
     */
    public function allListingsTitlesShouldHaveTheWordInIt()
    {
        throw new PendingException();
    }

    /**
     * @When I click the download word cloud button
     */
    public function iClickTheDownloadWordCloudButton()
    {
        throw new PendingException();
    }

    /**
     * @Then the word cloud should be downloaded
     */
    public function theWordCloudShouldBeDownloaded()
    {
        throw new PendingException();
    }
}
