(function($){
	$('input[type="checkbox"]').each(function(i,e){
		var label = $(e).parent('label');
		if(label && !label.hasClass('form-control')){
			label.addClass('checkbox checkbox-inline');
			$(e).after('<span class="input-helper"></span>');
		}
	});
})(jQuery);