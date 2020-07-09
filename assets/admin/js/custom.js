$( "#group_admin_id" ).change(function() {
	if($( "#group_admin_id" ).val()!=''){
		$.ajax({
	  		url: baseurl+'users/get_tenant_users',
	  		type : 'POST', /*or POST*/
	  		data: {'id':$( "#group_admin_id" ).val()}, /*if any*/
	  		dataType: "json",
	  		success:function(response){
	         	var html = '';
	         	if(response.status == 1){
	         		$( "#tenant_admin_id" ).html('<option value="">Select Tenant Admin</option>');
	         		$.each(response.data, function( index, value ) {
					  html += '<option value="'+value.user_id+'">'+value.name+' '+value.email+'</option>';
					});
	         	}
	         	$( "#tenant_admin_id" ).append(html);
	  		}
	  	});
	}
});