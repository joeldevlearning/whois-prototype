# whois-prototype

###Experimental client and api for ARIN's RESTful whois service

##Purpose
Prototype the features of a search-friendly interface to ARIN's whois REST service. 

###**Goals**:
1. **Fully support** ARIN's public REST API (the user should be able to make any query, or its equivalent, that the API supports)

2. **Simplify calling** the API (The user should not need to know the details of the API or dataset to make their query)

3. Support **exploration** of the API (Query results should show explicit relationships between records; the UI should allow the user to browse these related records)

##Core Features
- Expose ARIN's whois database using four basic search controls.
- Analyze user input of varying length and ambiguity to generate multiple API calls.

###Wishlist Features 
- Group similar entities together in search results
- Interactive feedback for parsing errors in formatting (e.g. of IP addresses)
- As-you-type search suggest
- Graphical tree of entities by IP address blocks
- Support wildcards for all queries (including IP addresses)
- Support for domain names (combining DNS and ARIN results)
- Overcome query limits (255 records per query) and offer pagination

##Technical Details

###Overview
The client makes a POST request to api.php, which creates a query object. This object stores the user input and all state. The query is passed down a pipeline of actions. Each action operates on the query's internal fields (mostly public arrays with no getters/setters). Pipeline actions include:
1.	**Clean** (validate client input)
2.	**Analyze** (identify type of query, determine which REST records and fields to target)
3.	**Build** (create REST queries)
4.	**Run** (asynchronously send REST queries and receive responses)
5.  **Transform** (modify received data)
6.	**Respond** (send data back to client)

###Dependencies
Currently an **HTML/bootstrap3** frontend, **JQuery** for UI tasks, and a **PHP/Guzzle** backend generating, running, and returning collection results. The API wrapper takes priority, so the UI is thin for now.  

###ARIN documentation
ARIN's website already features a [whois search form](https://www.arin.net/) (and an [advanced search](https://whois.arin.net/ui/advanced.jsp)), which offers some conveniences beyond the basic API (e.g. searching multiple record types at once). Unfortunately the search form uses internal, unreleased code. Many of the prototype's features are inspired by the web interface, and this project's goals are to overcome some of its limitations.

ARIN's whois REST API features can be found at: https://www.arin.net/resources/whoisrws/index.html

##Disclaimer
This project has no relationship to ARIN, It is a personal learning project.