(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$(document).on('click','.handlediv',function(){
		var select = $(this).parent().parent().next();
		if(select.hasClass('d-none')){
			select.removeClass('d-none');
			$('pzryr_gizle_'+$(this).data('platform')).val('1');
		}
		else{
			select.addClass('d-none');
			$('pzryr_gizle_'+$(this).data('platform')).val('0');
		}
	});
	$('.filterCategory').select2();
	$(document).ready(function() {
		$('.filterCategory2').select2({
			minimumInputLength: 2,
			placeholder: "Kategori Adı Arayın",
			language: "tr",
			templateResult: formatRepo,
			escapeMarkup: function (markup) { return markup; },
			ajax: {
				url: 'https://pazaryerieklentisi.com/api/categories/?platform='+$('#pzryr_PLATFORM').val(),
				dataType: 'json',
				beforeSend: function (request) {
					request.setRequestHeader("Authorization", 'Bearer '+$('#pzryr_TOKEN').val());
				},
				quietMillis: 100,
				delay: 250,
				cache: true,
				data: function (params) {
					var query = {
						q: params.term
					};
					return query;
				},
				processResults: function (data, params) {
					var arr = [];
					$.each(data.data, function (index, value) {
						var isim = value.mesh;
						if(value.platform == 'n11')  isim = value.mesh + " > " + value.name;
						
						arr.push({
							id: value.kategori_id,
							text: isim,
						})
					});
					return {
						results: arr
					};
				}
			}
		});
	});
})( jQuery );
function formatRepo (repo) {
	var markup = "<option value='"+repo.id+"'> " + repo.text + "</option>";
	return markup;
}