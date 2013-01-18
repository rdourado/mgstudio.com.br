$(document).ready(function(){
	// Filter
	try{
		$('.filter a').click(function(){
			var $this = $(this),
				$slug = $this.attr('data-slug');
			if ($slug) {
				$('.filter-list>*:not(.'+$slug+')').stop(true,true).slideUp();
				$('.filter-list>*.'+$slug).stop(true,true).slideDown();
			} else {
				$('.filter-list>*').stop(true,true).slideDown();
			}
			$this.parent().parent().find('a').removeClass('current');
			$this.addClass('current');
			return false;
		}).first().trigger('click');
	}catch(e){}

	// Slideshow
	try{
		var $slideshow = $('.slideshow', '#body'),
			$slide_child = $slideshow.wrap('<div id="slideshow"></div>').children(),
			$slide_count = $slideshow.attr('data-time') ? $slideshow.attr('data-time') : 8000,
			$slide_total = $slide_child.length,
			$slide_wrap = $('#slideshow'),
			$slide_curr = 0,
			$slide_time = 0,
			$slide_next = 1;

		$slide_nav = ['<div id="slideshow_nav">'];
		for (var i=0; i<$slide_total; i++) $slide_nav.push('<a href="#" class="pos-'+i+'" data-pos="'+i+'"></a>');
		$slide_nav.push('</div>');
		$slide_wrap.append($slide_nav.join(''));

		var $slide_nav = $('#slideshow_nav>a'),
			$slide_fn = function(){
				$slide_next = ($slide_curr + 1 < $slide_total) ? $slide_curr + 1 : 0;
				$slide_child.eq($slide_curr).stop().fadeTo('slow', 0, function(){
					$(this).hide();
					$slide_nav.eq($slide_curr).removeClass('current');
					$slide_curr = $slide_next;
					$slide_child.eq($slide_curr).show().fadeTo('slow', 1);
					$slide_nav.eq($slide_curr).addClass('current');
				});
			};

		$slide_wrap.hover(function(){
			clearInterval($slide_time);
		}, function(){
			clearInterval($slide_time);
			$slide_time = setInterval($slide_fn, $slide_count);
		}).trigger('mouseout');

		$slide_nav.click(function(){
			var $this = $(this);
			if (!$this.hasClass('current')) {
				clearInterval($slide_time);

				$this.parent().find('>a.current').removeClass('current');
				$this.addClass('current');
				$slide_next = parseInt($(this).attr('data-pos'));
				$slide_child.eq($slide_curr).stop().fadeTo('slow', 0, function(){
					$(this).hide();
					$slide_curr = $slide_next;
					$slide_child.eq($slide_curr).show().fadeTo('slow', 1);
				});
			}

			return false;
		});

		$slide_nav.eq(0).addClass('current');
		$('>*:gt(0)', $slideshow).fadeTo(0,0).hide();
	}catch(e){}

});