# API Overview

##Summary
The API takes a set of user input _n_ (where 1 ≤ _n_ ≤ 4), maps it to a set of RWS calls _m_, calls _m_ asynchronously, buffers the results _z_, and returns _z_ as a JSON object.

##Interface
###Selectors
User input consists of four variables (called "selectors") sent via GET:
- "pr", alphanumeric string to search for a record
- "prFlag" 3 character code for specifying desired type of __record__ for "pr" (asn,cus,net,org,poc)
- "se", alphanumeric string to create where-style conditions
- "seFlag", variable character code for specifying desired type of __field__ for "se" (depends on record type)

The order of selectors is ignored, but their **combination** is meaningful. Certain combinations are rejected (for ambiguity), but most are mapped to a REST queries.

###Parameters
Alongside selectors are two optional parameters: 
####boolean `hint` 
> `hint=1`, enabled, **default**

> `hint=0`, disabled

Toggles the hinting feature. When enabled, the Analyzer determines if the search input is "number" (IP address, customer ID number, etc.) or "name" type.  Once determined, certain RWS fields are _not_ queried (e.g. when query is of type "name", "number" fields are not queried).

Hinting reduces unnecessary calls to RWS.

####boolean `wildcard` 
> `wildcard=1`, enabled, **default**

> `wildcard=0`, disabled

Toggles the auto wildcard feature. When enabled, the Analyzer inspects whether or not a wildcard is present. If _not_ present, the Analyzer adds one to each query string.

Auto wildcards are a trade off. The benefit is they lower the chance of _all_ results returning 404 "not found" (i.e. where every RWS call returns 404). The cost is that they increase the chance of false positives. 

For example, if _disabled_, a search for `Dog` will _not_ return `DogLovers`, only `Dog Homes`. However, when _enabled_, the search `Dog` is transformed into `Dog*`, which will return both `DogLovers` and `Dog Homes`.

###What input does the API accept? reject?
- ACCEPT Any alphanumeric string 
- ACCEPT any string of 100 characters or less
- ACCEPT one or more wildcard `*` symbols in a string
- ACCEPT one or more dash `-` symbols in a string

...
- REJECT any non-alphanumeric characters (excluding `*` and `-`)
- REJECT a string longer than 100 characters

##Implementation

###Component Overview
The client makes a GET request to api.php, which creates a Query object. This object holds the query state. The query is passed down a pipeline of actions. Each action operates on the query's internal fields (mostly public arrays with no getters/setters). 

###Pipeline actions:
####Clean 
- Validate client input with **Respect/Validation**
- Reject on bad input
- Handle wildcards
- Handle spaces

####Analyze 
- Reject on ambivalent selector combinations
- Identify type of query (based on selector combination)
- Identify ARIN record/field targets for query (via AnalyzeLookUp class)

 
####Build 
- Create formatted query strings for ARIN RWS

####Run 
- Asynchronously send REST queries (with **Guzzle**)
- Receive and store responses
- Handle errors

####Transform 
- Aggregate responses into single JSON object
- Add header information

####Respond 
- On success, send JSON object back to client
- On failure, send headers and message back to client


