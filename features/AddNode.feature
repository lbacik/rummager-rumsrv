
Feature: Add Node

  Background:
    Given the following hosts exist:
      | id | name       | t |
      |  1 | oldone.com | 2 |
    And the following nodes exist:
      | id | hid |
      |  5 | 1   |

  Scenario: Add new node
    When worker tries to add node for host id: 1
    Then node should be added successfully
      And node hid is 1
      And node create timestamp has been set properly
#      And node status should be ...

  Scenario: Add new node for not existent host
    When worker tries to add node for host id: 2
    Then Exception '\Rummager\Service\Host\Exceptions\NotExistingHostException' should be thrown / AddNodeContext
