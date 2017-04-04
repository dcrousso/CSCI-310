Feature: Search Page
  In order to search for papers
  As a user
  I need to be able to use a fully functional search page

  Scenario: The user should be able to search for author names or key terms and have a word cloud of the most used words appear on the word cloud page
    Given I am on the search page
    When I enter a search term
    And I click search
    Then I am on the word cloud page
    And I should see a loading status bar
    And if I wait some time, I should see a word cloud image

  Scenario: The search page should have a field for number of papers and the search bar
    Given I am on the search page
    Then I should see an input field for number of papers referenced
    And I should see a search input field

  Scenario: If the user is typing in the search bar, a search history should appear as a dropdown menu
    Given I am on the search page
    When I enter a search term
    Then I should see a dropdown of search history