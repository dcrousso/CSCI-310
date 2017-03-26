Feature: Paper Details
  In order to access more information about the paper 
  As a user
  I need to have this information on a page that I can access

  Scenario: Clicking on an author should redirect to another wordcloud
    Given I am on the paper details page
    When I click an author
    Then I am on the word cloud page

  Scenario: The regenerated word cloud from clicking on an author should only provide listings with the specified author
    Given I am on the paper details page
    When I click an author
    And I am on the word cloud page
    And I click a word
    Then I am on the paper listings page
    And the author is the same for each paper