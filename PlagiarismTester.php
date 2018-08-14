<?php

class PlagiarismTester {
	
	var $apiKey;
	var $endpoint_url;


	function __construct() {
		//set your new API Key here
		$this->apiKey = "1234567890";		

		/* do not touch! */
		$this->endpoint_url = 'https://www.PrepostSEO.com/apis/checkPlag';
		$this->account_balance_endpoint_url = 'https://www.prepostseo.com/apis';
	}

	/*
	*	checkAccountBalance()
	*	Checks PrepostSEO acount balance.
	*	returns json response data
	*/
	public function checkAccountBalance() {

		$data_to_post = [
				'key' => $this->apiKey,
			];

		return $this->curlRequest($this->account_balance_endpoint_url, $data_to_post);
	}


	/*
	*	checkPlag($data)
	*	Parameter:
	*	$data_to_post: array. Format ['key'=> 'API KEY', 'data' => 'article_content']
	*	Scans through the data passed and returns acount balance.
	*	returns json response data
	*/
	public function checkPlag($data) {

		$data_to_post = [
				'key' => $this->apiKey,
				'data' => $data,
			];

		return $this->curlRequest($this->endpoint_url, $data_to_post);
	}


	/*
	*	curlRequest($this->endpoint_url, $data_to_post)
	*	Performs CURL POST requests.
	*	Parameters: 
	*	$this->endpoint_url: string; 
	*	$data_to_post: array. Format ['key1'=> 'value1', 'key2', 'value2']
	*	returns json response data
	*/
	private function curlRequest($endpoint_url, $data_to_post) {
		
		$options = [
		  CURLOPT_URL        => $endpoint_url,
			CURLOPT_POST       => true,
			CURLOPT_POSTFIELDS => $data_to_post,
			CURLOPT_RETURNTRANSFER => true,
		];

		// Initiates the cURL object
		$curl = curl_init();
		curl_setopt_array($curl, $options);
//		$results = ;

//		curl_close($curl);

		$result = @curl_exec($curl);

		if(!$result) {
			$result = json_encode(array('error' => curl_error($curl)));
		}
		curl_close($curl);
		return $result;

	}
}


//$plagtester = new PlagiarismTester();

//echo $plagtester->checkAccountBalance();
?>
