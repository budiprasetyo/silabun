/*
 * base.js
 * 
 * Copyright 2012 budi prasetyo a.k.a. metamorph <metamorph@Cyber-Station> bprast1@yahoo.co.id
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 *

/*-----------------------------------
 * jquery.ui dialog
 * @access		public
 *----------------------------------*/
function dialog()
{
	$("#formdialog").dialog({
		modal: true
	});	
}
/*-----------------------------------
 * jquery.ui datepicker
 * @access		public
 *----------------------------------*/
function datepicker(date_id)
{ 
	$("#"+date_id).datepicker({
		changeMonth: true,
		changeYear: true,
		buttonImage : '/../assets/development-bundle/demos/datepicker/images/calendar.gif',
		dateFormat: 'dd/mm/yy'
	});
}	
/*-----------------------------------
 * jquery.ui monthpicker hack from datepicker
 * @access		public
 *----------------------------------*/
function monthpicker(month_class)
{
    $("."+month_class).datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'dd/mm/yy',
        onClose: function(dateText, inst) { 
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        },
		beforeShow : function(input, inst) {
			if ((datestr = $(this).val()).length > 0) {
				year = datestr.substring(datestr.length-4, datestr.length);
				month = jQuery.inArray(datestr.substring(0, datestr.length-5), $(this).datepicker('option', 'monthNames'));
				$(this).datepicker('option', 'defaultDate', new Date(year, month, 1));
				$(this).datepicker('setDate', new Date(year, month, 1));
			}
		}
    });
    $("."+month_class).focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
}

/*---------------------------------------
 * jquery prevent Enter button
 * Enter button causes form submission
 * @access		public
 *--------------------------------------*/
function preventEnter()
{
	$("input:text:first").focus();
			
	$("input:text").bind("keydown",function(e){
		var n = $("input:text").length;
		if(e.which == 13) 
		{ 
			e.preventDefault();
			
			var nextIndex = $("input:text").index(this) + 1;
			if(nextIndex < n)
			{
				$("input:text")[nextIndex].focus();
			}
			else
			{
				$("input:text")[nextIndex-1].blur();
				$("#btnSubmit").click();
			}
		}
	});
	
	$("#btnSubmit").click(function(){
	});
}
/*-----------------------------------
 * jquery success confirmation 
 * @access		public
 *----------------------------------*/
function successConfirm()
{
	$(".success").fadeOut(5000,function(){
	});
}
/*-----------------------------------
 * jquery failed confirmation 
 * @access		public
 *----------------------------------*/
function failedConfirm()
{
	$(".failed").fadeOut(5000,function(){
	});
}
/*----------------------------------------------
 * jquery autocomplete
 * dependencies only jquery with no plugin
 * @access		public
 * @param		string(the name of controller)
 * @return 		string
 *---------------------------------------------*/
function autoComplete(controller,category_suggestions,category,category_autoSuggestionsList)
{
		var item1 = '#'+category_suggestions;
		var item2 = '#'+category;
		var item3 = '#'+category_autoSuggestionsList;
		
		$("#"+category_suggestions).css({
			"list-style": "none",
			"padding": "5px 10px",
			"border": "2px solid #9EA1A5",
			"background": "#fdb1c4",
			"width": "365px",
			"-moz-border-radius": "4px",
			"-webkit-border-radius": "4px",
			"-o-border-radius": "4px",
			"border-radius": "4px",
			"cursor": "pointer"
			});
		
		$(item1).hide();
		
		function lookup(fieldSuggestions, fieldSuggestionsList, inputString){
			if(inputString.length == 0){
				$(fieldSuggestions).hide();
			}else{
				$.post(controller,
				{queryString: ""+inputString+""},
				function(data){
					if(data.length > 0){
						$(fieldSuggestions).show();
						$(fieldSuggestionsList).html(data);
					}
				});
			}
		}
		
		function fill(fieldId, fieldSuggestions, thisValue){
			$(fieldId).val(thisValue);
			setTimeout("$('" + fieldSuggestions + "').hide();",200);
		}
		
		$(item2).keyup(function(){
			lookup(item1, item3, $(item2).val());
		});
		// fill text box with li title
		$(item3 + " li").live('click',function(){
			fill(item2, item1, $(this).attr('title'));
		});
	
}
/*----------------------------------------------
 * jquery clone input text
 * dependencies only jquery with no plugin
 * @access		public
 * @param		string(id input text and clone input text)
 * @return 		string
 *---------------------------------------------*/
function cloneInputText(idInputText,idClone1,idClone2,idClone3)
{
	                                   
	$("#"+idInputText).change(function() {                  
		$("#"+idClone1).val(this.value);                  
		$("#"+idClone2).val(this.value);                  
		$("#"+idClone3).val(this.value);                  
	});
	
	/*
	$("#"+idInputText).blur(function() {
		$+idClone.val( this.value );
	});
	*/
}

/*-----------------------------------------------
 * jquery calx for calculation
 * dependency to src="<?php echo base_url();?>assets/calx-master/jquery-calx-1.1.9.js"
 * @acces		public
 * @param 		none
 * @return		none
 * --------------------------------------------*/
function calculationForm()
{
	//register new language config
	    $().calx('language',{
		id : 'id',
			config: {
				delimiters: {
				thousands: '.',
				decimal: ','
				},
				abbreviations: {
				thousand: 'rb',
				million: 'jt',
				billion: 'M',
				trillion: 'T'
				},
				ordinal : function (number) {
				return '';
				},
				currency: {
				symbol: 'Rp'
				}
	        }
	    });
	    
	    //load the language
	    $('#calx').calx({
		language : 'id'
	    });
}

/*----------------------------------------------
 * jquery hide input text depends on radio button
 * dependencies only jquery with no plugin
 * @access		public
 * @param		string keyID
 * @param		string classHide
 * @return 		string
 *---------------------------------------------*/
function showInputRadio(keyID,classHide,boolvalue)
{
	$('.'+classHide).hide();
	$("input[name='"+keyID+"']").click(function(){
		if($("input[name='"+keyID+"']:checked").val() == boolvalue)
			$('.'+classHide).show();
		else $('.'+classHide).hide();
	});
}


function showInputText(keyID,classHide)
{
	$("."+classHide).hide();
	$("#"+keyID).on("keyup focus", function(e){
		if( $("#"+keyID).val() == '' )
		$("."+classHide).hide(500);
		else
		$("."+classHide).show(500);
	});
}

function showInputTextByClick(keyID,classHide)
{
	$("."+classHide).hide();
	$("#"+keyID).click(function(){
		$("."+classHide).toggle(500);
	});
}
