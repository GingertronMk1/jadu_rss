# Time

## Steps

### Step 1 - Objects and Relationships

The specification for this task called for two object models: the User and the RSS Feed (Feed).
A Feed should belong to a single User, this relationship is defined on Feed creation, and the creator should be the only User who can edit or delete a Feed.
If a User is deleted, so should all of their feeds, therefore a `User hasMany Feeds`.

The User should have a name and a unique means of logging in.
Using Laravel's default auth package gives us an email address/password combination for this.
The Feed should have a name, the URL of the feed, and an optional description should the user wish to add more detail about the purpose of the feed.

For testing purposes I created some database seeds to quickly generate a number of Users and Feeds based on the URLs provided by the task sheet.
With this foundation set up I moved on to parsing the RSS feeds.

### Step 2 - RSS Parsing

In order to get the data from the RSS feed I used the HTTP client introduced in Laravel 7.
Given that this is essentially just a wrapper around the Guzzle HTTP client I would have used Guzzle were it not available.
This returns an XML document, which must be parsed.
I did this initially using `simplexml_load_string`.

Before this test I had little experience of RSS feeds and their structure - initially I presumed they had some common layout, which for the first two examples was true; posts were found under the 'items' key.
However for the BBC feed this was not the case.
Here it was found under `channel->items`, and the posts contained no titles or descriptions, only links.
Looking at the page source in a web browser showed that the title and description of the posts was in some way protected by a `CDATA` declaration.
This meant that `simplexml_load_string` would not parse it correctly, so a different approach was required.

This different approach was to use the PHP DOMDocument model, which is similar in construction to the one used by JavaScript when accessing and manipulating DOM elements.
With it I could get all elements with a particular tag (in this case 'item'), and process them as a collection.
For each item I iterated over all of its child nodes to find the ones containing the title and description of that item.
I then added these to an array initiated before I began this loop.
The code for this can be found in `app/Http/Controllers/FeedController.php`.

### Step 3 - Adding, Updating, and Deleting

The final major component was the addition and modification of Feeds.
To do this I edited the `FeedController` file with the appropriate methods (create, store, edit, update, destroy), and their associated template files.
These can be found in `resources/views/feeds`, and are simple HTML/PHP forms built using Laravel's Blade templating system, so include error flashes for invalid data.

### Step 4 - Data Validation

The first additional step I took was to validate the data coming in, to ensure that all Feeds had names and URLs without just throwing an SQL error relating to a null column where there shouldn't be one.
Laravel provides an easy reusable method for this in the form of custom requests.
The custom request for a Feed is a FeedRequest, which can be found in `app/Http/Requests`.
It ensures 3 things:

1. A Feed has a name
2. A Feed has a URL
3. A Feed's URL is valid

The latter of these is done using Laravel's built-in URL validation.
A step I would take at some point is validating that the URL points to a valid RSS feed, however I do not know of any way to do that presently short of at every stage of updating the URL making a GET request to ensure that the data recieved can be parsed correctly.

### Step 5 - Testing

I user tested the application, first trying to add and edit new feeds with invalid data, then by comparing the output of the "show" view with that of the Google Chrome Extension [RSS Feed Reader](https://chrome.google.com/webstore/detail/rss-feed-reader/pnjaodmkngahhkoihejjehlcdlnohgmp/related?hl=en).
These matched up, with which I was satisfied that the view worked as intended.

## Breakdown

The bulk of my time in this project was spent understanding the structure and parsing of the XML document returned by the RSS URL.
I was initially unfamiliar with this structure, and my initial assumption that all documents followed the same layout were incorrect.
After some research I found the `DOMDocument` functionality in PHP, after which it became considerably more straightforward.
