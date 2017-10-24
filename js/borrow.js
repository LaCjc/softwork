// JavaScript Document
$(document).ready(function(e) {
    var title=$('#title').children()[0];
	var category=$('#category');
	var press=$('#press');
	$("#btn").click(function(){
		alert(title);
		$.ajax({
			type:GET,
			url:include/borrow.func.php,
			data:"titlename=title&categoryname=category&pressname=press",
            success: function(){
				alert("成功");
				}
			})
		
		})
	
	
});
