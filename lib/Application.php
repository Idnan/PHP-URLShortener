<?php 

/**
* Application class that handles everything from saving a URL
* to redirecting the user to the original URL
*/
class Application extends Database
{
	public function __construct()
	{
		if ( isset($_POST['url']) && !empty($_POST['url']) )  {
			$this->shortenUrl( $_POST['url'] );
		} else if (isset($_GET['shortened_code'])) {
			$this->handleRedirection( $_GET['shortened_code'] );
		}
	}

	public function shortenUrl( $url )
	{
		
	}

	public function handleRedirection( $code )
	{
		
	}
}