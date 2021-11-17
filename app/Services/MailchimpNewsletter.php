<?php

namespace App\Services;

use \MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter
{
    protected $apiClient;
    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function subscribe(string $email, string $list = null)
    {
        $list = $list ?? config('services.mailchimp.lists.subscribers');
        // $list == null && $list = config('services.mailchimp.lists.subscribers');

        return $this->apiClient->lists->addListMember($list, [
            "email_address" => $email,
            "status" => "subscribed",
        ]);
    }

    protected function client()
    {
        // $client = new ApiClient();
        return $this->apiClient->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us20'
        ]);
    }
}
