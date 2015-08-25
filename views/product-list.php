<?php 
	if($messages) { ?>
	<div id="message" class="alert alert-success">
		<?=$messages;?>
	</div>
<?php }
	$flavour_dd = '';
	foreach($flavours as $flavour)
	{
		$flavour_dd .= "<option value='{$flavour->flavour_id}'>{$flavour->flavour_name}</option>";

	}
	foreach($products as $product)
	{ ?>
		<form name="add_to_cart_<?=$product->product_id;?>" method="POST" action="index.php?p=cart/add">
			<h3 class="col-lg-3"><?php echo $product->product_name; ?></h3>
			<div  class="col-lg-5">
				<?php if($product->types) { ?>
				<div>
					<label> Type </label>
					<select name = 'product_type_id' onchange="return getPrice(this, <?=$product->product_id;?>)" required class="form-control">
						<option> </option>
						<?php foreach($product->types as $type) { ?>
							<option value='<?=$type->type_id;?>'> <?=$type->type_name;?> </option>
						<?php } ?>
					</select>
				</div>	
				<?php } ?>
				<div>
					<label> Flavour </label>
					<span> 
						<select name='flavour[0]' class="form-control">
							<?=$flavour_dd;?>
						</select>
					</span>
				</div>
				<?php if($product->discount) { ?>
					<div>
						<label> Discount </label>
						<span>
							<input type="text" name="discount" value = '' onblur="return calculateDiscount(this, <?=$product->product_id;?> )" class="form-control"/>
						</span>
					</div>
				<?php } ?>	

			</div>	

			<div class="col-lg-2">
			<h3 id="price_<?=$product->product_id;?>">
				<span> </span>
			</h3>	
				<button type="submit" btn btn-primary> <i class="fa fa-cart-plus"></i>Add to cart </button>
			</div>		
			<input type="hidden" name="max_scoop" value="<?=$product->max_scoop;?>" />
			<input type="hidden" name="product_id" value="<?=$product->product_id;?>" />
			<input type="hidden" id="product_actual_price_<?=$product->product_id;?>" name="actual_price">
			<input type="hidden" id="product_price_<?=$product->product_id;?>" name="final_price">		
			
		</form>	
		<div class="clearfix"> &nbsp; </div>
		<hr />	
	<?php } ?>

