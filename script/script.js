$(document).ready(function () {
	if ($(".article-comments-container")) {
		$(".article-comments-container .bypostauthor > .comment-body .comment-meta .comment-author")
			.append($('<span class="comment-by-post-author">Post author</span>'));
	}
});

// srcoll to top 
$(document).ready(function() {

	var documentHeight = document.documentElement.offsetHeight || document.body.offsetHeight;
	var timer = null;

	$scrollBtn = $("#backToTopBtn");
	
	if (!$scrollBtn) {
		return;
	}

	$scrollBtn.css({'display': 'none'});
	
	$(document).on("scroll", function () {
		var scrollToTopDis = document.documentElement.scrollTop;

		// 使得返回顶部按钮在合适的时候出现
		if (scrollToTopDis >= parseInt(documentHeight / 4)) {
			$scrollBtn.fadeIn();
		} else {
			$scrollBtn.fadeOut("slow");
		}
	});

	$scrollBtn.on("click", function (event) {
		var doc  = null;

		if (document.documentElement && document.documentElement.scrollTop) {
			doc = document.documentElement;
		} else if(document.body) {
			doc = document.body;
		}
		
		timer = setInterval(function () {

			doc.scrollTop = parseInt(doc.scrollTop / 1.5);

			if (doc.scrollTop == 0) {
				clearInterval(timer);
			};
		}, 30);
		event.preventDefault();
	});
});

/*** Fixed TextWeidget ***/
$(document).ready(function () {
	
	var $textwidget = $(".widgets-lists .textwidget");

	if ($textwidget) {
		$textwidget.parent(".widgets-lists").css({
			'paddingLeft': 0,
			'paddingRight': 0
		});
		$textwidget.prev(".widget-title").css({
			"marginLeft": 20,
			"marginRight": 20
		});
		$textwidget.css({
			'textAlign': 'center'
		});
	}
});


// navigation
// $(document).ready(function () {

// 	var $navigationIteams 			= $(".navigation .navigation-container .menu li");
// 	var navigationContainerWidth 	= document.getElementById('navigationContainer').offsetWidth;
// 	var IteamSumWith 				= 0;

// 	$navigationIteams.each(function (index) {

// 		IteamSumWith += $navigationIteams.eq(index)[0].offsetWidth;

// 		// find those more iteams
// 		if (IteamSumWith > navigationContainerWidth) {

// 			// wrap this more iteams
// 		}
// 	});
// });

// fix the single article page empty navigation 
$(function () {
	if ($(".post-navigation").length == 0) {
		return;
	}

	$prev = $(".post-navigation div.previous-post");
	$next = $(".post-navigation div.next-post");

	if ($prev.find("a").length == 0) {
		$prev.css({display: "none"});
	}

	if ($next.find("a").length == 0) {
		$next.css({display: "none"});
	}
});


$(function () {
    tabSwitcher();
});

function tabSwitcher() {
    var $tab = $(".tab");
    $tab.each(function (index, element) {
        var $tabSwitcherList = $(element).find(".tab-switcher .tab-switcher-list");
        var $tabContentList = $(element).find(".tab-container .tab-content .tab-content-list");
        var $tabContainer = $(element).find(".tab-container");

        $tabSwitcherList.on("click", function (event) {
            
            event = event || window.event;
            event.preventDefault();

            if (!$(this).hasClass("current")) {
            	$tabSwitcherList.removeClass("current");

            	var index = $(this).addClass("current").index();

            	$tabContentList.css({display:"none"}).eq(index).fadeIn(300);	
            }
        });
    });
}