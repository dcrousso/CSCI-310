Feature: Search Results
  In order to fetch individual papers from the ACM/IEEE databases
  As a user
  I need to be provided search results with all the required functionality

  Scenario: Users should be able to navigate back to the Wordcloud page
    Given I am on the listings page for a given query "JavaScript", "10" number of papers, and keyword "JavaScript"
    When I click the "back" button 
    Then I am on the wordcloud page

  Scenario: The user should be able to regenerate the wordcloud from a subset of papers
    Given I am on the listings page for a given query "JavaScript", "10" number of papers, and keyword "JavaScript"
    When I click on a number of check boxes for each paper
    And I click the "subset" button
    Then I am on the wordcloud page
    And after I wait "some time"
    And I should see a wordcloud image

  # NEW
  Scenario: The user should be able to perform a search for papers created by a specific author
    Given I am on the listings page for a given query "JavaScript", "10" number of papers, and keyword "JavaScript"
    When I click on an author
    Then I am on the wordcloud page
    And after I wait "some time"
    And I should see a wordcloud image

  Scenario: The user should be able to perform a search for papers from a certain conference
    Given I am on the listings page for a given query "JavaScript", "10" number of papers, and keyword "JavaScript"
    When I click on the conference "name"
    Then I am on the wordcloud page
    And I am on the wordcloud page for the selected conference
    And after I wait "some time"
    And I should see a wordcloud image

  Scenario: The user should be able to sort listings in various orders
    Given I am on the listings page for a given query "JavaScript", "10" number of papers, and keyword "JavaScript"
    When I select descending frequency from the dropdown menu
    Then all the listings should be sorted in descending frequency

  Scenario: The user should be able to read the abstract of the paper on the listings page
    Given I am on the listings page for a given query "JavaScript", "10" number of papers, and keyword "JavaScript"
    When I click on the details of a listing
    Then I should see a paragraph summary of the paper's abstract

  # TODO Edit once highlight download is done
  Scenario: The user should be able to download a highlighted version of the paper
    Given I am on the listings page for a given query "JavaScript", "10" number of papers, and keyword "JavaScript"
    When I click on the details of a listing
    And I click the "highlighted" button
    Then after I wait "some time"
    And I should have downloaded a ".pdf" file

  Scenario: The user should be able to download a regular version of the paper
    Given I am on the listings page for a given query "JavaScript", "10" number of papers, and keyword "JavaScript"
    When I click on the "download" button
    Then I am on a page that should contain delivery.acm.org or ieee.explore.org


  Scenario: The user should be able to download the bibtex of a paper
    Given I am on the listings page for a given query "JavaScript", "10" number of papers, and keyword "JavaScript"
    When I click on the "bibtex" button
    Then I should have downloaded a ".bib" file






