Feature: Word Cloud
  In order to select specific words to target in my results
  As a user
  I need to be be able to interact with a Word Cloud provided

  Scenario: If the user clicks on a word from the word cloud and sets a number of papers, the number of papers in the results should be correct
    Given I am on the search page
    And I enter a search term
    And I enter a number of papers
    And I am on the word cloud page
    When I click on a word from the word cloud image
    Then I am on the paper listings page
    And I should see one result

  Scenario: If the user clicks on a word from the word cloud, all results should have the 
  	Given I am on the word cloud page
  	When I click on a word from the word cloud image
  	Then I am on the paper listings page
  	And all listings' titles should have the word in it

  Scenario: Users should be able to download the word cloud image
    Given I am on the word cloud page
    When I click the download word cloud button
    Then the word cloud should be downloaded