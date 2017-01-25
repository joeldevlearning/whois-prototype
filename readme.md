# whois-prototype

###Experimental client and api for ARIN's whois REST API

##Purpose
Prototype the features of a search-friendly interface to ARIN's whois REST API. 

###**Goals**:
1. **Fully support** ARIN's public REST API (the user should be able to make any query, or its equivalent, that the API supports)

2. **Simplify calling** the API (The user should not need to know the details of the API or dataset to make their query)

3. Support **exploration** of the API (Query results should show explicit relationships between records; the UI should allow the user to browse these related records)

##Design
Currently an **HTML/bootstrap3** frontend, **JQuery** for UI tasks, and a **PHP/Guzzle** backend generating, running, and returning collection results. The API wrapper takes priority, so the UI is thin for now.  

##Core Features
- Expose ARIN's whois database using four basic search controls.
- Analyze user input of varying length and ambiguity to generate multiple API calls.

###Wishlist Features
- Group similar entities together in search results
- Interactive feedback for parsing errors in formatting (e.g. of IP addresses)
- As-you-type searches to check for any results
- Search suggest features
- Graphical tree of entities by IP address blocks
- Support wildcards for all queries (including IP addresses)
- Support for domain names (combining DNS and ARIN results)
- Overcome query limits (255 records per query) and offer pagination

###ARIN documentation
ARIN's website already features a [whois search form](https://www.arin.net/) (and an [advanced search](https://whois.arin.net/ui/advanced.jsp)), which offers some conveniences beyond the basic API (e.g. searching multiple record types at once). Unfortunately the search form uses internal, unreleased code. Many of the prototype's features are inspired by the web interface, and this project's goals are to overcome some of its limitations.

ARIN's whois REST API features can be found at: https://www.arin.net/resources/whoisrws/index.html

##Caveats
This project has no relationship to ARIN, It is a personal learning project.