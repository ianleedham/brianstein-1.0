<?php

# Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = new Mailgun('key-ab11fd5d8a6bf9948e52a2cdee7f7c80');
$domain = "sandbox6186e84df4d044fcabd8c80b3b8dcdba.mailgun.org";

# Make the call to the client.
$result = $mgClient->sendMessage("$domain",
array('from'    => 'Mailgun Sandbox <postmaster@sandbox6186e84df4d044fcabd8c80b3b8dcdba.mailgun.org>',
'to'      => 'admin <brian@brianstein.co.uk>',
'subject' => 'Hello admin',
'text'    => 'Congratulations admin, you just sent an email with Mailgun!  You are truly awesome! '));

# You can see a record of this email in your logs: https://app.mailgun.com/app/logs .

# You can send up to 300 emails/day from this sandbox server.
# Next, you should add your own domain so you can send 10,000 emails/month for free.