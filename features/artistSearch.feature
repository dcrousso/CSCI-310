Feature: Artist search
  In order to generate lyric word clouds
  As a user
  I need to be able to search for artists and be properly redirected to the artist page

  Scenario: Searching for an artist should redirect me to artist.php 
    Given I am on "/index.php" 
    When I enter "artist name" in the search bar "a[]"
    And I click the "search" button
    Then I am redirected to "/artist.php" and "wordcloud" should contain the generated word cloud for Drake.

  Scenario: Merging artists on the word cloud should refresh the page with a new word cloud
    Given I am on "/artist.php"
    And the title above the word cloud is for "artist1"
    When I enter "artist2" in the search bar "a[]"
    And I click the "merge" button
    Then "/artist.php" is refreshed
    And the title of the word cloud should read "artist1", "artist2"
    And the word cloud should be updated

  Scenario: Searching for another artist from artist.php regenerates dynamic fields (title, word cloud) for that artist
    Given I am on "/artist.php"
    And the title above the word cloud is for "artist1"
    When I enter "artist2" in the search bar "a[]"
    And I click the "search" button
    Then "/artist.php" is refreshed
    And the "title of the word cloud should read "artist2"
    And the word cloud should be updated

  Scenario: Artist suggestions drop down appears when input is entered in the search bar
    Given I am on "/index.php"
    When I enter "3 characters" in the search bar "a[]"
    Then A "drop-down menu" should appear
    And Artist names in that "drop-down menu" should begin with the "3 characters"
