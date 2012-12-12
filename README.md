php-sendgrid-parse
==================

A php library for the sendgrid parse api. It's really more convention than code.


## Installation

1. Clone the repository or copy the php file into your project.
2. Include the php file.


## Usage

After your router identified the request as coming from SendGrid, you can parse the incoming data as follows:

  ```php
  $parsed = new SendgridParse();
  ```
    
You can then access <a href="http://sendgrid.com/docs/API_Reference/Webhooks/parse.html">all attributes</a> of the incoming email as attributes of ```$parsed```. The following attributes get special treatment:

- ```$parsed->from```: an array that maps "name" to the name, "email" to the email address and "full" to the combination of both;
- ```$parsed->to```: an array of all to-recipients - each recipient is treated by an array that maps "name", "email" and "full" again;
- ```$parsed->cc```: same thing for the cc-recipients;
- ```$parsed->attachments```: an array of all attachments - each attachment is a record for an uploaded file.
