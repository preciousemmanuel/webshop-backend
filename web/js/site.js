$(document).ready(function(){
		$('.updateStatus').change(function(){

			if(confirm("Do You want to continue")){
				var url=window.location.origin+"/order/update";
				//alert(url)
				var orderId=$(this).attr("id");
				var status=$(this).val();
				
				$.ajax({
					type:"PUT",
					url:url,
					data:{
						orderId:orderId,status:status
					},
					success:function(response){
						console.log(response);
						window.location.reload()
					},
					error:function(error){
						console.log("horrrow")
            console.log(error)
            console.log(url)
        }
				})
			}
		})
	})