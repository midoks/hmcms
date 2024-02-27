<?php
namespace app\common\logic;

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
//S3文件
class S3 extends Base{

	public $client;
	public $bucket;

	public function __construct(){
		// $bucket_name        = "semang";
		// $account_id         = "26c97a0d4f5655a3533e281ac0d4662c";
		// $access_key_id      = "403a3e6ea7bcc77e471484d60d3acc85";
		// $access_key_secret  = "deb4805e8cd1cd9b13b558b9f2e99c93ca2660dfa6a85ec3bb0ab865c9bfd0f7";

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