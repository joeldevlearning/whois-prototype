# API Overview

## Implementation

### Component Overview
The client makes a GET request to api.php, which creates a Query object. 
This object holds the query state.
The query is passed down a pipeline of actions. 
Each action operates on the query's internal fields (mostly public arrays with no getters/setters). 

### Pipeline actions:
#### Clean 
- Validate client input with **Respect/Validation**
- Reject on bad input
- Handle wildcards
- Handle spaces

#### Analyze 
- Reject on "bad" queries (with ambiguous combinations of selector)
- Identify type of query (based on selector combination)
- Identify ARIN record/field targets for query (via AnalyzeLookUp class)

 
#### Build 
- Choose correct syntax for each query
- Create formatted query strings for Whois-RWS

#### Request
- Asynchronously send REST queries (with **Guzzle's** Promise API)
- Receive and store responses
- Handle errors

#### Transform 
- Strip unneeded JSON values
- Aggregate responses into single JSON object
- Add header information

#### Respond 
- On success, send JSON string and message back to client
- On failure, send headers and message back to client


