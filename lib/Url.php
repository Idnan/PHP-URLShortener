<?php 

/**
 * Url class to handle all the URL related tasks, such as redirections, validations, shortening and other related utility functions
 * @author Kamran Ahmed <kamranahmed.se@gmail.com>
 */
class Url extends Database
{
	// Calls the parent constructor, so to initialise the database connection
	function __construct()
	{
		parent::__construct();

	} // end __construct()

	/**
	 * validates i.e. checks, if the url passed is valid
	 * @param  string $url URL that is to be validated
	 * @return mixed      returns a string showing the validation error message if the validation fails and boolean true if the validation succeeds
	 */
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
	} // end validateUrl()

	/**
	 * Checks if the URL is already shortened by looking for our site's chunk inside the URL passed
	 * @param  string $url URL that is to be checked
	 * @return Boolean      returns true or false depending upon the result of validation
	 */
	public function alreadyShortened( $url )
	{
		// if [URL_CHUNK] constant is set inside the config file
		if ( URL_CHUNK ) {
			return (preg_match("/" . URL_CHUNK . "/i",$url)) ? true: false;
		}
	} // end alreadyShortened()

	/**
	 * generates a 6 digit random code consisting of a combination of alphabets and numbers
	 * @return string a 6 digit random code
	 */
	public function generateCode()
	{
		$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		return substr(str_shuffle($str),0,6);
	} // end generateCode()

	/**
	 * checks if the passed code is unique ( i.e. if any other URL has this code assigned to it)
	 * @param  string  $code Code that is to be checked for uniqueness (later on if the validation passes, this code will be used to shorten the URL)
	 * @return boolean       true if the passed code is unique and false otherwise.
	 */
	public function isCodeUnique( $code )
	{
		$sql = 'SELECT COUNT(url_id) AS url_count FROM urls WHERE code=:code LIMIT 1';
		
		$query = $this->db->prepare( $sql );
		$query->execute( array( ':code' => $code ));

		$result = $query->fetch( PDO::FETCH_ASSOC );
		return ( $result['url_count'] == 0 ) ? true : false;
	} // end isCodeUnique()

	/**
	 * get code for the passed URL. Checks the database for the passed URl to see, if someone has already shortened this URL.
	 * @param  string $url A URL that is to be looked for the short code
	 * @return mixed      short code is returned, if a matching code is found in the database and false otherwise
	 */
	public function getUrlCode( $url )
	{
		$sql = 'SELECT code FROM urls WHERE url=:url';
		
		$query = $this->db->prepare( $sql );
		$query->execute(array(
			':url' => $url
		));
		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		return ( count($result) !== 0 ) ? $result[0]['code'] : false;
	} // end getUrlCode()

	/**
	 * shortens the URL i.e. inserts an entry for the URL and the respective code to the database
	 * @param  string $url  URL that is to be assigned a shortcode
	 * @param  string $code short code for the URL, this will be later used to access this saved URL.
	 * @return string       Message showing the success or failure of the shortening
	 */
	public function shorten( $url, $code )
	{
		$sql = 'INSERT INTO urls( url, code ) VALUES( :url, :code)';

		$query = $this->db->prepare( $sql );
		$query->execute( array( ':url' => $url, ':code' => $code) );

		return ( $query->rowCount() != 1 ) ? 'ERROR_UNKNOWN' : 'SHORTENED_SUCCESS';
	} // end shorten()

	/**
	 * Gets the original URL by checking for the short code that is passed to it.
	 * @param  string $code short code that was used to shorten the URL
	 * @return mixed       URL if the url is found in the database against the passed shortcode and false otherwise
	 */
	public function getUrl($code)
	{
		$sql = "SELECT url FROM urls WHERE code=:code LIMIT 1";
		$query = $this->db->prepare( $sql );
		$query->execute(array(
			':code' => $code
		));
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return ( count( $result ) === 1 ) ? $result[0]['url'] : false;
	} // end getUrl()
}