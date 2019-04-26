@api_user
@api_detail_user

Feature: I need to be able to get one user from a client
  Background:
    Given I load the following client :
      | username | name   | lastname |  password    | email              | b2b    |
      | romain   | romain | romain   |  12345rege78 | blabla@car.com     | sfr    |
      | bad      | client | test     |  12345rege78 | badclient@test.com | orange |
    And client have the following user:
      | name  | lastname | email            | cellPhone  | client  |
      | test1 | test1    | test1@gmail.com  | 0123456789 | romain  |

  Scenario: [Fail] Submit request without authentication.
    When I send a "GET" request to "/api/clients/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa/users/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    Then the response status code should be 401
    And the JSON node "code" should be equal to 401
    And the JSON node "message" should be equal to "JWT Token not found"

  Scenario: [Fail] Submit request with bad client id
    And client with username "romain" should have following id "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    And user with email "test1@gmail.com" should have following id "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    When After authentication on url "/api/login_check" with method "POST" as username "bad" and password "12345rege78", I send a "GET" request to "/api/clients/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaaa/users/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa" with body:
    """
    """
    Then the response status code should be 403
    And the JSON node "message" should be equal to "vous ne pouvez pas consulter cet utilisateur"

  Scenario: [Fail] Submit request with bad user id
    And client with username "romain" should have following id "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    And client have the following user:
      | name  | lastname | email            | cellPhone  | client  |
      | test2 | test2    | test2@gmail.com  | 0123456789 | romain  |
    And user with email "test2@gmail.com" should have following id "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    When After authentication on url "/api/login_check" with method "POST" as username "romain" and password "12345rege78", I send a "GET" request to "/api/clients/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaab/users/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaadd" with body:
    """
    """
    Then the response status code should be 404

  Scenario: [Success] Submit request with valid client's id and user id
    And client with username "romain" should have following id "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    And client have the following user:
      | name  | lastname | email            | cellPhone  | client  |
      | test3 | test3    | test3@gmail.com  | 0123456789 | romain  |
    And user with email "test3@gmail.com" should have following id "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaccc"
    When After authentication on url "/api/login_check" with method "POST" as username "romain" and password "12345rege78", I send a "GET" request to "/api/clients/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaab/users/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaccc" with body:
    """
    """
    Then the response status code should be 200
    And the JSON node "id" should be equal to "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaccc"
    And the JSON node "name" should be equal to "test3"
    And the JSON node "lastname" should be equal to "test3"
    And the JSON node "email" should be equal to "test3@gmail.com"
