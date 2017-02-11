<?php
// This script will remove all Stripe subscriptions for your account
//
// 1. Go to https://dashboard.stripe.com/subscriptions and download an export
// 2. Open in your favorite spreadsheet program, remove all but the first column
// 3. Delete the id row
// 4. Copy/paste the first column into a text file named subs.txt
// 5. Replace secret key below
// 6. Run this script: php remove-subs.php

$stripeSecretKey = "sk_live_XXXXXXXXXXXXXXX";

$data = explode("\n", file_get_contents("subs.txt"));

foreach ($data as $row) {
	$row = trim($row);
	if (!empty($row)) shell_exec("curl https://api.stripe.com/v1/subscriptions/".$row." --silent -u ".stripeSecretKey.": -X DELETE");
}