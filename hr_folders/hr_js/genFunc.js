
// $(document).ready(function () 
// {
	// field_focused_isEmpty_then_hide_text ( '#id or class' , " textField or textArea default value" , "on blur color " , " on focus color" );
	function field_focused_isEmpty_then_hide_text ( textF , isEmptyVal , blurColor , focusColor ) 
	{
		$(textF).focus(function() {
		    if ( $(textF).val() == isEmptyVal ) 
			{ 
				$(textF).val("");    			 	 
				$(textF).css({"color":focusColor})
			}
		});
	 	$(textF).blur(function() {
			if ( $(textF).val()=="") 
			{ 
			    $(textF).val(isEmptyVal);	
			    $(textF).css({"color":blurColor})		 	 
			} 		
		});
	}  

	function click_show_out_hide ( clickable_el , show_container_el ) 
	{	
	 	$(clickable_el).click(function () 
		{
			// alert($(show_container_el).attr('class'));	

			if( $(show_container_el).attr('class') == 'open' ) 
			{ 
				$(show_container_el).removeClass('open');
				$(show_container_el).css({'display':'none'});
				$(show_container_el).addClass( "close" );
			} 
			else 
			{ 
				$(show_container_el).removeClass('close');
				$(show_container_el).css({'display':'block'});
				$(show_container_el).addClass( "open" );
			}
		});
	}

// });