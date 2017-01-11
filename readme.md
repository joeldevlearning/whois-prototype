# whois-prototype

2

###Experimental client and middleware to search ARIN's whois REST API

3

​

4

##Purpose

5

Prototype the features of a friendlier wrapper to ARIN's whois API. 

6

​

7

###**Goals**:

8

​

9

1. **Fully support** the API (the user should be able to make any query, or its equivalent, that the API supports)

10

​

11

2. **Simplify calling** the API (The user should not need to know the details of the API or dataset to make their query)

12

​

13

3. Support **exploration** of the API (Query results should show explicit relationships between records; the UI should allow the user to browse these related records)

14

​

15

##Design

16

An **HTML/bootstrap3** frontend, **JQuery** for UI tasks, and a **PHP/Guzzle** backend generating, running, and returning collection results. The API wrapper takes priority, so the UI is thin for now.  

17

​

18

##Planned Features

19

- Search multiple record categories at once

20

- Handle ambiguous input (spacing, wildcards, etc.)

21

- Support wildcards in complex queries

22

- One minimal search form for all possible queries 

23

- Return only active links to related records

24

​

25

###Feature Wishlist

26

- Overcome query limits (255 records per query) and offer pagination

27

- Group similar entities together in search results

28

- Interactive feedback for parsing errors in formatting (e.g. of IP addresses)

29

- As-you-type searches to check for any results

30

- Search suggest features

31

- Graphical tree of entities by IP address blocks

32

- Wildcards for IP addresses

33

- Support for domain names (mixing results from another API with ARIN's)

34

​

35

###ARIN documentation

36

ARIN's website already features a [whois search form](https://www.arin.net/) (and an [advanced search](https://whois.arin.net/ui/advanced.jsp)), which offers some conveniences beyond the basic API (e.g. searching multiple record types at once). Unfortunately the search form uses an internal, undocumented API. 

37

​

38

ARIN's whois REST API features can be found at: https://www.arin.net/resources/whoisrws/index.html

39

​

40

##Caveats

41

This project has no relationship to ARIN. This is a personal learning project to sketch out some features.