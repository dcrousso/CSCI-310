<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Behat\Mink\Mink,
    Behat\Mink\Session,
    Behat\Mink\Selenium2Driver;

use Selenium\Client as SeleniumClient;

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
     * @When I click the :arg1 button
     */
    public function iClickTheButton($arg1)
    {
      $button = $this->getSession()->getPage()->find('css', '#' . $arg1);

      if (!$button) {
        throw new Exception($arg1 . " button could not be found");
      } else {
        $button->click();
      }
    }
    /**
     * @When I click the navigation :arg1 button
     */
    public function iClickTheButton2($arg1)
    {
      $button = $this->getSession()->getPage()->find('css', '#' . $arg1);

      if (!$button) {
        throw new Exception($arg1 . " button could not be found");
      } else {
        $button->click();
      }
    }
    /**
     * @Then I am redirected to :arg1 and :arg2 should contain the generated word cloud for :arg3.
     */
    public function iAmRedirectedToAndShouldContainTheGeneratedWordCloudFor($arg1, $arg2, $arg3)
    {
      if (strpos($this->getSession()->getCurrentUrl(), $arg1) === false)
        throw new Exception("Currently not on /artist.php!");

      $this->assertSession()->elementExists('css', '#wordcloud');

      if (strpos($this->getSession()->getPage()->find('css', '#artist')->getText(), $arg3) === false)
        throw new Exception("Incorrect word cloud generated!");
    }

    /**
     * @Given I am on :arg1 for :arg2
     */
    public function iAmOnFor($arg1, $arg2)
    {
      $url = 'localhost/CSCI-310' . $arg1 . '?a[]=' . $arg2 . '&search=';
      $this->getSession()->visit($url);
    }

    /**
     * @Then :arg1 is refreshed
     */
    public function isRefreshed($arg1)
    {
      if (strpos($this->getSession()->getCurrentUrl(), $arg1) === false)
        throw new Exception("Currently not on /artist.php!");
    }

    /**
     * @Then the title of the word cloud should read :arg1, :arg2
     */
    public function theTitleOfTheWordCloudShouldRead($arg1, $arg2)
    {
      if ($this->getSession()->getPage()->find('css', 'h1')->getText() !== ($arg1 . ', ' . $arg2))
        throw new Exception("Word Cloud title incorrect!");
    }

    /**
     * @Then the word cloud should be updated
     */
    public function theWordCloudShouldBeUpdated()
    {
      $this->assertSession()->elementExists('css', '#wordcloud');
    }

    /**
     * @Then the "title of the word cloud should read :arg1
     */
    public function theTitleOfTheWordCloudShouldRead2($arg1)
    {
      if (strpos($this->getSession()->getPage()->find('css', 'h1')->getText(), $arg1) === false)
        throw new Exception("Word Cloud title incorrect!");
    }

    /**
     * @Then A drop-down menu should appear
     */
    public function aShouldAppear()
    {
      // THIS MAY BUG OUT IF API KEYS EXPIRED  
      $this->assertSession()->elementExists('css', '#dropdown');      
    }

    /**
     * @Then Artist names in that :arg1 should begin with the :arg2
     */
    public function artistNamesInThatShouldBeginWithThe($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then the lyrics for the song should be displayed correctly and formatted correctly
     */
    public function theLyricsForTheSongShouldBeDisplayedCorrectlyAndFormattedCorrectly()
    {
      // THIS MAY BUG OUT DUE TO API KEY EXPIRATION
      $this->assertSession()->elementExists('css', '#lyrics');
    }

    /**
     * @Then the lyrics for the song should be displayed correctly and any occurence of the selected :arg1 should be highlighted
     */
    public function theLyricsForTheSongShouldBeDisplayedCorrectlyAndAnyOccurenceOfTheSelectedShouldBeHighlighted($arg1)
    {
      // THIS FUNCTION MAY BUG OUT DUE TO API KEY EXPIRATION
      $occurrences = $this->getSession()->getPage()->findAll('css', '#occurrence');
      foreach ($occurrences as $occurrence) {
        if ($occurrence->getText() !== $arg1) {
          throw new Exception("Word that was not a keyword was highlighted!");
        }
      } 
    }

    /**
     * @Given I specified an artist :arg1
     */
    public function iSpecifiedAnArtist($arg1)
    {
      if (strpos($this->getSession()->getCurrentUrl(), ('a[]=' . $arg1) === false)) {
        throw new Exception("No artist(s) was/were specified!");
      }
    }

    /**
     * @Then I should be on :arg1 for the selected :arg2
     */
    public function iShouldBeOnForTheSelected($arg1, $arg2)
    {
      if (strpos($this->getSession()->getCurrentUrl(), $arg1) === false)
        throw new Exception("Currently not on " . $arg1 . "!");

      if (strpos($this->getSession()->getCurrentUrl(), $arg2) === false)
        throw new Exception("Currently not on " . $arg1 . " for the right " . $arg2 . "!");
    }

    /**
     * @Given I specified a word :arg1 and artist :arg2
     */
    public function iSpecifiedAWordAndArtist($arg1, $arg2)
    {
      $this->getSession()->visit($this->getSession()->getCurrentUrl() . "?a[]=" . $arg2 . "&w=" . $arg1);
    }

    /**
     * @Then the :arg1 should be a heading near the top of the page
     */
    public function theShouldBeAHeadingNearTheTopOfThePage($arg1)
    {
      if ($this->getSession()->getPage()->find('css', '#keyword')->getText() !== $arg1) {
        throw new Exception("Incorrect keyword as title!");
      }
    }

    /**
     * @Then the first column of the results table should contain decreasing numbers
     */
    public function theFirstColumnOfTheResultsTableShouldContainDecreasingNumbers()
    {
      $freqs = $this->getSession()->getPage()->findAll('css', '#song-count');

      for ($i=1; $i < count($freqs) ; $i++) { 
        if ((int)$freqs[$i]->getText() > (int)$freqs[$i-1]->getText())
          throw new Exception("Occurences are not descending");
      }
    }

    /**
     * @When I click on a :arg1 from the :arg2 table
     */
    public function iClickOnAFromTheTable($arg1, $arg2)
    {
      $this->getSession()->getPage()->find('css', '#results #song-title')->click();
    }

    /**
     * @Then I am redirected to :arg1
     */
    public function iAmRedirectedTo($arg1)
    {
        if (strpos($this->getSession()->getCurrentUrl(), $arg1) === false)
        throw new Exception("Currently not on " . $arg1 . "!");
    }

    /**
     * @Then the artist column in the results table should somehow include the artist :arg1 as the writer or a collaborator
     */
    public function theArtistColumnInTheResultsTableShouldSomehowIncludeTheArtistAsTheWriterOrACollaborator2($arg1)
    {
        $artists = $this->getSession()->getPage()->findAll('css', '#artist-name');

        foreach($artists as $artist) {
          if (strpos($artist->getText(), $arg1) === false) throw new Exception("Artist field incorrect!");
        }
    }

    /**
     * @When I click on the button with the :arg1 in it
     */
    public function iClickOnTheButtonWithTheInIt($arg1)
    {
      $this->getSession()->getPage()->find('css', '#word-back')->click(); 
    }


    /**
     * @Given the word cloud did load
     */
    public function theWordCloudDidLoad()
    {
      $this->assertSession()->elementExists('css', '#wordcloud');
    }

    /**
     * @When I click on a :arg1 from the word cloud
     */
    public function iClickOnAFromTheWordCloud($arg1)
    {
      $this->getSession()->getPage()->find('css', 'a')->click();
    }

    /**
     * @Then A :arg1 with Facebook's sharing functionality should pop up
     */
    public function aWithFacebookSSharingFunctionalityShouldPopUp($arg1)
    {
    }

    /**
     * @When I enter :arg1 in the search bar :arg2
     */
    public function iEnterInTheSearchBar($arg1, $arg2)
    {
        throw new PendingException();
    }


    /**
     * @Given I am on :arg1 for a given artist :arg2
     */
    public function iAmOnForAGivenArtist($arg1, $arg2)
    {
      $this->getSession()->visit('localhost/CSCI-310' . $arg1 . "?a[]=" . $arg2);
    }

    /**
     * @When I click on a word :arg1 from the word cloud
     */
    public function iClickOnAWordFromTheWordCloud($arg1)
    {
      $this->getSession()->visit($this->getSession()->getCurrentUrl() . '&w=' . $arg1);
    }

    /**
     * @Then I should be on :arg1 for the selected word :arg2
     */
    public function iShouldBeOnForTheSelectedWord($arg1, $arg2)
    {
      if (strpos($this->getSession()->getCurrentUrl(), $arg1) === false)
        throw new Exception("Currently not on " . $arg1 . "!");

      if (strpos($this->getSession()->getCurrentUrl(), $arg2) === false)
        throw new Exception("Currently not on " . $arg1 . " for the right " . $arg2 . "!");
    }

    /**
     * @Given on artist.php for a given artist :arg1
     */
    public function onArtistPhpForAGivenArtist($arg1)
    {
      $this->getSession()->visit($this->getSession()->getCurrentUrl() . '?a=' . $arg1);
    }

    /**
     * @Given I am on :arg1 for song Love the Way You Lie and keyword right
     */
    public function iAmOnForSongLoveTheWayYouLieAndKeywordRight($arg1)
    {
      $this->getSession()->visit('http://localhost/CSCI-310/lyrics.php?a[]=Eminem&s=Love the Way You Lie&w=right');
    }
}
