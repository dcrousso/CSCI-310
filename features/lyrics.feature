Feature: Lyrics pages for various songs
  In order to view the lyrics and the context of specific words in said songs
  As a user
  I must be able to access the full, correct lyrics of any given song

  Scenario: The user accesses the lyrics of a song
    Given I am on "/lyrics.php" for a given "song"
    Then the lyrics for the song should be displayed correctly and formatted correctly

  Scenario: The user wants to clearly distinguish the keywords in the song
    Given I am on "/lyrics.php" for a given song and "word"
    Then the lyrics for the song should be displayed correcly and any occurence of the selected "word" should be highlighted

  Scenario: The user wants to go back to the word cloud page
    Given I am on "/lyrics.php" for a given "artist" and word
    When I click the "artist" button
    Then I should be on "/artist.php" for the selected "artist"

  Scenario: The user wants to go back to the song listings page
    Given I am on "/lyrics.php" for a given artist and "word"
    When I click the "word" button
    Then I should be on "/word.php" for the selected "word"
