# API Overview

## Summary
The API acts as a facade to [Whois-RWS](https://www.arin.net/resources/whoisrws/). 

It accepts a set of user input _n_ (where 1 ≤ _n_ ≤ 4 variables),  to a set of RWS calls _m_, calls _m_ asynchronously, and serializes the results as JSON.

## API Terms
| **Term** | **Explanation**|**Example**|
|:----------:|:---------|:---------|
| **RWS** | ARIN's [RESTful Web Service](https://www.arin.net/resources/whoisrws/) for whois services over HTTP.  
| **Selector** | Our term for a search string that we use to query RWS. 
| **Flag** |  Our term for the kind of entity that a search string targets.

||||
|:----------:|:---------|:---------|
| **Primary Selector** (`pr`) |  The first search string entered. Matching this term is given priority over the secondary. | SEARCH FOR `primary`
| **Primary Flag** (`prflag`) |  The predefined type to match the primary against. Adds constraint to fulfilling the primary. | SEARCH FOR `primary` WHERE `primary=TYPE`
| **Secondary Selector** (`se`)  | An additional search string; given lower priority than the primary. | SEARCH FOR `primary` AND `secondary`
| **Secondary Flag** (`seflag`) |  The predefined type to match the secondary against. Adds a constraint on using the secondary. | SEARCH FOR `primary` AND `secondary` WHERE `secondary=TYPE`

---
### Overview of Query Types
The API supports the following kinds of queries:
- search for `SomeCompany` (use `pr=SomeCompany`)
- search for `SomeCompany` where `SomeCompany is an organization` (use `pr=SomeCompany & prflag=org`)
- search for `SomeCompany` and `Doe` where `SomeCompany is an organization` (use `pr=SomeCompany & prflag=org & se=Doe`)
- search for `SomeCompany` and `Doe` where `SomeCompany is an organization, Doe is a point of contact` (use `pr=SomeCompany & prflag=org & se=Doe`)

---
## Examples of Using the API
### Simple Example
Suppose you want to find the IP addresses of **SomeCompany**. 

In the RWS model, SomeCompany could be match an "organization", a "customer", or both. Therefore you need to look at multiple RWS routes, find the IP ranges associated with each result, aggregate the results.

Because of the way RWS associates IP addresses with entities, you must make at least three queries to cover ARIN's dataset (notice the wildcard *):
- "rest/customers" for `SomeCompany*`
- "rest/organizations" for `SomeCompany*`
- "rest/nets" for `SomeCompany*`

Our API allows you to make one query:
- `pr=SomeCompany & prflag=ip`

This query can be thought of as: SELECT `IP addresses` WHERE `NAME = SomeCompany`. It will transparently map to multiple RWS calls, scrap IP addresses, and aggregate the results.

### Complex Example
Suppose you are familiar with the RWS model. You are interested in a specific point of contact (i.e. person) with the last name "Doe". Doe is associated with an organization whose name includes the string "Something".

You would need to make several RWS in the following sequence:
    1) query "rest/organizations" for "Something"
    2) query rest/pocs for each result of #1
    3) manually filter the results of #2, looking for "Doe" 

Our API allows you to make one query:
- `pr=Doe & prflag=poc & se=Something & seflag=org`

This query can thought of as: SELECT `Point of Contact` WHERE `NAME = Doe` AND `ORG = Something`. Internally, the API works in two stages to fulfill this query (replicating the manual steps above).

### Further Analysis
An alternative to the above "complex" query is the following:
- `pr=Doe & prflag=poc & se=Something`

This alternative query forces the API to guess what `Something` might be. The API will first query all records that can contain a point of contact (including organizations). Then it will then scrap the results for point of contact links, follow these links, and finally return only those links that match "Doe".  

### Coordinating Primary and Secondary
In some cases you want to search one type of record (or entity) by matching two of its fields (where the primary matches one field, the secondary the other). For example, say that you want to find the point of contact `Doe` who works for `SomeCompany` (which is __not__ equivalent to "Doe is the point of contact FOR AnotherCompany).

To do this, set both the primary and secondary flag to the same type, like so:
- `pr=Doe & prflag=poc & se=Something & seflag=poc`

The API interprets this to mean that the primary and secondary strings need to match the SAME point of contact - the API will ignore other types of records and try to match one record with a one field matching `Doe` and another matching `Something`. Internally the API will first search poc records for `Doe` and, if successful, look within them for `Something`. At the same time, the API will also search for the reverse: poc records matching `Something` that contain `Doe`.

---
## Selectors
[More details about Selectors](api-selectors.md/)

---
## Parameters
[About Parameters](api-parameters.md/)

