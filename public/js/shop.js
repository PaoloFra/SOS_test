$(document).ready(function() {
	$('.show-basket').on('click', function(e){
		e.preventDefault();
		$('.basket_pop').fancybox({
			padding: 40,
			'width': 675,
			'autoSize' : false,
			wrapCSS: 'popDialog smallDialog',
			modal: false,
			helpers: {
				title: {
					type: 'inside',
					position: 'top'
				}
			},
			openEffect: 'fade',
			closeEffect: 'fade'
		}).trigger('click');
	});

	var $basketInput = $('.basket-input'),
		$valueInput,
		$thisBPlus,
		$thisBMinus;

	function numInImput() {
		if ($valueInput >= 99) {
			$thisBPlus.addClass('off');
			$thisBMinus.removeClass('off');
		} else if ($valueInput <= 1) {
			$thisBMinus.addClass('off');
			$thisBPlus.removeClass('off');
		} else {
			$thisBPlus.removeClass('off');
			$thisBMinus.removeClass('off');
		}
	}

	$basketInput.keypress(function(e) {
		if (e.keyCode < 48 || e.keyCode > 57) {
			$(this).val('1');
			return false;
		}
	});
	$basketInput.blur(function() {
		if (!$(this).val() || $(this).val().match(/[^0-9]/g)) {
			$(this).val('1');
		}
		funSum();
	});
	$basketInput.keyup(function() {
		$thisBPlus = $(this).closest('.input-block').find('.plus');
		$thisBMinus = $(this).closest('.input-block').find('.minus');
		$valueInput = $(this).val();

		if ($(this).val().match(/[^0-9]/g)) {
			$(this).val('1');
		}
		numInImput($valueInput, $thisBPlus, $thisBMinus);
		funSum();
	});

	$('.basket-input-ico.plus').on('click', function(e){
		e.preventDefault();
		var thisInput = $(this).closest('.input-block').find('.basket-input'),
			thisVal = $(this).closest('.input-block').find('.basket-input').val(),
			thisMinus = $(this).closest('.input-block').find('.minus');

		if (thisVal < 99) {
			thisInput.val(++thisVal);
			thisMinus.removeClass('off');
			if (thisVal == 99) {
				$(this).addClass('off');
			}
		} else {
			$(this).addClass('off');
		}
		funSum();
	});
	$('.basket-input-ico.minus').on('click', function(e){
		e.preventDefault();
		var thisInput = $(this).closest('.input-block').find('.basket-input'),
			thisVal = $(this).closest('.input-block').find('.basket-input').val(),
			thisPluse = $(this).closest('.input-block').find('.plus');

		if (thisVal > 1) {
			thisInput.val(--thisVal);
			thisPluse.removeClass('off');
			if (thisVal == 1) {
				$(this).addClass('off');
			}
		} else {
			$(this).addClass('off');
		}
		funSum();
	});

	var funSum = function () {
		$('.table-pop tbody tr').each(function(){
			var price = $(this).find('.price span').html();
			var val = $(this).find('.basket-input').val();
			var sum = price * val;
			$(this).find('.sum span').html(sum);
		});

		var totalSum = 0;
		$('.sum span').each(function() {
		    totalSum += parseInt($(this).html());
		});
		$('.total-sum span').html(totalSum);
	}
	funSum();


	$('.clear_filter').on('click', function(e){
		e.preventDefault();
		$('.shop_filter input[type=checkbox]').prop('checked', false);
	});
});