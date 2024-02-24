<?php

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

//S3文件
class S3{

	public $client;
	public $bucket;

	public function __construct(){


		$bucket_name        = S3_BUCKET_NAME;
		$account_id         = S3_ACCOUNT_ID;
		$access_key_id      = S3_ACCESS_KEY_ID;
		$access_key_secret  = S3_ACCESS_KEY_SECRET;

		$credentials = new Aws\Credentials\Credentials($access_key_id, $access_key_secret);

		$options = [
		    'region' => 'auto',
		    'endpoint' => "https://$account_id.r2.cloudflarestorage.com",
		    'version' => 'latest',
		    'credentials' => $credentials
		];

		$this->bucket_name = $bucket_name;
		$this->client = new S3Client($options);

	}

	public function upload($abs_pfile, $key){
		$re = $this->client->putObject([
	        'Bucket' => $this->bucket_name,
	        'Key' => $key,
	        'SourceFile' => $abs_pfile,
	    ]);
	    return $re;
	}


	public function del($key){
		$re = $this->client->putObject([
	        'Bucket' => $this->bucket_name,
	        'Key' => $key,
	        'SourceFile' => $abs_pfile,
	    ]);
	    return $re;
	}

	public function list(){
		$buckets = $this->client->listBuckets();

		var_dump($buckets);
	}
}

?>