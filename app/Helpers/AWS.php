<?php

namespace App\Helpers;

use Aws\Credentials\Credentials;
use Aws\S3\S3Client;

class AWS
{
    public static function getS3(): S3Client
    {
        $awsAccessKeyId = env('AWS_ACCESS_KEY_ID');
        $awsSecretKey = env('AWS_SECRET_ACCESS_KEY');

        $credentials = new Credentials($awsAccessKeyId, $awsSecretKey);

        return new S3Client([
            'version' => 'latest',
            'region' => 'ap-south-1', // Замените на ваш регион
            'credentials' => $credentials,
        ]);

    }
}
