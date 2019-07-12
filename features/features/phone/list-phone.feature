@api_phone
@api_list_phone

Feature: I need to be able to get all phones
  Background:
    Given I load the following client :
      | username | name   | lastname |  password    | email          | b2b |
      | romain   | romain | romain   |  12345rege78 | blabla@car.com | sfr |

  Scenario: [Fail] Submit request without authentication.
    When I send a "GET" request to "/api/phones"
    Then the response status code should be 401
    And the JSON node "code" should be equal to 401
    And the JSON node "message" should be equal to "JWT Token not found"

  Scenario: [Fail] Submit request with authentication and without fixtures
    When After authentication on url "/api/login_check" with method "POST" as username "romain" and password "12345rege78", I send a "GET" request to "/api/phones" with body:
    """
    """
    Then the response status code should be 200
    And the response should be empty
    And the client with username "romain" should exist in database

  Scenario: [Success] Submit request with authentication and fixtures
    And I load fixture file "load.yml"
    When After authentication on url "/api/login_check" with method "POST" as username "romain" and password "12345rege78", I send a "GET" request to "/api/phones" with body:
    """
    {
    }
    """
    Then the response status code should be 200
    And the JSON node "phones" should exist
    And the client with username "romain" should exist in database