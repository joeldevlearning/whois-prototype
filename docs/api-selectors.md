#Selectors
User input consists of four variables (called **"selectors"**) sent via GET:
- `pr`, primary search string (e.g. **"SomeCompany"**)
- `prFlag`, code to specify the type of record "pr" should match (an **"org"** matching **"SomeCompany"** ) 
- `se`, string that adds specificity to the primary search (an **"org"** matching **"SomeCompany"** WHERE )
- `seFlag`, code to specify the type of field "se" should match

---

###Selectors and Allowed Values 
| Selector | Allowed Values | Our Term | RWS Term  |
|:----------:|:---------|:---------|:---------|
| **pr** | alphanumeric string with `*` and/or `-` | primary |directly addressable "handle"
| **prflag** | three-letter ASCII code (predefined: asn,cus,net,org,poc) | primary record type |"first order object"
| **se** | alphanumeric string with  `*` and/or `-` | secondary | none
| **seflag** | variable-length ASCII code (predefined) | secondary record/field type | "field"
Case is ignored by the API, just as with Whois-RWS.


##Selector Side-Effects

###Combinations and Order
The order of selectors is ignored, but their **combination** is meaningful. Certain combinations are rejected (because of ambiguity). Acceptable combinations are mapped Whois-RWS queries.

###Complex Cases
The `se` and `seflag` act as conditions on the overall query. When both are set, `se` matches to the field defined by `seflag`. 

If only `se` is set, it's value is used to filter record results (returning records where any field matches `se`). 

Using `seflag` without `se` is ambigious and invalid. `seflag` sets the field for `se`; without a value to search for, the type of field is irrelevant (the API returns records, not individual fields.)

####Multi-step Queries
Whois-RWS exposes some fields as indexes (we can query their contents). These we access with the `pr` (`primary`) selector. But most fields are not searchable. We access these with the `se` (`secondary`) selector.

Suppose the user selects for records using a  `secondary` field (like city or phone number). We support this with a multistep query: `fetch` results by a `primary` selector, then `filter` said results by a `secondary` selector.

####Multiple Fetching Steps
In some cases we need _multiple_ `fetch` and `filter` steps. This happens when we must first inspect one type of record to glean information on the actual target records. 

For example, suppose we want to find IP addresses for a specific entity _SomeCompany_. We first `fetch` a set of records (org, customer, etc.) and `filter` these for references to net records. We then `fetch` for these net records, which we finally `return` to the client.

###List of Selector Combinations and Effects 
> `fetch` = call Whois-RWS

>`mapExtract` = extract a certain value from Whois-RWS results

>`filterHas` = select subset of Whois-RWS results that have a certain value

>`return` = return results to the client

| Selector Combination | Actions | Example Query | Example Actions  
|:----------:|:---------|:---------|:---------|
| **(pr)**                  | `fetch`-> `return` | find _any_ records matching "Orange" | `fetch` any records matching "Orange"
| **(pr,prflag)**           | `fetch`-> `return` | find _org_ records "Orange" | `fetch` org records matching "Orange"
| **(pr,prflag,se)**        | `fetch`-> `mapExtract`-> `fetch`-> `return` | find IP addresses for _org_ record matching "Orange" | 1) `fetch` _org_ records matching "Orange" 2) `mapExtract` IP 3) `fetch` IP records
| **(pr,prflag,se,seflag)** | `fetch`-> `filterHas`-> `return`| find _org_ records matching "Orange", where IP matches "192.168.1.1" | 1) `fetch` org records matching Apple 2) `filterHas` IP range containing 192.168.1.1 
| **(pr,se)**               | `fetch`-> `mapExtract`-> `fetch`-> `filterHas`-> `return` | find _any_ records matching "Orange", where IP matches "192.168.1.1" | 1) `fetch` any records matching "Orange" 2) `mapExtract` net records 3) `fetch` net records 4) `filterHas` IP range containing 192.168.1.1
| **(pr,se,seflag)**        | `fetch`-> `filterHas`-> `return`| find _any_ record for "Orange", where IP matches "192.192.0.0" | 1) `fetch` any records matching "Orange" 2) `filterHas` CA



##Invalid Selector Combinations
There are two cases for rejecting selector combinations.

1) Whois-RWS only indexes a few fields for each record. Thus all our queries **require** a `pr` selector. 

2) An `seflag` names a field to filter by. But without an `se`, we have no terms to filter with. 
 
At present, we favor rejecting badly formed queries rather than modifying them.

####List of Invalid Selector Combinations
| Selector Combination | Effect | Reason
|:----------:|:---------|:---------|
| **(se)**              | `REJECT` | No `pr` to search for records
| **(prflag)**          | `REJECT` | No `pr` to search for records
| **(seflag)**          | `REJECT` | No `pr` to search for records
| **(prflag, seflag)**  | `REJECT` | No `pr` to search for records
| **(prflag, se)**      | `REJECT` | No `pr` to search for records
| **(se,seflag)**       | `REJECT` | No `pr` to search for records
| **(pr, seflag)**      | `REJECT` | `seflag` without `se` is ambigious

