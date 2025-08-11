Feature: Universal Ticket Queue Management

Scenario: Join attraction queue with universal ticket
Given a user has a valid park entry ticket
When the user requests to join the Roller Coaster queue
Then a new UserAttraction record should be created with status waiting
And the queue_position should be assigned at the end of the queue

Scenario: Join restaurant queue with universal ticket
Given a user has a valid park entry ticket
When the user requests to join the Burger House queue
Then a new UserRestaurant record should be created with status waiting
And the queue_position should be assigned at the end of the queue

Scenario: Staff calls next guest in attraction queue
Given an authenticated staff owns the attraction
When the staff calls the next number
Then the next waiting reservation should change to called
And the queue positions should be recalculated for remaining waiting users

Scenario: Complete service and mark as served
Given a called reservation exists for an attraction
When the staff marks the reservation as served
Then the reservation status should change to served
And the queue positions should be recalculated

Scenario: Cancel a queue reservation by user
Given a user has a waiting reservation in an attraction
When the user cancels the reservation
Then the reservation status should change to cancelled
And other waiting users should keep correct positions

Scenario: Prevent joining multiple active queues in same location
Given a user already has a waiting reservation in a specific attraction
When the user tries to join the same attraction again
Then the request should be rejected
And an informative message should be shown

Scenario: Allow joining different attractions with the same ticket
Given a user has a valid park ticket
When the user joins two different attractions
Then both reservations should be created
And ticket quantities are not consumed

Scenario: Staff authorization is enforced for queue actions
Given a staff with session staff_id 10
When the staff tries to manage another attraction not owned by them
Then the action should be denied
And an authorization error should be shown
