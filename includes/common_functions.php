<?php
class ClassCmnFunctions
{
	function funCurl ($Arrpostdata,$URL='') {
	  // Here is the data we will be sending to the service
	//  $some_data = array(
	//    'message' => 'Hello World', 
	//    'name' => 'Anand'
	//  );  
	//print_r($Arrpostdata);
		
	
		
		// You can also set the URL you want to communicate with by doing this:
		if(RUN_ON=="local")
			$URL = "https://localhost/lexus.php";
		else
			$URL = "http://www.nichetrackers.com/electrolux-promoter-curl/curl.php";
			//echo $URL;

		$curl = curl_init();
		
		
		//echo $URL;
		
		// We POST the data
		curl_setopt($curl, CURLOPT_POST, 1);
		
		// Set the url path we want to call
		curl_setopt($curl, CURLOPT_URL,$URL);  
		// Make it so the data coming back is put into a string
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Insert the data
		curl_setopt($curl, CURLOPT_POSTFIELDS, $Arrpostdata);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		// You can also bunch the above commands into an array if you choose using: curl_setopt_array

		// Send the request
		$result = curl_exec($curl);
		
		
		/*
		$err = curl_errno ( $curl );
        $errmsg = curl_error ( $curl );
        $header = curl_getinfo ( $curl );
        $httpCode = curl_getinfo ( $curl, CURLINFO_HTTP_CODE );
        print_r($result);
        echo '------------------------';
        print_r($curl);
        print_r($err);
        print_r($errmsg);
        print_r($header);
        print_r($httpCode);*/

		// Get some cURL session information back
		$info = curl_getinfo($curl);  
				//echo 'content type: ' . $info['content_type'] . '<br />';
				//echo 'http code: ' . $info['http_code'] . '<br />';
					
				
		// Free up the resources $curl is using
		curl_close($curl);
		//echo $result;
		return $result;
		
	}
}

?>