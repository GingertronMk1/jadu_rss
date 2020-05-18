# RSS Bookmarking Tool

### Official Specification

- [/] Allow a user to enter a new RSS Feed link and add this to a database
- [/] List all current RSS Feeds held within the database
- [ ] Allow each RSS Feed link to be updated and/or deleted
- [ ] Fetch and display the contents of a single RSS Feed at a time (i.e. parse the contents of the
feed and present it to the user)

### Structure

There are 2 classes:

- `User`
- `Feed`

A `User` can have many `Feed`s, and a `Feed` can belong to a single `User`.
The `User` can create new `Feed`s.
