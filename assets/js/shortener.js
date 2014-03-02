var Shortener = function(){

	// Caching the "elements"
	var $urlBox = $('.urlBox');
	var $shortenBtn = $('.shortenBtn');

	/**
	 * Messages that will be shown to the user in different cases.
	 * @type {Object}
	 */
	var messages = {
		'ERROR_NO_URL' : 'Error!\nNo URL was provided to be shortened!',
		'ERROR_INVALID_URL' : 'Error!\nInvalid URL entered, please enter a valid URL e.g. http://somelink.com/foo/bar',
		'ERROR_IS_SHORTENED' : 'Error!\nURL you have provided is already shortened!',
		'ERROR_UNKNOWN' : 'Error!\nAn unknown error occured, and the shortening was unsuccessful, please try again!',
		'SHORTENED_SUCCESS' : 'URL successfuly shortened!'
	};	

	/**
	 * Checks if the URL provided is valid
	 * @param  {string}  url URL that is being provided to be shortened
	 * @return {Boolean}     TRUE/FALSE depending upon the validation being passed by the URL or not.
	 */
	function isValidUrl ( url ) {

		// Add the validation code here

		return true;
	} // end isValidUrl( url )

	function validateForm () {
			
		var url = $urlBox.val();

		if ( url ) { // if there is a URL to shorten

			if ( isValidUrl( url ) ) {
				
				return true;

			} else { // invalid URL entered
				
				$urlBox.addClass('input-error');
				$urlBox.focus();

				alert('Please provide a valid URL! e.g. http://someurl.com/foo/bar');

				return false;
			}

		} else { // No URL entered
			$urlBox.addClass('input-error');
			$urlBox.focus();

			alert('URL field is required!');

			return false
		}

	} // end validateForm()

	// Public 
	var obj = {

		init : function() {
			obj.bindUI();
		}, // end init()

		bindUI : function() {

			$shortenBtn.on('click', function() {
				if ( validateForm() ) {
					obj.shortenUrl();
				}
			});

		}, // end bindUI()

		shortenUrl : function() {
			$.ajax({

				url : 'bootstrap.php',
				type : 'post',

				data : { url : $urlBox.val() },

				beforeSend : function() { },
				success : function( data ) { 
					// Trim out the white spaces from data.
					data = $.trim(data);
					var msgParts = data.split('@');

					if (msgParts[0] === 'SHORTENED_SUCCESS') {
						alert( messages[msgParts[0]] );
						$urlBox.val(msgParts[1]);
						$urlBox.select();
					} else {
						alert( messages[msgParts[0]] );
					}
				},
				complete : function( data ) { },
				error : function( error ) { 
				}

			});
		}

	}; // end obj

	return obj;
};

var app = new Shortener();
app.init();