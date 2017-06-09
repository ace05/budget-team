$(document).ready(function(){
	$('form.search-form').submit(function() {
		$.ajax({
			type: 'post',
			cache: false,
			dataType: 'json',
			url: $('form.search-form').attr('action'),
			data: $('form.search-form').serialize(),
			beforeSend: function() { 
				$(".validation-errors").hide().empty(); 
			},
			success: function(data) {
				if(data.success == false){
					var arr = data.errors;
					$.each(arr, function(index, value)
					{
						if (value.length != 0)
						{
							$(".validation-errors").append('<div class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+ value +'</div>');
						}
					});
					$(".validation-errors").show();
				} else {
					$(".result").html(data.data);
				}
			},
			error: function(xhr, textStatus, thrownError) {
				alert('Something went to wrong.Please Try again later...');
			}
		});
		return false;
	});

	$('a.candidate-delete').on('click', function(e){
		e.preventDefault();
		var url = $(this).attr('href');
			panelClass = $('.'+$(this).attr('id'));
		swal({
          "title": "Are you sure?",
          "type": "warning",
          "showCancelButton": true,
          "confirmButtonColor": "#DD6B55",
          "confirmButtonText": "Yes, delete it!",
          "closeOnConfirm": false
        },function(isConfirm){
        	if (isConfirm) {
			    $.get(url, function(update){
	                if(update.status === false){
	                    swal("Unable to Delete. Please try again later"); 
	                }
	                else{
	                    panelClass.hide('slow', function(){ panelClass.remove(); });
	                    swal("Deleted!", "Candidate has been deleted successfully", "success");
	                }
	            });
			 } 

        });
	})
});