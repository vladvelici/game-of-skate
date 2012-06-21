function validate(id,status) {
	if (status!==1 && status!==0)
		return false;
	$.ajax({
		url:'/horse/index.php?r=validator/validateIt&id='+id+'&status='+status,
		success:function(data) {
				if (data==1) {
					$('#vtrick_'+id).slideUp(400);
				} else {
					$('#vtrick_err_'+id).html('Error updating status. Please try again later.');
					$('#vtrick_err_'+id).css('display','block');
				}
			}	
	});
}
