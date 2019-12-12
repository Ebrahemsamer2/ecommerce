// Ajax Calls

$(function() {
	
	$("#add-category").submit(function(e) {
		e.preventDefault();

		let data = $(this).serialize();
	    $.ajax({
	        url: "/admin/categories",
	        method: "POST",
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: data,
	        dataType: 'json',
	        success: function(data) {
	            $(".categories tbody").prepend(data.success);
	            $("#add-category")[0].reset();
	        },
	        fail: function(data) {
	            $("#add-category").append(data.fail);
	        }
	    });
	});

	$(".deletecategory").submit(function(e) {
		
		e.preventDefault();

		let data = $(this).serialize();
		let cat_id = $(".deletecategory input[name='id']").val();
	    $.ajax({
	        url: "/admin/categories/"+cat_id,
	        method: "DELETE",
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: data,
	        dataType: 'json',
	        success: function(data) {
	            $(".categories tbody #cat"+cat_id).remove();
	            $(".ajax-alerts").html(data.success);
	        }
	    });

	});
		
});