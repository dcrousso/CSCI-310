Feature: Testing Word Cloud Functionality
  In order to use the functionality of the word cloud as specified in our requirements
  As a user
  I need to be able to select words from the word cloud, use sharing for social media, and be redirected correctly

  Scenario: The user clicks on a word from the word cloud
    Given I am on "/artist.php"
    And the word cloud did load
    When I click on a "word" from the word cloud
    Then I should be on "/word.php" for the selected "word"

  Scenario: The user clicks on the share button to share the word cloud to Facebook
    Given I am on "/artist.php"
    And the word cloud did load
    When I click the "share" button
    Then A "window" with Facebook's sharing functionality should pop up
