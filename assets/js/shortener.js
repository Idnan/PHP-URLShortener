var Shortener = function(){

	// Private
	var $urlBox = $('.urlBox');
	var $shortenBtn = $('.shortenBtn');

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
				dataType : 'json',

				data : { url : $urlBox.val() },

				beforeSend : function() { },
				success : function( data ) { 

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