@api_user
@api_list_user

Feature: I need to be able to get all users from a client
  Background:
    Given I load the following client :
      | username | name   | lastname |  password    | email          | b2b |
      | romain   | romain | romain   |  12345rege78 | blabla@car.com | sfr |

  Scenario: [Fail] Submit request without authentication.
    When I send a "GET" request to "/api/clients/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa/users"
    Then the response status code should be 401
    And the JSON node "code" should be equal to 401
    And the JSON node "message" should be equal to "JWT Token not found"

  Scenario: [Fail] Submit request with invalid client id
    And client with username "romain" should have following id "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    When After authentication on url "/api/login_check" with method "POST" as username "romain" and password "12345rege78", I send a "GET" request to "/api/clients/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaab/users" with body:
    """
    """
    Then the response status code should be 403
    And the JSON node "message" should be equal to "vous ne pouvez pas consulter les utilisateurs"

  Scenario: [Success] Submit request with valid client id
    And client with username "romain" should have following id "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    And client have the following user:
      | name  | lastname | email            | cellPhone  | client  |
      | test1 | test1    | test1@gmail.com  | 0123456789 | romain  |
      | test2 | test2    | test2@gmail.com  | 0123456789 | romain  |
    When After authentication on url "/api/login_check" with method "POST" as username "romain" and password "12345rege78", I send a "GET" request to "/api/clients/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa/users" with body:
    """
    """
    Then the response status code should be 200