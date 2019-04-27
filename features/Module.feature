
Feature: Module

  Background:
    Given the following modules exist:
    | id | name    | result_tab |
    | 1  | example | smtp       |

  Scenario: Get module by name
    When client tries to get module passing name example
    Then repository should return '\Rummager\Service\Module\Module' entity with id 1 2
      And module's result_tab value should be 'smtp'

  Scenario: Get module by name (not existent)
    When client tries to get module passing name 'notExistingOne'
    Then repository should throw exception: 'Rummager\Service\Module\Exceptions\NotExistingModuleException' 2
