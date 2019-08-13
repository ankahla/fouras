# Fouras cms app
This is the cms part of the fouras website
Some folders are compressed on a zip file but some others are not (editable because it depend on environement)

## To install the project

- unzip file
- create database
- Import cms.sql to the database
- update configuration.php to use the just created database 
- update .htaccess file to make it work

## Administrator interface (/administrator/index.php)
- login: backoffice
- pwd: admnistrator

#### Api credential
- login: api
- pwd: api-secret

## Api calls

- List of articles

GET /api/articles/article?params=...

|parameter|default|type|description|
|---------|:-----|----|-----------|
|id|null|integer|the article id in cms|
|category_id|null|array|specify this if you want the list of article under a particular category|
|search|null|integer|search in article titles and content for the search word|
|featured|null|integer|featured article only or not (0 or 1)|
|limitstart|0|integer|page start if pagination is enabled
|limit|0|integer|number of article per page
|lang|fr|string| possible values fr, en, ar|
|fields|id, title, alias, introtext, catid, category_title, images|string|comma separated field names|
|sort|created|string|field name used for sorting|
|listOrder|DESC|string|sort direction (asc or desc)|
|key|null|string|api key see cms administrator page for plugin configuration|

Example:
/api/articles/article?key=8d6f1fbea40c389706b796068ed37505&id=6&fields=id,title,alias,introtext,catid,category_title,images,created,fulltext,tags&limit=1&lang=fr

- List of categories

GET /api/categories/categories?params=...

|parameter|default|type|description|
|---------|:-----|----|-----------|
|id|null|integer|the category id in cms|
|search|null|not implemented|
|featured|null|integer|not implemented|
|limitstart|0|integer|not implemented|
|limit|0|integer|not implemented|
|lang|fr|string| possible values fr, en, ar|
|sort|created|string|not implemented|
|direction|DESC|string|not implemented|
|key|null|string|api key see cms administrator page for plugin configuration|

Example:
/api/categories/categories?id=9&key=8d6f1fbea40c389706b796068ed37505&lang=fr