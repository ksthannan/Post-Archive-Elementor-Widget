(function($){
    $(document).ready(function(){

		function formatToCurrency(amount) {
			var result = amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
	
			return "$" + result.substring(0, result.length - 3);
		}

		function calculator_roof(){
			$('.roof_submit_btn').on('click', function(e){
				e.preventDefault();
				
				let valid = true;
	
				$('.roofcost_form [required]').each(function() {
					if ($(this).is(':invalid') || !$(this).val()) valid = false;
				})
	
				if(valid == false){
					$('.submit_notice').fadeIn();
					setTimeout(function(){
						$('.submit_notice').fadeOut();
					}, 2000);
				}else{
					
					$('.submit_notice').fadeOut();
					$('.roofcost_section').fadeOut();
					$('.roofcost_results').fadeIn();
	
					// Pricings for roof
					let walkableCost = [0, 500, 1000];
					let pricesLower = [6000, 8000, 12000, 15000];
					let pricesUpper = [10000, 13000, 17000, 21000];
	
					let homesize = $('input[name=homesize]:checked').closest('label').data('value');
	
					let resultLowerPrice = 0;
					let resultUpperPrice = 0;
	
					if(homesize){
						resultLowerPrice = pricesLower[Number(homesize) - 1];
						resultUpperPrice = pricesUpper[Number(homesize) - 1];
					}
	
					let walkable = $('input[name=walkable]:checked').closest('label').data('value');
					if(walkable){
						$('#roof_lower_cost').html(formatToCurrency(resultLowerPrice + walkableCost[Number(walkable) - 1]));
						$('#roof_upper_cost').html(formatToCurrency(resultUpperPrice + walkableCost[Number(walkable) - 1]));
					}

					let upgrade_price1 = formatToCurrency((resultLowerPrice + walkableCost[Number(walkable) - 1]) * 1.20) + ' - ' + formatToCurrency((resultUpperPrice + walkableCost[Number(walkable) - 1]) * 1.20);
					let upgrade_price2 = formatToCurrency((resultLowerPrice + walkableCost[Number(walkable) - 1]) * 1.40) + ' - ' + formatToCurrency((resultUpperPrice + walkableCost[Number(walkable) - 1]) * 1.40);
					let upgrade_price3 = formatToCurrency((resultLowerPrice + walkableCost[Number(walkable) - 1]) * 1.60) + ' - ' + formatToCurrency((resultUpperPrice + walkableCost[Number(walkable) - 1]) * 1.60);
					let upgrade_price4 = formatToCurrency((resultLowerPrice + walkableCost[Number(walkable) - 1]) * 1.80) + ' - ' + formatToCurrency((resultUpperPrice + walkableCost[Number(walkable) - 1]) * 1.80);
	
					$('#price1').text(upgrade_price1);
					$('#price2').text(upgrade_price2);
					$('#price3').text(upgrade_price3);
					$('#price4').text(upgrade_price4);
	
					// selections 
					let selections = document.forms['roof_replacement_form']['rooftype'].value + ', '  + document.forms['roof_replacement_form']['walkable'].value + ', ' + document.forms['roof_replacement_form']['homesize'].value;
					$('.results_text p span').html(selections);
	
					$('html, body').animate({
						scrollTop: $('.roofcost_calculator_container').offset().top
					}, 1000);
	
				}
	
			});
			$('.results_back.roofcost_btn').on('click', function(e){
				e.preventDefault();
				$('.roofcost_section').fadeIn();
				$('.roofcost_results').fadeOut();
	
				$('html, body').animate({
					scrollTop: $('.roofcost_calculator_container').offset().top
				}, 800);
				
			});
		}
		calculator_roof();


// Siding cost calculator 
		function calculator_siding(){
			$('.siding_submit_btn').on('click', function(e){
				e.preventDefault();
				
				let valid = true;
	
				$('.sidingcost_form [required]').each(function() {
					if ($(this).is(':invalid') || !$(this).val()) valid = false;
				})
	
				if(valid == false){
					$('.submit_notice').fadeIn();
					setTimeout(function(){
						$('.submit_notice').fadeOut();
					}, 2000);
				}else{
					
					$('.submit_notice').fadeOut();
					$('.sidingcost_section').fadeOut();
					$('.sidingcost_results').fadeIn();
	
					// Pricings for siding
					let storiesCost = [0, 500, 1000];
					let pricesLower = [6000, 8500, 12000, 15000];
					let pricesUpper = [11000, 13500, 18000, 28000];
	
					let homesize = $('input[name=homesize]:checked').closest('label').data('value');
	
					let resultLowerPrice = 0;
					let resultUpperPrice = 0;
	
					if(homesize){
						resultLowerPrice = pricesLower[Number(homesize) - 1];
						resultUpperPrice = pricesUpper[Number(homesize) - 1];
					}
	
					let stories = $('input[name=stories]:checked').closest('label').data('value');
					if(stories){
						$('#siding_lower_cost').html(formatToCurrency(resultLowerPrice + storiesCost[Number(stories) - 1]));
						$('#siding_upper_cost').html(formatToCurrency(resultUpperPrice + storiesCost[Number(stories) - 1]));
					}

					let upgrade_price1 = formatToCurrency((resultLowerPrice + storiesCost[Number(stories) - 1]) * 1.20) + ' - ' + formatToCurrency((resultUpperPrice + storiesCost[Number(stories) - 1]) * 1.20);
					let upgrade_price2 = formatToCurrency((resultLowerPrice + storiesCost[Number(stories) - 1]) * 1.40) + ' - ' + formatToCurrency((resultUpperPrice + storiesCost[Number(stories) - 1]) * 1.40);
					let upgrade_price3 = formatToCurrency((resultLowerPrice + storiesCost[Number(stories) - 1]) * 1.60) + ' - ' + formatToCurrency((resultUpperPrice + storiesCost[Number(stories) - 1]) * 1.60);
					let upgrade_price4 = formatToCurrency((resultLowerPrice + storiesCost[Number(stories) - 1]) * 1.80) + ' - ' + formatToCurrency((resultUpperPrice + storiesCost[Number(stories) - 1]) * 1.80);
	
					$('#price1').text(upgrade_price1);
					$('#price2').text(upgrade_price2);
					$('#price3').text(upgrade_price3);
					$('#price4').text(upgrade_price4);
	
					// selections 
					let selections = document.forms['siding_replacement_form']['sidingtype'].value + ', '  + document.forms['siding_replacement_form']['stories'].value + ', ' + document.forms['siding_replacement_form']['homesize'].value;
					$('.results_text p span').html(selections);
	
					$('html, body').animate({
						scrollTop: $('.sidingcost_calculator_container').offset().top
					}, 1000);
	
				}
	
			});
			$('button.results_back.sidingcost_btn').on('click', function(e){
				e.preventDefault();
				$('.sidingcost_section').fadeIn();
				$('.sidingcost_results').fadeOut();
	
				$('html, body').animate({
					scrollTop: $('.sidingcost_calculator_container').offset().top
				}, 800);
				
			});
		}
		calculator_siding();


		// Calculate window cost 
		function calculate_window(){
				
			setInterval(function(){
				$('.windowtype').each(function(){

					let checked = $(this).is(':checked')
					if(checked == true){
						$(this).parent().find('fieldset').removeAttr('disabled')

					}else{
						$(this).parent().find('fieldset').attr('disabled', '')
					}
				});
			}, 1000);

			

			$('.window_submit_btn').on('click', function(e){
				e.preventDefault();
				
				let valid = true;
	
				$('.windowcost_form [required]').each(function() {
					let fieldsetAttr = $(this).closest('fieldset').attr('disabled');
					if(typeof fieldsetAttr == 'undefined' || fieldsetAttr == false){

						if ($(this).is(':invalid') || !$(this).val()) valid = false;

					}
				})

	
				if(valid == false){
					$('.submit_notice').fadeIn();
					setTimeout(function(){
						$('.submit_notice').fadeOut();
					}, 2000);
				}else{
					
					$('.submit_notice').fadeOut();
	
					// Pricings for window
					let minPrice = 0;
					let maxPrice = 0;
					let selected = '';
					let isSelected = false;
					$('.content_fields fieldset').each(function(){
						let disabled = $(this).attr('disabled');
						if(disabled == undefined || disabled == false){

							isSelected = true;

							let qty = $(this).find('input[name=quantity]').val();
							let minvalue = $(this).find('select[name=item_ui]').find('option:selected').data('minvalue');
							let maxvalue = $(this).find('select[name=item_ui]').find('option:selected').data('maxvalue');
	
							let fieldset_name = $(this).find('h3').text();
	
							minPrice += Number(qty) * Number(minvalue);
							maxPrice += Number(qty) * Number(maxvalue);
							
							if(selected == ''){
								selected += qty + ' ' + fieldset_name;
							}else{
								selected += ', ' + qty + ' ' + fieldset_name;
							}
						}
						
						
					});

					if(isSelected){
						$('.windowcost_section').fadeOut();
						$('.windowcost_results').fadeIn();

						$('.window_lower_cost').html(formatToCurrency(minPrice));
						$('.window_upper_cost').html(formatToCurrency(maxPrice));
						
						let upgrade_price1 = formatToCurrency(minPrice * 1.20) + ' - ' + formatToCurrency(maxPrice * 1.20);
						let upgrade_price2 = formatToCurrency(minPrice * 1.40) + ' - ' + formatToCurrency(maxPrice * 1.40);
						let upgrade_price3 = formatToCurrency(minPrice * 1.60) + ' - ' + formatToCurrency(maxPrice * 1.60);
						let upgrade_price4 = formatToCurrency(minPrice * 1.80) + ' - ' + formatToCurrency(maxPrice * 1.80);
		
						$('#price1').text(upgrade_price1);
						$('#price2').text(upgrade_price2);
						$('#price3').text(upgrade_price3);
						$('#price4').text(upgrade_price4);

						// selections 
						$('.results_text p span').html(selected);
		
						$('html, body').animate({
							scrollTop: $('.windowcost_calculator_container').offset().top
						}, 1000);
					}else{
						$('.submit_notice').fadeIn();
						setTimeout(function(){
							$('.submit_notice').fadeOut();
						}, 2000);
					}

				}
	
			});
			$('button.results_back.windowcost_btn').on('click', function(e){
				e.preventDefault();
				$('.windowcost_section').fadeIn();
				$('.windowcost_results').fadeOut();
	
				$('html, body').animate({
					scrollTop: $('.windowcost_calculator_container').offset().top
				}, 800);
				
			});
			
		}
		calculate_window();


    });
})(jQuery);


