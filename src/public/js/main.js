function refresh(){
	var idmess = $(".lastmess").last().html();
	var iduserdest = $("#iduserdest").html();
	$.post("refreshTchat?last_id_message=" + idmess + "&id=" + iduserdest).done(
	function(data){
		$(".messages").append(data); 
	});
}

$(document).ready(function() {
	if($('#user').get(0)){
		$('#user').dataTable();
		$('#user a.delete').on('click',function(event){
			event.preventDefault();
			var href = $(this).prop('href');
			$.get(href).done(function(data){
				$(".bg-classes").replaceWith(data);
			})
		});	
	}
});

setInterval(function(){
	refresh();
},1000);