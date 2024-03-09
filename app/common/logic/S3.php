<?php
namespace app\common\logic;

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
//S3文件
class S3 extends Base{

	public $client;
	public $bucket;

	public function __construct(){

		$m = $this->model('Option');
		$annex = $m->getValueByName('annex');

		$r3 = $m->getValueByName('r3');

		$bucket_name        = $r3['bucket_name'];
		$account_id         = $r3['account_id'];
		$access_key_id      = $r3['access_key_id'];
		$access_key_secret  = $r3['access_key_secret'];

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
		// var_dump($buckets);
	}

}

?>