# JumpTwenty4
A Jump24 task  using the Giphy API: https://developers.giphy.com/docs/ , within Laravel.:

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system

### Prerequisites
What things you need to install the software and how to install them
```
⦁	PHP >= 7.1.3
⦁	OpenSSL PHP Extension
⦁	PDO PHP Extension
⦁	Mbstring PHP Extension
⦁	Tokenizer PHP Extension
⦁	XML PHP Extension
⦁	Ctype PHP Extension
⦁	JSON PHP Extension
⦁	BCMath PHP Extension
```

### Installation
A step by step series of examples that tell you how to get a development env running

```
git clone https://github.com/follypimpin/jump24GiphyApi.git /var/www/destination_directory Copy repo
```
Followed by
```
cd destination_directory/ Go into dir.
```
Then ...
```
⦁	git fetch && git checkout Branc_to_go_to Switch to the latest branch
⦁	 `composer install` Install composer dependencies (should see vendor folder)
⦁	- Edit ".env" file according to the installation requirements
		GIPHY_API_KEY= "YOUR_API_KEY"  copy from you Giphy account (see 				[Giphy](https://developers.giphy.com/dashboard/)
		GIPHY_BASE_URL = "http://api.giphy.com/v1"
⦁	Additionally,  you can manually copy the .env.example file to .env and fill-in their own values 
⦁	`php artisan key:generate` Generates unique application
```
## DB migration
Enter/edit the DB credentials in ".env"
```
		DB_DATABASE = your database name
		DB_USERNAME = your database username
		DB_PASSWORD = your database password

   - `php artisan migrate:fresh` recreates all tables in the database
```
## Testing Routes
Simply navigate to the url below to get either Gifs or Stickers
```
1 - Gif & 2 - Stickers
http://127.0.0.1/giphy_api/trending/1
http://127.0.0.1/giphy_api/trending/2
```
Sample Response
```
{
    "data": [
        {
            type: "gif",
            id: "FiGiRei2ICzzG",
            slug: "funny-cat-FiGiRei2ICzzG",
            url: "http://giphy.com/gifs/funny-cat-FiGiRei2ICzzG",
            bitly_gif_url: "http://gph.is/1fIdLOl",
            bitly_url: "http://gph.is/1fIdLOl",
            embed_url: "http://giphy.com/embed/FiGiRei2ICzzG",
            username: "",
            source: "http://tumblr.com",
            rating: "g",
            caption: "",
            content_url: "",
            source_tld: "tumblr.com",
            source_post_url: "http://tumblr.com",
            import_datetime: "2014-01-18 09:14:20",
            trending_datetime: "1970-01-01 00:00:00",
            images: {
                fixed_height: {
                    url: "http://media2.giphy.com/media/FiGiRei2ICzzG/200.gif",
                    width: "568",
                    height: "200",
                    size: "460622",
                    mp4: "http://media2.giphy.com/media/FiGiRei2ICzzG/200.mp4",
                    mp4_size: "13866",
                    webp: "http://media2.giphy.com/media/FiGiRei2ICzzG/200.webp",
                    webp_size: "367786"
                },
                fixed_height_still: {
                    url: "http://media2.giphy.com/media/FiGiRei2ICzzG/200_s.gif",
                    width: "568",
                    height: "200"
                },
                fixed_height_downsampled: {
                    url: "http://media2.giphy.com/media/FiGiRei2ICzzG/200_d.gif",
                    width: "568",
                    height: "200",
                    size: "476276",
                    webp: "http://media2.giphy.com/media/FiGiRei2ICzzG/200_d.webp",
                    webp_size: "100890"
                },
                fixed_width: {
                    url: "http://media2.giphy.com/media/FiGiRei2ICzzG/200w.gif",
                    width: "200",
                    height: "70",
                    size: "90483",
                    mp4: "http://media2.giphy.com/media/FiGiRei2ICzzG/200w.mp4",
                    mp4_size: "14238",
                    webp: "http://media2.giphy.com/media/FiGiRei2ICzzG/200w.webp",
                    webp_size: "47302"
                },
                fixed_width_still: {
                    url: "http://media2.giphy.com/media/FiGiRei2ICzzG/200w_s.gif",
                    width: "200",
                    height: "70"
                },
                fixed_width_downsampled: {
                    url: "http://media2.giphy.com/media/FiGiRei2ICzzG/200w_d.gif",
                    width: "200",
                    height: "70",
                    size: "71069",
                    webp: "http://media2.giphy.com/media/FiGiRei2ICzzG/200w_d.webp",
                    webp_size: "13186"
                },
                fixed_height_small: {
                    url: "http://media2.giphy.com/media/FiGiRei2ICzzG/100.gif",
                    width: "284",
                    height: "100",
                    size: "460622",
                    webp: "http://media2.giphy.com/media/FiGiRei2ICzzG/100.webp",
                    webp_size: "72748"
                },
                fixed_height_small_still: {
                    url: "http://media2.giphy.com/media/FiGiRei2ICzzG/100_s.gif",
                    width: "284",
                    height: "100"
                },
                fixed_width_small: {
                    url: "http://media2.giphy.com/media/FiGiRei2ICzzG/100w.gif",
                    width: "100",
                    height: "35",
                    size: "90483",
                    webp: "http://media2.giphy.com/media/FiGiRei2ICzzG/100w.webp",
                    webp_size: "18298"
                },
                fixed_width_small_still: {
                    url: "http://media2.giphy.com/media/FiGiRei2ICzzG/100w_s.gif",
                    width: "100",
                    height: "35"
                },
                downsized: {
                    url: "http://media2.giphy.com/media/FiGiRei2ICzzG/giphy.gif",
                    width: "500",
                    height: "176",
                    size: "426811"
                },
                downsized_still: {
                    url: "http://media2.giphy.com/media/FiGiRei2ICzzG/giphy_s.gif",
                    width: "500",
                    height: "176"
                },
                downsized_large: {
                    url: "http://media2.giphy.com/media/FiGiRei2ICzzG/giphy.gif",
                    width: "500",
                    height: "176",
                    size: "426811"
                },
                original: {
                    url: "http://media2.giphy.com/media/FiGiRei2ICzzG/giphy.gif",
                    width: "500",
                    height: "176",
                    size: "426811",
                    frames: "22",
                    mp4: "http://media2.giphy.com/media/FiGiRei2ICzzG/giphy.mp4",
                    mp4_size: "51432",
                    webp: "http://media2.giphy.com/media/FiGiRei2ICzzG/giphy.webp",
                    webp_size: "291616"
                },
                original_still: {
                    url: "http://media2.giphy.com/media/FiGiRei2ICzzG/giphy_s.gif",
                    width: "500",
                    height: "176"
                }
            },
            title: "Funny Cat GIF",
        },
        ... 24 more items
    ],
    "meta": {
        "status": 200,
        "msg": "OK"
    },
    "pagination": {
        "total_count": 1947,
        "count": 25,
        "offset": 0
    }
}
 
```

## Running the tests
Simply run the following command
```
./vendor/bin/phpunit
```

### Break down into end to end tests
```
GifEndPointTest - All the Giphy Gif related endpoints
GifTest - All gif related methods

```
## Benchmark and Optimisation Result
```
500 records from performing Giphy gif search end point - using chunk()
Query 
{
        "id" : 1,
        "query" : "cats"
      
}
```
| fetchSearchRandom(Chunk) | DB Completion (ms)      | Description       |
| ----------------- | ----------------------------- |--------------------|
| `insert 100 per iteration` | 0.08372998237609863  | **passed by val**  |
| `insert 100 per iteration` | 0.07692408561706543  | **passed by ref**  |
| `insert 200 per iteration` | 0.14775919914245605  | **passed by val**  |
| `insert 200 per iteration` | 0.04747796058654785  | **passed by ref**  |



```
1000 records from search Giphy gif search end point - using chunk() 
Query 
{
        "id" : 1,
        "query" : "dogs"
      
}


```
| fetchSearchThouRandom(Chunk) | DB Completion (ms)      | Description   |
| ----------------- | ----------------------------- |--------------------|
| `insert 200 per iteration` | 0.08954501152038574  | **passed by ref**  |
| `insert 300 per iteration` | 0.12642788887023926  | **passed by ref**  |
| `insert 500 per iteration` | 0.15838193893432617  | **passed by val**  |
| `insert 500 per iteration` | 0.10385298728942871  | **passed by ref**  |
```
Build a SQL statement that iterates over each random record, modifies its name to
append a timestamp, and stores it to a new table
Query DB using indexed migrate_date [TimeStamp]
{
        "from" : "2019-02-15 07:00:00",
        "to" : "2019-02-19 23:59:59"
      
}

```
| appendCursorTimeStamp(Using Cursors) | DB Completion (ms)      | Description             |Memory Peak |
| ------------------------------------ | ----------------------- |-------------------------|------------|
| `inserted mass 985 records`| 0.23484492301940918               | **laravel cursor**      | **2**      |
| `inserted mass 985 records`| 0.2549459934234619                | **laravel cursor**       | **2**      |
| `inserted mass 961 records`| 0.17969012260437012               | **laravel cursor**       | **4**      |

```

```
| appendChunkTimeStap(Using Chunks) | DB Completion (ms)      | Description                |  Memory Peak |
| ----------------------------------| ----------------------  |----------------------------|---------------|

| `insert 200 per iteration` | 0.12642788887023926    | **laravel chunk passed by val**    |              |
| `insert 200 per iteration` | 0.21620512008666992    | **laravel chunk passed by ref**    |              |
| `insert 200 per iteration` | 0.2465660572052002     | **laravel chunk passed by val**     |   **2**      |
| `insert 250 per iteration` | 0.22419309616088867    | **laravel chunk passed by val**    |   n/a        |
| `insert 250 per iteration` | 0.21016907691955566    | **laravel chunk passed by val**    |  **2**       |


## Work Undertaken


## Built With

* [Laravel ](https://laravel.com/docs/5.7) - The web framework used

## Contributing
⦁	Fork it
⦁	Create your feature branch (git checkout -b my-new-feature)
⦁	Make your changes
⦁	Run the tests, adding new ones for your own code if necessary (phpunit)
⦁	Commit your changes (git commit -am 'Added some feature')
⦁	Push to the branch (git push origin my-new-feature)
⦁	Create new Pull Request

## Benchmarked or optimised SQL statements result

* **Rafael** 
