# whois-prototype

### Experimental client and API for ARIN's RESTful whois service

# Purpose
To prototype the features of a search-friendly interface to ARIN's whois REST service (known as **Whois RWS**). 

#### Why a prototype?
This is a learning project: Discover features, try to implement them, and experiment. The choice of languages, libraries, etc. are part of this effort.  

### **Goals**:
1. **Fully support** ARIN's Whois-RWS API (the user should be able to make any query, or its equivalent, that the API supports)

2. **Simplify calling** the Whois-RWS API (The user should not need to know the details of the API or dataset to make their query)

3. **Support exploration** of ARIN's data (Query results should show explicit relationships between records; the UI should allow the user to browse these related records)

# Demo
Try the online demo: 
http://who.nfshost.com
# Documentation
[API overview](docs/api-overview.md)

## Feature set

#### Client Features
||
|:-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| - Four search controls to vary specificity 
| - As-you-type feedback 
| - Warn on formatting mistakes 
| - Formatting cues for specific types of records and fields 
| - Group related search results together by entity, IP block, etc., 
| - Browse related records from a single search result |

#### API Features
||
|:-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| - Generate multiple RWS calls from a single query 
| - "hint" feature to avoid unnecessary RWS calls 
| - "auto-wildcard" feature to lower chance of 404 returns |

#### Wishlist
(unlikely to implemented)

| Client | API  |
|:-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|:----------------------------------------------------------------------------------------------------------------------------------------------------------|
| - Support wildcards for all queries (including IP addresses) | - Support for domain names (combining DNS and ARIN results); Overcome RWS query limits (255 records per query) |


### Dependencies
Currently an **HTML/bootstrap3** frontend, **JQuery** for UI tasks, and a **PHP7/Guzzle** backend generating, running, and returning collection results. The API wrapper takes priority, so the UI is thin for now.  

### ARIN documentation
ARIN's website already features a [whois search form](https://www.arin.net/) (and an [advanced search](https://whois.arin.net/ui/advanced.jsp)), which offers some conveniences beyond the basic API (e.g. searching multiple record types with one a single query). Unfortunately the search form uses internal, unreleased code. Many of the prototype's features are inspired by the web interface, and this project's goals are to overcome some of its limitations.

ARIN's whois REST API features can be found at: https://www.arin.net/resources/whoisrws/index.html

# Disclaimer
This project has no relationship to ARIN. It is a personal learning project.
