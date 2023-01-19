<?php
if( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

class Curlings extends CI_Model 
{

	function get_curl( $url)
    {
     


      $request_headers = array();
      $request_headers[] = "application/json";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 60);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $output = curl_exec($ch);

      if (curl_errno($ch))
        {
        print "Error: " . curl_error($ch);
        }
        else
        {
        // Show me the result
        return $output;

     }  

      }

      function to_curl($url, $data)
		 {

		 	$headers = array
        (
          'Content-Type: application/json',
          'Content-Length: ' . strlen( json_encode($data) ) 
        );
     

		 	$ch = curl_init();  
			curl_setopt($ch, CURLOPT_URL, $url);  
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST" ); 
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1 ); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
		    curl_setopt($ch, CURLOPT_HTTPHEADER,  $headers );
			
			curl_setopt($ch, CURLOPT_POST, 1); 
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));  
			$output = curl_exec($ch); 

				
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			/*if($httpcode != 200)
				{	
				$this->session->set_flashdata( "error", "An error has ocurred . Try again" );				
				redirect('land');
				}
*/
			curl_close($ch); 
		return $output;
			
	}



	

}