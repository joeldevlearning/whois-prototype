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

---
###Combinations and Order 
The order of selectors is ignored, but their **combination** is meaningful. Certain combinations are rejected (because of ambiguity). Acceptable combinations are mapped Whois-RWS queries.

####Complex Cases
The `se` and `seflag` act as conditions on the overall query. When both are set, `se` matches to the field defined by `seflag`. 

If only `se` is set, it's value is used to filter record results (returning records where any field matches `se`). 

Using `seflag` without `se` is ambigious and invalid. `seflag` sets the field for `se`; without a value to search for, the type of field is irrelevant (the API returns records, not individual fields.)

#####Validate Selector Combinations and Effects 
| Selector Combination | Effect | Example | Inverted Example  
|:----------:|:---------|:---------|:---------|
| **(pr)**                  | `fetch` | find records for "Apple" | none
| **(pr,prflag)**           | `fetch` | find org "Apple" | none
| **(pr,prflag,se)**        | `fetch`-> `filter`-> `fetch` | find IP addresses for org "Apple" | find IP address "192.192.0.0" for "Apple"
| **(pr,prflag,se,seflag)** | `fetch`-> `filter` | find record for org "Apple", where IP matches "192.192.0.0" | find IP address "192.192.0.0", where org matches "Apple" 
| **(pr,se)**               | `fetch`-> `filter`-> `fetch`-> `filter` | find record for "Apple", where any field is "Cupertino" | none
| **(pr,se,seflag)**        | `fetch`-> `filter`-> `fetch`| find record for "Apple", where IP matches "192.192.0.0" | find IP address, where organization matches "Apple"

> `fetch` = call Whois-RWS

>`filter` = select subset of Whois-RWS results

#####Invalidate Selector Combinations 
| Selector Combination | Effect | Reason
|:----------:|:---------|:---------|
| **(se)**              | `REJECT` | No `pr` to search for records
| **(prflag)**          | `REJECT` | No `pr` to search for records
| **(seflag)**          | `REJECT` | No `pr` to search for records
| **(prflag, seflag)**  | `REJECT` | No `pr` to search for records
| **(prflag, se)**      | `REJECT` | No `pr` to search for records
| **(se,seflag)**       | `REJECT` | No `pr` to search for records
| **(pr, seflag)**      | `REJECT` | `seflag` without `se` is ambigious

