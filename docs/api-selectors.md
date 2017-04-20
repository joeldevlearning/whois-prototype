# Selectors
User input consists of four variables (called **"selectors"**) sent via GET:
- `pr`, primary search string (e.g. **"SomeCompany"**)
- `prFlag`, code to specify the type of record "pr" should match (an **"org"** matching **"SomeCompany"** ) 
- `se`, string that adds specificity to the primary search (an **"org"** matching **"SomeCompany"** WHERE )
- `seFlag`, code to specify the type of field "se" should match

---

### Selectors and Allowed Values 
| Selector | Allowed Values | Our Term | RWS Term  |
|:----------:|:---------|:---------|:---------|
| **pr** | alphanumeric string with `*` and/or `-` | primary |directly addressable "handle"
| **prflag** | three-letter ASCII code (predefined: asn,cus,net,org,poc) | primary record type |"first order object"
| **se** | alphanumeric string with  `*` and/or `-` | secondary | none
| **seflag** | variable-length ASCII code (predefined) | secondary record/field type | "field"
Case is ignored by the API, just as with Whois-RWS.


## Selector Side-Effects

### Combinations and Order
The order of selectors is ignored, but their **combination** is meaningful. Certain combinations are rejected (because of ambiguity). Acceptable combinations are mapped Whois-RWS queries.

### Complex Cases
The `se` and `seflag` act as conditions on the overall query. When both are set, `se` matches to the field defined by `seflag`. 

If only `se` is set, it's value is used to filter record results (returning records where any field matches `se`). 

Using `seflag` without `se` is ambigious and invalid. `seflag` sets the field for `se`; without a value to search for, the type of field is irrelevant (the API returns records, not individual fields.)

#### Multi-step Queries
Whois-RWS exposes some fields as indexes (we can query their contents). These we access with the `pr` (`primary`) selector. But most fields are not searchable. We access these with the `se` (`secondary`) selector.

Suppose the user selects for records using a  `secondary` field (like city or phone number). We support this with a multistep query: `fetch` results by a `primary` selector, then `filter` said results by a `secondary` selector.

#### Multiple Fetching Steps
In some cases we need _multiple_ `fetch` and `filter` steps. This happens when we must first inspect one type of record to glean information on the actual target records. 

For example, suppose we want to find IP addresses for a specific entity _SomeCompany_. We first `fetch` a set of records (org, customer, etc.) and `filter` these for references to net records. We then `fetch` for these net records, which we finally `return` to the client.

### List of Selector Combinations and Effects 
> `fetch` = call Whois-RWS

>`filter` = select subset of Whois-RWS results

>`return` = return results to the client

| Selector Combination | Effect | Example | Inverted Example  
|:----------:|:---------|:---------|:---------|
| **(pr)**                  | `fetch`-> `return` | find records for "Apple" | none
| **(pr,prflag)**           | `fetch`-> `return` | find org "Apple" | none
| **(pr,prflag,se)**        | `fetch`-> `filter`-> `fetch`-> `return` | find IP addresses for org "Apple" | find IP address "192.192.0.0" for "Apple"
| **(pr,prflag,se,seflag)** | `fetch`-> `filter`-> `return` | find record for org "Apple", where IP matches "192.192.0.0" | find IP address "192.192.0.0", where org matches "Apple" 
| **(pr,se)**               | `fetch`-> `filter`-> `fetch`-> `filter`-> `return` | find record for "Apple", where any field is "Cupertino" | none
| **(pr,se,seflag)**        | `fetch`-> `filter`-> `fetch`-> `return`| find record for "Apple", where IP matches "192.192.0.0" | find IP address, where organization matches "Apple"



## Invalid Selector Combinations
There are two cases for rejecting selector combinations.

1) Whois-RWS only indexes a few fields for each record. Thus all our queries **require** a `pr` selector. 

2) An `seflag` names a field to filter by. But without an `se`, we have no terms to filter with. 
 
At present, we favor rejecting badly formed queries rather than modifying them.

#### List of Invalid Selector Combinations
| Selector Combination | Effect | Reason
|:----------:|:---------|:---------|
| **(se)**              | `REJECT` | No `pr` to search for records
| **(prflag)**          | `REJECT` | No `pr` to search for records
| **(seflag)**          | `REJECT` | No `pr` to search for records
| **(prflag, seflag)**  | `REJECT` | No `pr` to search for records
| **(prflag, se)**      | `REJECT` | No `pr` to search for records
| **(se,seflag)**       | `REJECT` | No `pr` to search for records
| **(pr, seflag)**      | `REJECT` | `seflag` without `se` is ambigious

