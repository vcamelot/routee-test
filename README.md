# routee-test

This library connects to OpenWeatherAPI, gets temperature for specified city, and sends SMS message to certain number.

Sample usage is in _index.php_

Configuration parameters are in _src/Config/app.ini_

NOTE: I was not able to find a good way to implement queueing in PHP to send 10 SMS messages with 10 minutes wait time between each. Probably it can be done using AMQP, Redis, or Amazon SQS but I have no experience working with these services yet.
