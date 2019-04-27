
  Feature: Network

    Background:
      Given the following Networks Statuses exist:
        | id | name     |
        | 1  | todo     |
        | 2  | finished |
        | 3  | on hold  |
      Given the following Networks exist:
        | id | ip      | mask | status | description |
        | 1  | 1.1.1.0 | 24   |  2     |             |
        | 2  | 1.1.2.0 | 24   |  1     |             |
        | 3  | 1.1.3.0 | 24   |  3     |             |

    Scenario: Get Network to check
      When client asks for a network to check
      Then network id 2 should be returned

    Scenario: Get network
      When client asks for network with id: 2
      Then network id: 2 should be returned
        And ip should be '1.1.2.0'
        And mask should be 24
        And status id should be 1

    Scenario: Get network for not existing id
      When client asks for network with id: 9
      Then exception '\Rummager\Service\Network\Exceptions\NotExistingNetworkException' should be thrown

    Scenario: Set Network status
      When client changes status of the network with id 2 to status id 2
       And client asks for network with id: 2
      Then network id: 2 should be returned
       And status id should be 2

    Scenario: Try to get Network to check when there is no network with TODO status
      When client changes status of the network with id 2 to status id 2
       And client asks for a network to check
      Then exception '\Rummager\Service\Network\Exceptions\NoNetworkToCheckException' should be thrown

    Scenario: Get network for ip: 1.1.1.0 and mask 255.255.255.0
      When client asks for network with ip '1.1.1.0' and mask 24
      Then network id: 1 should be returned

    Scenario: Get network for not existing ip and mask
      When client asks for network with ip '9.9.9.0' and mask 8
      Then exception '\Rummager\Service\Network\Exceptions\NotExistingNetworkException' should be thrown
