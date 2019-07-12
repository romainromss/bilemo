@api_client
@api_login

Feature: I need to login to api and obtain token
  Background:
    Given I load the following client :
      | username | name   | lastname |  password    | email          | b2b |
      | romain   | romain | romain   |  12345rege78 | blabla@car.com | sfr |

  Scenario: [Fail] I submit request with bad credential.
    When I send a "POST" request to "/api/login_check" with username "jhonDoe" and password "passphrase"
    Then the response status code should be 401
    And the JSON node "code" should be equal to 401
    And the JSON node "message" should be equal to "Bad credentials"

  Scenario: [Submit] I submit request with valid credential.
    When I send a "POST" request to "/api/login_check" with username "romain" and password "12345rege78"
    Then the response status code should be 200
    And the JSON node "token" should exist