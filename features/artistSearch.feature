Feature: Artist search
  In order to generate lyric word clouds
  As a user
  I need to be able to search for artists and be properly redirected to the artist page

  Rules:
  - "a[]" search bar should be empty on page load

  Scenario: Searching for an artist should redirect me to artist.php 
    Given: I am on "/index.php"
    When: I enter "Drake" in "a[]"
    And: I hit the search button
    Then: I am redirected to "/artist.php" and "wordcloud" should contain the generated word cloud for Drake.
