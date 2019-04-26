@api_user
@api_delete_user

Feature: I need to be able to delete user
  Background:
    Given I load the following client :
      | username | name   | lastname |  password    | email          | b2b |
      | romain   | romain | romain   |  12345rege78 | blabla@car.com | sfr |

  Scenario: [Fail] Submit request without authentication.
    When I send a "DELETE" request to "/api/clients/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa/users/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    Then the response status code should be 401
    And the JSON node "code" should be equal to 401
    And the JSON node "message" should be equal to "JWT Token not found"

  Scenario: [Fail] Submit request with authentication and invalid client id
    And client with username "romain" should have following id "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    When After authentication on url "/api/login_check" with method "POST" as username "romain" and password "12345rege78", I send a "DELETE" request to "/api/clients/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaab/users/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa" with body:
    """
    """
    Then the response status code should be 403
    And the JSON node "message" should be equal to "vous ne pouvez pas supprimer cet utilisateur"

  Scenario: [Success] Submit request with authentication, valid client's id and user id
    And client with username "romain" should have following id "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    And client have the following user:
      | name | lastname | email              | cellPhone  | client  |
      | john | doe      | johndoe@gmail.com  | 0010203040 | romain |
    And user with email "johndoe@gmail.com" should have following id "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    When After authentication on url "/api/login_check" with method "POST" as username "romain" and password "12345rege78", I send a "DELETE" request to "/api/clients/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa/users/aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa" with body:
    """
    """
    Then the response status code should be 204
