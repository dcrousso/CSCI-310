Feature: Lyrics pages for various songs
  In order to view the lyrics and the context of specific words in said songs
  As a user
  I must be able to access the full, correct lyrics of any given song

  Scenario: The user accesses the lyrics of a song
    Given I am on "/lyrics.php" for song Love the Way You Lie and keyword right
    Then the lyrics for the song should be displayed correctly and formatted correctly

  Scenario: The user wants to clearly distinguish the keywords in the song
    Given I am on "/lyrics.php" for song Love the Way You Lie and keyword right
    Then the lyrics for the song should be displayed correctly and any occurence of the selected "right" should be highlighted

  Scenario: The user wants to go back to the word cloud page
    Given I am on "/lyrics.php" for song Love the Way You Lie and keyword right
    When I click the navigation "artist" button
    Then I should be on "/artist.php" for the selected "Eminem"

  Scenario: The user wants to go back to the song listings page
    Given I am on "/lyrics.php" for song Love the Way You Lie and keyword right
    When I click the "keyword" button
    Then I should be on "/word.php" for the selected "right"
