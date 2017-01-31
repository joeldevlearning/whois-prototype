# API Overview

##Interface
Four variables ("selectors") sent via GET:
- "pr", alphanumeric string to search for a record
- "prFlag" 3 character code for specifying desired type of __record__ for "pr" (asn,cus,net,org,poc)
- "se", alphanumeric string to create where-style conditions
- "seFlag", variable character code for specifying desired type of __field__ for "se" (depends on record type)

The order of selectors is ignored, but their **combination** is meaningful. Certain combinations are rejected (for ambiguity), but most are mapped to a REST queries.

###What input does the API accept? reject?
- ACCEPT Any alphanumeric string 
- ACCEPT any string of 100 characters or less
- ACCEPT a single wildcard at the string's end (subject to change)

- REJECT a wildcard that is not at the string's end (subject to change)
- REJECT any non-alphanumeric characters
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
- Asynchronously send REST queries
- Receive and store responses
- Handle errors

####Transform 
- Aggregate responses into single JSON object
- Add header information

####Respond 
- On success, send JSON object back to client
- On failure, send headers and message back to client


