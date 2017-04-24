Feature: Word Cloud
  In order to select specific words to target in my results
  As a user
  I need to be be able to interact with a Word Cloud provided

  Scenario: Clicking on a word from the word cloud should take the user to the listings page 
    Given I am on the wordcloud page for a given query and number of papers
    When I click on a word from the wordcloud
    Then I am on the listings page

  Scenario: The user should be able to download the wordcloud as an image
  	Given I am on the word cloud page
    When I click on the download button
    Then I wait some time
    And the file should be downloaded
