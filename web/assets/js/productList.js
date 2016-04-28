jQuery(document).ready(function()
{	
	var slideOptions = { duration: 450, easing: "easeOutQuart", queue: false, complete: function() {}};
		

	$('.productItem:not(.disabled)').mouseenter(function() {
		if ($('.moreResultContainer:visible').size() > 0) return;
		var star = GLOBAL.getConstellation().getStarFromName($(this).attr('data-star-name'));
		star.getMarker().showBigSize();
	}).mouseleave(function() {
		if ($('.moreResultContainer:visible').size() > 0) return;
		var star = GLOBAL.getConstellation().getStarFromName($(this).attr('data-star-name'));
		star.getMarker().showNormalSize();
	});

	$('.productItem:not(.disabled)').click(function()
	{
		if ($(this).attr('data-providers-size') == 1)
		{			
			var star = GLOBAL.getConstellation().getStarFromName($(this).attr('data-star-name'));
			showProviderInfosOnMap(star.getProviderId());
		}
		else
		{			
			animate_down_bandeau_detail(); 
		}

		var star = GLOBAL.getConstellation().getStarFromName($(this).attr('data-star-name'));
		var idToFocus = star.getProviderListId();
		
		var body = $(this).parent().find('.moreResultContainer');
		
		// if the moreResultContainer si already visible
		if (body.is(":visible")) 
		{
			body.stop(true,false).slideUp(slideOptions);
			GLOBAL.getMarkerManager().clearFocusOnThesesMarkers(idToFocus);
			GLOBAL.getClusterer().repaint();	
			animate_down_bandeau_detail(); 
		}
		else
		{
			// if an other container is visible, we clear it
			if ($('.moreResultContainer:visible').size() > 0)
			{
				var otherContainerVisible = $('.moreResultContainer:visible').first();
				var otherStarName = otherContainerVisible.parent().find('.productItem').attr('data-star-name');
				var otherStar = GLOBAL.getConstellation().getStarFromName(otherStarName);
				var otherIdsToClear = otherStar.getProviderListId();
				otherContainerVisible.stop(true,false).slideUp(slideOptions);
				GLOBAL.getMarkerManager().clearFocusOnThesesMarkers(otherIdsToClear);
			}

			body.stop(true,false).slideDown(slideOptions);
			GLOBAL.getMarkerManager().focusOnThesesMarkers(idToFocus);
			GLOBAL.getClusterer().repaint();
		}		
	});

	$('.moreResultProviderItem, .providerItem').mouseenter(function() {
		var marker = GLOBAL.getMarkerManager().getMarkerById($(this).attr('data-provider-id'));
		marker.showBigSize();
	}).mouseleave(function() {
		var marker = GLOBAL.getMarkerManager().getMarkerById($(this).attr('data-provider-id'));
		marker.showNormalSize();
	});
	
	$('.moreResultProviderItem').click(function() 
	{
		var star = GLOBAL.getConstellation().getStarFromName($(this).attr('data-star-name'));
		star.setIndex($(this).attr('data-provider-index'));
		$(this).parents('li').find('.productItem').click();
	});
});
