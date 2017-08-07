$(document).ready(function(){
	
		var base_url = "http://localhost/myhoaweb/admin/";
		var table = $("#table-3").dataTable({
			"sPaginationType": "bootstrap",
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"bStateSave": true,
			"ordering":false
		});
		
		table.columnFilter({
			"sPlaceHolder" : "head:after",
			//"columns" : 1
		});

		$(".del-btn").click(function(){
			href = $(this).attr("data-href");
			$("a.modal-delete").attr("href",href);
		});



			$(".gallery-env").on("click", ".image-thumb .image-options a.delete", function(ev)
			{
				ev.preventDefault();				
				var $image = $(this).closest('[data-tag]');
				
				var t = new TimelineLite({
					onComplete: function()
					{
						name = $image[0].attributes['data-tag'].value;
						c_id = $image[0].attributes['data-id'].value;
						console.log(name);
						$image.slideUp(function()
						{
							$.ajax({
								type:"POST",
								url:base_url+"classifieds/delete_photo",
								data:{name:name,id:c_id},
								success:function(data)
								{
								//	console.log(data);
									$image.remove();
									location.reload();
								}
							});
						
						});
					}
				});				
				$image.addClass('no-animation');				
				t.append( TweenMax.to($image, .2, {css: {scale: 0.95}}) );
				t.append( TweenMax.to($image, .5, {css: {autoAlpha: 0, transform: "translateX(100px) scale(.95)"}}) );
			}).on("click", ".image-thumb .image-options a.view", function(ev)
			{
				ev.preventDefault();
				src = $(this).parent().parent().find("img").attr("src");
				// This will open sample modal
				$("#album-image-options").modal('show');
				// Sample Crop Instance
				var image_to_crop = $("#album-image-options img"),
				img_load = new Image();
				img_load.src = image_to_crop.attr('src',src);
				/*img_load.onload = function()
				{
					if(image_to_crop.data('loaded'))
						return false;
						
					image_to_crop.data('loaded', true);
					
					image_to_crop.Jcrop({
						//boxWidth: $("#album-image-options").outerWidth(),
						boxWidth: 580,
						boxHeight: 385,
						onSelect: function(cords)
						{
							// you can use these vars to save cropping of the image coordinates
							var h = cords.h,
								w = cords.w,
								
								x1 = cords.x,
								x2 = cords.x2,
								
								y1 = cords.w,
								y2 = cords.y2;
							
						}
					}, function()
					{
						var jcrop = this;
						
						jcrop.animateTo([600, 400, 100, 150]);
					});
				}*/
			});
			
			
$('.datetime').bootstrapMaterialDatePicker
	({
		time: true,
		format :"YYYY-MM-DD H:s",
		minDate : new Date(),
		clearButton: false
	});

	$(".select2").select2();
			
		$(".form-input ul li").click(function(){
			field =$(this).attr("data-field");
			$("input[name='label']").val("");
			$(".field_type").val(field);
			if(field=="select-field" || field=="radio-field" || field=="check-field")
				$(".opt-div.select,.other-field").show();
			else if(field=="payment-field")
				$(".payment-field").show();
		});

		$(".rem_field").click(function(){
			$(this).parent().parent().remove();
			id = $(this).attr("data-id");
			$.ajax({
				type:"POST",
				url: base_url+"form/remove_field",
				data:{id:id},
				success:function(data)
				{

				}
			});
		});

		$(".edit_field").click(function(){
			id = $(this).attr("data-id");
			$.ajax({
				type:"POST",
				url:base_url+"form/get_field",
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

		$(".saved-form ul").sortable({
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
		$( ".saved-form ul" ).disableSelection();
		function updatesort(data)
		{
		//	console.log(data);
			$.each(data,function(index, value){
				var result	=	value.split("=");
				$.ajax({
					type:"POST",
					url:base_url+"form/sort/",
					data:{field_id:result[0], sort:result[1] },
					success:function( data )
					{
						console.log("Id ->" +result[0]+'@@@ Sort ->' + result[1]);
					}
				});
			});
		}

		$(document).on("click",".del_ip",function(){
			$(this).parent().remove();
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

	$(".view-msg").click(function(){
		id = $(this).attr("data-id");
		$.ajax({
			type:"POST",
			url:base_url+"inbox/get_message_by_id/",
			data:{id:id},
			success:function(data)
			{
				$("#modal-5 .ajax-content").html(data);
			}
		})
	});

});