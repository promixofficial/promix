jQuery(document).ready(function($) {
	$('#external_featured_image .remove-post-thumbnail').click(function() {
		$('#external_featured_image input[type=text]').val('');
		$('#external_featured_image textarea').val('');
		$('#external_featured_image .preview-wrapper').hide();
		$('#external_featured_image .preview-wrapper img').remove();
		$('#external_featured_image .push-wrapper').show();
	});

	$('#external_featured_image .push-wrapper input[type=button]').click(function() {
		$('#external_featured_image .push-wrapper').hide();
		$('#external_featured_image .preview-wrapper').show();
		$('<img />', {src:$(this).parent().find('input[type=text]').val(), /*width:266, height:266,*/ class:'attachment-266x266'}).prependTo($('#external_featured_image .preview-wrapper p:first-child'));
	});
});