
// JavaScript Document


$(document).ready(function(){
	
	$('.fancybox').fancybox();
	$('.fancybox-thumbs').fancybox({
				
				prevEffect : 'none',
				nextEffect : 'none',


				closeBtn  : false,
				arrows    : false,
				nextClick : true,
				title : 'Photo Album',
				helpers : {					
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});
	
	$(document).tooltip();
	$(".dropdown-toggle").dropdown();
	
	$( "#progressbar" ).progressbar({
			value: false
		});

	 $("#dp_issue").datepicker({
		    minDate: 0, maxDate: "+48M",
		 	showOn: "button",
		 	dateFormat:"DD, d MM, yy",
			buttonImage: "source/images/calendar.gif",
			buttonImageOnly: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true
		});		

	  $("#datepicker").datepicker({
	        showOn: "button",
			buttonImage: "source/images/calendar.gif",
			buttonImageOnly: true,
			changeMonth: true,
			dateFormat:"DD, d MM, yy",
			changeYear: true,
			showButtonPanel: true
		});
	
$("input[type=password]").hidePassword(true);
		

$("#an").keyup(function(){
	
	var an = $("#an").val();
	an = $.trim(an);
	
	$.get("getbookdetails.php",{an:an},function(json) {	
	
	var d = jQuery.parseJSON(json);	
	
	$("#callno").val(d.call_no);
	$("#authors").val(d.authors);
	$("#title").val(d.title);
	$("#p").val(d.publisher);
	$("#pd").val(d.published_date);
	$("#pp").val(d.published_place);
	$("#price").val(d.price);
	$("#pages").val(d.pages);
	$("#volume").val(d.volume);
	$("#edition").val(d.edition);
	$("#source").val(d.source);
	$("#billno").val(d.bill_no);	
	$("#subject").val(d.subject);
	$("#category").val(d.category);
	$("#remark").val(d.remark);	
	});  
});	//end of #an keypup
	
$("#searchBox").keyup(function() {
	var a = $("#searchBox").val();
	a = $.trim(a);
	if(a)
	{
		$(".main").html("<img id='load' src='source/images/load.gif'>");				
		$.get("search.php",{id:a},function(d) {			
		$(".main").html(d);
		});
	}
	else
	{
		$(".main").html("");
	}
});//end of #searchBox keypup
		
function searchResult()
{
	var a = $("#searchBox").val();
	a = $.trim(a);
	if(a)
	{
		$(".main").html("<img id='load' src='source/images/load.gif'>");				
		$.get("search.php",{id:a},function(d) {			
		$(".main").html(d);
		});
	}
	else
	{
		$(".main").html("");
	}
 }//end of searchResult()	
		
$("#issue_an").autocomplete({						
	source:'getBooks.php',
    minLength:1 // search after 1 character
   });	
$("#issue_libid").autocomplete({
    source:'getMembers.php',
    minLength:1 // search after 1 character
   });
$("#return_an").autocomplete({						
    source:'getIssuedBooks.php',
    minLength:1 // search after 1 character
  });	
$("#return_libid").autocomplete({
    source:'getMembers.php',
    minLength:1 // search after 1 character
  });					

});

function logoutNow(){
	$( "#dialog-confirm" ).dialog({
			resizable: false,
			height:140,
			modal: true,
			buttons: {
				"Logout from the System": function() {
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	}