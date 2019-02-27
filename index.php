<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Autocomplete js task</title>
	<link rel="Shortcut Icon" href="http://cdn.tripbase.com/favicon.ico">

	<style>
		body {
			font-size: 16px;
		}
		#flights_booking_form {
			width: 62.2%;
			min-width: 580px;
			max-width: 750px;
			background-color: #D9EBFF;
			margin: 0 auto 0 auto;
			padding: 25px;
			border-radius: 8px;
			text-align: left;
			font-family: Arial;
			-webkit-box-shadow: 0px 0px 5px rgba(50, 50, 50, 0.64);
			-moz-box-shadow: 0px 0px 5px rgba(50, 50, 50, 0.64);
			box-shadow: 0px 0px 5px rgba(50, 50, 50, 0.64);
		}
		.text_input_big {
			width: 94.2%;
			margin-bottom: 20px;
		}
	</style>
</head>

<body style="background-color: #5e99c0;">

	<div id="flights_booking_form" style="position:relative;">
		<form action="javascript:void(0)">
			<div>
				<div>
					<label>From</label>
				</div>
				<div>
					<input type="text" id="flights-origin" class="text_input_big" placeholder="City or Airport" tabindex="1" />
				</div>
			</div>
			<div style="clear: both;"></div>
            <div class="ui-widget" style="margin-top:2em; font-family:Arial">
                Result:
                <div id="log" style="height: 200px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
            </div>

		</form>
	</div>

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/customAutocomplete.js"></script>
    <script>
        $(function() {
            var autocompleteUrl = "http://localhost:8070/api/v1/search";
            $( "#flights-origin" ).autocomplete({
                delay: 50,
                source: function( request, response ) {
                    $.ajax({
                        url: autocompleteUrl,
                        dataType: "json",
                        data: {
                            q: request.term,
                            max: 3
                        },
                        success: function( data ) {
                            response( data );
                            console.log(data);
                        }
                    });
                },
                minLength: 3,
                select: function( event, ui ) {
                    console.log('select');
                    $.fn.logAutocomplete( event, ui );
                },
                open: function(event, ui) {
                    $.fn.openAutocomplete();
                },
                close: function() {
                    $.fn.closeAutocomplete();
                }
            }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
                return $.fn.buildAutocomplete( ul, item );
            };
        });
    </script>


<!--	<script>-->

<!---->
<!--		// todo: example usage:-->
<!--		$('#flights-origin').customAutocomplete({-->
<!--			'url' : autocompleteUrl,-->
<!--			'fontSize' : '14px',-->
<!--			// 'prepareDataFunc' : autocompletePrepareDataFunc,-->
<!--			// 'prepareLabelFunc' : autocompletePrepareLabelFunc-->
<!--		});-->
<!---->
<!---->
<!--	</script>-->
</body>
</html>
