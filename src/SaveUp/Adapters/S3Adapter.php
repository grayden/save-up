<?php namespace SaveUp\Adapters;

require 'vendor/autoload.php';

use Aws\S3\S3Client;

class S3Adapter
{
    private $bucket;

    private $client;

    public function __construct($bucket)
    {
        $this->bucket = $bucket;

        $this->client = S3Client::factory(array(
            'profile' => 'default'
        ));
    }

    public function save($name, $content)
    {
        $this->client->putObject(array(
            'Bucket' => $this->bucket,
            'Key' => $name,
            'Body' => $content
        ));
    }
}
