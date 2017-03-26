Feature: Search Results
  In order to fetch individual papers from the ACM/IEEE databases
  As a user
  I need to be provided search results with all the required functionality

  Scenario: The paper details page should provide the reader with a parsed/highlighted abstract and a download link
    Given I am on the paper listings page
    When I click a paper's title
    Then I am on the paper details page
    And I should see the abstract
    And I should see a download link

  Scenario: All the links for each paper listing should be there
    Given I am on the paper listings page
    Then I should see a download link for each paper
    And I should see a bibtext link for each paper
    And I should see an author link for each paper
    And I should see a conference name for each paper

  Scenario: The user should be able to regenerate the wordcloud from a subset of papers
    Given I am on the paper listings page
    When I click on a number of boxes' check boxes for each paper
    And I click regenerate word cloud
    Then I am on the word cloud page
    And I should see a word cloud image