
Feature: Check

  Background:
    Given the following hosts exist:
      | id | name        |
      | 1  | example.com |
    Given the following nodes exist:
      | id | hid |
      | 10 | 1   |
      | 11 | 1   |
    Given the following modules exist:
      | id | name    | result_tab |
      | 1  | smtp    | smtp        |
      | 2  | sender  | sender      |
    Given the following Networks Statuses exist:
      | id | name     |
      | 1  | todo     |
      | 2  | finished |
      | 3  | on hold  |
    Given the following Networks exist:
      | id | ip      | mask | description | status |
      | 1  | 1.1.1.1 | 24   |             | 1      |
    Given the following checks exist:
      | id | node | net  | module |
      | 20 | 10   | null | 2      |
      | 21 | 11   | 1    | 1      |

  Scenario: Add new check process
    Given new check process module id is 1
      And new check process node id is 11
      And new check process network id is 1
    When client tries to add new check process
    Then new check process should be added successfully

  Scenario: Try to add new check process with not valid data (module)
    Given new check process module id is null
    And new check process node id is 11
    And new check process network id is 1
    When client tries to add new check process
    Then exception '\TypeError' should be thrown

  Scenario: Try to add new check process with not valid data (node)
    Given new check process module id is 1
    And new check process node id is null
    And new check process network id is 1
    When client tries to add new check process
    Then exception '\TypeError' should be thrown

  Scenario: [!FIXME!] Try to add new check process with not valid data for given module
    Given new check process module id is 1
    And new check process node id is 11
    And new check process network id is null
    When client tries to add new check process
    # Then exception '\Illuminate\Validation\ValidationException' should be thrown
    Then new check process should be added successfully

  Scenario: Add new check process (for module Sender network can be null)
    Given new check process module id is 2
    And new check process node id is 11
    And new check process network id is null
    When client tries to add new check process
    Then new check process should be added successfully

  Scenario: Add new check process with not existing node id
    Given new check process module id is 1
    And new check process node id is 20
    And new check process network id is 1
    When client tries to add new check process
    Then exception '\Rummager\Service\Host\Node\Exceptions\NotExistingNodeException' should be thrown

  Scenario: Add new check process with not existing module id
    Given new check process module id is 10
    And new check process node id is 10
    And new check process network id is 1
    When client tries to add new check process
    Then exception '\Rummager\Service\Module\Exceptions\NotExistingModuleException' should be thrown
