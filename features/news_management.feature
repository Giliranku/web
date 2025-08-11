Feature: News Management and User View

Scenario: Admin creates a news item with cover image
Given an authenticated admin is on the news creation page
When the admin submits a title description keywords category and cover image
Then the news item should be created
And the cover should be stored and accessible

Scenario: Admin edits a news item
Given an existing news item
When the admin updates the title and description
Then the news item should reflect the new content

Scenario: Admin deletes a news item
Given an existing news item
When the admin deletes the item
Then the news item should no longer be visible to users

Scenario: User filters news by category
Given there are news items across multiple categories
When the user filters by category Promo Spesial
Then only news with the promo category should be listed

Scenario: User searches news by keyword
Given news items with keywords are available
When the user searches with a keyword
Then results should match title description or keywords

Scenario: User opens news detail page
Given a published news item
When the user clicks read more on the card
Then the user should see the full content with date and cover
