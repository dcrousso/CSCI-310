Feature: Song Listings page that lists all songs by a given artist using a specific word
  In order to get all the songs by a certain artist and analyze word frequency
  As a user
  I need to have the listings accurately provided to me

  Scenario: Song listings are sorted by frequency of word occurrence
    Given I am on "/word.php" for a given "word" and "artist"
    Then the "word" should be a heading near the top of the page
    And the first column of the results table should contain decreasing numbers

  Scenario: The user clicks a song name and the webpage loads the correct lyrics page
    Given I am on "/word.php" for a given "word" and "artist"
    When I click on a "song title" from the "results" table
    Then I am redirected to "/lyrics.php" for the selected "song title"

  Scenario: The song listings the user sees should all be written by the specified artist
    Given I am on "/word.php" for a given "artist"
    Then the artist column in the results table should somehow include the "artist" as the writer or a collaborator

  Scenario: The artist chooses to go back to the Word Cloud via back button
    Given I am on "/word.php" for a given word and "artist(s)"
    When I click on the button with the "artist(s)" in it
    Then I am redirected to "/artist.php" for the specified "artist(s)"
