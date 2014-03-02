<?php 

/**
* Url class to handle all the shortening and other related URL tasks
*/
class Url extends Database
{
	function __construct()
	{
		parent::__construct();
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

	public function generateCode()
	{
		$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		return substr(str_shuffle($str),0,6);
	}

	public function isCodeUnique( $code )
	{
		$sql = 'SELECT COUNT(url_id) AS url_count FROM urls WHERE code=:code LIMIT 1';
		
		$query = $this->db->prepare( $sql );
		$query->execute( array( ':code' => $code ));

		$result = $query->fetch( PDO::FETCH_ASSOC );
		return ( $result['url_count'] == 0 ) ? true : false;
	}

	public function getUrlCode( $url )
	{
		$sql = 'SELECT code FROM urls WHERE url=:url';
		
		$query = $this->db->prepare( $sql );
		$query->execute(array(
			':url' => $url
		));
		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		return ( count($result) !== 0 ) ? $result[0]['code'] : false;
	}

	public function shorten( $url, $code )
	{
		$sql = 'INSERT INTO urls( url, code ) VALUES( :url, :code)';

		$query = $this->db->prepare( $sql );
		$query->execute( array( ':url' => $url, ':code' => $code) );

		return ( $query->rowCount() != 1 ) ? 'ERROR_UNKNOWN' : 'SHORTENED_SUCCESS';
	}

	public function getUrl($code)
	{
		$sql = "SELECT url FROM urls WHERE code=:code LIMIT 1";
		$query = $this->db->prepare( $sql );
		$query->execute(array(
			':code' => $code
		));
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return ( count( $result ) === 1 ) ? $result[0]['url'] : false;
	}
}