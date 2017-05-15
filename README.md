# Jxaat

IP details scrapper web app with email notify system using php, oop, ajax, xml, json, curl, js, html, css, jquery..

Live preview: http://jxaat.com


Jxaat.com Released!

You can use jxaat simply to:
- view or send any ip details to any email
- view or send your website visitors ip details
Live example view or send your (latitude) from somewhere on this earth:
Open your mobile browser go to jxaat.com click generated link in the top which contain your ip
and to specify latitude only add param &key=latitude or without key param to send all details..

Request url: jxaat.com/jxaat.php

Parameters: ip= , email= , format= , key=

Format: JSON, CSV, XML | Methods: [POST], [GET]

Sender function: rawgit.com/khaledalam/Jxaat/master/sender.js

ex. url form: http:jxaat.com/jxaat.php?ip=xx.xx.xx.xx&email=example@mail.com&key=city&format=xml

Limits: ~ 10,000 requests per hour


Keys:
---/ 'ip'

--/ 'country_code'

-/ 'region_name'

/ 'city'

\ 'zip_code'

-\ 'time_zone'

--\ 'latitude' 'longitude'

---\ 'metro_code'

Data:

---/ Time Zone

--/ Host Name

-/ City

/ Country

\ Network

-\ Region

--\ Location (Lat/Long)

---\ Metro Code


Error Codes:

0 error in return result

-1 not valid ip

-2 not valid email

-3 not valid key

-4 not valid format

you can develop it as you wish, source codes are available on github 

github: github.com/khaledalam/jxaat | follow on github @khaledalam

v1.0 | twitter: @jxaat | facebook: facebook.com/jxaat
