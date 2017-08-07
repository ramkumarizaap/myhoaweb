$(document).ready(function(){
	  $('#back-to-top').click(function () {
      $('#back-to-top').tooltip('hide');
      $('body,html').animate({
          scrollTop: 0
      }, 300);
      return false;
  });

	  $(".login-btn").click(function(){
	  	username = $("#username").val();
	  	password = $("#password").val();
	  	if(username=="")
	  		$(".error.username").html("Please Enter Username");
	  	else if(password=="")
	  		$(".error.password").html("Please Enter Password");
	  	else
	  	{
	  		$.ajax({
	  			type:"POST",url:"http://localhost/myhoaweb/home/login_check/",
	  			data:{username:username,password:password},
	  			success:function(data)
	  			{
	  				if(data=="Fail")
	  				{
	  					$(".error.invalid").html("Invalid Username or Password<br>");
	  				}
	  				else
	  					$(location).attr('href',"http://localhost/myhoaweb/home/logged");
	  			}
	  		});
	  	}
	  });
	  $(".verify_code").click(function(){
	  	code = $("#code").val();
	  	if(code=="")
	  	{
	  		$(".comm_code").html("Please Enter Community Code");
	  	}
	  	else
	  	{
	  		$.ajax({
	  			type:"POST",url:"http://localhost/myhoaweb/registration/input_check/",
	  			data:{table:"hoa_community",val:code,type:"code"},
	  			success:function(data)
	  			{
	  				if(data=="Fail")
	  				{
	  					$(".comm_code").html("InValid Community Code");
	  					$(".save-btn").hide();
	  				}
	  				else
	  				{
	  					$(".comm_code").html("Valid Community Code");
	  					$(".save-btn").show();
	  				}
	  			}
	  		});
	  	}
	  });
	  $("#email").blur(function(){
	  	val = $(this).val();
	  	$.ajax({
	  		type:"POST",
	  		url:"http://localhost/myhoaweb/registration/input_check/",
	  		data:{table:"hoa_users",val:val,type:"email"},
	  		success:function(data)
	  		{
	  			if(data=="Fail")
	  			{
	  				$(".next-btn").hide();
	  				$(".email").html("Email Already Exists");
	  			}
	  			else
	  			{
	  				$(".next-btn").show();
	  				$(".email").html("");
	  			}
	  		}
	  	});
	  });

	$('#rootwizard').bootstrapWizard(
		{
			onNext: function(tab, navigation, index) 
			{
				$(".error").html("");
				$("input").css("border","1px solid #ccc");
				var error_message = '';
				var error_count = 0;
				if(index==1) 
				{
					//alert($('#u_username').val());
					$(".register-btn").hide();
					$("ul.pager").show();
					if(!$('#fname').val()) 
					{
						$("#fname").css("border","1px solid red");
						$(".fname").html('Please enter First Name');
						error_count++;
					}
					if(!$('#lname').val()) 
					{
						$("#lname").css("border","1px solid red");
						$(".lname").html('Please enter Last Name');
						error_count++;
					}
					if($('#u_username').val()=='') 
					{
						$("#username").css("border","1px solid red");
						$(".username").html('Please enter Username');
						error_count++;
					}
					if(!$('#email').val()) 
					{
						$("#email").css("border","1px solid red");
						$(".email").html('Please enter Email-ID');
						error_count++;
					}
					if($('#email').val() != false) 
					{
						if(!is_valid_email($('#email').val())) 
						{
							$("#email").css("border","1px solid red");
							$(".email").html('Please enter valid Email-ID');
							error_count++;
						}
					}
					if(!$('#u_password').val()) 
					{
						$("#u_password").css("border","1px solid red");
						$(".password").html('Please enter Password');
						error_count++;
					}
					if(!$('#v_password').val()) 
					{
						$("#v_password").css("border","1px solid red");
						$(".v_password").html('Please enter Verify Password');
						error_count++;
					}
					if( ($('#u_password').val()!='' && $('#v_password').val()!='') 
							&& ( $('#u_password').val() != $('#v_password').val()) )
					{
						$("#v_password,#password").css("border","1px solid red");
						$(".v_password").html('Password Mismatch');
						error_count++;
					}
					if(error_count > 0) 
					{
						//alert(error_message);
						return false;
					}
					else
					{
						$(".register-btn").show();
						$("ul.pager").hide();
						return true;
					}
				}
				else if(index == 2) 
				{

					//checking if a gender is chosen
					var value = $("input[type='radio'][name='gender']:checked").val();
					if(value === undefined) 
					{
						error_message = 'Please select a gender.\n';
						error_count++;
					}
					//checking if address is valid
					if($('#age_select').val() < 18) 
					{
						error_message = error_message + 'You must be 18 or older to register.';
						error_count++;
					}
					if(error_count > 0) 
					{
						alert(error_message);
						return false;
					}
					else 
					{
						return true;
					}
				}
				else if(index == 3) 
				{
					//check the character length of address to validate
					if(($('#address').val().length) < 10) 
					{
						alert('Address can\'t be less than 10 characters.');
						return false;
					}
				}
			}
		});


function is_valid_email(email) {

	var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

	return re.test(email);

}
var error_count = 0;
$(".save-btn").click(function(){
	
	$.ajax({
		type:"POST",
		url:"http://localhost/myhoaweb/registration/check_code",
		data:{code:$("#code").val()},
		success:function(data)
		{
			
			console.log(data);
			if(data==0)
			{
				$("form").submit();
			}
			else
			{
				alert("Invalid Community Code");
				return false;
			}
		}
	});
	
});


$('.ip_date').bootstrapMaterialDatePicker
			({
				time: false,
				minDate : new Date(),
				clearButton: false
			});

/*Refine Users Results Based on Community*/

	$(".sel_community").change(function(){
		val = $(this).val();
		$.ajax({
			type:"POST",
			url:"http://localhost/myhoaweb/invoices/get_users/",
			data:{val:val},
			success:function(data)
			{
				if(data!="Fail")
				{
					$("div.refine_result").removeClass("hide");		
					$("div.refine_result table tbody").html(data);
				}
				else
				{
					//$("div.refine_result").toggleClass("hide");		
					$("div.refine_result table tbody").html("No Results Found");
				}
			}
		});
		
	});
	$(".sel_all_user").click(function(){
		$(".usel_all_user").toggleClass("hide");
		$(".sel_all_user").toggleClass("hide");
		$("div.refine_result table tbody td input[type='checkbox']").prop("checked",true);
	});
	$(".usel_all_user").click(function(){
		$(".sel_all_user").toggleClass("hide");
		$(".usel_all_user").toggleClass("hide");
		$("div.refine_result table tbody td input[type='checkbox']").prop("checked",false);
	});

	$(".done_sel").click(function(){
		$('#adduser').modal('hide');
		var a = $("div.refine_result table tbody td input[type='checkbox']:checked").parent().parent().parent().html();
		$(".sel_results thead")
			.append(a)
			.find("a")
			.text("Remove");
		
		$(".sel_results td:first-child").remove();
	});

	$(document).on('click',".del_item_row",function()
		{
			$(this).parent().parent().remove();
		});
	

	function autoCalcSetup() {
					$('form[name=invoice]').jAutoCalc('destroy');
					$('form[name=invoice] .item_table tr[name=line_items]').jAutoCalc({
						keyEventsFire: true,
						 decimalPlaces: 2,
						 emptyAsZero: true,
						 thousandOpts: [',']
					});
					$('form[name=invoice]').jAutoCalc({decimalPlaces: 2});
				}
				autoCalcSetup();


		$(".add_item").click(function(){
			
					var $table = $(".item_table");
					var $top = $table.find('tr[name=line_items]').first();
					var $new = $top.clone(true);
					$new.jAutoCalc('destroy');
					$new.insertAfter($top);
					$new.find('input[type=text]').val('');
					autoCalcSetup();
		});

		/*$(".i_qty,.i_tax,.i_price").keyup(function(){
			qty = $(".i_qty").val();
			tax = $(".i_tax").val();
			price = $(".i_price").val();
			val = parseFloat(price)  * parseFloat(qty);
			total = ((val / 100) * tax) + val;
			alert(total);
		});*/

		$(".num_only").keypress(function(event){
			 return (((event.which > 47) && (event.which < 58)) || (event.which == 13));
		});
		
		$(".inbox-table tbody tr").click(function(){
			$(location).attr("href",$(this).attr("data-href"));
		});

		$(".del_cat").click(function(){
			$("#DeleteModal .modal-footer a").attr("href",$(this).attr("data-href"));
		});
		$(".remove_message").click(function(){
			val = $(this).attr("data-id");
			$(this).parent().parent().parent().remove();
			$.ajax({
				type:"POST",
				url:"http://localhost/myhoaweb/inbox/delete_message",
				data:{val:val},
				success:function(Data)
				{
					$(this).parent().parent().parent().remove();
				}
			});
		});

		//$(".select2-select").select2();

		$("ul.input-list li").click(function(){
			field =$(this).attr("data-field");
			$("input[name='label']").val("");
			$(".field_type").val(field);
			if(field=="select-field" || field=="radio-field" || field=="check-field")
				$(".opt-div.select,.other-field").show();
			else if(field=="payment-field")
				$(".payment-field").show();
		});
		$(".add_opt_field").click(function(){

			field = $(".field_type").val();
			switch(field)
			{
				case 'select-field':
				case 'radio-field':
				case 'check-field':
				html = '<div>'+
	      					'<div class="col-md-11">'+
	      							'<input type="text" class="form-control" name="select_ip[]">'+
	      					'</div>'+
      						'<a href="javascript:void(0)" class="del_ip">'+
      							'<i class="glyphicon glyphicon-remove"></i>'+
      						'</a>'+
	      				'</div><br>';
					$(".opt-div.select").append(html);
				break;
			}
		});
		$(document).on("click",".del_ip",function(){
			$(this).parent().remove();
		});

		$(".del_form").click(function(){
			id = $(this).attr("data-id");
			$.ajax({
				type:"POST",
				url:"http://localhost/myhoaweb/form/del_form",
				data:{id:id},
				success:function(data)
				{
					location.reload();
				}
			});
		});

		$(".rem_field").click(function(){
			$(this).parent().parent().remove();
			id = $(this).attr("data-id");
			$.ajax({
				type:"POST",
				url:"http://localhost/myhoaweb/form/remove_field",
				data:{id:id},
				success:function(data)
				{

				}
			});
		});

		$(".form-create-div ul").sortable({
       axis: "y",
			revert: true,
			scroll: true,
			placeholder: "sortable-placeholder",
			cursor: "move",
			stop:function(e,ui)
			{
				var array = new Array();
				updatesort($.map($(this).find('li'), function(el) {
					return $(el).attr("data-id") + "=" + $(el).index();
				}));
			}
    });
		$( ".form-create-div ul" ).disableSelection();
		function updatesort(data)
		{
		//	console.log(data);
			$.each(data,function(index, value){
				var result	=	value.split("=");
				$.ajax({
					type:"POST",
					url:"http://localhost/myhoaweb/form/sort/",
					data:{field_id:result[0], sort:result[1] },
					success:function( data )
					{
						console.log("Id ->" +result[0]+'@@@ Sort ->' + result[1]);
					}
				});
			});
		}

		$(".edit_field").click(function(){
			id = $(this).attr("data-id");
			$.ajax({
				type:"POST",
				url:"http://localhost/myhoaweb/form/get_field",
				data:{id:id},
				success:function(data)
				{
					data = JSON.parse(data);
					field = JSON.parse(data.field);
					required = field.required;
					$("input[name='edit_id']").val(data.id);
					$(".field_type").val(field.type);
					$("input[name='label']").val(field.label);
					if(required=="on")
						$("input[name='required']").prop("checked",true);

					if(field.type=="select-field" || field.type=="radio-field" || 
							field.type=="check-field")
					{
						$(".other-field").show();
						$(".opt-div.select").html("");
						options = field.options.split(',');
						html="";
						for (var i=0; i < options.length; i++)
						{
							html += '<div>'+
			      						'<div class="col-md-11">'+
			      							'<input type="text" value="'+options[i]+'" class="form-control" name="select_ip[]">'+
			      						'</div>'+
			      						'<a href="javascript:void(0)" class="del_ip">'+
			      							'<i class="glyphicon glyphicon-remove"></i>'+
			      						'</a>'+
			      					'</div><br>';
						}
						
	      		$(".opt-div.select").html(html);
					}
				}
			});
		});

$(".classifieds-btn").click(function(){
	from = $(".from_email").val();
	to = $(".to_email").val();
	desc = $(".cl-desc").val();
	$.ajax({
		type:"POST",
		url:"http://localhost/myhoaweb/classifieds/contact_advertiser/",
		data:{from:from,to:to,desc:desc},
		success:function(data)
		{
			console.log(data);
			if(data=="Fail")
			{
				class1 = "alert-danger";
				html="<strong>Error!</strong>Something went wrong. Try again later";
			}
			else
			{
				class1 = "alert-info";
				html = "<strong>Success!</strong>Mail has been sent successfully to advertiser";
			}
			$(".classified-msg .alert .cl-msg").html(html);
			$(".classified-msg").toggleClass("hide");
			$(".classified-msg .alert").addClass(class1);
		}
	});
});

$(".del-doc").click(function(){
	id = $(this).attr("data-id");
	table = $(this).attr("data-table");
	field = $(this).attr("data-field");
	$(this).parent().parent().remove();
	$.ajax({
		type:"POST",
		url:"http://localhost/myhoaweb/home/delete",
		data:{id:id,table:table,field:field},
		success:function(data)
		{
			
		}
	});
});

$(".banner-form").submit(function(e){
	e.preventDefault();
	var formData = new FormData($(this)[0]);
	val = $("#PicModal input[name='userfile1']").val();
	if(val=="")
	{
		 $("#PicModal span.error.banner").html("Please Select File");
	}
	else
	{
		$.ajax({
			type:"POST",
			url:"http://localhost/myhoaweb/home/change_banner",
			data:formData,
			contentType: false,
      processData: false,
			async: false,
			success:function(data)
			{
				console.log(data);
				$("#PicModal .alert").toggleClass("hide");
				if(data=="Success")
				{
					$("#PicModal .alert").addClass("alert-info");
					$("#PicModal .alert .msg").html("Banner Changed Successfully");
				}
				else if(data=="Fail")
				{
					$("#PicModal .alert").addClass("alert-danger");
					$("#PicModal .alert .msg").html("Something Wrong");
				}
				setTimeout(function(){location.reload();},3000);

			}
		});
	}
});
$(".pass-toggle").click(function(){
	$(".profilepass").attr("type","text");
	$(".pass-toggle i").addClass("glyphicon-eye-close");
	setTimeout(function(){
		$(".profilepass").attr("type","password");
		$(".pass-toggle i").removeClass("glyphicon-eye-close");
	},1000);
});


});
