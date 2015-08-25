<h3 class="text-center"> <?=$cart_messages;?></h3>
<?php 
	if($messages != '') { ?>
	<div id="message" class="alert alert-error">
		<?=$messages;?>
	</div>
<?php } ?>
<div>
	<?php
	if(count($carts) > 0 ) { ?>
		<ul class="cart-list">
			<?php foreach($carts as $cart) {
			?>
				<li>
					<div class="product_name col-lg-4"> <?=$cart->product_name;?>  </div>
					<div class="actual_price col-lg-2"> <?=$cart->actual_price;?> </div>
					<div class="discount  col-lg-2"> <?=$cart->discount;?> 		</div>
					<div class="final_price col-lg-4"> <?=$cart->final_price;?> </div> 
				</li>
				<div class="clearfix">&nbsp;</div>
				<hr>
			<?php }	?>
			<li> 
				<h3 class="col-lg-8"> Total </h3>
				<h2 class="col-lg-4"> <?=$cart->amount;?> </h2>
			</li>
			
		</ul>
		<form name="order" action="index.php?p=cart/order" method = 'POST'>
			<input type="hidden" name="cart_id" value="<?=$cart->cart_id;?>" />
			<button class="btn btn-primary" type="submit"> Order </button>
		</form>
	<?php }
	else { ?> 
		<h4> 
			NO Item on Cart
		</h4>

	<?php } ?>	

</div> 
