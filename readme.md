# Rollbar x Iron.io Error Queue Reporter
A simple Iron.io Worker that processes the payload received from your Iron.io error queue/s and reports them in [Rollbar.com](https://rollbar.com)

## Getting Started

You need the following:

* [Iron.io](https://iron.io) account & the Iron CLI tool installed
* [Rollbar.com](http://rollbar.com) account


## Install
Run composer:
```sh
$ composer install
```

Setup the iron.json file with your token & project ID:
```json
{"token":"IRON_PROJECT_ID","project_id":"IRON_PROJECT_ID"}
```

Setup reporter.php with your Rollbar 'Post Server Access Token', you can find this under; Settings > Project Access Tokens.
```php
$config = array(
    // required
    'access_token' => 'POST_SERVER_ITEM_ACCESS_TOKEN',
    // optional - environment name. any string will do.
    'environment' => 'iron',
);
```

Find out more about the [Rollbar PHP notifier ](https://rollbar.com/docs/notifier/rollbar-php/)

### Package your code
Zip the contents of the directory, ready for uploading with the Iron CLI tool:

```sh
zip -r example.zip .
```

### Upload your code
You need to ensure you have the [iron CLI](http://dev.iron.io/worker/cli/) installed.

To upload the worker package/zip:
```sh
iron worker upload --name error-queue-reporter --zip example.zip iron/php php reporter.php
```
### Copy the webhook URL
Open up the 'codes' section under your Iron Workers and copy the Webhook URL.

### Create the error queue
You can do this via Iron front end or via the Iron MQ library, ensure you create a multicast queue and set the 'Subscriber URL' as the 'Webhook URL' from step 5.

More details can be found on the [Iron API reference](http://dev.iron.io/mq/3/reference/push_queues/#error_queues)

## Useful
 * [iron-io worker](https://github.com/iron-io/dockerworker/blob/master/php/hello.php)
 * [Rollbar PHP](https://rollbar.com/docs/notifier/rollbar-php/#quick-start)
