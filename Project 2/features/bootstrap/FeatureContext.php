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

    protected $conference;

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
        $search = $this->session->getPage()->find('css', '#searchbar');
        $search->setValue('javascript');
    }

    /**
     * @When I simulate keystrokes
     */
    public function iSimulateKeystrokes()
    {
        $search = $this->session->getPage()->find('css', '#searchbar');
        $search->focus();
        
        $this->session->visit("http://localhost/CSCI-310/Project%202/cloud.php?q=JavaScript&n=10");
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
        $bar = $this->session->getPage()->find('css', '#progress');

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
     * @Given I am on the listings page for a given query :arg1, :arg2 number of papers, and keyword :arg3
     */
    public function iAmOnThePageForAGivenAndAOfPapers($arg1, $arg2, $arg3)
    {
      $url = "http://localhost/CSCI-310/Project%202/word.php?q=" . $arg1 . "&n=" . $arg2 . "&w=" . $arg3;

      $this->session->visit($url);
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
        $this->conference = $conference->getText();
        $conference->click();
    }

    /**
     * @Then I am on the wordcloud page for the selected conference
     */
    public function iAmOnTheWordcloudPageForTheSelectedConference()
    {
        $url = $this->session->getCurrentUrl();

        $cloud = strpos($url, "cloud.php");
        $conf = strpos($url, $this->conference);

        if (!$cloud && !$conf) {
            throw new Exception('I was not on the cloud page for the correct conference');
        }
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
        $button = $this->session->getPage()->find('css', '#' . $arg1);
        if (!$button) {
            throw new Exception("Did not find a " . $arg1 . " button!");
        } else {
            $button->click();
        }
    }

    /**
     * @Then I am on a page that should contain delivery.acm.org or ieee.explore.org
     */
    public function iAmOnAPageThatShouldContainDeliveryAcmOrgOrIeeeExploreOrg()
    {
        $url = $this->session->getCurrentUrl();
        $acm = strpos($url, "delivery.acm.org");
        $ieee = strpos($url, "ieee.explore.org");

        if (!$acm && !$ieee) {
            throw new Exception('I was not redirected to an ACM/IEEE webpage!');
        }
    }

    /**
     * @Given I am on the wordcloud page for a given query and number of papers
     */
    public function iAmOnTheWordcloudPageForAGivenQueryAndNumberOfPapers()
    {
        $url = "http://localhost/CSCI-310/Project%202/cloud.php?q=JavaScript&n=10";
        $this->session->visit($url);
    }

    /**
     * @When I click on a :arg1 from the wordcloud
     */
    public function iClickOnAFromTheWordcloud($arg1)
    {
        $link = $this->session->getPage()->find('css', '#wordcloud-link');

        if (!$link) {
        	throw new Exception("Word Cloud failed to generate!");
        } else {
        	$link->click();
        }
    }

    /**
     * @Then I am on the listings page for that :arg1
     */
    public function iAmOnTheListingsPageForThat($arg1)
    {
        $url = $this->session->getCurrentUrl();
        
        if (!strpos($url, "word.php") || !strpos($url, $arg1))
        	throw new Exception("Regenerated wordcloud failed!");
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
        $url = $this->session->getCurrentUrl();
        if (strpos($url, "cloud.php") === false) throw new Exception('Not on the wordcloud page!');
    }

    /**
     * @When I click on a number of check boxes for each paper
     */
    public function iClickOnAOfBoxesCheckBoxesForEachPaper()
    {
    	$checkbox = $this->session->getPage()->find('css', '.checkbox-test');

    	if (!$checkbox) {
    		throw new Exception("No checkboxes detected!");
    	} else {
    		$checkbox->click();
    	}
    }
}
