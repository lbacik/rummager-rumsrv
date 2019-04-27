Feature: Rummager Repository

  Background:
    Given the following hosts exist:
        | id | name           |
        |  1 | example.com    |
        |  2 | rummager10.net |
    And the following nodes exist:
        | id | hid |
        |  5 | 1   |
        |  6 | 2   |

  Scenario: Retrieve host when providing a name
    When client tries to get host's entity passing name rummager10.net
    Then repository should return '\Rummager\Service\Host\Host' entity with id 2

  Scenario: Retrieve host when providing a not existent name
    When client tries to get host's entity passing name ahost.net
    Then repository should throw exception: '\Rummager\Service\Host\Exceptions\NotExistingHostException'

  Scenario: Retrieve host when providing host id
    When client tries to get host's entity passing id 1
    Then repository should return '\Rummager\Service\Host\Host' entity with name example.com

  Scenario: Retrieve host when providing a not existing host id
    When client tries to get host's entity passing id 99
    Then repository should throw exception: '\Rummager\Service\Host\Exceptions\NotExistingHostException'

  Scenario: Retrieve node when providing node id
    When client tries to get node's entity passing id 6
    Then repository should return '\Rummager\Service\Node' entity with host.id 2

  Scenario: Retrieve node when providing a not existing node id
    When client tries to get node's entity passing id 99
    Then repository should throw exception: '\Rummager\Service\Host\Node\Exceptions\NotExistingNodeException'
