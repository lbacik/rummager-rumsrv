
Feature: Add Host

  Background:
    Given the following hosts exist:
      | id | name       |
      |  1 | oldone.com |

  Scenario: Add not existent host
    Given set host name to example.com
    When client tries to add host
    Then host should be added successfully
      And host name value is example.com
      And host n value is 1
      And host t value is 1
      And host s value is 0
      And host create timestamp has been set properly

  Scenario: Client tries to add existing host
    Given set host name to oldone.com
    When client tries to add host
    Then Exception '\Doctrine\DBAL\Exception\UniqueConstraintViolationException' should be thrown / AddHostContext

  Scenario: Add not existent host with n value
    Given set host name to example.com
      And set host n to 4
    When client tries to add host
    Then host should be added successfully
      And host name value is example.com
      And host n value is 4
      And host t value is 1
      And host s value is 0

  Scenario: Add not existent host with n and t values
    Given set host name to example.com
     And set host n to 4
     And set host t to 5
    When client tries to add host
    Then host should be added successfully
     And host name value is example.com
     And host n value is 4
     And host t value is 5
     And host s value is 0

  Scenario: Add not existent host with n, t and s values
    Given set host name to example.com
     And set host n to 4
     And set host t to 5
     And set host s to 6
    When client tries to add host
    Then host should be added successfully
     And host name value is example.com
     And host n value is 4
     And host t value is 5
     And host s value is 6
