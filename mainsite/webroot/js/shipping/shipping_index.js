function afterAddRate(id, response) {
	var addRateRow = '#new-shipping-rate-'+id;
	var json_object = $.parseJSON(response);
	
	if (json_object.success) {
		$(addRateRow).before(json_object.contents);
	} else {
		$.each($.parseJSON(json_object.contents), function(key, value) {
			$('#flashMessage').text(value);
		});
	}
}

function showMaxPurchase(id) {
	var maxPurchase = '#max-purchase-'+id;
	var maxPurchaseLink = '#max-purchase-link-'+id;
	var maxPriceInput = '#max-price-input-'+id;
	$(maxPurchase).show();
	$(maxPurchaseLink).hide();
	$(maxPurchase + ' input').focus();
	$(maxPriceInput).blur(function() {
		
		if (!($(maxPriceInput).val().length > 0)) {
			$(maxPurchase).hide();
			$(maxPurchaseLink).show();
		}
	});
}

function showPriceForm(id) {
	
	var priceForm = '#price-form-'+id;
	var weightForm = '#weight-form-'+id;
	$(priceForm).show();
	$(weightForm).hide();
}

function showWeightForm(id) {
	
	var priceForm = '#price-form-'+id;
	var weightForm = '#weight-form-'+id;
	$(weightForm).show();
	$(priceForm).hide();
}
