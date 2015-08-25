		</div>
	</div>
</body>		
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="css/main.css" />
<script>
	function getPrice(t, product_id) {
		var type_id = $(t).val();

		$.ajax({
			type 	: 'POST',
			url 	: 'ajax/products.php',
			data 	: {
						product_id 	: product_id,
						type_id 	: type_id
					},
			success : function(response) {
				$("#price_"+product_id).html('$'+response);
				$("#product_actual_price_"+product_id).val(response);
				$('#product_price_'+product_id).val(response);
			}		
		});
	}

	function calculateDiscount(t, product_id)
	{
		var discount = parseInt($(t).val());
		var product_price = parseInt($('#product_price_'+product_id).val());
		var discounted_price = product_price - ((product_price*discount)/100);
		$("#price_"+product_id).html(discounted_price);
		$('#product_price_'+product_id).val(discounted_price);
	}
</script>
</html>
