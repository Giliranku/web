Feature: Staff Dashboard Layout and Sidebar Behavior

Scenario: Sidebar remains scrollable on small viewport heights
Given a staff user is on the attraction dashboard
When the viewport height is small
Then the sidebar should enable vertical scrolling
And the content should not overflow horizontally

Scenario: Sidebar z-index is above page content
Given a staff user opens the sidebar menu
When overlays like dropdowns appear
Then the sidebar should remain visible above content

Scenario: Sidebar active state reflects current route
Given a staff user navigates to the queue history
When the page is loaded
Then the corresponding sidebar item should be active

Scenario: Sidebar collapse and expand with Alpine store
Given the sidebar is expanded
When the user clicks the collapse toggle
Then the sidebar should collapse and show only icons
And when clicked again it should expand to show labels
