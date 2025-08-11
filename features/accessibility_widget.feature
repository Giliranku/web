Feature: Accessibility Widget and Preferences

Scenario: Toggle dark mode from accessibility widget
Given the page is loaded
When the user toggles dark mode in the widget
Then the data-bs-theme should switch between light and dark

Scenario: Increase font size via accessibility controls
Given the default font scale is 1
When the user increases font size twice
Then the CSS variable --accessibility-font-scale should be 1.2
And the body text should appear larger

Scenario: Enable dyslexic-friendly font
Given the default font family is the system font
When the user activates the dyslexic font option
Then elements outside the accessibility widget should use OpenDyslexic
And elements inside the widget should keep their font size

Scenario: High contrast mode updates colors
Given the user enables high contrast mode
When the mode is active
Then background and text colors should meet contrast standards

Scenario: Reduced motion preference disables animations
Given the user prefers reduced motion
When the page loads
Then pulse animations should be disabled
