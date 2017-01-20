# whois-prototype

###Experimental client and api for ARIN's whois REST API

##Purpose
Prototype the features of a friendlier wrapper to ARIN's whois API. 

###**Goals**:
1. **Fully support** the API (the user should be able to make any query, or its equivalent, that the API supports)

2. **Simplify calling** the API (The user should not need to know the details of the API or dataset to make their query)

3. Support **exploration** of the API (Query results should show explicit relationships between records; the UI should allow the user to browse these related records)

##Design
An **HTML/bootstrap3** frontend, **JQuery** for UI tasks, and a **PHP/Guzzle** backend generating, running, and returning collection results. The API wrapper takes priority, so the UI is thin for now.  

##Planned Features
- A minimal search form for all queries, supporting variable amounts of input  
- Search multiple record types and fields simultaneously
- Handle ambiguous input (spacing, wildcards, etc.)
- Return only active links to related records

###Wishlist Features
- Group similar entities together in search results
- Interactive feedback for parsing errors in formatting (e.g. of IP addresses)
- As-you-type searches to check for any results
- Search suggest features
- Graphical tree of entities by IP address blocks
- Support wildcards for all queries (including IP addresses)
- Support for domain names (mixing results from another API with ARIN's)
- Overcome query limits (255 records per query) and offer pagination

###ARIN documentation
ARIN's website already features a [whois search form](https://www.arin.net/) (and an [advanced search](https://whois.arin.net/ui/advanced.jsp)), which offers some conveniences beyond the basic API (e.g. searching multiple record types at once). Unfortunately the search form uses an internal, undocumented API. 

ARIN's whois REST API features can be found at: https://www.arin.net/resources/whoisrws/index.html

##Caveats
This project has no relationship to ARIN, It is a personal learning project to sketch out some features.