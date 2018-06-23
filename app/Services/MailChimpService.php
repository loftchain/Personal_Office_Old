<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class MailChimpService
{

	public $mailchimp;

	public function __construct(\Mailchimp $mailchimp)
	{
		$this->mailchimp = $mailchimp;
	}

	public function sendCampaign($email, $subject, $view)
	{

		try {
			$options = [
				'list_id'   => env('MAILCHIMP_LIST_ID'),
				'from_name' => env('MAILCHIMP_FROM_NAME'),
				'from_email' => env('MAILCHIMP_FROM_EMAIL'),
				'subject' => $subject,
				'to_name' => $email
			];
			$content = [
				'html' => view($view)->render(), //this converts HTML to STRING
			];

			$campaign = $this->mailchimp->campaigns->create('regular', $options, $content);
			$this->mailchimp->campaigns->send($campaign['id']);

			Log::info('send campaign successfully');

		} catch (Exception $e) {
			Log::info('Error from MailChimp');
			Log::info($e->getMessage());
		}
	}
}