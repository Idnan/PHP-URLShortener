<?php 

/**
* Application class that handles everything from saving a URL
* to redirecting the user to the original URL
*/
class Application extends Database
{
	public function __construct()
	{
		parent::__construct();

		if ( isset($_POST['url']) && !empty($_POST['url']) )  {
			$this->processUrl( $_POST['url'] );
		} else if (isset($_GET['shortened_code'])) {
			$this->handleRedirection( $_GET['shortened_code'] );
		}
	}

	public function validateUrl( $url )
	{
		if(empty($url)) {
			return 'ERROR_NO_URL';
		}
		else if(filter_var($url, FILTER_VALIDATE_URL) === false) {
			return 'ERROR_INVALID_URL';
		}
		else if( $this->alreadyShortened( $url ) )
		{	
			return 'ERROR_IS_SHORTENED';
		} else { 
			return true;
		}
	}

	public function alreadyShortened( $url )
	{
		if ( URL_CHUNK ) {
			return (preg_match("/" . URL_CHUNK . "/i",$url)) ? true: false;
		}
	}

	public function generate_code()
	{
		$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		return substr(str_shuffle($str),0,6);
	}

	public function is_code_unique( $code )
	{
		$sql = 'SELECT COUNT(url_id) AS url_count FROM urls WHERE code=:code LIMIT 1';
		
		$query = $this->db->prepare( $sql );
		$query->execute( array( ':code' => $code ));

		$result = $query->fetch( PDO::FETCH_ASSOC );
		return ( $result['url_count'] == 0 ) ? true : false;
	}

	public function shortenUrl( $url, $code )
	{
		$sql = 'INSERT INTO urls( url, code ) VALUES( :url, :code)';

		$query = $this->db->prepare( $sql );
		$query->execute( array( ':url' => $url, ':code' => $code) );

		return ( $query->rowCount() != 1 ) ? 'ERROR_UNKNOWN' : 'SHORTENED_SUCCESS';
	}

	public function processUrl( $url )
	{
		$isValid = $this->validateUrl( $url );

		if ( $isValid === true ) {

			while( true )
			{
				$code = $this->generate_code();
				if( $this->is_code_unique($code) )
				{
					$result = $this->shortenUrl( $url, $code );

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
			// Echoing out, because there is an ajax request calling this function
			echo $isValid;
		}
	}

	public function handleRedirection( $code )
	{
		
	}
}