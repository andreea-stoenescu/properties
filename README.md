country/county/town/type/property_type fields should be dropdowns that support other values, too, but that is a bit complicated (easier with the select2 package)
the download script could be made faster and more efficient, but I didn't do it, due to time constraints

I created separate tables for countries, counties and towns to allow for the 3 selects that I was planning on adding to the search page

When editing an existing property, my plan was to set the block_api_update on property to true, to stop the API from overwriting users' changes

Another custom command would be useful, to unblock all the properties from being updated by the API, in case the users need that

I added only search by country, because I don't have time to do more.

##Setup

The usual Laravel setup, plus 2 new env variables (see the .env.example) file: MTC_PROPERTY_API_ROOT, MTC_PROPERTY_API_KEY

In production, APP_DEBUG should be set to false, to avoid showing the env data (it can also be hidden, even when DEBUG is true)

##Download
The command to download the data from the API is php artisan properties:download
