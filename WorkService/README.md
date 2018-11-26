# The WorkService Application
The crossplatform applications, used to running the different workload.

### WorkService.Console (.net core)
The Console application used for running the workload on Windows, Linuix, Mac.

### WorkService.Desktop (winform)
The Desktop application used for running the workload on Windows only.

# .net standard portable dlls
Used for both Console & Desktop clients/service.

### Worker.Crawler
Crawls an url, fetching the raw html.

### Worker.Scraper
Scrapes html, for product attributes like, Price, Title, Product Image etc. and also for new urls the crawler to crawl.

### Worker.Fetcher
Gets product image data from websites, and maybe manipulate it for max size.

### Worker.ImageModel
Creates or Uses an already created model for product image classification.

### Worker.WorkQueue
Looks for more work from WebSite Api.