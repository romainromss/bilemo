@api_user
@api_add_user

Feature: I need to be able to add user
  Background:
    Given I load the following client :
      | username | name   | lastname |  password    | email          | b2b |
      | romain   | romain | romain   |  12345rege78 | blabla@car.com | sfr |

  Scenario: [Fail] Submit request without authentication.
    When I send a "GET" request to "/api/phones"
    Then the response status code should be 401
    And the JSON node "code" should be equal to 401
    And the JSON node "message" should be equal to "JWT Token not found"

  Scenario: [Fail] Submit request with invalid client id
    And client with username "romain" should have following id "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    When After authentication on url "/api/login_check" with method "POST" as username "romain" and password "12345rege78", I send a "POST" request to "/api/clients/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaab/users" with body:
    """
    {
    }
    """
    Then the response status code should be 403
    And the JSON node "message" should be equal to "vous ne pouvez pas ajouter cet utilisateur"

  Scenario: [Success] Submit request with valid payload
    And client with username "romain" should have following id "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    When After authentication on url "/api/login_check" with method "POST" as username "romain" and password "12345rege78", I send a "POST" request to "/api/clients/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa/users" with body:
    """
    {
      "name": "john",
      "lastname": "doe",
      "email": "johndoe@gmail.com",
      "cellphone": "0123456789"
    }
    """
    Then the response status code should be 201
    And the response should be empty