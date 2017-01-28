<?php

include 'vendor/autoload.php';

$config = array(
    // required
    'access_token' => 'POST_SERVER_ITEM_ACCESS_TOKEN',
    // optional - environment name. any string will do.
    'environment' => 'iron',
);

// installs global error and exception handlers
Rollbar::init($config);

// init the IronWorker runtime
$payload = IronWorker\Runtime::getPayload(true);

//print the payload so the task log shows something
print_r($payload);

//report the message on Rollbar
Rollbar::report_message($payload["subscribers"][0]["msg"], Level::ERROR,
                        // key-value additional data
                        array(
                        "source_msg_id" => $payload["source_msg_id"],
                        "body" => $payload["body"],
                        "url" => $payload["subscribers"][0]["url"],
                        "code" => $payload["subscribers"][0]["code"]),
                        // payload options (overrides defaults) - see api docs
                        array("exception.message" => $payload["subscribers"][0]["msg"]));

?>
