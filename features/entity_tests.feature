Feature: Entity basic tests

  Scenario: Group can add and remove User
    Given I have a new Group entity
    And I have a new User entity
    When I add User to Group
    Then Group should contain User
    When I remove User from Group
    Then Group should NOT contain User

  Scenario: UserMeta key and value
    Given I have a new UserMeta entity
    When I set key to "theme"
    Then UserMeta key should be "theme"
    When I set value to "dark"
    Then UserMeta value should be "dark"

  Scenario: UserMeta user relation
    Given I have a new User entity
    And I have a new UserMeta entity
    When I set UserMeta's user to User
    Then UserMeta's user should be User

  Scenario: User can add and remove UserMeta
    Given I have a new User entity
    And I have a new UserMeta entity with key "color" and value "blue"
    When I add UserMeta to User
    Then User should have 1 UserMeta
    And UserMeta's user should be User
    When I remove UserMeta from User
    Then User should have 0 UserMeta
    And UserMeta's user should be null

  Scenario: User email, roles and nickname
    Given I have a new User entity
    When I set User email to "test@example.com"
    Then User email should be "test@example.com"
    When I set User roles to "ROLE_ADMIN"
    Then User roles should contain "ROLE_ADMIN"
    And User roles should contain "ROLE_USER"
    When I set User nickname to "tester"
    Then User nickname should be "tester"

  Scenario: Group name can be set and retrieved
    Given I have a new Group entity
    When I set Group name to "Admins"
    Then Group name should be "Admins"

  Scenario: User can have multiple roles
    Given I have a new User entity
    When I set User roles to "ROLE_ADMIN,ROLE_MODERATOR"
    Then User roles should contain "ROLE_ADMIN"
    And User roles should contain "ROLE_MODERATOR"
    And User roles should contain "ROLE_USER"

  Scenario: UserMeta key can be updated
    Given I have a new UserMeta entity with key "language" and value "en"
    When I set key to "locale"
    Then UserMeta key should be "locale"
    And UserMeta value should be "en"

  Scenario: UserMeta value can be updated
    Given I have a new UserMeta entity with key "timezone" and value "UTC"
    When I set value to "CET"
    Then UserMeta value should be "CET"
    And UserMeta key should be "timezone"

  Scenario: User nickname can be cleared
    Given I have a new User entity
    When I set User nickname to "tester"
    Then User nickname should be "tester"
    When I set User nickname to ""
    Then User nickname should be ""
