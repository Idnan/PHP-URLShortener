<?php 

/**
* Application class that handles everything from saving a URL
* to redirecting the user to the original URL
* @author Kamran Ahmed <kamranahmed.se@gmail.com>
* @version 0.1
*/
class Application
{
	/**
	 * Initializes the properties and decides the route
	 */
	public function __construct()
	{
		$this->url = new Url();

		if ( isset($_POST['url']) && !empty($_POST['url']) )  {
			$this->processUrl( $_POST['url'] );
		} else if (isset($_GET['code'])) {
			$this->handleRedirection( $_GET['code'] );
		}
	}

	/**
	 * Processes the URL for shortening purposes
	 * @param  string $url URL that is to be shortened
	 * @return mixed      returns the URL of the form [SHORTENED_SUCCESS@http://baseurl.com/shortcode] if shortening succeeds, otherwise error message is returned
	 */
	public function processUrl( $url )
	{
		$isValid = $this->url->validateUrl( $url );

		if ( $isValid === true ) {

			// Check if someone has already shortened this URL
			$code = $this->url->getUrlCode( $url );

			if ( $code === false ) {

				// Keep iterating unless URL is shortened
				while( true )
				{
					// Generate a shortened code
					$code = $this->url->generateCode();

					// If this generated code is unique (i.e. not already assigned to some URL)
					if( $this->url->isCodeUnique($code) )
					{	
						// Shorten URL with this code
						$result = $this->url->shorten( $url, $code );

						if ( $result === 'SHORTENED_SUCCESS' ) {  // URL has been shortened
							echo 'SHORTENED_SUCCESS@' . URL . $code;
							break 1;
						} else { // Shortening query failed due to some reason.
							echo $result;
							break 1;
						}

					} // endif

				} // end while

			} else {

				echo 'SHORTENED_SUCCESS@' . URL . $code;
				return;
			}

		} else {
			// Echoing out, because there is an ajax request calling this function
			echo $isValid;
		}
	} // end processUrl()

	/**
	 * Handles the redirection, when some one tries to access the shortened URL
	 * @param  string $code shortcode that is stripped from the shortened URL that a user is trying to open
	 * @return HTTP-Redirect       Redirects the user to the original URL, if found and to the home page otherwise
	 */
	public function handleRedirection( $code )
	{
		// Get the URL for this code
		$url = $this->url->getUrl($code);

		// URL found
		if( $url !== false) {
			header("Location: " . $url);
		} else { // URL not found
			header("Location: " . URL);
		}
	} // end handleRedirection()
}