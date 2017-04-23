# API Parameters
Alongside selectors are two optional parameters: 

### boolean `wildcard` 
> `wildcard=1`, enabled, **default**

> `wildcard=0`, disabled

Toggles the auto wildcard feature. When enabled, the Analyzer inspects whether or not a wildcard is present. If _not_ present, the Analyzer adds one to each query string.

Auto wildcards are a trade off. The benefit is they lower the chance of _all_ results returning 404 "not found" (i.e. where every RWS call returns 404). The cost is that they increase the chance of false positives. 

For example, consider the set of two records `{DogLovers, Dog Homes}`. If auto wildcards are _disabled_, a search for `Dog` will _not_ return `DogLovers` (no space), only `Dog Homes` (with a space). However, when _enabled_, the search `Dog` is transformed into `Dog*`, which will return both `DogLovers` and `Dog Homes`.

Exactly phrased queries may want to disable auto wildcards.

### boolean `raw` 
> `hint=1`, enabled

> `hint=0`, disabled, **default**

Toggles the raw-results feature. When enabled, the Transformer leaves Whois-RWS JSON unformatted. The client still receives a single JSON body with an API wrapper, but the nested contents are raw Whois-RWS JSON.

Raw-results allows a client that understands Whois-RWS JSON to consume it normally (once the outer wrapper is removed).


