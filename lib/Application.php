<?php 

/**
* Application class that handles everything from saving a URL
* to redirecting the user to the original URL
*/
class Application
{
	public function __construct()
	{

		$this->url = new Url();

		if ( isset($_POST['url']) && !empty($_POST['url']) )  {
			$this->processUrl( $_POST['url'] );
		} else if (isset($_GET['code'])) {
			$this->handleRedirection( $_GET['code'] );
		}
	}

	public function processUrl( $url )
	{
		$isValid = $this->url->validateUrl( $url );

		if ( $isValid === true ) {

			$code = $this->url->getUrlCode( $url );

			if ( $code === false ) {
				while( true )
				{
					$code = $this->url->generateCode();
					if( $this->url->isCodeUnique($code) )
					{
						$result = $this->url->shorten( $url, $code );

						if ( $result === 'SHORTENED_SUCCESS' ) {
							echo 'SHORTENED_SUCCESS@' . URL . $code;
							break 1;
						} else {
							echo $result;
							break 1;
						}
					}
				}
			} else {

				echo 'SHORTENED_SUCCESS@' . URL . $code;
				return;
			}

		} else {
			// Echoing out, because there is an ajax request calling this function
			echo $isValid;
		}
	}

	public function handleRedirection( $code )
	{
		$url = $this->url->getUrl($code);

		if( $url !== false) {
			header("Location: " . $url);
		} else {
			header("Location: " . URL);
		}
	}
}