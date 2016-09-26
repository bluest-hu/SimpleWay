// 给评论添加文章发布者标志
$(document).ready(function () {
	if ($(".article-comments-wrap")) {
		$(".article-comments-wrap .bypostauthor > .comment-body .comment-meta .comment-author")
			.append($('<span class="comment-by-post-author">Author</span>'));
	}
});

// scroll to top
$(document).ready(function() {

	var documentHeight = document.documentElement.offsetHeight || document.body.offsetHeight;
	var timer = null;

	$scrollBtn = $("#backToTopBtn");

	if (!$scrollBtn) {
		return;
	}

	$scrollBtn.css({'display': 'none'});

	$(document).on("scroll", function () {

		var scrollToTopDis = document.documentElement.scrollTop || document.body.scrollTop;

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
			}
		}, 30);
		event.preventDefault();
	});
});

/*** Fixed TextWedgit ***/
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


//
$(function () {
	var $SinglePostWrap = $("#singlePostWrap");

	// 如果是非文章页面 那么不处理
	if ( !$SinglePostWrap.length ) {
		return;
	}

	var $ThumbnailWrap 	= $SinglePostWrap.find(".post-thumbnail-wrap"),
		$Thumbnail 		= $ThumbnailWrap.find(".thumbnail"),
		$ThumnailCover 	= $ThumbnailWrap.find(".thumbnail-cover");

	var $Post 			= $SinglePostWrap.find(".single-post"),
		$PostMeta 		= $Post.find(".post-top-column");

	var paddingOffset 	= parseInt($Post.css("paddingTop")),
		thumbnailHeight = 0,
		postMetaHeight 	= parseInt($PostMeta.height()) + parseInt($PostMeta.css("marginBottom"));

	var offset = paddingOffset + postMetaHeight;

	var image = new Image;

	image.src = $Thumbnail.attr("src");

	$(image).on("load",function() {
		thumbnailHeight = parseInt($(this).get(0).height);

		var position = (postMetaHeight / thumbnailHeight) * 100 + "%";

		var timer= setTimeout(function () {
			$SinglePostWrap.addClass("has-thumbnail");

			$Post.css({
				"marginTop": -offset,
				"position": "relative"
			});

			$ThumnailCover.css({
				"background-image": "linear-gradient(transparent " + position  + ", rgba(0, 0, 0, .7))"
			});
			// 清除定时器
			clearTimeout(timer);
		}, 500);



	});
});

// fix the single article page empty navigation
$(function () {
	if ($(".post-navigation").length == 0) {
		return;
	}

	$prev = $(".post-navigation div.previous-post");
	$next = $(".post-navigation div.next-post");

	if ( !$prev.find("a") ) {
		$prev.css({
			display: "none"
		});
	}

	if ( !$next.find("a") ) {
		$next.css({
			display: "none"
		});
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


$(function () {
	var $CatItems = $("#sidebar .cat-item");

    if (!$CatItems.length) {
        return ;
    }

	$CatItems.each(function (index, element) {
		var $CatItem = $(element);

		var children = $CatItem.eq(0)[0].childNodes;

		for (var i = 0, length = children.length; i< length; i++ ) {
			var child = children[i];

			if (child.nodeType === 3 )  {
				var count = child.nodeValue.match(/\d+/);
				if (count != null) {
					var span = document.createElement("span");
					span.setAttribute("class", "count");
					var num = document.createElement("b");
					num.setAttribute("class", "number");
					num.appendChild(document.createTextNode(count));
					span.appendChild(num);
					element.replaceChild(span, child);
				}
			}
		}

		if ( $CatItem.children(".children").length ) {
			$CatItem.addClass("active");
		}
	});

	$CatItems.hover(function () {
		var $This = $(this);
		var $Children = $This.children(".children");

		if ( $Children.length ) {
			$Children.filter(":animated").stop(true);
			$Children.slideDown("fast", function () {
				$This.removeClass("active");
			});
		}
	}, function () {
		var $This = $(this);
		var $Children = $This.children(".children");

		if ( $Children.length ) {
			$Children.filter(":animated").stop(true);
			$Children.slideUp("fast", function () {
				$This.addClass("active");
			});
		}

	});
});

$(function () {
    var $ArticleArchive = $("#sidebar .article-archives li");

    console.log($ArticleArchive)

    if (!$ArticleArchive.length) {
        return ;
    }

    $ArticleArchive.each(function (index, element) {
        var $CatItem = $(element);

        var children = $CatItem.eq(0)[0].childNodes;

        for (var i = 0, length = children.length; i< length; i++ ) {
            var child = children[i];

            if (child.nodeType === 3 )  {
                var count = child.nodeValue.match(/\d+/);
                if (count != null) {
                    var span = document.createElement("span");
                    span.setAttribute("class", "count");
                    var num = document.createElement("b");
                    num.setAttribute("class", "number");
                    num.appendChild(document.createTextNode(count));
                    span.appendChild(num);
                    element.replaceChild(span, child);
                }
            }
        }

        if ( $CatItem.children(".children").length ) {
            $CatItem.addClass("active");
        }
    });
});

(function (win, $, undefined) {

    var _Video = function () {



    };

    _Video.prototype.init = function () {

    };




})(window, $);


var a = new Date();
