
Feature: Module Smtp

  Background:
    Given the following hosts exist:
      | id | name        |
      | 1  | example.com |
    And the following nodes exist:
      | id | hid |
      | 10 | 1   |
      | 11 | 1   |
    And the following modules exist:
      | id | name    | result_tab |
      | 1  | smtp    | smtp        |
      | 2  | sender  | sender      |
    And  the following Networks Statuses exist:
      | id | name     |
      | 1  | todo     |
      | 2  | finished |
      | 3  | on hold  |
    And the following Networks exist:
      | id | ip      | mask | description | status |
      | 1  | 1.1.1.0 | 24   |             | 1      |
      | 2  | 1.1.2.0 | 24   |             | 1      |
      | 3  | 1.1.3.0 | 24   |             | 1      |
    And the following checks exist:
      | id | node | net  | module |
      | 20 | 10   | null | 2      |
      | 21 | 11   | 1    | 1      |
      | 22 | 11   | 2    | 1      |
      | 23 | 11   | 3    | 1      |
    And the following records in smtp table exist:
      | id | check | ip_decoded |
      | 1  | 21    | 1.1.1.1    |
      | 2  | 21    | 1.1.1.2    |
      | 3  | 21    | 1.1.1.3    |
      | 4  | 22    | 1.1.2.1    |
      | 5  | 22    | 1.1.2.3    |
      | 6  | 23    | 1.1.3.100  |


  Scenario: Get last ip (1)
    When client asks for last ip for network with ip '1.1.1.0' and broadcast '1.1.1.255'
    Then ip '1.1.1.3' should be returned

  Scenario: Get last ip (2)
    When client asks for last ip for network with ip '1.1.2.0' and broadcast '1.1.2.255'
    Then ip '1.1.2.3' should be returned

  Scenario: Get last ip (3)
    When client asks for last ip for network with ip '1.1.3.0' and broadcast '1.1.3.255'
    Then ip '1.1.3.100' should be returned

  Scenario: Get last ip for not existing network
    When client asks for last ip for network with ip '9.9.9.0' and broadcast '9.9.255.255'
    Then exception '\Rummager\Service\Module\Smtp\Exceptions\NoDataException' should be thrown

  Scenario: Add data
    Given Smtp Module Data check id is 21
      And Smtp Module Data ip is '1.1.1.4'
    When client tries to add Smtp Module Data
    Then Smtp Module Data shoule be added successfully
     And Smtp Module record create timestamp should be set properly
