=== Book Notes ===
Contributors: yourusername
Tags: books, notes, custom post type, shortcode, rest-api
Requires at least: 6.0
Tested up to: 6.6
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A simple plugin to manage book notes with custom post types, meta fields, shortcode, settings, and REST API.

== Description ==

Book Notes lets you add book reviews or notes with custom fields for *Author* and *Rating*.  
You can display them on the front-end using a shortcode and fetch them programmatically using a REST API endpoint.  

**Features:**
* Custom Post Type: `book_note`
* Custom Meta Fields: Author, Rating (1–5)
* Shortcode: `[book_notes min_rating="3" search="keyword"]`
* Settings Page: choose number of notes per page
* REST API: `/wp-json/book-notes/v1/notes?min_rating=4`

== Installation ==

1. Upload the `book-notes` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Add new Book Notes from the admin menu.
4. Insert `[book_notes]` shortcode into any post or page.

== Frequently Asked Questions ==

= How do I show only high-rated books? =
Use `[book_notes min_rating="4"]` to show only notes with rating 4 or above.

= How do I change items per page? =
Go to **Settings > Book Notes** and set the number.

== Screenshots ==

1. Admin list of Book Notes
2. Meta box for Author and Rating
3. Frontend display using shortcode
4. Settings page

== Changelog ==

= 1.0.0 =
* Initial release with CPT, meta fields, shortcode, settings page, and REST API.

== Upgrade Notice ==

= 1.0.0 =
First stable release.

== License ==

This plugin is free software; you can redistribute it and/or modify it under the terms of the GPLv2 or later.
