	  

	  	var c = 0;
	  	function test1()
	  	{ 
	 		alert('you are connected with function js ');
	 	}
		function Go(location) 
		{
		 	window.location = location;
		}
	  	function live_ajax_load() {  
	  		// alert('hello');

	  		// ajax_send_data('comments_result','look_comment_items/look-comments_display.php');
	  		live_comment_initialize();
	  	} 


		function replace_all (subject , find , replace ) 
		{
				  
		 	var url1=subject.split(find);
		 	
			//alert(url1);
			var new_str = '';

			for (var i = 0; i < url1.length; i++) 
			{
		 		new_str += url1[i]+replace;		 
			};

			new_str = new_str.substring(0, subject.length);
			//alert(new_str);
			return new_str
		}

	  	

	  	function live_comment_initialize(){ 
	  		// alert('comment load');
	  		// document.getElementById('comment_loader').innerHTML = "<img src='images/loading 2.gif' >";
	  		ajax_send_data('comments_result','fs_folders/fs_lookdetails/look_comment_items/look-comments_display.php','comment_loader img'); //print current comments..
	  		// ajax_send_data('comments_result','fs_foldsers/fs_lookdetails/look_comment_items/test1.php','comment_loader img'); //print current comments..
	  		// alert('comments are loaded');

	  		
			setTimeout(function() {
				// alert('start auto load now ');
				live_comment_checker();
			} ,7000);
	  	}




	  	function live_comment_checker(){ 
	  		// alert('check initial ');
	  	// 	setTimeout(function(){
		 	// 	live_check_new_comment();
		 	// },5000);
	  		live_check_new_comment()

	  		
			


	  	}
	  	function live_check_new_comment(){ 
	  		// alert('checking database if there is new comments');
	  		live_append_new_Comment();
	  		setTimeout(function(){
	  			// alert('checking new comment');
		 		live_comment_checker();
		 	},60000);
	  	}
	  	function live_append_new_Comment(){ 
	  		// alert('add new comment');
	  		ajax_insert_and_append_result('comments_result','look_comment_items/look-comments_display.php?post_comment=live_check_new_message','comment_loader');
	  	}




















		function random_numers(num){ 
			rnum=Math.floor((Math.random()*num)+1);
			return rnum;
		} 
	  function ajax_send_data(view_result_id,data,loader)
	  { 
	  		 $('#'+loader).css('visibility','visible');
	  		 // alert("loading visible ")
		  	// alert('append is working'+view_result_id+","+data+","+loader);
	  		// alert('working data = '+data+' view result as = '+view_result_id);
	  		// document.getElementById(view_result_id).innerHTML = "<img src='images/loading 2.gif' >";
	  		// getID(view_result_id).style.background="#000 url('images/loading 2.gif') center no-repeat";

			if (window.XMLHttpRequest)  {
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

					
					document.getElementById(view_result_id).innerHTML = xmlhttp.responseText;
					// alert(xmlhttp.responseText)
					// document.getElementById('comment_loader').innerHTML = "";
					// document.getElementById(loader).innerHTML = "";
				     $('#'+loader).css('visibility','hidden');
				     // alert("loading hidden ")
				}
			}
			xmlhttp.open('GET',data,true);
			xmlhttp.send();
		}	
	 	
	 function bool_show_hide( view_result_id , data , show , hide , loader ) { 

			if (window.XMLHttpRequest)  {
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {


					document.getElementById(view_result_id).innerHTML = xmlhttp.responseText;

					 
					 // alert('this is splited'+r[0]);
					 // alert(xmlhttp.responseText.indexOf('true'));
					if (xmlhttp.responseText.indexOf('true') > 0 ) 
					{ 
						// alert('true');
						$(hide).css({'display':'none'})
						$(show).css({'display':'block'})
					}

					else if (xmlhttp.responseText.indexOf('false')) 
					{ 
						// alert('false');
						$(show).css({'display':'none'})
						$(hide).css({'display':'block'})
					}

					 $(loader).css('visibility','hidden');
				}
			}
			xmlhttp.open('GET',data,true);
			xmlhttp.send();
		}	

	  function prepend(view_result_id,data){ 
	  		// alert('working data = '+data+' view result as = '+view_result_id);
	  		// document.getElementById(view_result_id).innerHTML = "<img src='images/loading 2.gif' >";
	  		// getID(view_result_id).style.background="#000 url('images/loading 2.gif') center no-repeat";

			if (window.XMLHttpRequest)  {
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					 $('#'+view_result_id).prepend(xmlhttp.responseText);
				}
			}
			xmlhttp.open('GET',data,true);
			xmlhttp.send();
		}	


	  function appendNow(view_result_id,data,loader)
	  	{ 
			if (window.XMLHttpRequest)  {
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					$("#"+view_result_id).append(xmlhttp.responseText);
					 $('#'+loader).css('visibility','hidden');
				}
			}
			xmlhttp.open('GET',data,true);
			xmlhttp.send();
		}	
	 	





	 	function ajax_insert_and_append_reply(view_result_id,data){ 
	 		// alert('reply append live');
			if (window.XMLHttpRequest)  {
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

					 var r=xmlhttp.responseText.split("<li>");
					 // alert('total result = '+r.length);
					// for (var i = 1; i < r.length; i++) {
					// 	alert(r[i]);
					// } 
					// alert(r[1]);
					var cno =  $('.cid').text();
					// alert('cno = '+cno);
					var newRepliedComment = r[1];
					 // document.getElementById(view_result_id+cno).innerHTML = "<li>"+newRepliedComment+"</li>";
					 $('#'+view_result_id+cno).append("<li>"+newRepliedComment+"</li>");

					// if (r.length == 1 ) { 
					// }else {  
					// 	document.getElementById(loader).innerHTML = "";
					// 	$('#replyContainer').append(xmlhttp.responseText);
					// }	
					// $('#replyContainer').append(xmlhttp.responseText);	
					// document.getElementById(view_result_id).innerHTML = xmlhttp.responseText ;


					$('.replyViewMoreContainer_'+c).css({'display':'none'}); // reply view more container
				}
			}
			xmlhttp.open('GET',data,true);
			xmlhttp.send();		
	 	}
	 
		function ajax_insert_and_append_result(view_result_id,data,loader){  
				
		// alert('data = '+data);
	  		
	  		// getID(view_result_id).style.background="#000 url('images/loading 2.gif') center no-repeat";
	  		 
	  		
			if (window.XMLHttpRequest)  {
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
			}  
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

					// alert(xmlhttp.responseText);
					
					// document.getElementById('comment_loader').innerHTML='';
					// document.getElementById(view_result_id).innerHTML = xmlhttp.responseText;


					 // split(xmlhttp.responseText)
					 var r=xmlhttp.responseText.split("<li>");
					// var r=xmlhttp.responseText.split("<li >");
					// alert('len = '+r.length);


					// for(i=1;i<r.length;i++){
					// 		$("#wook ul").append("<li >"+r[i]);
					// }
					// alert('append');

					if (r.length == 1 ) { 
						// result is empty
					}else {  
						// document.getElementById(loader).innerHTML = ""; 
						$(loader).css('display','none');
						// var div = document.getElementById(view_result_id);
						// div.innerHTML = div.innerHTML + xmlhttp.responseText;
						$('#'+view_result_id).append(xmlhttp.responseText);


					}


						
							// div.innerHTML = div.innerHTML +  "<hr>";		
						// c+=100;
						// move_view_more(c);  

				}
				
			}
			xmlhttp.open('GET',data,true);
			xmlhttp.send();						

		}
			// function move_view_more(){ 
			// 	var p = $("#viewmore_comments");
			// 	var offset = p.offset();
			// 	$("#viewmore_comments").css({'margin-top':c,'position':'absolute'});
			// }
		function ajax_Send_on_flag_box(view_result_id,data,loader){ 

			// open loading here

			if (window.XMLHttpRequest)  {
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

					// close loading here

					// alert('response = '+xmlhttp.responseText);
					 document.getElementById(loader).innerHTML ='';
					 	var r=xmlhttp.responseText.split("<li>");
					 	// alert(r.length);
					if(r.length == 2){  
						alert('not yet flagged');
						// show_not_yet_flagged_box();
						// flagTable1
					}
					else{ 
						alert('already flagged');
						 // show_already_flagged_box()
						 // flagged

					}
				 	


				}
			}
			xmlhttp.open('GET',data,true);
			xmlhttp.send();
		}	


		function reply_flagged_ajax( view_result_id , data , loader ) { 

			// open loading here
			// alert('flagged ajax wrking');
			if (window.XMLHttpRequest)  {
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

					// close loading here

					// alert('response = '+xmlhttp.responseText);
					var response = xmlhttp.responseText;
					// alert(response);
					 document.getElementById(view_result_id).innerHTML = response;
					 // document.getElementById(loader).innerHTML ='';
					 	// var r=xmlhttp.responseText.split("<li>");
					 	// alert(r.length);  

					  
					 	if (response.indexOf("not yet flagged") != -1  ) { 
					 		// alert('not yet flagged');
					 		 show_reply_not_yet_flagged_box();
					 	} 
					 	else if (response.indexOf("already flagged") != -1  ) { 
					 		// alert('already flagged');
					 		 show_already_flagged_box();
					 		 // hide_reply_not_yet_flagged_box ( );
					 	}



				 

				}
			}
			xmlhttp.open('GET',data,true);
			xmlhttp.send();
		}






	 	function procceed(page){ 
	 		// alert('fsdfsd'+page);
	 		document.location=page;
	 	}
		function empty_now(pointer,type){ 
	 		// alert(pointer);
	 		// if (type == 'text') {
	 		// 	$(pointer).text('');
	 		// }
	 		// if (type == 'val') {
	 		// 	$(pointer).val('');
	 		// }
	 		// c();
	 		// document.getElementById(pointer).text('');
	 		// document.getElementById(pointer).val('fsfsfgfg');

	 	} 	
		 
		function show_reply_not_yet_flagged_box ( ) { 
			// alert('function reply flagged');
			hide_reply_edit ( );
			show_overlay_container ( );
			hide_maincomment_not_yet_flgged ( );
			hide_maincomment_flgged ( );
			show_reply_comment_not_yet_flagged ( );
		}

		function hide_reply_not_yet_flagged_box ( ) { 

	 
			hide_overlay_container ( );
			hide_reply_comment_not_yet_flagged ( );
			
			
		}
		function  show_reply_edit ( )  { 

			show_overlay_container ( );
			show_reply_edit_box ( );
			hide_maincomment_not_yet_flgged ( );
			hide_maincomment_flgged ( );
			hide_reply_comment_not_yet_flagged ( );
			hide_comment_edit ( );

		} 

	    function hide_reply_edit ( )	{ 
	    	$('.reply_edit').css({'display':'none'});
	    }
	    function  show_comment_edit (id)  { 
	    	// alert(id);

			show_overlay_container ( );
			show_reply_edit_box ( );
			show_comment_edit_box ( );
			comment_suply_text_textarea( id );
			hide_maincomment_not_yet_flgged ( );
			hide_maincomment_flgged ( );
			hide_reply_comment_not_yet_flagged ( );
			hide_reply_edit ( );
		}
		function show_reply_edit_box ( )	{   
	    	$('.reply_edit').css({'display':'block'});
	    }
		function hide_comment_edit ( )	{   
	    	$('.comment_edit').css({'display':'none'});
	    }
	    function show_comment_edit_box ( )	{ 
	    	$('.comment_edit').css({'display':'block'});
	    }
		function show_not_yet_flagged_box ( ) { 
			hide_reply_edit ( );
			hide_comment_edit ( );
		 	hide_reply_comment_not_yet_flagged ( ); 
			$('.flag_main_container').fadeIn('fast');
			$('body').css({'overflow':'hidden'});
			$('.bgcolor').css({'display':'block'});
			$('.already_flagged_div').css({'display':'none'});
			$('.replybox').css({'display':'none'});
			$('.not_yet_flagged_table').css({'display':'block'});
			$('.text_area_notes').val('');

			$('.check_box1').attr('checked', false);
			$('.check_box2').attr('checked', false);
			$('.check_box3').attr('checked', false);

		}
		function show_already_flagged_box ( ){ 
			hide_reply_edit ( );
			hide_comment_edit ( );
			hide_reply_comment_not_yet_flagged ( );
			$('.flag_main_container').fadeIn('fast');
			$('body').css({'overflow':'hidden'});
			$('.bgcolor').css({'display':'block'});
			$('.not_yet_flagged_table').css({'display':'none'});
			$('.replybox').css({'display':'none'});
			$('.already_flagged_div').css({'display':'block'});	
		}



		function show_overlay_container() { 
			$('.flag_main_container').fadeIn('fast');
			$('body').css({'overflow':'hidden'});
			$('.bgcolor').css({'display':'block'});
		}

		function hide_overlay_container() { 
			$('.flag_main_container').fadeOut('fast');
			$('body').css({'overflow':'visible'});
			$('.bgcolor').css({'display':'none'});
		}
		function hide_maincomment_not_yet_flgged() { 
			$('.not_yet_flagged_table').css({'display':'none'});
			$('.replybox').css({'display':'none'});
		}


		function hide_maincomment_flgged() { 
			$('.already_flagged_div').css({'display':'none'});
			$('.replybox').css({'display':'none'});
		} 

		function hide_reply_comment_not_yet_flagged ( ) { 
			$('.reply_not_yet_flagged_table').css({'display':'none'});
			$('.reply_text_area_notes').css({'display':'none'});
		}
		function show_reply_comment_not_yet_flagged ( ) { 
			hide_reply_edit ( );
			hide_comment_edit ( );
			$('.reply_not_yet_flagged_table').css({'display':'block'});
			$('.reply_text_area_notes').css({'display':'block'});
		}
		function setEmpty(){  
			$('.text_area_notes').val('');
			$('#comment_box').val('');
			$('.replyTextArea').val('');
			$('.reply_text_area_notes').val('');
			$('.reply_edit_textarea').val('');
		}
		function set_unchecked_checkbox() { 
			$('.check_box1').attr('checked', false);
			$('.check_box2').attr('checked', false);
			$('.check_box3').attr('checked', false);
		}   
		function get_comment_reply_edit ( plcrno ) { 
			var rcomment = $('#rcomment_span_'+plcrno).text();
			// rcomment=rcomment.substring(2,rcomment.length );
			$('.reply_edit_textarea').val(rcomment);
		}
		function replace_edited_replied_text( plcrno ) { 

			$('#rcomment_span_'+plcrno).text($('.reply_edit_textarea').val());  
		}
		function comment_suply_text_textarea( id ) {  
			var ctext = $('#comment_span_'+id).text( ) ; 
			$('.comment_edit_textarea').val(ctext);
		}	
		function get_new_edit_comment( ) { 
			return $('.comment_edit_textarea').val();
		} 
		function set_new_edit_comment( commentEdited , id ) { 
		 	$('#comment_span_'+id).text( commentEdited );
		} 








	//  new home 



	  function append_home(view_result_id,data,loader,home_counter)
	  { 
	  

	  	// alert('function append work')
	  	if( loader == '')
	  	{
	  		alert('loader is empty ');
	  	}

	  		 var c=0;
			if (window.XMLHttpRequest)  {
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					var r=xmlhttp.responseText.split("<li >");
	 
				 
				 	 
					// document.getElementById('imgres').innerHTML =  data+xmlhttp.responseText;

					for(i=1;i<r.length;i++){	
						c++;
						// alert(r[i]);
						$('#home_res'+c).append("<li >"+r[i]);

	 
						if (c == 3 ) 
						{
							c=0;
						} 
						if ( i == r.length-1 ) 
						{
						}
					}
					$(loader).css({'display':'none' });


				}	

			}

			xmlhttp.open('GET',data,true);
			xmlhttp.send();
		}	


	  function append_home_tabs(view_result_id,data,loader,url)
	  { 

	 

	  		window.history.pushState({"html":'html',"pageTitle":"home page is this "},"",url);
	  		// alert(' append home tabs work in function.js line 592');
	  		 var c=0;
			if (window.XMLHttpRequest)  {
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					// $('#'+view_result_id).append(xmlhttp.responseText);
					var r=xmlhttp.responseText.split("<li >");
					// alert('total result = '+r.length); 

					document.getElementById('home_res1').innerHTML ='';
					document.getElementById('home_res2').innerHTML ='';
					document.getElementById('home_res3').innerHTML ='';

				    // document.getElementById('imgres').innerHTML =  data+xmlhttp.responseText;
	 
					$('.look_container_div').css({"display":"none"});
					var c = 0;
					for(i=1;i<r.length;i++){	
						c++;
						// alert(r[i]);
						// $('#look_t').fadeIn('slow');
						$('#home_res'+c).append("<li id='wee' >"+r[i]);

						if (c == 3 ) 
						{
							c=0;
						} 
						if ( i == r.length-1 ) 
						{
							// alert('get position of the footer.');
						}
					}
					$(loader).css({'display':'none'});
				}	

			}

			xmlhttp.open('GET',data,true);
			xmlhttp.send();
		}	
	   


	// end home

		// new design functions 
			function click_show_or_hide ( clickable_el , show_container_el ) 
			{	
				// click_show_out_hide
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
						// $(show_container_el).slideDown('fast');
						$(show_container_el).addClass( "open" );
					}
				});
			}
			function mouseOver_elemShow_mouseOut_elemHide( mouseOver_el , mouseOut_el , show_hide_el ) 
		    {	
		    	$(mouseOver_el).mouseover(function ( ) {
		    		$(show_hide_el).css("display","block");
		    	})
		    	$(mouseOut_el).mouseout(function ( ) {
		    		$(show_hide_el).css("display","none");
		    	})
		    }
		    function mouseOver_hideMe_showOther_mouseOut_showMe_hideOther (mouseOver_el , hide1 , show1 , mouseOut_el , hide2 , show2 ) 
		    {	
	 			// mouseOver_hideMe_showOther_mouseOut_showMe_hideOther ('#invite_img1' , "#invite_img1" , "#invite_img2" , "#invite_img2" , "#invite_img1" , "#invite_img2" ) 	    	  
		    	$(mouseOver_el).mousemove(function ( ) {
		    		// alert('enter');
		    		$(hide1).css("display","none");
		    		$(show1).css("display","block");
		    	})
		    	$(mouseOut_el).mouseout(function ( ) {
		    		$(hide2).css("display","block");
		    		$(show2).css("display","none");
		    	})
		    }
		    function mouseIn_showOverFlow_mouseOut_shideOverFlow( element ) 
			{
				$(element).mouseover(function() {
					// alert("mouse enter");
					$(element).css({"overflow-y":"auto"});  
				} )
				$(element).mouseout(function() {
					// alert("mouse out");
					$(element).css({"overflow-y":"hidden"});
				} )
			}
			function click_hide_and_show_el ( clicked_el , hide_el , show_el , other_el_hide ,  other_el_show , hideDropDowns , openDropDowns ) 
			{

			 	// var clicked_el = "#invite_img1";

			 	// var hide_el = "#invite_img1"; 
			 	// var show_el = "#invite_img2";	

			 	// var current_class = 'grey';
			 	// var new_class = 'red';

			 	

			 	$(clicked_el).click(function( ) {

	 				$(show_el).css({'display':'block'});
	 				$(other_el_show).css({'display':'block'});

	 				$(hide_el).css({'display':'none'});
	 				$(other_el_hide).css({'display':'none'});
	 				
	 				$(hideDropDowns).css({'display':'none'});
	 				$(openDropDowns).css({'display':'block'});
	  				
	 				
			 	})
			}
	 
		// new design functions 

		// new warnings 
			function warning_link_under_onstruction() 
			{
			 	alert('Our programmer and designer are hard working to make this link live ASAP, thank you from FS team');
			}
		// end warning



		// new home or index  
			function link_colored_when_document_ready (link_id , color , underline) 
			{
				
				 $(link_id).css({'color':color});
				 $(underline).css({'border':'3px solid #c51d20','display':'block'});
			}
		// end home or index 

		//  new post article
			function post_article_result( view_result_id , data , loader )
			{  
		  		$('#'+loader).css('visibility','visible');
	 
	 			if (window.XMLHttpRequest)  {
					xmlhttp = new XMLHttpRequest();
				} else {
					xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
				}  
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{

						document.getElementById('home_res1').innerHTML ='';
						document.getElementById('home_res2').innerHTML ='';
						document.getElementById('home_res3').innerHTML ='';
					    document.getElementById("article_res").innerHTML = "";
					    var result = xmlhttp.responseText;
	 
					    // get title
					    // var str = "How are you doing today?";
					  	// alert(n[1]);
					    // alert(title[1]);
					    // alert(desc[1]);
					    // var res_container = "";
		  
					    // new title and description
					    	var n = result.split("<h1>");
						    var title = n[1].replace("</h1>","");
						     var desc = n[2].replace("</h1>","");
		 					
		 					$('#article_description').val("");
							$('#article_title').val(title);
							$('#article_description').val(desc);


							var r=xmlhttp.responseText.split("<li>");
							var rlen = r.length;
							var rlen1 = rlen-1;
						// new title and description

						// new for the result
							var c = 0; 
							$('#article_total_result span').css({'visibility':'visible'});

							var found_message = ''; 
							if (  rlen1 ==  0) 
							{
								found_message = 'Sorry No Article Found';
							}
							else 
							{ 
								found_message = rlen1+' Article Found';
							}
							$('#article_total_result span').text( found_message );
	 					// end for the result

	 					// new images display
							for(i=1;i<r.length;i++)
							{
								c++;
								// alert('res = '+r[i]);
								$('#home_res'+c).append("<li>"+r[i]);
								
								if ( c ==  3 ) 
								{
									c=0;
								} 
							}
							$('#'+loader).css('visibility','hidden');
						// end images display  
					}
				}
				xmlhttp.open('GET',data,true);
				xmlhttp.send(); 
			}
		// end post article 
		function home_initialize() { 
		 
			
		}


		// new hr 
			function  delete_reservation ( rl_id  ) {
				alert(" rlid = "+rl_id);
				var bol = confirm("are you sure to delete this reservation ? "); 
				if (bol == true) {
					// alert("reservation succesfully deleted!")
					document.location = 'delete_reservation?rl_id='+rl_id+'&fromPage=home';
				}else{
					// alert("reservatoin not deleted! ")
				}
			}

			function delete_hr ( loc , message ) {
				 if ( confirm(message) ) {
				 	document.location = loc;
				 }else{

				 }
			}


		// end hr