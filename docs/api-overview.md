# API Overview

## Summary
The API acts as a facade to [Whois-RWS](https://www.arin.net/resources/whoisrws/). 

It accepts a set of user input _n_ (where 1 ≤ _n_ ≤ 4), maps it to a set of RWS calls _m_, calls _m_ asynchronously, buffers the results _z_, and returns _z_ as a JSON object.

Results are always records, never individual fields.

## Interface
###Selectors
User input consists of four variables (called **"selectors"**) sent via GET:
- `pr`, primary search string (e.g. **"SomeCompany"**)
- `prFlag`, code to specify the type of record "pr" should match (an **"org"** matching **"SomeCompany"** ) 
- `se`, string that adds specificity to the primary search (an **"org"** matching **"SomeCompany"** WHERE )
- `seFlag`, code to specify the type of field "se" should match

#### Summary of Valid/Invalid Input
The API respects the following rules for `pr` and `se` selectors:
- ACCEPT Any alphanumeric string 
- ACCEPT any string of 100 characters or less
- ACCEPT one or more wildcard `*` symbols in a string
- ACCEPT one or more dash `-` symbols in a string


- REJECT any non-alphanumeric characters (excluding `*` and `-`)
- REJECT a string longer than 100 characters

[More details about Selectors](api-selectors.md/)

---
### Parameters
Alongside selectors are two optional parameters: 

#### boolean `wildcard` 
> `wildcard=1`, enabled, **default**

> `wildcard=0`, disabled

Toggles the auto wildcard feature. When enabled, the Analyzer inspects whether or not a wildcard is present. If _not_ present, the Analyzer adds one to each query string.

Auto wildcards are a trade off. The benefit is they lower the chance of _all_ results returning 404 "not found" (i.e. where every RWS call returns 404). The cost is that they increase the chance of false positives. 

For example, consider the set of two records `{DogLovers, Dog Homes}`. If auto wildcards are _disabled_, a search for `Dog` will _not_ return `DogLovers` (no space), only `Dog Homes` (with a space). However, when _enabled_, the search `Dog` is transformed into `Dog*`, which will return both `DogLovers` and `Dog Homes`.

Exactly phrased queries may want to disable auto wildcards.

#### boolean `raw` 
> `hint=1`, enabled

> `hint=0`, disabled, **default**

Toggles the raw-results feature. When enabled, the Transformer leaves Whois-RWS JSON unformatted. The client still receives a single JSON body with an API wrapper, but the nested contents are raw Whois-RWS JSON.

Raw-results allows a client that understands Whois-RWS JSON to consume it normally (once the outer wrapper is removed).

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


