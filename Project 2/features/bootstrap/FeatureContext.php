<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Behat\Mink\Mink,
    Behat\Mink\Session,
    Behat\Mink\Selenium2Driver;

use SeleniumClient as SeleniumClient;

use Behat\Behat\Hook\Scope\BeforeScenarioScope,
    Behat\Behat\Hook\Scope\AfterScenarioScope;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends Behat\MinkExtension\Context\MinkContext
{
    protected $driver;
    protected $session;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $this->session = new \Behat\Mink\Session($this->driver);
    }

    /**
     * @BeforeScenario
     */
    public function openBrowser(BeforeScenarioScope $event) {
        $this->session->start();
    }

    /**
     * @AfterScenario
     */
    public function closeBrowser(AfterScenarioScope $event) {
        $this->session->stop();
    }

    /**
     * @When I enter a search term
     */
    public function iEnterASearchTerm()
    {
        $search = $this->session->getPage()->find('css', '#search');
        $search->setValue('javascript');
    }

    /**
     * @When I click the :arg1 button
     */
    public function iClickTheButton($arg1)
    {
        $button = $this->session->getPage()->find('css', '#' . $arg1);

        if (!$button) {
            throw new Exception($arg1 . " button could not be found!");
        } else {
            $button->click();
        }
    }

    /**
     * @Then I should see a loading status bar
     */
    public function iShouldSeeALoadingStatusBar()
    {
        $bar = $this->session->getPage()->find('css', '#loading');

        if (!$bar) {
            throw new Exception("Loading bar could not be found!");
        }
    }

    /**
     * @Then after I wait some time
     */
    public function afterIWaitSomeTime()
    {
        $this->session->wait(30);
    }

    /**
     * @Then I should see a wordcloud image
     */
    public function iShouldSeeAWordcloudImage()
    {
        $wordcloud = $this->session->getPage()->find('css', '#wordcloud');

        if (!$wordcloud) {
            throw new Exception("Wordcloud could not be found!");
        }
    }

    /**
     * @Then I should see a dropdown of search history
     */
    public function iShouldSeeADropdownOfSearchHistory()
    {
        throw new PendingException();
    }

    /**
     * @Given I am on the :arg1 page for a given :arg2 and a :arg3 of papers
     */
    public function iAmOnThePageForAGivenAndAOfPapers($arg1, $arg2, $arg3)
    {
        $url = $this->session->getCurrentURL();

        $a1 = strpos($url, $arg1);
        $a2 = strpos($url, $arg2);
        $a3 = strpos($url, $arg3);

        if (!$a1 || !$a2 || !$a3) {
            throw new Exception("Not on the correct page!");
        }
    }

    /**
     * @Then after I wait :arg1
     */
    public function afterIWait($arg1)
    {
        $time = (int)$arg1;
        $this->session->wait($time);
    }

    /**
     * @When I click on an author
     */
    public function iClickOnAnAuthor()
    {
        $author = $this->session->getPage()->find('css', '#author');

        $author->click();
    }

    /**
     * @When I click on the conference :arg1
     */
    public function iClickOnTheConference($arg1)
    {
        $conference = $this->session->getPage()->find('css', '#conference');

        $conference->click();
    }

    /**
     * @Then I am on the wordcloud page for a conference :arg1
     */
    public function iAmOnTheWordcloudPageForAConference($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I select descending frequency from the dropdown menu
     */
    public function iSelectDescendingFrequencyFromTheDropdownMenu()
    {
        throw new PendingException();
    }

    /**
     * @Then all the listings should be sorted in descending frequency
     */
    public function allTheListingsShouldBeSortedInDescendingFrequency()
    {
        throw new PendingException();
    }

    /**
     * @When I click on the details of a listing
     */
    public function iClickOnTheDetailsOfAListing()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see a paragraph summary of the paper's abstract
     */
    public function iShouldSeeAParagraphSummaryOfThePapersAbstract()
    {
        throw new PendingException();
    }

    /**
     * @Then I should have downloaded a :arg1 file
     */
    public function iShouldHaveDownloadedAFile($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I click on the :arg1 button
     */
    public function iClickOnTheButton($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I am on a page that should contain delivery.acm.org or ieee.explore.org
     */
    public function iAmOnAPageThatShouldContainDeliveryAcmOrgOrIeeeExploreOrg()
    {
        throw new PendingException();
    }

    /**
     * @Given I am on the wordcloud page for a given query and number of papers
     */
    public function iAmOnTheWordcloudPageForAGivenQueryAndNumberOfPapers()
    {
        throw new PendingException();
    }

    /**
     * @When I click on a :arg1 from the wordcloud
     */
    public function iClickOnAFromTheWordcloud($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I am on the listings page for that :arg1
     */
    public function iAmOnTheListingsPageForThat($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given I am on the search page
     */
    public function iAmOnTheSearchPage()
    {
      $this->session->visit('http://localhost/CSCI-310/Project%202');
    }

    /**
     * @Then I am on the wordcloud page
     */
    public function iAmOnTheWordcloudPage()
    {
        throw new PendingException();
    }

    /**
     * @When I click on a :arg1 of boxes check boxes for each paper
     */
    public function iClickOnAOfBoxesCheckBoxesForEachPaper($arg1)
    {
        throw new PendingException();
    }
}
