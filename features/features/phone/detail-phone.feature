@api_phone
@api_detail_phone

Feature: I need to be able to get phone's detail
  Background:
    Given I load the following client :
      | username | name   | lastname |  password    | email          | b2b |
      | romain   | romain | romain   |  12345rege78 | blabla@car.com | sfr |
    And I load this phone :
      | name   | description      | memory   |  brand    | os      |
      | galaji | new best phone   | ['test'] |  Peach    | android |

  Scenario: [Fail] Submit request without authentication.
    When I send a "GET" request to "/api/phones/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    Then the response status code should be 401
    And the JSON node "code" should be equal to 401
    And the JSON node "message" should be equal to "JWT Token not found"

  Scenario: [Fail] Submit request with invalid phone id
    And phone with name "galaji" should have following id "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    When After authentication on url "/api/login_check" with method "POST" as username "romain" and password "12345rege78", I send a "GET" request to "/api/phones/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaaa" with body:
    """
    """
    Then the response status code should be 404

  Scenario: [Success] Submit request with authentication and valid phone id
    And phone with name "galaji" should have following id "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    When After authentication on url "/api/login_check" with method "POST" as username "romain" and password "12345rege78", I send a "GET" request to "/api/phones/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa" with body:
    """
    {
    }
    """
    Then the response status code should be 200
    And the JSON node "id" should be equal to "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    And the JSON node "name" should be equal to "galaji"
    And the JSON node "description" should be equal to "new best phone"
    And the JSON node "brand" should be equal to Peach
    And the JSON node "os" should be equal to android