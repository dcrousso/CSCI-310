Feature: Song Listings page that lists all songs by a given artist using a specific word
  In order to get all the songs by a certain artist and analyze word frequency
  As a user
  I need to have the listings accurately provided to me

  Scenario: Song listings are sorted by frequency of word occurrence
    Given I am on "/word.php" for a given "word" and "artist"
    Then the "word" should be a heading near the top of the page
    And the first column of the results table should contain decreasing numbers

