var socialWarfarePlugin = socialWarfarePlugin || {};
! function(t, e) {
    var i, a = t.socialWarfarePlugin;
    a.throttle = i = function(t, i, o, n) {
        function s() {
            function a() {
                l = +new Date, o.apply(p, c)
            }

            function s() {
                r = e
            }
            var p = this,
                d = +new Date - l,
                c = arguments;
            n && !r && a(), r && clearTimeout(r), n === e && d > t ? a() : !0 !== i && (r = setTimeout(n ? s : a, n === e ? t - d : t))
        }
        var r, l = 0;
        return "boolean" != typeof i && (n = o, o = i, i = e), a.guid && (s.guid = o.guid = o.guid || a.guid++), s
    }, a.debounce = function(t, a, o) {
        return o === e ? i(t, a, !1) : i(t, o, !1 !== a)
    }
}(this),
function(t, e, i) {
    "use strict";

    function a(t) {
        return parseInt(t, 10)
    }

    function o(i) {
        var a = e.Event(i);
        e(t).trigger(a)
    }

    function n() {
        e(".swp_social_panel:not(.swp_social_panelSide) .nc_tweetContainer:not(.swp_nohover) .iconFiller").removeAttr("style"), e(".swp_social_panel:not(.swp_social_panelSide) .nc_tweetContainer:not(.swp_nohover)").removeAttr("style")
    }

    function s() {
        e(".nc_wrapper").length && e(".nc_wrapper").remove();
        var i = e(".swp_social_panel").not('[data-float="ignore"]').first(),
            a = i.data("float"),
            o = i.data("align");
        if (a) {
            if (e(".swp_social_panel").not(".swp_social_panelSide").length) {
                var n = e(".swp_social_panelSide").data("float-mobile"),
                    s = i.offset(),
                    r = e(".swp_social_panelSide").filter(":not(.mobile)"),
                    l = r.data("screen-width");
                if (s.left < 100 || e(t).width() < l) var p = n;
                else var p = a
            } else var p = a;
            var d = e(".swp_social_panel").data("floatcolor"),
                c = e('<div class="nc_wrapper" style="background-color:' + d + '"></div>');
            if (c.appendTo("body"), "left" === a || "right" === a) var p = i.data("float-mobile");
            else var p = i.data("float");
            i.clone().appendTo(c), e(".nc_wrapper").hide().addClass(p);
            var f = i.outerWidth(!0),
                h = i.offset();
            e(".swp_social_panel").last().addClass("nc_floater").css({
                width: f,
                left: "center" == o ? 0 : h.left
            }), e(".swp_social_panel .swp_count").css({
                transition: "padding .1s linear"
            }), e(".swp_social_panel").eq(0).addClass("swp_one"), e(".swp_social_panel").eq(2).addClass("swp_two"), e(".swp_social_panel").eq(1).addClass("swp_three")
        }
    }

    function r() {
        var i = e(".swp_social_panel"),
            a = i.not('[data-float="float_ignore"]').eq(0).data("float"),
            o = e(t),
            n = o.height(),
            s = e(".nc_wrapper"),
            r = e(".swp_social_panelSide").filter(":not(.mobile)"),
            l = (e(".swp_social_panel").data("position"), r.data("screen-width")),
            p = i.eq(0).offset(),
            d = o.scrollTop(),
            c = (e(t).scrollTop(), !1);
        if (void 0 === t.swpOffsets && (t.swpOffsets = {}), "right" === a || "left" === a) {
            var f = e(".swp_social_panelSide").data("float-mobile"),
                h = -1 !== a.indexOf("left") ? "left" : "right";
            e(".swp_social_panel").not(".swp_social_panelSide").length ? (e(".swp_social_panel").not(".swp_social_panelSide, .nc_floater").each(function() {
                var t = e(this).offset(),
                    i = e(this).height();
                t.top + i > d && t.top < d + n && (c = !0)
            }), p.left < 100 || e(t).width() < l ? (c = !0, "bottom" == f ? a = "bottom" : "top" == f && (a = "top")) : c || (c = !1)) : e(t).width() > l ? c = !1 : (c = !0, "bottom" == f ? a = "bottom" : "top" == f && (a = "top"));
            var _ = r.data("transition");
            "slide" == _ ? 1 == c ? r.css(h, "-150px") : r.css(h, "5px") : "fade" == _ && (1 == c ? r.fadeOut(200) : r.fadeIn(200).css("display", "flex"))
        }
        if ("bottom" == a || "top" == a)
            if (c = !1, e(".swp_social_panel").not(".swp_social_panelSide, .nc_floater").each(function() {
                    var t = e(this).offset(),
                        i = e(this).height();
                    t.top + i > d && t.top < d + n && (c = !0)
                }), c) s.hide(), "bottom" == a ? e("body").animate({
                "padding-bottom": t.bodyPaddingBottom + "px"
            }, 0) : "top" == a && e("body").animate({
                "padding-top": t.bodyPaddingTop + "px"
            }, 0);
            else {
                var w, u;
                s.show(), "bottom" == a ? (w = t.bodyPaddingBottom + 50, e("body").animate({
                    "padding-bottom": w + "px"
                }, 0)) : "top" == a && (u = e(".swp_social_panel").not(".swp_social_panelSide, .nc_wrapper .swp_social_panel").first().offset(), u.top > d + n && (w = t.bodyPaddingTop + 50, e("body").animate({
                    "padding-top": w + "px"
                }, 0)))
            }
    }

    function l() {
        var e = jQuery("[class*=float-position-center]");
        if (e.length) {
            var i = e.outerHeight(),
                a = t.innerHeight;
            if (i > a) return void e.css("top", 0);
            var o = (a - i) / 2;
            e.css("top", o)
        }
    }

    function p() {
        0 !== e(".swp_social_panel").length && (s(), l(), f.activateHoverStates(), c(), e(t).scrollTop(), e(t).scroll(f.throttle(50, function() {
            r()
        })), e(t).trigger("scroll"))
    }

    function d() {
        var i = {
                wrap: '<div class="sw-pinit" />',
                pageURL: document.URL
            },
            a = e.extend(i, a);
        e(".swp-content-locator").parent().find("img").each(function() {
            var i = e(this);
            if (!(i.outerHeight() < swpPinIt.minHeight || i.outerWidth() < swpPinIt.minWidth)) {
                var o = !1;
                if (void 0 !== swpPinIt.image_source ? o = swpPinIt.image_source : i.data("media") ? o = i.data("media") : e(this).data("lazy-src") ? o = e(this).data("lazy-src") : i[0].src && (o = i[0].src), !1 !== o && !i.hasClass("no_pin")) {
                    var n = "";
                    void 0 !== swpPinIt.image_description ? n = swpPinIt.image_description : i.attr("title") ? n = i.attr("title") : i.attr("alt") && (n = i.attr("alt"));
                    var s = "http://pinterest.com/pin/create/bookmarklet/?media=" + encodeURI(o) + "&url=" + encodeURI(a.pageURL) + "&is_video=false&description=" + encodeURIComponent(n),
                        r = i.attr("class"),
                        l = i.attr("style");
                    i.removeClass().attr("style", "").wrap(a.wrap), i.after('<a href="' + s + '" class="sw-pinit-button sw-pinit-' + swpPinIt.vLocation + " sw-pinit-" + swpPinIt.hLocation + '">Save</a>'), i.parent(".sw-pinit").addClass(r).attr("style", l), e(".sw-pinit .sw-pinit-button").on("click", function() {
                        if (t.open(e(this).attr("href"), "Pinterest", "width=632,height=253,status=0,toolbar=0,menubar=0,location=1,scrollbars=1"), "function" == typeof ga && !0 === swpClickTracking) {
                            ga("send", "event", "social_media", "swp_pin_image_share")
                        }
                        return !1
                    })
                }
            }
        })
    }

    function c() {
        e(".nc_tweet, a.swp_CTT").off("click"), e(".nc_tweet, a.swp_CTT").on("click", function(i) {
            if (e(this).hasClass("noPop")) return !1;
            if (e(this).data("link")) {
                i.preventDefault ? i.preventDefault() : i.returnValue = !1;
                var a, o, n, s, r, l = e(this).data("link");
                if (l = l.replace("’", "'"), e(this).hasClass("pinterest") || e(this).hasClass("buffer_link") || e(this).hasClass("flipboard") ? (a = 550, o = 775) : (a = 270, o = 500), n = t.screenY + (t.innerHeight - a) / 2, s = t.screenX + (t.innerWidth - o) / 2, r = "height=" + a + ",width=" + o + ",top=" + n + ",left=" + s, t.open(l, "_blank", r), "function" == typeof ga && !0 === swpClickTracking) {
                    if (e(this).hasClass("nc_tweet")) var p = e(this).parents(".nc_tweetContainer").attr("data-network");
                    else if (e(this).hasClass("swp_CTT")) var p = "ctt";
                    ga("send", "event", "social_media", "swp_" + p + "_share")
                }
                return !1
            }
        })
    }
    var f = t.socialWarfarePlugin,
        h = {};
    socialWarfarePlugin.fetchShares = function() {
        e.when(e.get("https://graph.facebook.com/?fields=og_object{likes.summary(true).limit(0)},share&id=" + swp_post_url), swp_post_recovery_url ? e.get("https://graph.facebook.com/?fields=og_object{likes.summary(true).limit(0)},share&id=" + swp_post_recovery_url) : "").then(function(t, e) {
            if (void 0 !== t[0].share) {
                var i = a(t[0].share.share_count),
                    o = a(t[0].share.comment_count);
                if (void 0 !== t[0].og_object) var n = a(t[0].og_object.likes.summary.total_count);
                else var n = 0;
                var s = i + o + n;
                if (swp_post_recovery_url) {
                    if (void 0 !== e[0].share) var r = a(e[0].share.share_count),
                        l = a(e[0].share.comment_count);
                    else var r = 0,
                        l = 0;
                    if (void 0 !== e[0].og_object) var p = a(e[0].og_object.likes.summary.total_count);
                    else var p = 0;
                    var d = r + l + p;
                    s !== d && (s += d)
                }
                h = {
                    action: "swp_facebook_shares_update",
                    post_id: swp_post_id,
                    activity: s
                }
            }
        })
    }, f.activateHoverStates = function() {
        o("pre_activate_buttons"), e(".swp_social_panel:not(.swp_social_panelSide) .nc_tweetContainer").on("mouseenter", function() {
            if (e(this).hasClass("swp_nohover"));
            else {
                n();
                var t = e(this).find(".swp_share").outerWidth(),
                    i = e(this).find("i.sw").outerWidth(),
                    a = e(this).width(),
                    o = 1 + (t + 35) / a;
                e(this).find(".iconFiller").width(t + i + 25 + "px"), e(this).css({
                    flex: o + " 1 0%"
                })
            }
        }), e(".swp_social_panel:not(.swp_social_panelSide)").on("mouseleave", function() {
            n()
        })
    }, e(t).on("load", function() {
        "undefined" != typeof swpPinIt && swpPinIt.enabled && d()
    }), e(document).ready(function() {
        c(), p();
        var i = e(".swp_social_panelSide");
        t.bodyPaddingTop = a(e("body").css("padding-top").replace("px", "")), t.bodyPaddingBottom = a(e("body").css("padding-bottom").replace("px", ""));
        var o = !1;
        if (e(".swp_social_panel").hover(function() {
                o = !0
            }, function() {
                o = !1
            }), e(t).resize(f.debounce(250, function() {
                e(".swp_social_panel").length && !1 !== o || (t.swpAdjust = 1, p())
            })), e(document.body).on("post-load", function() {
                p()
            }), 0 !== i.length) {
            if (-1 !== e(i).attr("class").indexOf("swp_side")) return;
            var n = e(i).height(),
                s = e(t).height(),
                r = a(s / 2 - n / 2);
            setTimeout(function() {
                e(i).animate({
                    top: r
                }, 0)
            }, 105)
        }
        1 === e(".swp-content-locator").parent().children().length && e(".swp-content-locator").parent().hide()
    })
}(this, jQuery),
function(t) {
    var e = /iPhone/i,
        i = /iPod/i,
        a = /iPad/i,
        o = /(?=.*\bAndroid\b)(?=.*\bMobile\b)/i,
        n = /Android/i,
        s = /(?=.*\bAndroid\b)(?=.*\bSD4930UR\b)/i,
        r = /(?=.*\bAndroid\b)(?=.*\b(?:KFOT|KFTT|KFJWI|KFJWA|KFSOWI|KFTHWI|KFTHWA|KFAPWI|KFAPWA|KFARWI|KFASWI|KFSAWI|KFSAWA)\b)/i,
        l = /Windows Phone/i,
        p = /(?=.*\bWindows\b)(?=.*\bARM\b)/i,
        d = /BlackBerry/i,
        c = /BB10/i,
        f = /Opera Mini/i,
        h = /(CriOS|Chrome)(?=.*\bMobile\b)/i,
        _ = /(?=.*\bFirefox\b)(?=.*\bMobile\b)/i,
        w = new RegExp("(?:Nexus 7|BNTV250|Kindle Fire|Silk|GT-P1000)", "i"),
        u = function(t, e) {
            return t.test(e)
        },
        v = function(t) {
            var v = t || navigator.userAgent,
                b = v.split("[FBAN");
            if (void 0 !== b[1] && (v = b[0]), b = v.split("Twitter"), void 0 !== b[1] && (v = b[0]), this.apple = {
                    phone: u(e, v),
                    ipod: u(i, v),
                    tablet: !u(e, v) && u(a, v),
                    device: u(e, v) || u(i, v) || u(a, v)
                }, this.amazon = {
                    phone: u(s, v),
                    tablet: !u(s, v) && u(r, v),
                    device: u(s, v) || u(r, v)
                }, this.android = {
                    phone: u(s, v) || u(o, v),
                    tablet: !u(s, v) && !u(o, v) && (u(r, v) || u(n, v)),
                    device: u(s, v) || u(r, v) || u(o, v) || u(n, v)
                }, this.windows = {
                    phone: u(l, v),
                    tablet: u(p, v),
                    device: u(l, v) || u(p, v)
                }, this.other = {
                    blackberry: u(d, v),
                    blackberry10: u(c, v),
                    opera: u(f, v),
                    firefox: u(_, v),
                    chrome: u(h, v),
                    device: u(d, v) || u(c, v) || u(f, v) || u(_, v) || u(h, v)
                }, this.seven_inch = u(w, v), this.any = this.apple.device || this.android.device || this.windows.device || this.other.device || this.seven_inch, this.phone = this.apple.phone || this.android.phone || this.windows.phone, this.tablet = this.apple.tablet || this.android.tablet || this.windows.tablet, "undefined" == typeof window) return this
        },
        b = function() {
            var t = new v;
            return t.Class = v, t
        };
    "undefined" != typeof module && module.exports && "undefined" == typeof window ? module.exports = v : "undefined" != typeof module && module.exports && "undefined" != typeof window ? module.exports = b() : "function" == typeof define && define.amd ? define("swp_isMobile", [], t.swp_isMobile = b()) : t.swp_isMobile = b()
}(this);
var thirstyFunctions;
jQuery(document).ready(function($) {
    thirstyFunctions = {
        recordLinkStatEvents: function() {
            if (thirsty_global_vars.enable_record_stats == 'yes')
                $('body').on('click', 'a', thirstyFunctions.recordLinkStat)
        },
        recordLinkStat: function(e) {
            var $link = $(this),
                href = $link.attr('href'),
                linkID = $link.data('linkid'),
                keyword = $link.text(),
                imgsrc, newWindow;
            if (!thirstyFunctions.isThirstyLink(href) && !linkID) return;
            if ($link.data("clicked")) {
                e.preventDefault();
                return
            }
            $link.data("clicked", !0);
            if (!keyword && $link.find('img').length) {
                imgsrc = $link.find('img').prop('src').split('/');
                keyword = imgsrc[imgsrc.length - 1]
            }
            if (thirsty_global_vars.enable_js_redirect === 'yes' && $link.data('nojs') != !0) {
                e.preventDefault();
                if ($link.prop('target') == '_blank')
                    newWindow = window.open('', '_blank')
            }
            $.post(thirsty_global_vars.ajax_url, {
                action: 'ta_click_data_redirect',
                href: href,
                page: window.location.href,
                link_id: linkID,
                keyword: keyword
            }, function(redirect_url) {
                $link.data("clicked", !1);
                if (thirsty_global_vars.enable_js_redirect !== 'yes' || $link.data('nojs') == !0)
                    return;
                if (newWindow)
                    newWindow.location.href = redirect_url ? redirect_url : href;
                else window.location.href = redirect_url ? redirect_url : href
            })
        },
        isThirstyLink: function(href) {
            if (!href)
                return;
            href = href.replace('http:', '{protocol}').replace('https:', '{protocol}');
            var link_uri = href.replace(thirsty_global_vars.home_url, '').replace('{protocol}', ''),
                link_prefix, new_href;
            link_uri = link_uri.indexOf('/') == 0 ? link_uri.replace('/', '') : link_uri;
            link_prefix = link_uri.substr(0, link_uri.indexOf('/')), new_href = href.replace('/' + link_prefix + '/', '/' + thirsty_global_vars.link_prefix + '/').replace('{protocol}', window.location.protocol);
            return (link_prefix && $.inArray(link_prefix, link_prefixes) > -1) ? new_href : !1
        },
        linkFixer: function() {
            if (thirsty_global_vars.link_fixer_enabled !== 'yes')
                return;
            var $allLinks = $('body a'),
                hrefs = [],
                href, linkClass, isShortcode, isImage, content, key;
            for (key = 0; key < $allLinks.length; key++) {
                href = $($allLinks[key]).attr('href');
                linkClass = $($allLinks[key]).attr('class');
                isShortcode = $($allLinks[key]).data('shortcode');
                isImage = $($allLinks[key]).has('img').length;
                href = thirstyFunctions.isThirstyLink(href);
                if (href && !isShortcode)
                    hrefs.push({
                        key: key,
                        class: linkClass,
                        href: href,
                        is_image: isImage
                    });
                $($allLinks[key]).removeAttr('data-shortcode')
            }
            if (hrefs.length < 1)
                return;
            $.post(thirsty_global_vars.ajax_url, {
                action: 'ta_link_fixer',
                hrefs: hrefs,
                post_id: thirsty_global_vars.post_id
            }, function(response) {
                if (response.status == 'success') {
                    for (x in response.data) {
                        var key = response.data[x].key,
                            hrefProp = $($allLinks[key]).prop('href'),
                            qs = hrefProp ? hrefProp.split('?')[1] : '',
                            href = (qs) ? response.data[x].href + '?' + qs : response.data[x].href,
                            title = response.data[x].title,
                            className = response.data[x]['class'];
                        href = href.replace('http:', window.location.protocol).replace('https:', window.location.protocol);
                        if (title)
                            $($allLinks[key]).prop('title', title);
                        else $($allLinks[key]).removeAttr('title');
                        if (thirsty_global_vars.disable_thirstylink_class == 'yes')
                            className = className.replace('thirstylinkimg', '').replace('thirstylink', '').trim();
                        if (className)
                            $($allLinks[key]).prop('class', className);
                        else $($allLinks[key]).removeAttr('class');
                        $($allLinks[key]).prop('href', href).prop('rel', response.data[x].rel).prop('target', response.data[x].target).attr('data-linkid', response.data[x].link_id);
                        if (thirsty_global_vars.enable_js_redirect === 'yes')
                            $($allLinks[key]).attr('data-nojs', response.data[x].nojs)
                    }
                }
            }, 'json')
        }
    }
    var link_prefixes = $.map(thirsty_global_vars.link_prefixes, function(value, index) {
        return [value]
    });
    thirstyFunctions.recordLinkStatEvents();
    thirstyFunctions.linkFixer()
});
"use strict";
var _createClass = function() {
    function i(t, e) {
        for (var a = 0; a < e.length; a++) {
            var i = e[a];
            i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(t, i.key, i)
        }
    }
    return function(t, e, a) {
        return e && i(t.prototype, e), a && i(t, a), t
    }
}();

function _classCallCheck(t, e) {
    if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
}(function() {
    var s;
    s = jQuery, window.EDD_Jilt = function() {
        function e() {
            var t, a = this;
            _classCallCheck(this, e), this.register_email_collection_opt_out = this.register_email_collection_opt_out.bind(this), this.handle_email_bypass = this.handle_email_bypass.bind(this), this.params = window.edd_jilt_params, null == this.params.email_collection_opt_out && this.register_email_collection_opt_out(), this.params.capture_email_on_add_to_cart && this.init_add_to_cart(), this.params.cart_token && ((t = s(document.body)).on("focusin", "input, select", function(t) {
                return a.persist_order_data(t)
            }), t.on("focusout", "input, select", function(t) {
                return a.send_order_data(t)
            }), t.on("change", "select", function(t) {
                return a.send_order_data(t)
            }), t.on("edd_gateway_loaded", function(t, e) {
                return a.send_chosen_payment_method(e)
            }), s(window).on("unload visibilitychange", function() {
                return a.send_order_data_before_unload()
            }))
        }
        return _createClass(e, [{
            key: "register_email_collection_opt_out",
            value: function() {
                var e = this;
                return s(document.body).on("click", "a.js-edd-jilt-email-collection-opt-out", function(t) {
                    return t.preventDefault(), s.ajax({
                        url: e.params.ajax_url,
                        method: "POST",
                        data: {
                            action: "edd_jilt_set_customer_email_collection_opt_out",
                            security: e.params.nonce,
                            email_capture_opt_out: !0
                        },
                        fail: function(t) {
                            if (e.params.log_threshold <= 100) return console.log(t)
                        },
                        success: function(t) {
                            return e.params.log_threshold <= 100 && console.log(t), s(".edd-jilt-email-usage-notice").slideToggle().remove(), e.params.email_collection_opt_out = !0
                        }
                    })
                }), s(".edd-jilt-email-usage-notice a.dismiss-link").on("click", function() {
                    return location.reload()
                })
            }
        }, {
            key: "init_add_to_cart",
            value: function() {
                var e = this;
                return s(document.body).on("click.jilt_capture_email", ".edd-add-to-cart", function(t) {
                    return e.handle_added_to_cart(s(t.target))
                })
            }
        }, {
            key: "handle_added_to_cart",
            value: function(t) {
                var e;
                return e = 1 < arguments.length && void 0 !== arguments[1] && arguments[1] ? function() {
                    return t[0].click()
                } : function() {}, this.init_email_capture(t, e), setTimeout(function() {
                    return t.webuiPopover("show")
                }, 0)
            }
        }, {
            key: "init_email_capture",
            value: function(e) {
                var t, a, i, o, n = this,
                    r = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : function() {};
                return i = s("input.js-edd-jilt-popover-email"), t = s(".edd-jilt-popover-email-addon"), a = t.find(".js-edd-jilt-popover-email-icon"), o = t.find(".js-edd-jilt-popover-email-typing-indicator"), e.webuiPopover({
                    title: this.params.add_to_cart_title,
                    animation: "pop",
                    url: "#edd-jilt-popover-content",
                    onShow: function() {
                        return i.focus(), t.width(t.height())
                    },
                    onHide: function() {
                        return n.is_valid_email(i.val()) || e.hasClass("popover-dismissed") || n.handle_email_bypass(null, e, r), e.webuiPopover("destroy")
                    }
                }), i.typeWatch({
                    callback: function(t) {
                        return t ? (a.hide(), o.show()) : (o.hide(), a.show())
                    },
                    wait: 150,
                    captureLength: 1
                }), i.typeWatch({
                    callback: function(t) {
                        if (n.is_valid_email(t)) return o.hide(), a.show().removeClass("dashicons-email").addClass("dashicons-yes edd-jilt-email-success"), setTimeout(function() {
                            return e.webuiPopover("hide"), n.terminate_add_to_cart(), n.set_customer({
                                email: t
                            }, r)
                        }, 500)
                    },
                    wait: 1250,
                    highlight: !0,
                    allowSubmit: !1,
                    captureLength: 6
                }), s(document.body).on("click", ".js-edd-jilt-popover-bypass", function(t) {
                    return e.addClass("popover-dismissed"), n.handle_email_bypass(t, e, r)
                })
            }
        }, {
            key: "handle_email_bypass",
            value: function(t, e) {
                var a, i = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : function() {};
                return a = {
                    add_to_cart_opt_out: !0
                }, null != t ? (t.preventDefault(), s(t.target).hasClass("js-edd-jilt-email-collection-opt-out") && (a.email_capture_opt_out = !0, this.params.email_collection_opt_out = !0)) : a.email_capture_opt_out = !1, e.webuiPopover("destroy"), this.set_customer({
                    add_to_cart_opt_out: !0,
                    email_capture_opt_out: null != t || void 0
                }, i), this.terminate_add_to_cart()
            }
        }, {
            key: "terminate_add_to_cart",
            value: function() {
                return s(document.body).off("click.jilt_capture_email")
            }
        }, {
            key: "persist_order_data",
            value: function(t) {
                var e;
                if (e = s(t.target), this.is_checkout_field(e)) return e.val() ? e.data("jilt-value", e.val()) : void 0
            }
        }, {
            key: "send_chosen_payment_method",
            value: function(t) {
                if (!this.params.email_collection_opt_out) return s.ajax({
                    method: "PATCH",
                    url: "" + this.params.orders_endpoint + this.params.cart_token,
                    headers: {
                        Authorization: "Token " + this.params.public_key,
                        "x-jilt-shop-domain": this.params.x_jilt_shop_domain
                    },
                    data: {
                        cart_token: this.params.cart_token,
                        client_session: {
                            options: {
                                gateway: t
                            }
                        }
                    }
                })
            }
        }, {
            key: "send_order_data",
            value: function(t) {
                var e, a, i, o, n, r;
                if (!this.params.email_collection_opt_out && (r = (e = s(t.target)).val(), null != (o = e.attr("name")) && this.is_checkout_field(e) && r && r !== e.data("jilt-value") && ("edd_email" !== o || this.is_valid_email(r)) && null != (i = this.params.payment_field_mapping[o]))) return (a = {}).cart_token = this.params.cart_token, a.billing_address = {}, a.billing_address[i] = r, -1 < ["email", "first_name", "last_name", "phone"].indexOf(i) && (a.customer = {}, a.customer[i] = r), (n = this.params.address_field_mapping[o]) && (a.client_session = {
                    customer: {
                        address: {}
                    }
                }, a.client_session.customer.address[n] = r), s.ajax({
                    method: "PATCH",
                    url: "" + this.params.orders_endpoint + this.params.cart_token,
                    headers: {
                        Authorization: "Token " + this.params.public_key,
                        "x-jilt-shop-domain": this.params.x_jilt_shop_domain
                    },
                    data: a
                })
            }
        }, {
            key: "send_order_data_before_unload",
            value: function() {
                var t, e, a, i, o, n, r;
                if (!this.params.email_collection_opt_out) {
                    for (a in r = "" + this.params.orders_endpoint + this.params.cart_token, (e = {}).cart_token = this.params.cart_token, e.customer = {}, e.billing_address = {}, e.shipping_address = {}, e.client_session = {
                            customer: {
                                address: {}
                            }
                        }, o = this.params.order_address_mapping) i = o[a], t = s("input[name=" + a + "], select[name=" + a + "]").val(), ("edd_email" !== a || this.is_valid_email(t)) && t && (e.billing_address[i] = t, (n = this.params.address_field_mapping[a]) && (e.client_session.customer.address[n] = t), -1 < ["email", "first_name", "last_name"].indexOf(i) && (e.customer[i] = t));
                    if (!s.isEmptyObject(e.customer) || !s.isEmptyObject(e.billing_address)) return null != navigator.sendBeacon ? (e.auth_token = this.params.public_key, navigator.sendBeacon(r + "/beacon", new Blob([s.param(e)], {
                        type: "application/x-www-form-urlencoded"
                    }))) : s.ajax({
                        method: "PATCH",
                        url: r,
                        headers: {
                            Authorization: "Token " + this.params.public_key,
                            "x-jilt-shop-domain": this.params.x_jilt_shop_domain
                        },
                        data: e,
                        async: !1,
                        timeout: 750
                    })
                }
            }
        }, {
            key: "is_checkout_field",
            value: function(t) {
                var e;
                return null != (e = t.attr("name")) && (-1 !== e.indexOf("edd_") || this.params.payment_field_mapping[e])
            }
        }, {
            key: "is_valid_email",
            value: function(t) {
                return /[^\s@]+@[^\s@]+\.[^\s@]+/.test(t)
            }
        }, {
            key: "set_customer",
            value: function(t) {
                var e = this,
                    a = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : function() {};
                return s.ajax({
                    method: "POST",
                    url: this.params.ajax_url,
                    data: {
                        action: "edd_jilt_set_customer",
                        _ajax_nonce: this.params.nonce,
                        email: t.email,
                        first_name: t.first_name,
                        last_name: t.last_name,
                        opt_out: t.opt_out,
                        add_to_cart_opt_out: t.add_to_cart_opt_out,
                        email_capture_opt_out: t.email_capture_opt_out
                    },
                    success: function(t) {
                        return e.params.log_threshold <= 100 && console.log(t), a()
                    },
                    failure: function(t) {
                        return e.params.log_threshold <= 100 && console.error(t), a()
                    }
                })
            }
        }]), e
    }(), window.edd_jilt = new EDD_Jilt
}).call(void 0);

function ga_skiplinks() {
    "use strict";
    var element = document.getElementById(location.hash.substring(1));
    element && (!1 === /^(?:a|select|input|button|textarea)$/i.test(element.tagName) && (element.tabIndex = -1), element.focus())
}
window.addEventListener ? window.addEventListener("hashchange", ga_skiplinks, !1) : window.attachEvent("onhashchange", ga_skiplinks);
jQuery(document).ready(function() {
    wp_gallery_custom_links_setup();

    function addLoadEvent(func) {
        var oldOnload = window.onload;
        if (typeof window.onload != 'function') {
            window.onload = func
        } else {
            window.onload = function() {
                oldOnload();
                func()
            }
        }
    }
    addLoadEvent(wp_gallery_custom_links_setup)
});

function wp_gallery_custom_links_setup() {
    if (jQuery.fn.off) {
        jQuery('.no-lightbox, .no-lightbox img').off('click')
    } else {
        jQuery('.no-lightbox, .no-lightbox img').unbind('click')
    }
    jQuery('a.no-lightbox').click(wp_gallery_custom_links_click);
    if (jQuery.fn.off) {
        jQuery('a.set-target').off('click')
    } else {
        jQuery('a.set-target').unbind('click')
    }
    jQuery('a.set-target').click(wp_gallery_custom_links_click)
}

function wp_gallery_custom_links_click() {
    if (!this.target || this.target == '' || this.target == '_self')
        window.location = this.href;
    else window.open(this.href, this.target);
    return !1
};
window.advadsGAAjaxAds = {};
window.advadsGAPassiveAds = {};
(function($) {
    if (typeof advanced_ads_pro !== 'undefined') {
        advanced_ads_pro.observers.add(function(event) {
            if (event.event === 'inject_passive_ads') {
                var server = 'all';
                if ($.isArray(event.ad_ids) && !event.ad_ids.length) {
                    event.ad_ids = {}
                }
                advadsGAPassiveAds = advads_tracking_utils('concat', advadsGAPassiveAds, event.ad_ids);
                var filteredIds = removeDelayedAdId(event.ad_ids);
                var advads_ad_ids;
                if (advadsTracking.method === 'frontend') {
                    advads_ad_ids = advads_tracking_utils('concat', advads_tracking_ads, filteredIds);
                    advads_tracking_ads = []
                } else {
                    advads_ad_ids = filteredIds;
                    server = 'passive'
                }
                advads_track_ads(advads_ad_ids, server)
            }
            if (event.event === 'inject_ajax_ads') {
                if ($.isArray(event.ad_ids) && !event.ad_ids.length) {
                    event.ad_ids = {}
                }
                advadsGAAjaxAds = advads_tracking_utils('concat', advadsGAAjaxAds, event.ad_ids);
                var filteredIds = removeDelayedAdId(event.ad_ids);
                advads_track_ads(filteredIds, 'analytics')
            }
        })
    }
}(jQuery));

function removeDelayedAdId(ids) {
    if (jQuery('[data-delayedgatrackid]').length) {
        jQuery('[data-delayedgatrackid]').each(function() {
            var id = parseInt(jQuery(this).attr('data-delayedgatrackid'));
            var bid = parseInt(jQuery(this).attr('data-delayedgabid'));
            if (advads_tracking_utils('hasAd', ids)) {
                if ('undefined' != typeof ids[bid]) {
                    var index = ids[bid].indexOf(id);
                    if (-1 != index) {
                        ids[bid].splice(index, 1)
                    }
                }
            }
        })
    }
    return ids
}
jQuery(document).ready(function($) {
    if ('undefined' == typeof advads_tracking_ads) return;
    advads_tracking_ads = removeDelayedAdId(advads_tracking_ads);
    if (typeof advanced_ads_pro === 'undefined') {
        if (advads_tracking_utils('hasAd', advads_tracking_ads)) {
            for (var bid in advads_tracking_ads) {
                if ('frontend' == advads_tracking_methods[bid]) {
                    advads_track_ads(advads_tracking_ads);
                    advads_tracking_ads = {
                        1: []
                    }
                }
            }
        }
    }
});
jQuery(document).on('advads_track_ads', function(e, ad_ids) {
    advads_track_ads(ad_ids)
});
jQuery(document).on('advads-layer-trigger', function(e) {
    if ('undefined' == typeof advadsGATracking) {
        return
    }
    advads_delayed_track_event(e)
})
jQuery(document).on('advads-sticky-trigger', function(e) {
    if ('undefined' == typeof advadsGATracking) {
        return
    }
    advads_delayed_track_event(e)
});

function advads_delayed_track_event(ev) {
    var $el = jQuery(ev.target);
    var $vector = [];
    if ($el.attr('data-delayedgatrackid')) {
        $vector = $el
    } else {
        $vector = $el.find('[data-delayedgatrackid]')
    }
    if ($vector.length) {
        var ids = {};
        $vector.each(function() {
            var bid = parseInt(jQuery(this).attr('data-delayedgabid'));
            if ('undefined' == typeof ids[bid]) {
                ids[bid] = []
            }
            ids[bid].push(parseInt(jQuery(this).attr('data-delayedgatrackid')))
        });
        if ('undefined' == typeof advadsGATracking.delayedAds) {
            advadsGATracking.delayedAds = {}
        }
        advadsGATracking.delayedAds = advads_tracking_utils('concat', advadsGATracking.delayedAds, ids);
        advads_track_ads(advadsGATracking.delayedAds, 'delayed')
    }
}

function advads_tracking_utils() {
    if (!arguments.hasOwnProperty(0)) return;
    var fn = arguments[0];
    var args = Array.prototype.slice.call(arguments, 1);
    var utils = {
        hasAd: function(data) {
            for (var i in data) {
                if (jQuery.isArray(data[i])) {
                    if (data[i].length) {
                        return !0
                    }
                }
            }
            return !1
        },
        concat: function() {
            var result = {};
            for (var i in args) {
                for (var j in args[i]) {
                    if ('undefined' == typeof result[j]) {
                        result[j] = args[i][j]
                    } else {
                        result[j] = result[j].concat(args[i][j])
                    }
                }
            }
            return result
        },
        blogUseGA: function(bid) {
            if ('ga' != advads_tracking_methods[bid] && !1 === advads_tracking_parallel[bid]) {
                return !1
            }
            if ('' == advads_gatracking_uids[bid]) {
                return !1
            }
            return !0
        },
        adsByBlog: function(ads, bid) {
            var result = {};
            if ('undefined' != typeof ads[bid]) {
                result[bid] = ads[bid];
                return result
            }
            return {}
        },
    };
    if ('function' == typeof utils[fn]) {
        return utils[fn].apply(null, args)
    }
}

function advads_track_ads(advads_ad_ids, server) {
    if (!advads_tracking_utils('hasAd', advads_ad_ids)) return;
    if ('undefined' == typeof server) server = 'all';
    for (var bid in advads_ad_ids) {
        var data = {
            ads: advads_ad_ids[bid],
        };
        if (advads_tracking_utils('blogUseGA', bid)) {
            if ('undefined' == typeof advadsGATracking) {
                advadsGATracking = {}
            }
            if ('undefined' === typeof advadsGATracking.deferedAds) {
                advadsGATracking.deferedAds = {}
            }
            if ('local' != server) {
                advadsGATracking.deferedAds = advads_tracking_utils('concat', advadsGATracking.deferedAds, advads_tracking_utils('adsByBlog', advads_ad_ids, bid), );
                if ('delayed' == server) {
                    jQuery(document).trigger('advadsGADelayedTrack');
                    var passiveDelayed = {};
                    passiveDelayed[bid] = [];
                    if (-1 == ['frontend', 'ga'].indexOf(advads_tracking_methods[bid])) {
                        if (advads_tracking_utils('hasAd', advads_tracking_utils('adsByBlog', advadsGAPassiveAds, bid))) {
                            for (var i in advads_ad_ids[bid]) {
                                if (-1 != advadsGAPassiveAds[bid].indexOf(advads_ad_ids[bid][i])) {
                                    passiveDelayed[bid].push(advads_ad_ids[i])
                                }
                            }
                        }
                        if (passiveDelayed[bid].length) {
                            for (var j in passiveDelayed[bid]) {
                                advadsGAPassiveAds[bid].splice(advadsGAPassiveAds[bid].indexOf(passiveDelayed[j]), 1)
                            }
                            jQuery.post(advads_tracking_urls[bid], {
                                ads: passiveDelayed[bid]
                            }, function(response) {})
                        }
                    }
                } else {
                    if ('passive' == server && advads_tracking_utils('hasAd', advads_tracking_utils('adsByBlog', advads_ad_ids, bid)) && -1 != ['onrequest', 'shutdown'].indexOf(advads_tracking_methods[bid])) {
                        jQuery.post(advads_tracking_urls[bid], data, function(response) {})
                    }
                    jQuery(document).trigger('advadsGADeferedTrack')
                }
            }
            if (advads_tracking_parallel[bid] && 'analytics' != server && advads_tracking_methods[bid] == 'frontend') {
                if (advads_tracking_utils('hasAd', advads_tracking_utils('adsByBlog', advadsGAAjaxAds, bid))) {
                    var removed = [];
                    for (var i in advadsGAAjaxAds[bid]) {
                        var index = data.ads.indexOf(advadsGAAjaxAds[bid][i]);
                        if (-1 != index) {
                            data.ads.splice(index, 1);
                            removed.push(advadsGAAjaxAds[bid][i])
                        }
                    }
                    if (removed.length) {
                        for (var j in removed) {
                            index = advadsGAAjaxAds[bid].indexOf(removed[j]);
                            advadsGAAjaxAds[bid].splice(index, 1)
                        }
                    }
                }
                if (data.ads.length) {
                    jQuery.post(advads_tracking_urls[bid], data, function(response) {})
                }
            }
        } else {
            if ('analytics' != server) {
                jQuery.post(advads_tracking_urls[bid], {
                    ads: data.ads
                }, function(response) {})
            }
        }
    }
};
! function(a) {
    a.fn.hoverIntent = function(b, c, d) {
        var e = {
            interval: 100,
            sensitivity: 6,
            timeout: 0
        };
        e = "object" == typeof b ? a.extend(e, b) : a.isFunction(c) ? a.extend(e, {
            over: b,
            out: c,
            selector: d
        }) : a.extend(e, {
            over: b,
            out: b,
            selector: c
        });
        var f, g, h, i, j = function(a) {
                f = a.pageX, g = a.pageY
            },
            k = function(b, c) {
                return c.hoverIntent_t = clearTimeout(c.hoverIntent_t), Math.sqrt((h - f) * (h - f) + (i - g) * (i - g)) < e.sensitivity ? (a(c).off("mousemove.hoverIntent", j), c.hoverIntent_s = !0, e.over.apply(c, [b])) : (h = f, i = g, c.hoverIntent_t = setTimeout(function() {
                    k(b, c)
                }, e.interval), void 0)
            },
            l = function(a, b) {
                return b.hoverIntent_t = clearTimeout(b.hoverIntent_t), b.hoverIntent_s = !1, e.out.apply(b, [a])
            },
            m = function(b) {
                var c = a.extend({}, b),
                    d = this;
                d.hoverIntent_t && (d.hoverIntent_t = clearTimeout(d.hoverIntent_t)), "mouseenter" === b.type ? (h = c.pageX, i = c.pageY, a(d).on("mousemove.hoverIntent", j), d.hoverIntent_s || (d.hoverIntent_t = setTimeout(function() {
                    k(c, d)
                }, e.interval))) : (a(d).off("mousemove.hoverIntent", j), d.hoverIntent_s && (d.hoverIntent_t = setTimeout(function() {
                    l(c, d)
                }, e.timeout)))
            };
        return this.on({
            "mouseenter.hoverIntent": m,
            "mouseleave.hoverIntent": m
        }, e.selector)
    }
}(jQuery);
(function($) {
    "use strict";
    $.maxmegamenu = function(menu, options) {
        var plugin = this;
        var $menu = $(menu);
        var defaults = {
            event: $menu.attr("data-event"),
            effect: $menu.attr("data-effect"),
            effect_speed: parseInt($menu.attr("data-effect-speed")),
            effect_mobile: $menu.attr("data-effect-mobile"),
            effect_speed_mobile: parseInt($menu.attr("data-effect-speed-mobile")),
            panel_width: $menu.attr("data-panel-width"),
            panel_inner_width: $menu.attr("data-panel-inner-width"),
            second_click: $menu.attr("data-second-click"),
            vertical_behaviour: $menu.attr("data-vertical-behaviour"),
            document_click: $menu.attr("data-document-click"),
            breakpoint: $menu.attr("data-breakpoint"),
            unbind_events: $menu.attr("data-unbind")
        };
        plugin.settings = {};
        var items_with_submenus = $("li.mega-menu-megamenu.mega-menu-item-has-children," + "li.mega-menu-flyout.mega-menu-item-has-children," + "li.mega-menu-tabbed > ul.mega-sub-menu > li.mega-menu-item-has-children," + "li.mega-menu-flyout li.mega-menu-item-has-children", menu);
        plugin.hidePanel = function(anchor, immediate) {
            anchor.parent().triggerHandler("before_close_panel");
            if (!immediate && plugin.settings.effect == 'slide' || plugin.isMobileView() && plugin.settings.effect_mobile == 'slide') {
                var speed = plugin.isMobileView() ? plugin.settings.effect_speed_mobile : plugin.settings.effect_speed;
                anchor.siblings(".mega-sub-menu").animate({
                    'height': 'hide',
                    'paddingTop': 'hide',
                    'paddingBottom': 'hide',
                    'minHeight': 'hide'
                }, speed, function() {
                    anchor.siblings(".mega-sub-menu").css("display", "");
                    anchor.parent().removeClass("mega-toggle-on").triggerHandler("close_panel")
                });
                return
            }
            if (immediate) {
                anchor.siblings(".mega-sub-menu").css("display", "none").delay(plugin.settings.effect_speed).queue(function() {
                    $(this).css("display", "").dequeue()
                })
            }
            anchor.siblings(".mega-sub-menu").find('.widget_media_video video').each(function() {
                this.player.pause()
            });
            anchor.parent().removeClass("mega-toggle-on").triggerHandler("close_panel");
            plugin.addAnimatingClass(anchor.parent())
        };
        plugin.addAnimatingClass = function(element) {
            if (plugin.settings.effect === "disabled") {
                return
            }
            $(".mega-animating").removeClass("mega-animating");
            var timeout = plugin.settings.effect_speed + parseInt(megamenu.timeout, 10);
            element.addClass("mega-animating");
            setTimeout(function() {
                element.removeClass("mega-animating")
            }, timeout)
        };
        plugin.hideAllPanels = function() {
            $(".mega-toggle-on > a.mega-menu-link", $menu).each(function() {
                plugin.hidePanel($(this), !1)
            })
        };
        plugin.hideSiblingPanels = function(anchor, immediate) {
            anchor.parent().parent().find(".mega-toggle-on").children("a.mega-menu-link").each(function() {
                plugin.hidePanel($(this), immediate)
            })
        };
        plugin.isDesktopView = function() {
            return Math.max(window.outerWidth, $(window).width()) > plugin.settings.breakpoint
        };
        plugin.isMobileView = function() {
            return !plugin.isDesktopView()
        };
        plugin.showPanel = function(anchor) {
            anchor.parent().triggerHandler("before_open_panel");
            $(".mega-animating").removeClass("mega-animating");
            if (plugin.isMobileView() && anchor.parent().hasClass("mega-hide-sub-menu-on-mobile")) {
                return
            }
            if (plugin.isDesktopView() && ($menu.hasClass("mega-menu-horizontal") || $menu.hasClass("mega-menu-vertical"))) {
                plugin.hideSiblingPanels(anchor, !0)
            }
            if ((plugin.isMobileView() && $menu.hasClass("mega-keyboard-navigation")) || plugin.settings.vertical_behaviour === "accordion") {
                plugin.hideSiblingPanels(anchor, !1)
            }
            plugin.calculateDynamicSubmenuWidths(anchor);
            if (plugin.settings.effect == "slide" || plugin.isMobileView() && plugin.settings.effect_mobile == 'slide') {
                var speed = plugin.isMobileView() ? plugin.settings.effect_speed_mobile : plugin.settings.effect_speed;
                anchor.siblings(".mega-sub-menu").css("display", "none").animate({
                    'height': 'show',
                    'paddingTop': 'show',
                    'paddingBottom': 'show',
                    'minHeight': 'show'
                }, speed, function() {
                    $(this).css("display", "")
                })
            }
            anchor.parent().addClass("mega-toggle-on").triggerHandler("open_panel")
        };
        plugin.calculateDynamicSubmenuWidths = function(anchor) {
            if (anchor.parent().hasClass("mega-menu-megamenu") && anchor.parent().parent().hasClass('mega-menu') && plugin.settings.panel_width && $(plugin.settings.panel_width).length > 0) {
                if (plugin.isDesktopView()) {
                    var submenu_offset = $menu.offset();
                    var target_offset = $(plugin.settings.panel_width).offset();
                    anchor.siblings(".mega-sub-menu").css({
                        width: $(plugin.settings.panel_width).outerWidth(),
                        left: (target_offset.left - submenu_offset.left) + "px"
                    })
                } else {
                    anchor.siblings(".mega-sub-menu").css({
                        width: "",
                        left: ""
                    })
                }
            }
            if (anchor.parent().hasClass("mega-menu-megamenu") && anchor.parent().parent().hasClass('mega-menu') && plugin.settings.panel_inner_width && $(plugin.settings.panel_inner_width).length > 0) {
                var target_width = 0;
                if ($(plugin.settings.panel_inner_width).length) {
                    target_width = parseInt($(plugin.settings.panel_inner_width).width(), 10)
                } else {
                    target_width = parseInt(plugin.settings.panel_inner_width, 10)
                }
                var submenu_width = parseInt(anchor.siblings(".mega-sub-menu").innerWidth(), 10);
                if (plugin.isDesktopView() && target_width > 0 && target_width < submenu_width) {
                    anchor.siblings(".mega-sub-menu").css({
                        "paddingLeft": (submenu_width - target_width) / 2 + "px",
                        "paddingRight": (submenu_width - target_width) / 2 + "px"
                    })
                } else {
                    anchor.siblings(".mega-sub-menu").css({
                        "paddingLeft": "",
                        "paddingRight": ""
                    })
                }
            }
        }
        var bindClickEvents = function() {
            var dragging = !1;
            $(document).on({
                "touchmove": function(e) {
                    dragging = !0
                },
                "touchstart": function(e) {
                    dragging = !1
                }
            });
            $(document).on("click touchend", function(e) {
                if (!dragging && plugin.settings.document_click === "collapse" && !$(e.target).closest(".mega-menu li").length && !$(e.target).closest(".mega-menu-toggle").length) {
                    plugin.hideAllPanels()
                }
                dragging = !1
            });
            $("> a.mega-menu-link", items_with_submenus).on("click.megamenu touchend.megamenu", function(e) {
                if (e.type === 'touchend') {
                    plugin.unbindHoverEvents();
                    plugin.unbindHoverIntentEvents()
                }
                if (plugin.isDesktopView() && $(this).parent().hasClass("mega-toggle-on") && $(this).parent().parent().parent().hasClass("mega-menu-tabbed")) {
                    if (plugin.settings.second_click === "go") {
                        return
                    } else {
                        e.preventDefault();
                        return
                    }
                }
                if (dragging) {
                    return
                }
                if (plugin.isMobileView() && $(this).parent().hasClass("mega-hide-sub-menu-on-mobile")) {
                    return
                }
                if ((plugin.settings.second_click === "go" || $(this).parent().hasClass("mega-click-click-go")) && $(this).attr('href') !== undefined) {
                    if (!$(this).parent().hasClass("mega-toggle-on")) {
                        e.preventDefault();
                        plugin.showPanel($(this))
                    }
                } else {
                    e.preventDefault();
                    if ($(this).parent().hasClass("mega-toggle-on")) {
                        plugin.hidePanel($(this), !1)
                    } else {
                        plugin.showPanel($(this))
                    }
                }
            })
        };
        var bindHoverEvents = function() {
            items_with_submenus.on({
                "mouseenter.megamenu": function() {
                    plugin.unbindClickEvents();
                    if (!$(this).hasClass("mega-toggle-on")) {
                        plugin.showPanel($(this).children("a.mega-menu-link"))
                    }
                },
                "mouseleave.megamenu": function() {
                    if ($(this).hasClass("mega-toggle-on") && !$(this).parent().parent().hasClass("mega-menu-tabbed")) {
                        plugin.hidePanel($(this).children("a.mega-menu-link"), !1)
                    }
                }
            })
        };
        var bindHoverIntentEvents = function() {
            items_with_submenus.hoverIntent({
                over: function() {
                    plugin.unbindClickEvents();
                    if (!$(this).hasClass("mega-toggle-on")) {
                        plugin.showPanel($(this).children("a.mega-menu-link"))
                    }
                },
                out: function() {
                    if ($(this).hasClass("mega-toggle-on") && !$(this).parent().parent().hasClass("mega-menu-tabbed")) {
                        plugin.hidePanel($(this).children("a.mega-menu-link"), !1)
                    }
                },
                timeout: megamenu.timeout,
                interval: megamenu.interval
            })
        };
        var bindKeyboardEvents = function() {
            var tab_key = 9;
            var escape_key = 27;
            $("body").on("keyup", function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === escape_key) {
                    $menu.parent().removeClass("mega-keyboard-navigation");
                    plugin.hideAllPanels()
                }
                if ($menu.parent().hasClass("mega-keyboard-navigation") && !($(event.target).closest(".mega-menu li").length || $(event.target).closest(".mega-menu-toggle").length)) {
                    $menu.parent().removeClass("mega-keyboard-navigation");
                    plugin.hideAllPanels();
                    if (plugin.isMobileView()) {
                        $menu.siblings('.mega-menu-toggle').removeClass('mega-menu-open')
                    }
                }
            });
            $menu.parent().on("keyup", function(e) {
                var keyCode = e.keyCode || e.which;
                var active_link = $(e.target);
                if (keyCode === tab_key) {
                    $menu.parent().addClass("mega-keyboard-navigation");
                    if (active_link.parent().is(items_with_submenus)) {
                        plugin.showPanel(active_link)
                    } else {
                        plugin.hideSiblingPanels(active_link)
                    }
                    if (active_link.hasClass("mega-menu-toggle")) {
                        active_link.addClass("mega-menu-open")
                    }
                }
            })
        };
        plugin.unbindAllEvents = function() {
            $("ul.mega-sub-menu, li.mega-menu-item, a.mega-menu-link", menu).off().unbind()
        };
        plugin.unbindClickEvents = function() {
            $("> a.mega-menu-link", items_with_submenus).off("click.megamenu touchend.megamenu")
        };
        plugin.unbindHoverEvents = function() {
            items_with_submenus.unbind("mouseenter.megamenu mouseleave.megamenu")
        };
        plugin.unbindHoverIntentEvents = function() {
            items_with_submenus.unbind("mouseenter mouseleave").removeProp('hoverIntent_t').removeProp('hoverIntent_s')
        };
        plugin.unbindMegaMenuEvents = function() {
            if (plugin.settings.event === "hover_intent") {
                plugin.unbindHoverIntentEvents()
            }
            if (plugin.settings.event === "hover") {
                plugin.unbindHoverEvents()
            }
            plugin.unbindClickEvents()
        }
        plugin.bindMegaMenuEvents = function() {
            if (plugin.isDesktopView() && plugin.settings.event === "hover_intent") {
                bindHoverIntentEvents()
            }
            if (plugin.isDesktopView() && plugin.settings.event === "hover") {
                bindHoverEvents()
            }
            bindClickEvents();
            bindKeyboardEvents()
        };
        plugin.monitorView = function() {
            if (plugin.isDesktopView()) {
                $menu.data("view", "desktop")
            } else {
                $menu.data("view", "mobile");
                plugin.switchToMobile()
            }
            plugin.checkWidth();
            $(window).resize(function() {
                plugin.checkWidth()
            })
        };
        plugin.checkWidth = function() {
            if (plugin.isMobileView() && $menu.data("view") === "desktop") {
                $menu.data("view", "mobile");
                plugin.switchToMobile()
            }
            if (plugin.isDesktopView() && $menu.data("view") === "mobile") {
                $menu.data("view", "desktop");
                plugin.switchToDesktop()
            }
            plugin.calculateDynamicSubmenuWidths($("li.mega-menu-megamenu.mega-toggle-on > a.mega-menu-link", $menu))
        };
        plugin.reverseRightAlignedItems = function() {
            if (!$('body').hasClass('rtl')) {
                $menu.append($menu.children("li.mega-item-align-right").get().reverse())
            }
        };
        plugin.addClearClassesToMobileItems = function() {
            $(".mega-menu-row", $menu).each(function() {
                $("> .mega-sub-menu > .mega-menu-column:not(.mega-hide-on-mobile)", $(this)).filter(":even").addClass('mega-menu-clear')
            })
        }
        plugin.switchToMobile = function() {
            plugin.unbindMegaMenuEvents();
            plugin.bindMegaMenuEvents();
            plugin.reverseRightAlignedItems();
            plugin.addClearClassesToMobileItems();
            plugin.hideAllPanels()
        };
        plugin.switchToDesktop = function() {
            plugin.unbindMegaMenuEvents();
            plugin.bindMegaMenuEvents();
            plugin.reverseRightAlignedItems();
            plugin.hideAllPanels()
        };
        plugin.init = function() {
            $menu.triggerHandler("before_mega_menu_init");
            plugin.settings = $.extend({}, defaults, options);
            $menu.removeClass("mega-no-js");
            $menu.siblings(".mega-menu-toggle").on("click", function(e) {
                if ($(e.target).is(".mega-menu-toggle-block, .mega-toggle-blocks-left, .mega-toggle-blocks-center, .mega-toggle-blocks-right, .mega-toggle-label, .mega-toggle-label span")) {
                    if (plugin.settings.effect_mobile == 'slide') {
                        if ($(this).hasClass("mega-menu-open")) {
                            $menu.animate({
                                'height': 'hide'
                            }, plugin.settings.effect_speed_mobile, function() {
                                $(this).css("display", "")
                            })
                        } else {
                            $menu.animate({
                                'height': 'show'
                            }, plugin.settings.effect_speed_mobile)
                        }
                    }
                    $(this).toggleClass("mega-menu-open")
                }
            });
            if (plugin.settings.unbind_events == 'true') {
                plugin.unbindAllEvents()
            }
            plugin.bindMegaMenuEvents();
            plugin.monitorView();
            $menu.triggerHandler("after_mega_menu_init")
        };
        plugin.init()
    };
    $.fn.maxmegamenu = function(options) {
        return this.each(function() {
            if (undefined === $(this).data("maxmegamenu")) {
                var plugin = new $.maxmegamenu(this, options);
                $(this).data("maxmegamenu", plugin)
            }
        })
    };
    $(function() {
        $('.max-mega-menu').maxmegamenu()
    })
})(jQuery);
(function($) {
    "use strict";
    $(function() {
        $('body').on('edd_cart_item_added', function(event, data) {
            $('.mega-menu-edd-cart-total').html(data.total);
            $('.mega-menu-edd-cart-count').html(data.cart_quantity)
        })
    })
})(jQuery);
(function($) {
    "use strict";
    $.maxmegamenu_searchbox = function(menu, options) {
        var plugin = this;
        var $menu = $(menu);
        var $wrap = $menu.parent();
        var breakpoint = $menu.attr('data-breakpoint');
        plugin.isDesktopView = function() {
            return Math.max(window.outerWidth, $(window).width()) >= breakpoint
        };
        plugin.monitorView = function() {
            if (typeof $menu.data("view") === 'undefined') {
                if (plugin.isDesktopView()) {
                    $menu.data("view", "desktop")
                } else {
                    $menu.data("view", "mobile")
                }
            }
            plugin.checkWidth();
            $(window).resize(function() {
                plugin.checkWidth()
            })
        };
        plugin.checkWidth = function() {
            var expanding_search = $("li.mega-menu-item .mega-search.expand-to-left input[type=text], li.mega-menu-item .mega-search.expand-to-right input[type=text]", $menu);
            if ($menu.data("view") === "mobile") {
                var placeholder = expanding_search.attr('data-placeholder');
                expanding_search.attr('placeholder', placeholder)
            }
            if ($menu.data("view") === "desktop") {
                expanding_search.attr('placeholder', '')
            }
        };
        plugin.init_replacements_search = function() {
            $(".mega-search", $menu).children('input[type=text]').val("");
            if ($menu.data("view") === "mobile") {
                $(".mega-search.expand-to-left .search-icon", $menu).on('click', function(e) {
                    $(this).parents(".mega-search").submit()
                })
            } else {
                $(".mega-search input[type=text]", $menu).on('focus', function(e) {
                    var form = $(this).parents('.mega-search');
                    if (!form.parent().hasClass('mega-static') && form.hasClass('mega-search-closed') && $menu.hasClass('mega-keyboard-navigation')) {
                        $(this).attr('placeholder', $(this).attr('data-placeholder'));
                        form.removeClass('mega-search-closed');
                        form.addClass('mega-search-open')
                    }
                });
                $(".mega-search input[type=text]", $menu).on('blur', function(e) {
                    var form = $(this).parents('.mega-search');
                    if (!form.parent().hasClass('mega-static') && form.hasClass('mega-search-open') && $menu.hasClass('mega-keyboard-navigation')) {
                        $(this).attr('placeholder', '');
                        form.removeClass('mega-search-open');
                        form.addClass('mega-search-closed')
                    }
                });
                $(".mega-search .search-icon", $menu).on('click', function(e) {
                    var input = $(this).parents('.mega-search').children('input[type=text]');
                    var form = $(this).parents('.mega-search');
                    if (form.parent().hasClass('mega-static')) {
                        if (input.val() != '') {
                            form.submit()
                        }
                    } else if (form.hasClass('mega-search-closed')) {
                        input.focus();
                        input.attr('placeholder', input.attr('data-placeholder'));
                        form.removeClass('mega-search-closed');
                        form.addClass('mega-search-open')
                    } else if (input.val() == '') {
                        form.addClass('mega-search-closed');
                        form.removeClass('mega-search-open');
                        input.attr('placeholder', '')
                    } else {
                        form.submit()
                    }
                })
            }
        };
        plugin.init_toggle_search = function() {
            $(".mega-menu-toggle .mega-search", $wrap).children('input[type=text]').val("");
            $(".mega-menu-toggle .mega-search .search-icon", $wrap).on('click', function(e) {
                var input = $(this).parents('.mega-search').children('input[type=text]');
                var form = $(this).parents('.mega-search');
                if (form.hasClass('static')) {
                    form.submit()
                } else if (form.hasClass('mega-search-closed')) {
                    input.focus();
                    input.attr('placeholder', input.attr('data-placeholder'));
                    form.removeClass('mega-search-closed');
                    form.addClass('mega-search-open')
                } else if (input.val() == '') {
                    form.addClass('mega-search-closed');
                    form.removeClass('mega-search-open');
                    input.attr('placeholder', '')
                } else {
                    form.submit()
                }
            })
        };
        plugin.monitorView();
        plugin.init_replacements_search();
        plugin.init_toggle_search()
    };
    $.fn.maxmegamenu_searchbox = function(options) {
        return this.each(function() {
            if (undefined === $(this).data('maxmegamenu_searchbox')) {
                var plugin = new $.maxmegamenu_searchbox(this, options);
                $(this).data('maxmegamenu_searchbox', plugin)
            }
        })
    };
    $(function() {
        $(".mega-menu").maxmegamenu_searchbox()
    })
})(jQuery);
(function($) {
    "use strict";
    $.maxmegamenu_sticky = function(menu, options) {
        var plugin = this;
        var $menu = $(menu);
        var $wrap = $menu.parent();
        var breakpoint = $menu.attr('data-breakpoint');
        var sticky_on_mobile = $menu.attr('data-sticky-mobile');
        var sticky_expand = $menu.attr('data-sticky-expand');
        var sticky_offset = parseInt($menu.attr('data-sticky-offset'));
        var sticky_hide_until_scroll_up = $menu.attr('data-sticky-hide');
        var sticky_hide_until_scroll_up_tolerance = parseInt($menu.attr('data-sticky-hide-tolerance'));
        var sticky_hide_until_scroll_up_offset = parseInt($menu.attr('data-sticky-hide-offset'));
        var sticky_menu_offset_top;
        var sticky_menu_offset_left;
        var sticky_menu_width;
        var sticky_menu_width_round_up;
        var sticky_menu_height;
        var is_stuck = !1;
        var admin_bar_height = 0;
        var last_scroll_top = 0;
        var saved_scroll_top = 0;
        var is_vertical = $menu.hasClass('mega-menu-vertical') || $menu.hasClass('mega-menu-accordion');
        var sticky_hide_until_scroll_up_enabled = function() {
            return $menu.hasClass('mega-menu-horizontal') && sticky_hide_until_scroll_up == "true"
        }
        var sticky_enabled = function() {
            return $(window).width() > breakpoint || sticky_on_mobile === 'true'
        };
        plugin.calculate_menu_position = function() {
            sticky_menu_offset_top = $wrap.offset().top;
            if ($('body').hasClass('admin-bar') && $("#wpadminbar").is(":visible") && $("#wpadminbar").css('top') == '0px') {
                admin_bar_height = $('#wpadminbar').height();
                sticky_menu_offset_top = sticky_menu_offset_top - admin_bar_height
            }
            if (sticky_offset < 0) {
                sticky_menu_offset_top = sticky_menu_offset_top + sticky_offset
            } else {
                sticky_menu_offset_top = sticky_menu_offset_top - sticky_offset
            }
            sticky_menu_offset_left = $menu.parent().offset().left;
            sticky_menu_width = window.getComputedStyle($wrap[0]).width;
            sticky_menu_width_round_up = Math.ceil(parseFloat(sticky_menu_width));
            sticky_menu_height = $wrap.height()
        };
        plugin.stick_menu = function() {
            is_stuck = !0;
            var total_offset = parseInt(admin_bar_height, 10) + parseInt(sticky_offset, 10);
            if (sticky_offset < 0) {
                total_offset = parseInt(admin_bar_height, 10)
            }
            var placeholder = $("<div />").addClass("mega-sticky-wrapper").css({
                'height': sticky_menu_height + 'px',
                'position': 'static'
            });
            $wrap.addClass('mega-sticky').wrap(placeholder).css({
                'margin-top': total_offset + 'px'
            });
            $menu.css({
                'margin-left': sticky_menu_offset_left + 'px',
                'max-width': sticky_menu_width_round_up + 'px'
            });
            if (is_vertical || sticky_expand === 'false') {
                $wrap.css({
                    'margin-left': '0',
                    'margin-right': '0',
                    'width': sticky_menu_width_round_up + 'px',
                    'left': sticky_menu_offset_left + 'px'
                });
                $menu.css({
                    'margin-left': '0'
                })
            }
            if (sticky_expand === 'true' && $(window).width() <= breakpoint) {
                $menu.css({
                    'max-width': 'none',
                    'margin-left': '0'
                })
            }
            $wrap.delay(0).queue(function(next) {
                $(this).addClass('mega-stuck');
                next()
            })
        };
        plugin.unstick_menu = function() {
            is_stuck = !1;
            $wrap.removeClass('mega-sticky').removeClass('mega-stuck').removeClass('mega-hide').removeClass('mega-reveal').unwrap().css({
                'margin': '',
                'width': '',
                'left': ''
            });
            $menu.css({
                'margin-left': '',
                'max-width': ''
            })
        };
        plugin.mega_sticky_on_scroll = function() {
            if (!sticky_enabled()) {
                return
            }
            var scroll_top = $(window).scrollTop();
            if (scroll_top > sticky_menu_offset_top) {
                if (!is_stuck) {
                    plugin.stick_menu()
                }
            } else {
                if (is_stuck) {
                    plugin.unstick_menu()
                }
            }
        };
        var mega_hide_on_scroll_up = function() {
            if (sticky_hide_until_scroll_up_enabled() && $(window).width() > breakpoint) {
                var scroll_top = $(window).scrollTop();
                if (last_scroll_top > 0) {
                    $wrap.addClass('mega-hide')
                }
                if (scroll_top < sticky_hide_until_scroll_up_offset) {
                    $wrap.addClass('mega-reveal')
                }
                saved_scroll_top = last_scroll_top;
                if (scroll_top < last_scroll_top) {
                    if (saved_scroll_top - scroll_top > sticky_hide_until_scroll_up_tolerance) {
                        $wrap.addClass('mega-reveal')
                    }
                } else {
                    if (scroll_top - saved_scroll_top > sticky_hide_until_scroll_up_tolerance) {
                        $wrap.removeClass('mega-reveal')
                    }
                }
                last_scroll_top = scroll_top
            }
        }
        plugin.mega_sticky_on_resize = function() {
            if ($('input', $wrap).is(':focus')) {
                return
            }
            if (sticky_enabled()) {
                if (is_stuck) {
                    plugin.unstick_menu();
                    plugin.calculate_menu_position();
                    plugin.stick_menu()
                } else {
                    plugin.calculate_menu_position();
                    plugin.mega_sticky_on_scroll()
                }
            } else {
                if (is_stuck) {
                    plugin.unstick_menu()
                }
            }
        };
        plugin.init = function() {
            plugin.calculate_menu_position();
            plugin.mega_sticky_on_scroll();
            var $window = $(window);
            $window.scroll(function() {
                plugin.mega_sticky_on_scroll();
                mega_hide_on_scroll_up()
            });
            var windowWidth = $window.width();
            $window.resize(function() {
                if ($window.width() != windowWidth) {
                    windowWidth = $window.width();
                    plugin.mega_sticky_on_resize()
                }
            })
        };
        plugin.init()
    };
    $.fn.maxmegamenu_sticky = function(options) {
        return this.each(function() {
            if (undefined === $(this).data('maxmegamenu_sticky')) {
                var plugin = new $.maxmegamenu_sticky(this, options);
                $(this).data('maxmegamenu_sticky', plugin)
            }
        })
    };
    $(window).on('load', function(e) {
        $(".mega-menu[data-sticky-enabled]").maxmegamenu_sticky()
    })
})(jQuery);
(function($) {
    $(function() {
        var calculate_tabbed_sub_menu_widths = function(menu_item) {
            var menu = menu_item.parents('.mega-menu');
            if ($(menu.attr('data-panel-inner-width')).length > 0) {
                if (menu.data("view") === "desktop") {
                    $('> ul.mega-sub-menu', menu_item).each(function() {
                        var tab_content = $(this);
                        var parent_submenu_content_width = parseInt(tab_content.width());
                        var parent_submenu_left_padding = parseInt(tab_content.css('paddingLeft'));
                        var tabs_width = $(this).find('a.mega-menu-link').first().outerWidth();
                        $('> li.mega-menu-item > ul.mega-sub-menu', $(this)).each(function() {
                            $(this).css('width', parent_submenu_content_width - tabs_width + 'px');
                            $(this).css('left', parent_submenu_left_padding + tabs_width + 'px')
                        })
                    })
                } else {
                    $('> ul.mega-sub-menu > li.mega-menu-item > ul.mega-sub-menu', menu_item).each(function() {
                        $(this).css('width', '');
                        $(this).css('left', '')
                    })
                }
            }
        }
        var calculate_tabbed_sub_menu_heights = function(menu_item) {
            var menu = menu_item.parents('.mega-menu');
            var max_height = 0;
            if (menu.data("view") === "desktop") {
                $('> ul.mega-sub-menu > li.mega-menu-item > ul.mega-sub-menu', menu_item).each(function() {
                    var tab_content = $(this);
                    var this_height = parseInt(tab_content.css('height'));
                    if (this_height > max_height) {
                        max_height = this_height
                    }
                });
                $('> ul.mega-sub-menu', menu_item).css('minHeight', max_height)
            } else {
                $('> ul.mega-sub-menu', menu_item).css('minHeight', '')
            }
        }
        $(window).resize(function() {
            calculate_tabbed_sub_menu_widths($('li.mega-menu-tabbed'));
            calculate_tabbed_sub_menu_heights($('li.mega-menu-tabbed'))
        });
        $('li.mega-menu-tabbed').on('open_panel', function() {
            var menu = $(this).parents('.mega-menu');
            var menu_item = $(this);
            $("> ul.mega-sub-menu", $(this)).promise().done(function() {
                calculate_tabbed_sub_menu_widths(menu_item);
                calculate_tabbed_sub_menu_heights(menu_item)
            });
            if (menu.data('view') == 'desktop') {
                if ($('> ul.mega-sub-menu > li.mega-menu-item-has-children.mega-toggle-on', menu_item).length == 0) {
                    $('> ul.mega-sub-menu > li.mega-menu-item-has-children', menu_item).first().addClass('mega-toggle-on')
                }
            }
            $('li.mega-menu-tabbed').on('close_panel', function() {
                $(".mega-toggle-on", menu).removeClass("mega-toggle-on")
            })
        })
    })
})(jQuery);
(function($) {
    "use strict";
    var HOST = 'https://www.google-analytics.com';
    var BATCH_PATH = '/batch';
    var COLLECT_PATH = '/collect';
    var CLICK_TIMEOUT = 1000;
    var CLICK_TIMER = null;
    var clickReqObj = null;

    function abortAndRedirect(url) {
        if (null !== CLICK_TIMER) {
            clearTimeout(CLICK_TIMER);
            CLICK_TIMER = null
        }
        if (null !== clickReqObj) {
            clickReqObj.abort();
            clickReqObj == null
        }
        window.location = url
    }
    var advadsTracker = function(name, blogId, UID) {
        this.name = name;
        this.blogId = blogId
        this.cid = !1;
        this.UID = UID;
        this.analyticsObject = null;
        var that = this;
        this.normalTrackingDone = !1;
        this.analyticsObject = ('string' == typeof(GoogleAnalyticsObject) && 'function' == typeof(window[GoogleAnalyticsObject])) ? window[GoogleAnalyticsObject] : !1;
        if (!1 === this.analyticsObject) {
            (function(i, s, o, g, r, a, m) {
                i.GoogleAnalyticsObject = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o), m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', '_advads_ga');
            _advads_ga('create', this.UID, 'auto', this.name);
            if (advads_gatracking_anonym) {
                _advads_ga('set', 'anonymizeIp', !0)
            }
            _advads_ga(function() {
                var tracker = _advads_ga.getByName(that.name);
                that.readyCB(tracker)
            })
        } else {
            if ('_advads_ga' !== GoogleAnalyticsObject) {
                console.log("Advanced Ads Analytics >> using other's variable named `" + GoogleAnalyticsObject + "`")
            }
            window[GoogleAnalyticsObject]('create', this.UID, 'auto', this.name);
            if (advads_gatracking_anonym) {
                window[GoogleAnalyticsObject]('set', 'anonymizeIp', !0)
            }
            window[GoogleAnalyticsObject](function() {
                var tracker = window[GoogleAnalyticsObject].getByName(that.name);
                that.readyCB(tracker)
            })
        }
        return this
    }
    advadsTracker.prototype = {
        contructor: advadsTracker,
        hasCid: function() {
            return (this.cid && '' !== this.cid)
        },
        readyCB: function(tracker) {
            var that = this;
            this.cid = tracker.get('clientId');
            $(document).on('advadsGADeferedTrack', function(args) {
                that.trackImpressions(!1)
            });
            $(document).on('advadsGADelayedTrack', function() {
                that.trackImpressions(!0)
            });
            this.trackImpressions()
        },
        trackImpressions: function(delayed) {
            if ('undefined' == typeof delayed) {
                delayed = !1
            }
            var trackedAds = [];
            if (!this.normalTrackingDone && advads_tracking_utils('hasAd', advads_tracking_utils('adsByBlog', advads_tracking_ads, this.blogId))) {
                trackedAds = trackedAds.concat(advads_tracking_ads[this.blogId])
            }
            if ('frontend' == advads_tracking_methods[this.blogId]) {
                trackedAds = []
            }
            if (delayed) {
                if ('undefined' != typeof advadsGATracking.delayedAds && advads_tracking_utils('hasAd', advads_tracking_utils('adsByBlog', advadsGATracking.delayedAds, this.blogId))) {
                    trackedAds = trackedAds.concat(advadsGATracking.delayedAds[this.blogId]);
                    advadsGATracking.delayedAds[this.blogId] = []
                }
            } else {
                if ('undefined' != typeof advadsGATracking.deferedAds && advads_tracking_utils('hasAd', advads_tracking_utils('adsByBlog', advadsGATracking.deferedAds, this.blogId))) {
                    trackedAds = trackedAds.concat(advadsGATracking.deferedAds[this.blogId]);
                    advadsGATracking.deferedAds[this.blogId] = []
                }
            }
            if (!trackedAds.length) {
                return
            }
            if (!this.hasCid()) {
                console.log(' Advads Tracking >> no clientID. aborting ...');
                return
            }
            var trackBaseData = {
                v: 1,
                tid: this.UID,
                cid: this.cid,
                t: 'event',
                ni: 1,
                ec: 'Advanced Ads',
                ea: advadsGALocale.Impressions,
                dl: document.location.origin + document.location.pathname,
                dp: document.location.pathname,
            };
            var payload = "";
            for (var i in trackedAds) {
                if (undefined !== advads_gatracking_allads[this.blogId][trackedAds[i]]) {
                    var adInfo = {
                        el: '[' + trackedAds[i] + '] ' + advads_gatracking_allads[this.blogId][trackedAds[i]].title,
                    };
                    var adParam = $.extend({}, trackBaseData, adInfo);
                    payload += $.param(adParam) + "\n"
                }
            }
            if (payload.length) {
                $.post(HOST + BATCH_PATH, payload)
            }
            if (!this.normalTrackingDone) this.normalTrackingDone = !0
        },
        trackClick: function(id, serverSide, ev, el) {
            if (!this.hasCid()) {
                console.log(' Advads Tracking >> no clientID. aborting ...');
                return
            }
            if (undefined === serverSide) serverSide = !0;
            var trackData = {
                v: 1,
                tid: this.UID,
                cid: this.cid,
                t: 'event',
                ni: 1,
                ec: 'Advanced Ads',
                ea: advadsGALocale.Clicks,
                el: '[' + id + '] ' + advads_gatracking_allads[this.blogId][id].title,
                dl: document.location.origin + document.location.pathname,
                dp: document.location.pathname,
            };
            var payload = $.param(trackData);
            var url = advadsGATracking.adTargets[this.blogId][id];
            if (serverSide) {
                url = $(el).attr('href')
            }
            var newTab = ($(el).attr('target')) ? !0 : !1;
            if (newTab) {
                $.post(HOST + COLLECT_PATH, payload);
                if (!serverSide) {
                    $(el).attr('href', url)
                }
            } else {
                ev.preventDefault();
                if (null === CLICK_TIMER && null === clickReqObj) {
                    CLICK_TIMER = setTimeout(function() {
                        abortAndRedirect(url, newTab)
                    }, CLICK_TIMEOUT);
                    clickReqObj = $.post(HOST + COLLECT_PATH, payload, function() {
                        clearTimeout(CLICK_TIMER);
                        CLICK_TIMER = null;
                        clickReqObj = null;
                        abortAndRedirect(url)
                    })
                }
            }
        },
    }
    $(function() {
        for (var bid in advads_tracking_methods) {
            if (advads_tracking_utils('blogUseGA', bid)) {
                var tracker = new advadsTracker('advadsTracker_' + bid, bid, advads_gatracking_uids[bid]);
                (function(_bid, _tracker) {
                    $(document).on('click', 'a[href^="' + advads_tracking_linkbases[_bid] + '"][data-bid="' + _bid + '"]', function(ev) {
                        var id = $(this).attr('href').split(advads_tracking_linkbases[_bid]);
                        id = parseInt(id[1]);
                        if ('undefined' != typeof advads_gatracking_allads[_bid][id] && advadsGATracking.adTargets[_bid][id]) {
                            var serverSide = !0;
                            if ('ga' == advads_tracking_methods[_bid]) {
                                serverSide = !1
                            }
                            _tracker.trackClick(id, serverSide, ev, this)
                        }
                    })
                })(bid, tracker)
            }
        }
    })
})(jQuery);
! function(a) {
    "function" == typeof define && define.amd ? define(["jquery"], a) : a(jQuery)
}(function(a) {
    function b(b, d) {
        var e, f, g, h = b.nodeName.toLowerCase();
        return "area" === h ? (e = b.parentNode, f = e.name, !(!b.href || !f || "map" !== e.nodeName.toLowerCase()) && (g = a("img[usemap='#" + f + "']")[0], !!g && c(g))) : (/^(input|select|textarea|button|object)$/.test(h) ? !b.disabled : "a" === h ? b.href || d : d) && c(b)
    }

    function c(b) {
        return a.expr.filters.visible(b) && !a(b).parents().addBack().filter(function() {
            return "hidden" === a.css(this, "visibility")
        }).length
    }
    a.ui = a.ui || {}, a.extend(a.ui, {
        version: "1.11.4",
        keyCode: {
            BACKSPACE: 8,
            COMMA: 188,
            DELETE: 46,
            DOWN: 40,
            END: 35,
            ENTER: 13,
            ESCAPE: 27,
            HOME: 36,
            LEFT: 37,
            PAGE_DOWN: 34,
            PAGE_UP: 33,
            PERIOD: 190,
            RIGHT: 39,
            SPACE: 32,
            TAB: 9,
            UP: 38
        }
    }), a.fn.extend({
        scrollParent: function(b) {
            var c = this.css("position"),
                d = "absolute" === c,
                e = b ? /(auto|scroll|hidden)/ : /(auto|scroll)/,
                f = this.parents().filter(function() {
                    var b = a(this);
                    return (!d || "static" !== b.css("position")) && e.test(b.css("overflow") + b.css("overflow-y") + b.css("overflow-x"))
                }).eq(0);
            return "fixed" !== c && f.length ? f : a(this[0].ownerDocument || document)
        },
        uniqueId: function() {
            var a = 0;
            return function() {
                return this.each(function() {
                    this.id || (this.id = "ui-id-" + ++a)
                })
            }
        }(),
        removeUniqueId: function() {
            return this.each(function() {
                /^ui-id-\d+$/.test(this.id) && a(this).removeAttr("id")
            })
        }
    }), a.extend(a.expr[":"], {
        data: a.expr.createPseudo ? a.expr.createPseudo(function(b) {
            return function(c) {
                return !!a.data(c, b)
            }
        }) : function(b, c, d) {
            return !!a.data(b, d[3])
        },
        focusable: function(c) {
            return b(c, !isNaN(a.attr(c, "tabindex")))
        },
        tabbable: function(c) {
            var d = a.attr(c, "tabindex"),
                e = isNaN(d);
            return (e || d >= 0) && b(c, !e)
        }
    }), a("<a>").outerWidth(1).jquery || a.each(["Width", "Height"], function(b, c) {
        function d(b, c, d, f) {
            return a.each(e, function() {
                c -= parseFloat(a.css(b, "padding" + this)) || 0, d && (c -= parseFloat(a.css(b, "border" + this + "Width")) || 0), f && (c -= parseFloat(a.css(b, "margin" + this)) || 0)
            }), c
        }
        var e = "Width" === c ? ["Left", "Right"] : ["Top", "Bottom"],
            f = c.toLowerCase(),
            g = {
                innerWidth: a.fn.innerWidth,
                innerHeight: a.fn.innerHeight,
                outerWidth: a.fn.outerWidth,
                outerHeight: a.fn.outerHeight
            };
        a.fn["inner" + c] = function(b) {
            return void 0 === b ? g["inner" + c].call(this) : this.each(function() {
                a(this).css(f, d(this, b) + "px")
            })
        }, a.fn["outer" + c] = function(b, e) {
            return "number" != typeof b ? g["outer" + c].call(this, b) : this.each(function() {
                a(this).css(f, d(this, b, !0, e) + "px")
            })
        }
    }), a.fn.addBack || (a.fn.addBack = function(a) {
        return this.add(null == a ? this.prevObject : this.prevObject.filter(a))
    }), a("<a>").data("a-b", "a").removeData("a-b").data("a-b") && (a.fn.removeData = function(b) {
        return function(c) {
            return arguments.length ? b.call(this, a.camelCase(c)) : b.call(this)
        }
    }(a.fn.removeData)), a.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()), a.fn.extend({
        focus: function(b) {
            return function(c, d) {
                return "number" == typeof c ? this.each(function() {
                    var b = this;
                    setTimeout(function() {
                        a(b).focus(), d && d.call(b)
                    }, c)
                }) : b.apply(this, arguments)
            }
        }(a.fn.focus),
        disableSelection: function() {
            var a = "onselectstart" in document.createElement("div") ? "selectstart" : "mousedown";
            return function() {
                return this.bind(a + ".ui-disableSelection", function(a) {
                    a.preventDefault()
                })
            }
        }(),
        enableSelection: function() {
            return this.unbind(".ui-disableSelection")
        },
        zIndex: function(b) {
            if (void 0 !== b) return this.css("zIndex", b);
            if (this.length)
                for (var c, d, e = a(this[0]); e.length && e[0] !== document;) {
                    if (c = e.css("position"), ("absolute" === c || "relative" === c || "fixed" === c) && (d = parseInt(e.css("zIndex"), 10), !isNaN(d) && 0 !== d)) return d;
                    e = e.parent()
                }
            return 0
        }
    }), a.ui.plugin = {
        add: function(b, c, d) {
            var e, f = a.ui[b].prototype;
            for (e in d) f.plugins[e] = f.plugins[e] || [], f.plugins[e].push([c, d[e]])
        },
        call: function(a, b, c, d) {
            var e, f = a.plugins[b];
            if (f && (d || a.element[0].parentNode && 11 !== a.element[0].parentNode.nodeType))
                for (e = 0; e < f.length; e++) a.options[f[e][0]] && f[e][1].apply(a.element, c)
        }
    }
});;
! function(a) {
    "function" == typeof define && define.amd ? define(["jquery"], a) : a(jQuery)
}(function(a) {
    var b = 0,
        c = Array.prototype.slice;
    return a.cleanData = function(b) {
        return function(c) {
            var d, e, f;
            for (f = 0; null != (e = c[f]); f++) try {
                d = a._data(e, "events"), d && d.remove && a(e).triggerHandler("remove")
            } catch (g) {}
            b(c)
        }
    }(a.cleanData), a.widget = function(b, c, d) {
        var e, f, g, h, i = {},
            j = b.split(".")[0];
        return b = b.split(".")[1], e = j + "-" + b, d || (d = c, c = a.Widget), a.expr[":"][e.toLowerCase()] = function(b) {
            return !!a.data(b, e)
        }, a[j] = a[j] || {}, f = a[j][b], g = a[j][b] = function(a, b) {
            return this._createWidget ? void(arguments.length && this._createWidget(a, b)) : new g(a, b)
        }, a.extend(g, f, {
            version: d.version,
            _proto: a.extend({}, d),
            _childConstructors: []
        }), h = new c, h.options = a.widget.extend({}, h.options), a.each(d, function(b, d) {
            return a.isFunction(d) ? void(i[b] = function() {
                var a = function() {
                        return c.prototype[b].apply(this, arguments)
                    },
                    e = function(a) {
                        return c.prototype[b].apply(this, a)
                    };
                return function() {
                    var b, c = this._super,
                        f = this._superApply;
                    return this._super = a, this._superApply = e, b = d.apply(this, arguments), this._super = c, this._superApply = f, b
                }
            }()) : void(i[b] = d)
        }), g.prototype = a.widget.extend(h, {
            widgetEventPrefix: f ? h.widgetEventPrefix || b : b
        }, i, {
            constructor: g,
            namespace: j,
            widgetName: b,
            widgetFullName: e
        }), f ? (a.each(f._childConstructors, function(b, c) {
            var d = c.prototype;
            a.widget(d.namespace + "." + d.widgetName, g, c._proto)
        }), delete f._childConstructors) : c._childConstructors.push(g), a.widget.bridge(b, g), g
    }, a.widget.extend = function(b) {
        for (var d, e, f = c.call(arguments, 1), g = 0, h = f.length; g < h; g++)
            for (d in f[g]) e = f[g][d], f[g].hasOwnProperty(d) && void 0 !== e && (a.isPlainObject(e) ? b[d] = a.isPlainObject(b[d]) ? a.widget.extend({}, b[d], e) : a.widget.extend({}, e) : b[d] = e);
        return b
    }, a.widget.bridge = function(b, d) {
        var e = d.prototype.widgetFullName || b;
        a.fn[b] = function(f) {
            var g = "string" == typeof f,
                h = c.call(arguments, 1),
                i = this;
            return g ? this.each(function() {
                var c, d = a.data(this, e);
                return "instance" === f ? (i = d, !1) : d ? a.isFunction(d[f]) && "_" !== f.charAt(0) ? (c = d[f].apply(d, h), c !== d && void 0 !== c ? (i = c && c.jquery ? i.pushStack(c.get()) : c, !1) : void 0) : a.error("no such method '" + f + "' for " + b + " widget instance") : a.error("cannot call methods on " + b + " prior to initialization; attempted to call method '" + f + "'")
            }) : (h.length && (f = a.widget.extend.apply(null, [f].concat(h))), this.each(function() {
                var b = a.data(this, e);
                b ? (b.option(f || {}), b._init && b._init()) : a.data(this, e, new d(f, this))
            })), i
        }
    }, a.Widget = function() {}, a.Widget._childConstructors = [], a.Widget.prototype = {
        widgetName: "widget",
        widgetEventPrefix: "",
        defaultElement: "<div>",
        options: {
            disabled: !1,
            create: null
        },
        _createWidget: function(c, d) {
            d = a(d || this.defaultElement || this)[0], this.element = a(d), this.uuid = b++, this.eventNamespace = "." + this.widgetName + this.uuid, this.bindings = a(), this.hoverable = a(), this.focusable = a(), d !== this && (a.data(d, this.widgetFullName, this), this._on(!0, this.element, {
                remove: function(a) {
                    a.target === d && this.destroy()
                }
            }), this.document = a(d.style ? d.ownerDocument : d.document || d), this.window = a(this.document[0].defaultView || this.document[0].parentWindow)), this.options = a.widget.extend({}, this.options, this._getCreateOptions(), c), this._create(), this._trigger("create", null, this._getCreateEventData()), this._init()
        },
        _getCreateOptions: a.noop,
        _getCreateEventData: a.noop,
        _create: a.noop,
        _init: a.noop,
        destroy: function() {
            this._destroy(), this.element.unbind(this.eventNamespace).removeData(this.widgetFullName).removeData(a.camelCase(this.widgetFullName)), this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled ui-state-disabled"), this.bindings.unbind(this.eventNamespace), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus")
        },
        _destroy: a.noop,
        widget: function() {
            return this.element
        },
        option: function(b, c) {
            var d, e, f, g = b;
            if (0 === arguments.length) return a.widget.extend({}, this.options);
            if ("string" == typeof b)
                if (g = {}, d = b.split("."), b = d.shift(), d.length) {
                    for (e = g[b] = a.widget.extend({}, this.options[b]), f = 0; f < d.length - 1; f++) e[d[f]] = e[d[f]] || {}, e = e[d[f]];
                    if (b = d.pop(), 1 === arguments.length) return void 0 === e[b] ? null : e[b];
                    e[b] = c
                } else {
                    if (1 === arguments.length) return void 0 === this.options[b] ? null : this.options[b];
                    g[b] = c
                }
            return this._setOptions(g), this
        },
        _setOptions: function(a) {
            var b;
            for (b in a) this._setOption(b, a[b]);
            return this
        },
        _setOption: function(a, b) {
            return this.options[a] = b, "disabled" === a && (this.widget().toggleClass(this.widgetFullName + "-disabled", !!b), b && (this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus"))), this
        },
        enable: function() {
            return this._setOptions({
                disabled: !1
            })
        },
        disable: function() {
            return this._setOptions({
                disabled: !0
            })
        },
        _on: function(b, c, d) {
            var e, f = this;
            "boolean" != typeof b && (d = c, c = b, b = !1), d ? (c = e = a(c), this.bindings = this.bindings.add(c)) : (d = c, c = this.element, e = this.widget()), a.each(d, function(d, g) {
                function h() {
                    if (b || f.options.disabled !== !0 && !a(this).hasClass("ui-state-disabled")) return ("string" == typeof g ? f[g] : g).apply(f, arguments)
                }
                "string" != typeof g && (h.guid = g.guid = g.guid || h.guid || a.guid++);
                var i = d.match(/^([\w:-]*)\s*(.*)$/),
                    j = i[1] + f.eventNamespace,
                    k = i[2];
                k ? e.delegate(k, j, h) : c.bind(j, h)
            })
        },
        _off: function(b, c) {
            c = (c || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, b.unbind(c).undelegate(c), this.bindings = a(this.bindings.not(b).get()), this.focusable = a(this.focusable.not(b).get()), this.hoverable = a(this.hoverable.not(b).get())
        },
        _delay: function(a, b) {
            function c() {
                return ("string" == typeof a ? d[a] : a).apply(d, arguments)
            }
            var d = this;
            return setTimeout(c, b || 0)
        },
        _hoverable: function(b) {
            this.hoverable = this.hoverable.add(b), this._on(b, {
                mouseenter: function(b) {
                    a(b.currentTarget).addClass("ui-state-hover")
                },
                mouseleave: function(b) {
                    a(b.currentTarget).removeClass("ui-state-hover")
                }
            })
        },
        _focusable: function(b) {
            this.focusable = this.focusable.add(b), this._on(b, {
                focusin: function(b) {
                    a(b.currentTarget).addClass("ui-state-focus")
                },
                focusout: function(b) {
                    a(b.currentTarget).removeClass("ui-state-focus")
                }
            })
        },
        _trigger: function(b, c, d) {
            var e, f, g = this.options[b];
            if (d = d || {}, c = a.Event(c), c.type = (b === this.widgetEventPrefix ? b : this.widgetEventPrefix + b).toLowerCase(), c.target = this.element[0], f = c.originalEvent)
                for (e in f) e in c || (c[e] = f[e]);
            return this.element.trigger(c, d), !(a.isFunction(g) && g.apply(this.element[0], [c].concat(d)) === !1 || c.isDefaultPrevented())
        }
    }, a.each({
        show: "fadeIn",
        hide: "fadeOut"
    }, function(b, c) {
        a.Widget.prototype["_" + b] = function(d, e, f) {
            "string" == typeof e && (e = {
                effect: e
            });
            var g, h = e ? e === !0 || "number" == typeof e ? c : e.effect || c : b;
            e = e || {}, "number" == typeof e && (e = {
                duration: e
            }), g = !a.isEmptyObject(e), e.complete = f, e.delay && d.delay(e.delay), g && a.effects && a.effects.effect[h] ? d[b](e) : h !== b && d[h] ? d[h](e.duration, e.easing, f) : d.queue(function(c) {
                a(this)[b](), f && f.call(d[0]), c()
            })
        }
    }), a.widget
});
! function(a) {
    "function" == typeof define && define.amd ? define(["jquery", "./widget"], a) : a(jQuery)
}(function(a) {
    var b = !1;
    return a(document).mouseup(function() {
        b = !1
    }), a.widget("ui.mouse", {
        version: "1.11.4",
        options: {
            cancel: "input,textarea,button,select,option",
            distance: 1,
            delay: 0
        },
        _mouseInit: function() {
            var b = this;
            this.element.bind("mousedown." + this.widgetName, function(a) {
                return b._mouseDown(a)
            }).bind("click." + this.widgetName, function(c) {
                if (!0 === a.data(c.target, b.widgetName + ".preventClickEvent")) return a.removeData(c.target, b.widgetName + ".preventClickEvent"), c.stopImmediatePropagation(), !1
            }), this.started = !1
        },
        _mouseDestroy: function() {
            this.element.unbind("." + this.widgetName), this._mouseMoveDelegate && this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate)
        },
        _mouseDown: function(c) {
            if (!b) {
                this._mouseMoved = !1, this._mouseStarted && this._mouseUp(c), this._mouseDownEvent = c;
                var d = this,
                    e = 1 === c.which,
                    f = !("string" != typeof this.options.cancel || !c.target.nodeName) && a(c.target).closest(this.options.cancel).length;
                return !(e && !f && this._mouseCapture(c)) || (this.mouseDelayMet = !this.options.delay, this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function() {
                    d.mouseDelayMet = !0
                }, this.options.delay)), this._mouseDistanceMet(c) && this._mouseDelayMet(c) && (this._mouseStarted = this._mouseStart(c) !== !1, !this._mouseStarted) ? (c.preventDefault(), !0) : (!0 === a.data(c.target, this.widgetName + ".preventClickEvent") && a.removeData(c.target, this.widgetName + ".preventClickEvent"), this._mouseMoveDelegate = function(a) {
                    return d._mouseMove(a)
                }, this._mouseUpDelegate = function(a) {
                    return d._mouseUp(a)
                }, this.document.bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate), c.preventDefault(), b = !0, !0))
            }
        },
        _mouseMove: function(b) {
            if (this._mouseMoved) {
                if (a.ui.ie && (!document.documentMode || document.documentMode < 9) && !b.button) return this._mouseUp(b);
                if (!b.which) return this._mouseUp(b)
            }
            return (b.which || b.button) && (this._mouseMoved = !0), this._mouseStarted ? (this._mouseDrag(b), b.preventDefault()) : (this._mouseDistanceMet(b) && this._mouseDelayMet(b) && (this._mouseStarted = this._mouseStart(this._mouseDownEvent, b) !== !1, this._mouseStarted ? this._mouseDrag(b) : this._mouseUp(b)), !this._mouseStarted)
        },
        _mouseUp: function(c) {
            return this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate), this._mouseStarted && (this._mouseStarted = !1, c.target === this._mouseDownEvent.target && a.data(c.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(c)), b = !1, !1
        },
        _mouseDistanceMet: function(a) {
            return Math.max(Math.abs(this._mouseDownEvent.pageX - a.pageX), Math.abs(this._mouseDownEvent.pageY - a.pageY)) >= this.options.distance
        },
        _mouseDelayMet: function() {
            return this.mouseDelayMet
        },
        _mouseStart: function() {},
        _mouseDrag: function() {},
        _mouseStop: function() {},
        _mouseCapture: function() {
            return !0
        }
    })
});
! function(a) {
    "function" == typeof define && define.amd ? define(["jquery", "./core", "./mouse", "./widget"], a) : a(jQuery)
}(function(a) {
    return a.widget("ui.sortable", a.ui.mouse, {
        version: "1.11.4",
        widgetEventPrefix: "sort",
        ready: !1,
        options: {
            appendTo: "parent",
            axis: !1,
            connectWith: !1,
            containment: !1,
            cursor: "auto",
            cursorAt: !1,
            dropOnEmpty: !0,
            forcePlaceholderSize: !1,
            forceHelperSize: !1,
            grid: !1,
            handle: !1,
            helper: "original",
            items: "> *",
            opacity: !1,
            placeholder: !1,
            revert: !1,
            scroll: !0,
            scrollSensitivity: 20,
            scrollSpeed: 20,
            scope: "default",
            tolerance: "intersect",
            zIndex: 1e3,
            activate: null,
            beforeStop: null,
            change: null,
            deactivate: null,
            out: null,
            over: null,
            receive: null,
            remove: null,
            sort: null,
            start: null,
            stop: null,
            update: null
        },
        _isOverAxis: function(a, b, c) {
            return a >= b && a < b + c
        },
        _isFloating: function(a) {
            return /left|right/.test(a.css("float")) || /inline|table-cell/.test(a.css("display"))
        },
        _create: function() {
            this.containerCache = {}, this.element.addClass("ui-sortable"), this.refresh(), this.offset = this.element.offset(), this._mouseInit(), this._setHandleClassName(), this.ready = !0
        },
        _setOption: function(a, b) {
            this._super(a, b), "handle" === a && this._setHandleClassName()
        },
        _setHandleClassName: function() {
            this.element.find(".ui-sortable-handle").removeClass("ui-sortable-handle"), a.each(this.items, function() {
                (this.instance.options.handle ? this.item.find(this.instance.options.handle) : this.item).addClass("ui-sortable-handle")
            })
        },
        _destroy: function() {
            this.element.removeClass("ui-sortable ui-sortable-disabled").find(".ui-sortable-handle").removeClass("ui-sortable-handle"), this._mouseDestroy();
            for (var a = this.items.length - 1; a >= 0; a--) this.items[a].item.removeData(this.widgetName + "-item");
            return this
        },
        _mouseCapture: function(b, c) {
            var d = null,
                e = !1,
                f = this;
            return !this.reverting && (!this.options.disabled && "static" !== this.options.type && (this._refreshItems(b), a(b.target).parents().each(function() {
                if (a.data(this, f.widgetName + "-item") === f) return d = a(this), !1
            }), a.data(b.target, f.widgetName + "-item") === f && (d = a(b.target)), !!d && (!(this.options.handle && !c && (a(this.options.handle, d).find("*").addBack().each(function() {
                this === b.target && (e = !0)
            }), !e)) && (this.currentItem = d, this._removeCurrentsFromItems(), !0))))
        },
        _mouseStart: function(b, c, d) {
            var e, f, g = this.options;
            if (this.currentContainer = this, this.refreshPositions(), this.helper = this._createHelper(b), this._cacheHelperProportions(), this._cacheMargins(), this.scrollParent = this.helper.scrollParent(), this.offset = this.currentItem.offset(), this.offset = {
                    top: this.offset.top - this.margins.top,
                    left: this.offset.left - this.margins.left
                }, a.extend(this.offset, {
                    click: {
                        left: b.pageX - this.offset.left,
                        top: b.pageY - this.offset.top
                    },
                    parent: this._getParentOffset(),
                    relative: this._getRelativeOffset()
                }), this.helper.css("position", "absolute"), this.cssPosition = this.helper.css("position"), this.originalPosition = this._generatePosition(b), this.originalPageX = b.pageX, this.originalPageY = b.pageY, g.cursorAt && this._adjustOffsetFromHelper(g.cursorAt), this.domPosition = {
                    prev: this.currentItem.prev()[0],
                    parent: this.currentItem.parent()[0]
                }, this.helper[0] !== this.currentItem[0] && this.currentItem.hide(), this._createPlaceholder(), g.containment && this._setContainment(), g.cursor && "auto" !== g.cursor && (f = this.document.find("body"), this.storedCursor = f.css("cursor"), f.css("cursor", g.cursor), this.storedStylesheet = a("<style>*{ cursor: " + g.cursor + " !important; }</style>").appendTo(f)), g.opacity && (this.helper.css("opacity") && (this._storedOpacity = this.helper.css("opacity")), this.helper.css("opacity", g.opacity)), g.zIndex && (this.helper.css("zIndex") && (this._storedZIndex = this.helper.css("zIndex")), this.helper.css("zIndex", g.zIndex)), this.scrollParent[0] !== this.document[0] && "HTML" !== this.scrollParent[0].tagName && (this.overflowOffset = this.scrollParent.offset()), this._trigger("start", b, this._uiHash()), this._preserveHelperProportions || this._cacheHelperProportions(), !d)
                for (e = this.containers.length - 1; e >= 0; e--) this.containers[e]._trigger("activate", b, this._uiHash(this));
            return a.ui.ddmanager && (a.ui.ddmanager.current = this), a.ui.ddmanager && !g.dropBehaviour && a.ui.ddmanager.prepareOffsets(this, b), this.dragging = !0, this.helper.addClass("ui-sortable-helper"), this._mouseDrag(b), !0
        },
        _mouseDrag: function(b) {
            var c, d, e, f, g = this.options,
                h = !1;
            for (this.position = this._generatePosition(b), this.positionAbs = this._convertPositionTo("absolute"), this.lastPositionAbs || (this.lastPositionAbs = this.positionAbs), this.options.scroll && (this.scrollParent[0] !== this.document[0] && "HTML" !== this.scrollParent[0].tagName ? (this.overflowOffset.top + this.scrollParent[0].offsetHeight - b.pageY < g.scrollSensitivity ? this.scrollParent[0].scrollTop = h = this.scrollParent[0].scrollTop + g.scrollSpeed : b.pageY - this.overflowOffset.top < g.scrollSensitivity && (this.scrollParent[0].scrollTop = h = this.scrollParent[0].scrollTop - g.scrollSpeed), this.overflowOffset.left + this.scrollParent[0].offsetWidth - b.pageX < g.scrollSensitivity ? this.scrollParent[0].scrollLeft = h = this.scrollParent[0].scrollLeft + g.scrollSpeed : b.pageX - this.overflowOffset.left < g.scrollSensitivity && (this.scrollParent[0].scrollLeft = h = this.scrollParent[0].scrollLeft - g.scrollSpeed)) : (b.pageY - this.document.scrollTop() < g.scrollSensitivity ? h = this.document.scrollTop(this.document.scrollTop() - g.scrollSpeed) : this.window.height() - (b.pageY - this.document.scrollTop()) < g.scrollSensitivity && (h = this.document.scrollTop(this.document.scrollTop() + g.scrollSpeed)), b.pageX - this.document.scrollLeft() < g.scrollSensitivity ? h = this.document.scrollLeft(this.document.scrollLeft() - g.scrollSpeed) : this.window.width() - (b.pageX - this.document.scrollLeft()) < g.scrollSensitivity && (h = this.document.scrollLeft(this.document.scrollLeft() + g.scrollSpeed))), h !== !1 && a.ui.ddmanager && !g.dropBehaviour && a.ui.ddmanager.prepareOffsets(this, b)), this.positionAbs = this._convertPositionTo("absolute"), this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"), this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"), c = this.items.length - 1; c >= 0; c--)
                if (d = this.items[c], e = d.item[0], f = this._intersectsWithPointer(d), f && d.instance === this.currentContainer && !(e === this.currentItem[0] || this.placeholder[1 === f ? "next" : "prev"]()[0] === e || a.contains(this.placeholder[0], e) || "semi-dynamic" === this.options.type && a.contains(this.element[0], e))) {
                    if (this.direction = 1 === f ? "down" : "up", "pointer" !== this.options.tolerance && !this._intersectsWithSides(d)) break;
                    this._rearrange(b, d), this._trigger("change", b, this._uiHash());
                    break
                }
            return this._contactContainers(b), a.ui.ddmanager && a.ui.ddmanager.drag(this, b), this._trigger("sort", b, this._uiHash()), this.lastPositionAbs = this.positionAbs, !1
        },
        _mouseStop: function(b, c) {
            if (b) {
                if (a.ui.ddmanager && !this.options.dropBehaviour && a.ui.ddmanager.drop(this, b), this.options.revert) {
                    var d = this,
                        e = this.placeholder.offset(),
                        f = this.options.axis,
                        g = {};
                    f && "x" !== f || (g.left = e.left - this.offset.parent.left - this.margins.left + (this.offsetParent[0] === this.document[0].body ? 0 : this.offsetParent[0].scrollLeft)), f && "y" !== f || (g.top = e.top - this.offset.parent.top - this.margins.top + (this.offsetParent[0] === this.document[0].body ? 0 : this.offsetParent[0].scrollTop)), this.reverting = !0, a(this.helper).animate(g, parseInt(this.options.revert, 10) || 500, function() {
                        d._clear(b)
                    })
                } else this._clear(b, c);
                return !1
            }
        },
        cancel: function() {
            if (this.dragging) {
                this._mouseUp({
                    target: null
                }), "original" === this.options.helper ? this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper") : this.currentItem.show();
                for (var b = this.containers.length - 1; b >= 0; b--) this.containers[b]._trigger("deactivate", null, this._uiHash(this)), this.containers[b].containerCache.over && (this.containers[b]._trigger("out", null, this._uiHash(this)), this.containers[b].containerCache.over = 0)
            }
            return this.placeholder && (this.placeholder[0].parentNode && this.placeholder[0].parentNode.removeChild(this.placeholder[0]), "original" !== this.options.helper && this.helper && this.helper[0].parentNode && this.helper.remove(), a.extend(this, {
                helper: null,
                dragging: !1,
                reverting: !1,
                _noFinalSort: null
            }), this.domPosition.prev ? a(this.domPosition.prev).after(this.currentItem) : a(this.domPosition.parent).prepend(this.currentItem)), this
        },
        serialize: function(b) {
            var c = this._getItemsAsjQuery(b && b.connected),
                d = [];
            return b = b || {}, a(c).each(function() {
                var c = (a(b.item || this).attr(b.attribute || "id") || "").match(b.expression || /(.+)[\-=_](.+)/);
                c && d.push((b.key || c[1] + "[]") + "=" + (b.key && b.expression ? c[1] : c[2]))
            }), !d.length && b.key && d.push(b.key + "="), d.join("&")
        },
        toArray: function(b) {
            var c = this._getItemsAsjQuery(b && b.connected),
                d = [];
            return b = b || {}, c.each(function() {
                d.push(a(b.item || this).attr(b.attribute || "id") || "")
            }), d
        },
        _intersectsWith: function(a) {
            var b = this.positionAbs.left,
                c = b + this.helperProportions.width,
                d = this.positionAbs.top,
                e = d + this.helperProportions.height,
                f = a.left,
                g = f + a.width,
                h = a.top,
                i = h + a.height,
                j = this.offset.click.top,
                k = this.offset.click.left,
                l = "x" === this.options.axis || d + j > h && d + j < i,
                m = "y" === this.options.axis || b + k > f && b + k < g,
                n = l && m;
            return "pointer" === this.options.tolerance || this.options.forcePointerForContainers || "pointer" !== this.options.tolerance && this.helperProportions[this.floating ? "width" : "height"] > a[this.floating ? "width" : "height"] ? n : f < b + this.helperProportions.width / 2 && c - this.helperProportions.width / 2 < g && h < d + this.helperProportions.height / 2 && e - this.helperProportions.height / 2 < i
        },
        _intersectsWithPointer: function(a) {
            var b = "x" === this.options.axis || this._isOverAxis(this.positionAbs.top + this.offset.click.top, a.top, a.height),
                c = "y" === this.options.axis || this._isOverAxis(this.positionAbs.left + this.offset.click.left, a.left, a.width),
                d = b && c,
                e = this._getDragVerticalDirection(),
                f = this._getDragHorizontalDirection();
            return !!d && (this.floating ? f && "right" === f || "down" === e ? 2 : 1 : e && ("down" === e ? 2 : 1))
        },
        _intersectsWithSides: function(a) {
            var b = this._isOverAxis(this.positionAbs.top + this.offset.click.top, a.top + a.height / 2, a.height),
                c = this._isOverAxis(this.positionAbs.left + this.offset.click.left, a.left + a.width / 2, a.width),
                d = this._getDragVerticalDirection(),
                e = this._getDragHorizontalDirection();
            return this.floating && e ? "right" === e && c || "left" === e && !c : d && ("down" === d && b || "up" === d && !b)
        },
        _getDragVerticalDirection: function() {
            var a = this.positionAbs.top - this.lastPositionAbs.top;
            return 0 !== a && (a > 0 ? "down" : "up")
        },
        _getDragHorizontalDirection: function() {
            var a = this.positionAbs.left - this.lastPositionAbs.left;
            return 0 !== a && (a > 0 ? "right" : "left")
        },
        refresh: function(a) {
            return this._refreshItems(a), this._setHandleClassName(), this.refreshPositions(), this
        },
        _connectWith: function() {
            var a = this.options;
            return a.connectWith.constructor === String ? [a.connectWith] : a.connectWith
        },
        _getItemsAsjQuery: function(b) {
            function c() {
                h.push(this)
            }
            var d, e, f, g, h = [],
                i = [],
                j = this._connectWith();
            if (j && b)
                for (d = j.length - 1; d >= 0; d--)
                    for (f = a(j[d], this.document[0]), e = f.length - 1; e >= 0; e--) g = a.data(f[e], this.widgetFullName), g && g !== this && !g.options.disabled && i.push([a.isFunction(g.options.items) ? g.options.items.call(g.element) : a(g.options.items, g.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), g]);
            for (i.push([a.isFunction(this.options.items) ? this.options.items.call(this.element, null, {
                    options: this.options,
                    item: this.currentItem
                }) : a(this.options.items, this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), this]), d = i.length - 1; d >= 0; d--) i[d][0].each(c);
            return a(h)
        },
        _removeCurrentsFromItems: function() {
            var b = this.currentItem.find(":data(" + this.widgetName + "-item)");
            this.items = a.grep(this.items, function(a) {
                for (var c = 0; c < b.length; c++)
                    if (b[c] === a.item[0]) return !1;
                return !0
            })
        },
        _refreshItems: function(b) {
            this.items = [], this.containers = [this];
            var c, d, e, f, g, h, i, j, k = this.items,
                l = [
                    [a.isFunction(this.options.items) ? this.options.items.call(this.element[0], b, {
                        item: this.currentItem
                    }) : a(this.options.items, this.element), this]
                ],
                m = this._connectWith();
            if (m && this.ready)
                for (c = m.length - 1; c >= 0; c--)
                    for (e = a(m[c], this.document[0]), d = e.length - 1; d >= 0; d--) f = a.data(e[d], this.widgetFullName), f && f !== this && !f.options.disabled && (l.push([a.isFunction(f.options.items) ? f.options.items.call(f.element[0], b, {
                        item: this.currentItem
                    }) : a(f.options.items, f.element), f]), this.containers.push(f));
            for (c = l.length - 1; c >= 0; c--)
                for (g = l[c][1], h = l[c][0], d = 0, j = h.length; d < j; d++) i = a(h[d]), i.data(this.widgetName + "-item", g), k.push({
                    item: i,
                    instance: g,
                    width: 0,
                    height: 0,
                    left: 0,
                    top: 0
                })
        },
        refreshPositions: function(b) {
            this.floating = !!this.items.length && ("x" === this.options.axis || this._isFloating(this.items[0].item)), this.offsetParent && this.helper && (this.offset.parent = this._getParentOffset());
            var c, d, e, f;
            for (c = this.items.length - 1; c >= 0; c--) d = this.items[c], d.instance !== this.currentContainer && this.currentContainer && d.item[0] !== this.currentItem[0] || (e = this.options.toleranceElement ? a(this.options.toleranceElement, d.item) : d.item, b || (d.width = e.outerWidth(), d.height = e.outerHeight()), f = e.offset(), d.left = f.left, d.top = f.top);
            if (this.options.custom && this.options.custom.refreshContainers) this.options.custom.refreshContainers.call(this);
            else
                for (c = this.containers.length - 1; c >= 0; c--) f = this.containers[c].element.offset(), this.containers[c].containerCache.left = f.left, this.containers[c].containerCache.top = f.top, this.containers[c].containerCache.width = this.containers[c].element.outerWidth(), this.containers[c].containerCache.height = this.containers[c].element.outerHeight();
            return this
        },
        _createPlaceholder: function(b) {
            b = b || this;
            var c, d = b.options;
            d.placeholder && d.placeholder.constructor !== String || (c = d.placeholder, d.placeholder = {
                element: function() {
                    var d = b.currentItem[0].nodeName.toLowerCase(),
                        e = a("<" + d + ">", b.document[0]).addClass(c || b.currentItem[0].className + " ui-sortable-placeholder").removeClass("ui-sortable-helper");
                    return "tbody" === d ? b._createTrPlaceholder(b.currentItem.find("tr").eq(0), a("<tr>", b.document[0]).appendTo(e)) : "tr" === d ? b._createTrPlaceholder(b.currentItem, e) : "img" === d && e.attr("src", b.currentItem.attr("src")), c || e.css("visibility", "hidden"), e
                },
                update: function(a, e) {
                    c && !d.forcePlaceholderSize || (e.height() || e.height(b.currentItem.innerHeight() - parseInt(b.currentItem.css("paddingTop") || 0, 10) - parseInt(b.currentItem.css("paddingBottom") || 0, 10)), e.width() || e.width(b.currentItem.innerWidth() - parseInt(b.currentItem.css("paddingLeft") || 0, 10) - parseInt(b.currentItem.css("paddingRight") || 0, 10)))
                }
            }), b.placeholder = a(d.placeholder.element.call(b.element, b.currentItem)), b.currentItem.after(b.placeholder), d.placeholder.update(b, b.placeholder)
        },
        _createTrPlaceholder: function(b, c) {
            var d = this;
            b.children().each(function() {
                a("<td>&#160;</td>", d.document[0]).attr("colspan", a(this).attr("colspan") || 1).appendTo(c)
            })
        },
        _contactContainers: function(b) {
            var c, d, e, f, g, h, i, j, k, l, m = null,
                n = null;
            for (c = this.containers.length - 1; c >= 0; c--)
                if (!a.contains(this.currentItem[0], this.containers[c].element[0]))
                    if (this._intersectsWith(this.containers[c].containerCache)) {
                        if (m && a.contains(this.containers[c].element[0], m.element[0])) continue;
                        m = this.containers[c], n = c
                    } else this.containers[c].containerCache.over && (this.containers[c]._trigger("out", b, this._uiHash(this)), this.containers[c].containerCache.over = 0);
            if (m)
                if (1 === this.containers.length) this.containers[n].containerCache.over || (this.containers[n]._trigger("over", b, this._uiHash(this)), this.containers[n].containerCache.over = 1);
                else {
                    for (e = 1e4, f = null, k = m.floating || this._isFloating(this.currentItem), g = k ? "left" : "top", h = k ? "width" : "height", l = k ? "clientX" : "clientY", d = this.items.length - 1; d >= 0; d--) a.contains(this.containers[n].element[0], this.items[d].item[0]) && this.items[d].item[0] !== this.currentItem[0] && (i = this.items[d].item.offset()[g], j = !1, b[l] - i > this.items[d][h] / 2 && (j = !0), Math.abs(b[l] - i) < e && (e = Math.abs(b[l] - i), f = this.items[d], this.direction = j ? "up" : "down"));
                    if (!f && !this.options.dropOnEmpty) return;
                    if (this.currentContainer === this.containers[n]) return void(this.currentContainer.containerCache.over || (this.containers[n]._trigger("over", b, this._uiHash()), this.currentContainer.containerCache.over = 1));
                    f ? this._rearrange(b, f, null, !0) : this._rearrange(b, null, this.containers[n].element, !0), this._trigger("change", b, this._uiHash()), this.containers[n]._trigger("change", b, this._uiHash(this)), this.currentContainer = this.containers[n], this.options.placeholder.update(this.currentContainer, this.placeholder), this.containers[n]._trigger("over", b, this._uiHash(this)), this.containers[n].containerCache.over = 1
                }
        },
        _createHelper: function(b) {
            var c = this.options,
                d = a.isFunction(c.helper) ? a(c.helper.apply(this.element[0], [b, this.currentItem])) : "clone" === c.helper ? this.currentItem.clone() : this.currentItem;
            return d.parents("body").length || a("parent" !== c.appendTo ? c.appendTo : this.currentItem[0].parentNode)[0].appendChild(d[0]), d[0] === this.currentItem[0] && (this._storedCSS = {
                width: this.currentItem[0].style.width,
                height: this.currentItem[0].style.height,
                position: this.currentItem.css("position"),
                top: this.currentItem.css("top"),
                left: this.currentItem.css("left")
            }), d[0].style.width && !c.forceHelperSize || d.width(this.currentItem.width()), d[0].style.height && !c.forceHelperSize || d.height(this.currentItem.height()), d
        },
        _adjustOffsetFromHelper: function(b) {
            "string" == typeof b && (b = b.split(" ")), a.isArray(b) && (b = {
                left: +b[0],
                top: +b[1] || 0
            }), "left" in b && (this.offset.click.left = b.left + this.margins.left), "right" in b && (this.offset.click.left = this.helperProportions.width - b.right + this.margins.left), "top" in b && (this.offset.click.top = b.top + this.margins.top), "bottom" in b && (this.offset.click.top = this.helperProportions.height - b.bottom + this.margins.top)
        },
        _getParentOffset: function() {
            this.offsetParent = this.helper.offsetParent();
            var b = this.offsetParent.offset();
            return "absolute" === this.cssPosition && this.scrollParent[0] !== this.document[0] && a.contains(this.scrollParent[0], this.offsetParent[0]) && (b.left += this.scrollParent.scrollLeft(), b.top += this.scrollParent.scrollTop()), (this.offsetParent[0] === this.document[0].body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && a.ui.ie) && (b = {
                top: 0,
                left: 0
            }), {
                top: b.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                left: b.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
            }
        },
        _getRelativeOffset: function() {
            if ("relative" === this.cssPosition) {
                var a = this.currentItem.position();
                return {
                    top: a.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(),
                    left: a.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft()
                }
            }
            return {
                top: 0,
                left: 0
            }
        },
        _cacheMargins: function() {
            this.margins = {
                left: parseInt(this.currentItem.css("marginLeft"), 10) || 0,
                top: parseInt(this.currentItem.css("marginTop"), 10) || 0
            }
        },
        _cacheHelperProportions: function() {
            this.helperProportions = {
                width: this.helper.outerWidth(),
                height: this.helper.outerHeight()
            }
        },
        _setContainment: function() {
            var b, c, d, e = this.options;
            "parent" === e.containment && (e.containment = this.helper[0].parentNode), "document" !== e.containment && "window" !== e.containment || (this.containment = [0 - this.offset.relative.left - this.offset.parent.left, 0 - this.offset.relative.top - this.offset.parent.top, "document" === e.containment ? this.document.width() : this.window.width() - this.helperProportions.width - this.margins.left, ("document" === e.containment ? this.document.width() : this.window.height() || this.document[0].body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]), /^(document|window|parent)$/.test(e.containment) || (b = a(e.containment)[0], c = a(e.containment).offset(), d = "hidden" !== a(b).css("overflow"), this.containment = [c.left + (parseInt(a(b).css("borderLeftWidth"), 10) || 0) + (parseInt(a(b).css("paddingLeft"), 10) || 0) - this.margins.left, c.top + (parseInt(a(b).css("borderTopWidth"), 10) || 0) + (parseInt(a(b).css("paddingTop"), 10) || 0) - this.margins.top, c.left + (d ? Math.max(b.scrollWidth, b.offsetWidth) : b.offsetWidth) - (parseInt(a(b).css("borderLeftWidth"), 10) || 0) - (parseInt(a(b).css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left, c.top + (d ? Math.max(b.scrollHeight, b.offsetHeight) : b.offsetHeight) - (parseInt(a(b).css("borderTopWidth"), 10) || 0) - (parseInt(a(b).css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top])
        },
        _convertPositionTo: function(b, c) {
            c || (c = this.position);
            var d = "absolute" === b ? 1 : -1,
                e = "absolute" !== this.cssPosition || this.scrollParent[0] !== this.document[0] && a.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                f = /(html|body)/i.test(e[0].tagName);
            return {
                top: c.top + this.offset.relative.top * d + this.offset.parent.top * d - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : f ? 0 : e.scrollTop()) * d,
                left: c.left + this.offset.relative.left * d + this.offset.parent.left * d - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : f ? 0 : e.scrollLeft()) * d
            }
        },
        _generatePosition: function(b) {
            var c, d, e = this.options,
                f = b.pageX,
                g = b.pageY,
                h = "absolute" !== this.cssPosition || this.scrollParent[0] !== this.document[0] && a.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                i = /(html|body)/i.test(h[0].tagName);
            return "relative" !== this.cssPosition || this.scrollParent[0] !== this.document[0] && this.scrollParent[0] !== this.offsetParent[0] || (this.offset.relative = this._getRelativeOffset()), this.originalPosition && (this.containment && (b.pageX - this.offset.click.left < this.containment[0] && (f = this.containment[0] + this.offset.click.left), b.pageY - this.offset.click.top < this.containment[1] && (g = this.containment[1] + this.offset.click.top), b.pageX - this.offset.click.left > this.containment[2] && (f = this.containment[2] + this.offset.click.left), b.pageY - this.offset.click.top > this.containment[3] && (g = this.containment[3] + this.offset.click.top)), e.grid && (c = this.originalPageY + Math.round((g - this.originalPageY) / e.grid[1]) * e.grid[1], g = this.containment ? c - this.offset.click.top >= this.containment[1] && c - this.offset.click.top <= this.containment[3] ? c : c - this.offset.click.top >= this.containment[1] ? c - e.grid[1] : c + e.grid[1] : c, d = this.originalPageX + Math.round((f - this.originalPageX) / e.grid[0]) * e.grid[0], f = this.containment ? d - this.offset.click.left >= this.containment[0] && d - this.offset.click.left <= this.containment[2] ? d : d - this.offset.click.left >= this.containment[0] ? d - e.grid[0] : d + e.grid[0] : d)), {
                top: g - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : i ? 0 : h.scrollTop()),
                left: f - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : i ? 0 : h.scrollLeft())
            }
        },
        _rearrange: function(a, b, c, d) {
            c ? c[0].appendChild(this.placeholder[0]) : b.item[0].parentNode.insertBefore(this.placeholder[0], "down" === this.direction ? b.item[0] : b.item[0].nextSibling), this.counter = this.counter ? ++this.counter : 1;
            var e = this.counter;
            this._delay(function() {
                e === this.counter && this.refreshPositions(!d)
            })
        },
        _clear: function(a, b) {
            function c(a, b, c) {
                return function(d) {
                    c._trigger(a, d, b._uiHash(b))
                }
            }
            this.reverting = !1;
            var d, e = [];
            if (!this._noFinalSort && this.currentItem.parent().length && this.placeholder.before(this.currentItem), this._noFinalSort = null, this.helper[0] === this.currentItem[0]) {
                for (d in this._storedCSS) "auto" !== this._storedCSS[d] && "static" !== this._storedCSS[d] || (this._storedCSS[d] = "");
                this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper")
            } else this.currentItem.show();
            for (this.fromOutside && !b && e.push(function(a) {
                    this._trigger("receive", a, this._uiHash(this.fromOutside))
                }), !this.fromOutside && this.domPosition.prev === this.currentItem.prev().not(".ui-sortable-helper")[0] && this.domPosition.parent === this.currentItem.parent()[0] || b || e.push(function(a) {
                    this._trigger("update", a, this._uiHash())
                }), this !== this.currentContainer && (b || (e.push(function(a) {
                    this._trigger("remove", a, this._uiHash())
                }), e.push(function(a) {
                    return function(b) {
                        a._trigger("receive", b, this._uiHash(this))
                    }
                }.call(this, this.currentContainer)), e.push(function(a) {
                    return function(b) {
                        a._trigger("update", b, this._uiHash(this))
                    }
                }.call(this, this.currentContainer)))), d = this.containers.length - 1; d >= 0; d--) b || e.push(c("deactivate", this, this.containers[d])), this.containers[d].containerCache.over && (e.push(c("out", this, this.containers[d])), this.containers[d].containerCache.over = 0);
            if (this.storedCursor && (this.document.find("body").css("cursor", this.storedCursor), this.storedStylesheet.remove()), this._storedOpacity && this.helper.css("opacity", this._storedOpacity), this._storedZIndex && this.helper.css("zIndex", "auto" === this._storedZIndex ? "" : this._storedZIndex), this.dragging = !1, b || this._trigger("beforeStop", a, this._uiHash()), this.placeholder[0].parentNode.removeChild(this.placeholder[0]), this.cancelHelperRemoval || (this.helper[0] !== this.currentItem[0] && this.helper.remove(), this.helper = null), !b) {
                for (d = 0; d < e.length; d++) e[d].call(this, a);
                this._trigger("stop", a, this._uiHash())
            }
            return this.fromOutside = !1, !this.cancelHelperRemoval
        },
        _trigger: function() {
            a.Widget.prototype._trigger.apply(this, arguments) === !1 && this.cancel()
        },
        _uiHash: function(b) {
            var c = b || this;
            return {
                helper: c.helper,
                placeholder: c.placeholder || a([]),
                position: c.position,
                originalPosition: c.originalPosition,
                offset: c.positionAbs,
                item: c.currentItem,
                sender: b ? b.element : null
            }
        }
    })
});
! function(i, e) {
    function t() {
        if (!r) {
            r = !0;
            for (var i = 0; i < n.length; i++) n[i].fn.call(window, n[i].ctx);
            n = []
        }
    }

    function o() {
        "complete" === document.readyState && t()
    }
    i = i || "wpProQuizReady", e = e || window;
    var n = [],
        r = !1,
        s = !1;
    e[i] = function(i, e) {
        return r ? void setTimeout(function() {
            i(e)
        }, 1) : (n.push({
            fn: i,
            ctx: e
        }), void("complete" === document.readyState ? setTimeout(t, 1) : s || (document.addEventListener ? (document.addEventListener("DOMContentLoaded", t, !1), window.addEventListener("load", t, !1)) : (document.attachEvent("onreadystatechange", o), window.attachEvent("onload", t)), s = !0)))
    }
}("wpProQuizReady", window), wpProQuizReady(function() {
        for (var i = window.wpProQuizInitList || [], e = 0; e < i.length; e++) jQuery(i[e].id).wpProQuizFront(i[e].init)
    }),
    function(i) {
        i.wpProQuizFront = function(e, t) {
            function o() {
                var i = 0,
                    e = -1,
                    t = 0,
                    o = !1;
                this.questionStart = function(t) {
                    -1 != e && this.questionStop(), e = t, i = +new Date
                }, this.questionStop = function() {
                    -1 != e && (a[e].time += Math.round((new Date - i) / 1e3), e = -1)
                }, this.startQuiz = function() {
                    o && this.stopQuiz(), t = +new Date, o = !0
                }, this.stopQuiz = function() {
                    o && (a.comp.quizTime += Math.round((new Date - t) / 1e3), o = !1)
                }, this.init = function() {}
            }
            var n = i(e),
                r = t,
                s = this,
                a = new Object,
                u = new Object,
                d = 0,
                c = null,
                p = [],
                l = "",
                h = !1,
                f = 1,
                m = {
                    randomAnswer: 0,
                    randomQuestion: 0,
                    disabledAnswerMark: 0,
                    checkBeforeStart: 0,
                    preview: 0,
                    cors: 0,
                    isAddAutomatic: 0,
                    quizSummeryHide: 0,
                    skipButton: 0,
                    reviewQustion: 0,
                    autoStart: 0,
                    forcingQuestionSolve: 0,
                    hideQuestionPositionOverview: 0,
                    formActivated: 0,
                    maxShowQuestion: 0,
                    sortCategories: 0
                },
                w = {
                    isQuizStart: 0,
                    isLocked: 0,
                    loadLock: 0,
                    isPrerequisite: 0,
                    isUserStartLocked: 0
                },
                Q = {
                    check: 'input[name="check"]',
                    next: 'input[name="next"]',
                    questionList: ".wpProQuiz_questionList",
                    skip: 'input[name="skip"]',
                    singlePageLeft: 'input[name="wpProQuiz_pageLeft"]',
                    singlePageRight: 'input[name="wpProQuiz_pageRight"]'
                },
                v = {
                    back: n.find('input[name="back"]'),
                    next: n.find(Q.next),
                    quiz: n.find(".wpProQuiz_quiz"),
                    questionList: n.find(".wpProQuiz_list"),
                    results: n.find(".wpProQuiz_results"),
                    quizStartPage: n.find(".wpProQuiz_text"),
                    timelimit: n.find(".wpProQuiz_time_limit"),
                    toplistShowInButton: n.find(".wpProQuiz_toplistShowInButton"),
                    listItems: i()
                },
                z = {
                    token: "",
                    isUser: 0
                },
                _ = {
                    START: 0,
                    END: 1
                },
                P = function() {
                    var i = r.timelimit,
                        e = 0,
                        t = {};
                    return t.stop = function() {
                        i && (window.clearInterval(e), v.timelimit.hide())
                    }, t.start = function() {
                        if (i) {
                            var o = 1e3 * i,
                                n = v.timelimit.find("span").text(s.methode.parseTime(i)),
                                r = v.timelimit.find(".wpProQuiz_progress");
                            v.timelimit.show();
                            var a = +new Date;
                            e = window.setInterval(function() {
                                var i = +new Date - a,
                                    e = o - i;
                                i >= 500 && n.text(s.methode.parseTime(Math.ceil(e / 1e3))), r.css("width", e / o * 100 + "%"), 0 >= e && (t.stop(), s.methode.finishQuiz(!0))
                            }, 16)
                        }
                    }, t
                }(),
                g = new function() {
                    function e(i) {
                        var e = c.eq(i),
                            t = e.offset().top,
                            o = a.offset().top,
                            n = t - o;
                        if (0 > n - 4 || n + 32 > 100) {
                            var r = o - c.eq(0).offset().top - (o - d.offset().top) + e.position().top;
                            r > w && (r = w);
                            var s = r / h;
                            d.attr("style", "margin-top: " + -r + "px !important"), u.css({
                                top: s
                            })
                        }
                    }

                    function t(i) {
                        var e = "",
                            t = Q[i];
                        t.review ? e = "#FFB800" : t.solved && (e = "#6CA54C"), c.eq(i).css("background-color", e)
                    }

                    function o(i) {
                        i.preventDefault();
                        var e = i.pageY - l;
                        0 > e && (e = 0), e > p && (e = p);
                        var t = h * e;
                        d.attr("style", "margin-top: " + -t + "px !important"), u.css({
                            top: e
                        })
                    }

                    function r(e) {
                        e.preventDefault(), i(document).unbind(".scrollEvent")
                    }
                    var a = [],
                        u = [],
                        d = [],
                        c = [],
                        p = 0,
                        l = 0,
                        h = 0,
                        f = 0,
                        w = 0,
                        Q = [];
                    this.init = function() {
                        a = n.find(".wpProQuiz_reviewQuestion"), u = a.find("div"), d = a.find("ol"), c = d.children(), u.mousedown(function(e) {
                            e.preventDefault(), e.stopPropagation(), l = e.pageY - u.offset().top + f, i(document).bind("mouseup.scrollEvent", r), i(document).bind("mousemove.scrollEvent", o)
                        }), c.click(function(e) {
                            s.methode.showQuestion(i(this).index())
                        }), n.bind("questionSolved", function(i) {
                            Q[i.values.index].solved = i.values.solved, t(i.values.index)
                        }), n.bind("changeQuestion", function(i) {
                            c.removeClass("wpProQuiz_reviewQuestionTarget"), c.eq(i.values.index).addClass("wpProQuiz_reviewQuestionTarget"), e(i.values.index)
                        }), n.bind("reviewQuestion", function(i) {
                            Q[i.values.index].review = !Q[i.values.index].review, t(i.values.index)
                        }), a.bind("mousewheel DOMMouseScroll", function(i) {
                            i.preventDefault();
                            var e = i.originalEvent,
                                t = e.wheelDelta ? -e.wheelDelta / 120 : e.detail / 3,
                                o = 20 * t,
                                n = f - d.offset().top + o;
                            n > w && (n = w), 0 > n && (n = 0);
                            var r = n / h;
                            return d.attr("style", "margin-top: " + -n + "px !important"), u.css({
                                top: r
                            }), !1
                        })
                    }, this.show = function(i) {
                        if (m.reviewQustion && a.parent().show(), n.find(".wpProQuiz_reviewDiv .wpProQuiz_button2").show(), !i) {
                            d.attr("style", "margin-top: 0px !important"), u.css({
                                top: 0
                            });
                            var e = d.outerHeight(),
                                t = a.height();
                            p = t - u.height(), l = 0, w = e - t, h = w / p, this.reset(), e > 100 && u.show(), f = u.offset().top
                        }
                    }, this.hide = function() {
                        a.parent().hide()
                    }, this.toggle = function() {
                        if (m.reviewQustion) {
                            a.parent().toggle(), c.removeClass("wpProQuiz_reviewQuestionTarget"), n.find(".wpProQuiz_reviewDiv .wpProQuiz_button2").hide(), d.attr("style", "margin-top: 0px !important"), u.css({
                                top: 0
                            });
                            var i = d.outerHeight(),
                                e = a.height();
                            p = e - u.height(), l = 0, w = i - e, h = w / p, i > 100 && u.show(), f = u.offset().top
                        }
                    }, this.reset = function() {
                        for (var i = 0, e = c.length; e > i; i++) Q[i] = {};
                        c.removeClass("wpProQuiz_reviewQuestionTarget").css("background-color", "")
                    }
                },
                q = new o,
                x = function(e, t, o, n) {
                    var r = !0,
                        a = 0,
                        u = i.isArray(t.points),
                        d = {},
                        c = {
                            singleMulti: function() {
                                var e = n.find(".wpProQuiz_questionInput").attr("disabled", "disabled"),
                                    o = t.diffMode;
                                n.children().each(function(n) {
                                    var d = i(this),
                                        c = d.data("pos"),
                                        p = e.eq(n).is(":checked");
                                    t.correct[c] ? (p ? u && (o ? a = t.points[c] : a += t.points[c]) : r = !1, t.disCorrect ? r = !0 : s.methode.marker(d, !0)) : p ? (t.disCorrect ? r = !0 : (s.methode.marker(d, !1), r = !1), o && (a = t.points[c])) : u && !o && (a += t.points[c])
                                })
                            },
                            sort_answer: function() {
                                var e = n.children();
                                e.each(function(e, o) {
                                    var n = i(this);
                                    d[e] = n.data("pos"), e == n.data("pos") ? (s.methode.marker(n, !0), u && (a += t.points[e])) : (s.methode.marker(n, !1), r = !1)
                                }), e.children().css({
                                    "box-shadow": "0 0",
                                    cursor: "auto"
                                }), n.sortable("destroy"), e.sort(function(e, t) {
                                    return i(e).data("pos") > i(t).data("pos") ? 1 : -1
                                }), n.append(e)
                            },
                            matrix_sort_answer: function() {
                                var e = n.children(),
                                    c = new Array;
                                d = {
                                    0: -1
                                }, e.each(function() {
                                    var e = i(this),
                                        o = e.data("pos"),
                                        n = e.find(".wpProQuiz_maxtrixSortCriterion"),
                                        p = n.children();
                                    p.length && (d[o] = p.data("pos")), p.length && i.inArray(String(o), String(p.data("correct")).split(",")) >= 0 ? (s.methode.marker(n, !0), u && (a += t.points[o])) : (r = !1, s.methode.marker(n, !1)), c[o] = n
                                }), s.methode.resetMatrix(o), o.find(".wpProQuiz_sortStringItem").each(function() {
                                    var e = c[i(this).data("pos")];
                                    void 0 != e && e.append(this)
                                }).css({
                                    "box-shadow": "0 0",
                                    cursor: "auto"
                                }), o.find(".wpProQuiz_sortStringList, .wpProQuiz_maxtrixSortCriterion").sortable("destroy")
                            },
                            free_answer: function() {
                                var e = n.children(),
                                    o = e.find(".wpProQuiz_questionInput").attr("disabled", "disabled").val();
                                i.inArray(i.trim(o).toLowerCase(), t.correct) >= 0 ? s.methode.marker(e, !0) : (s.methode.marker(e, !1), r = !1)
                            },
                            cloze_answer: function() {
                                n.find(".wpProQuiz_cloze").each(function(e, o) {
                                    var n = i(this),
                                        d = n.children(),
                                        c = d.eq(0),
                                        p = d.eq(1),
                                        l = s.methode.cleanupCurlyQuotes(c.val());
                                    i.inArray(l, t.correct[e]) >= 0 ? (u && (a += t.points[e]), m.disabledAnswerMark || c.css("background-color", "#B0DAB0")) : (m.disabledAnswerMark || c.css("background-color", "#FFBABA"), r = !1, p.show()), c.attr("disabled", "disabled")
                                })
                            },
                            assessment_answer: function() {
                                r = !0;
                                var e = n.find(".wpProQuiz_questionInput").attr("disabled", "disabled"),
                                    t = 0;
                                e.filter(":checked").each(function() {
                                    t += parseInt(i(this).val())
                                }), a = t
                            }
                        };
                    return c[e](), !u && r && (a = t.points), {
                        c: r,
                        p: a,
                        s: d
                    }
                },
                k = new function() {
                    var e = {
                            isEmpty: function(e) {
                                return e = i.trim(e), !e || 0 === e.length
                            }
                        },
                        t = {
                            TEXT: 0,
                            TEXTAREA: 1,
                            NUMBER: 2,
                            CHECKBOX: 3,
                            EMAIL: 4,
                            YES_NO: 5,
                            DATE: 6,
                            SELECT: 7,
                            RADIO: 8
                        };
                    this.checkForm = function() {
                        var o = !0;
                        return n.find(".wpProQuiz_forms input, .wpProQuiz_forms textarea, .wpProQuiz_forms .wpProQuiz_formFields, .wpProQuiz_forms select").each(function() {
                            var n = i(this),
                                r = 1 == n.data("required"),
                                s = n.data("type"),
                                a = !0,
                                u = i.trim(n.val());
                            switch (s) {
                                case t.TEXT:
                                case t.TEXTAREA:
                                case t.SELECT:
                                    r && (a = !e.isEmpty(u));
                                    break;
                                case t.NUMBER:
                                    (r || !e.isEmpty(u)) && (a = !e.isEmpty(u) && !isNaN(u));
                                    break;
                                case t.EMAIL:
                                    (r || !e.isEmpty(u)) && (a = !e.isEmpty(u) && new RegExp(/^[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/).test(u));
                                    break;
                                case t.CHECKBOX:
                                    r && (a = n.is(":checked"));
                                    break;
                                case t.YES_NO:
                                case t.RADIO:
                                    r && (a = void 0 !== n.find('input[type="radio"]:checked').val());
                                    break;
                                case t.DATE:
                                    var d = 0,
                                        c = 0;
                                    n.find("select").each(function() {
                                        d++, c += e.isEmpty(i(this).val()) ? 0 : 1
                                    }), (r || c > 0) && (a = d == c)
                            }
                            a ? n.siblings(".wpProQuiz_invalidate").hide() : (o = !1, n.siblings(".wpProQuiz_invalidate").show())
                        }), o
                    }, this.getFormData = function() {
                        var e = {};
                        return n.find(".wpProQuiz_forms input, .wpProQuiz_forms textarea, .wpProQuiz_forms .wpProQuiz_formFields, .wpProQuiz_forms select").each(function() {
                            var o = i(this),
                                n = o.data("form_id"),
                                r = o.data("type");
                            switch (r) {
                                case t.TEXT:
                                case t.TEXTAREA:
                                case t.SELECT:
                                case t.NUMBER:
                                case t.EMAIL:
                                    e[n] = o.val();
                                    break;
                                case t.CHECKBOX:
                                    e[n] = o.is(":checked") ? 1 : 0;
                                    break;
                                case t.YES_NO:
                                case t.RADIO:
                                    e[n] = o.find('input[type="radio"]:checked').val();
                                    break;
                                case t.DATE:
                                    e[n] = {
                                        day: o.find('select[name="wpProQuiz_field_' + n + '_day"]').val(),
                                        month: o.find('select[name="wpProQuiz_field_' + n + '_month"]').val(),
                                        year: o.find('select[name="wpProQuiz_field_' + n + '_year"]').val()
                                    }
                            }
                        }), e
                    }
                },
                S = function(e) {
                    n.find(".wpProQuiz_questionList").each(function() {
                        var t = i(this),
                            o = t.data("question_id"),
                            n = t.data("type"),
                            r = {};
                        if ("single" == n || "multiple" == n) t.find(".wpProQuiz_questionListItem").each(function() {
                            r[i(this).data("pos")] = +i(this).find(".wpProQuiz_questionInput").is(":checked")
                        });
                        else if ("free_answer" == n) r[0] = t.find(".wpProQuiz_questionInput").val();
                        else {
                            if ("sort_answer" == n) return !0;
                            if ("matrix_sort_answer" == n) return !0;
                            if ("cloze_answer" == n) {
                                var s = 0;
                                t.find(".wpProQuiz_cloze input").each(function() {
                                    r[s++] = i(this).val()
                                })
                            } else "assessment_answer" == n && (r[0] = "", t.find(".wpProQuiz_questionInput:checked").each(function() {
                                r[i(this).data("index")] = i(this).val()
                            }))
                        }
                        e[o].data = r
                    })
                };
            s.methode = {
                parseBitOptions: function() {
                    if (r.bo) {
                        m.randomAnswer = 1 & r.bo, m.randomQuestion = 2 & r.bo, m.disabledAnswerMark = 4 & r.bo, m.checkBeforeStart = 8 & r.bo, m.preview = 16 & r.bo, m.isAddAutomatic = 64 & r.bo, m.reviewQustion = 128 & r.bo, m.quizSummeryHide = 256 & r.bo, m.skipButton = 512 & r.bo, m.autoStart = 1024 & r.bo, m.forcingQuestionSolve = 2048 & r.bo, m.hideQuestionPositionOverview = 4096 & r.bo, m.formActivated = 8192 & r.bo, m.maxShowQuestion = 16384 & r.bo, m.sortCategories = 32768 & r.bo;
                        var i = 32 & r.bo;
                        i && void 0 != jQuery.support && void 0 != jQuery.support.cors && 0 == jQuery.support.cors && (m.cors = i)
                    }
                },
                setClozeStyle: function() {
                    n.find(".wpProQuiz_cloze input").each(function() {
                        for (var e = i(this), t = "", o = e.data("wordlen"), n = 0; o > n; n++) t += "w";
                        var r = i(document.createElement("span")).css("visibility", "hidden").text(t).appendTo(i("body")),
                            s = r.width();
                        r.remove(), e.width(s + 5)
                    })
                },
                parseTime: function(i) {
                    var e = parseInt(i % 60),
                        t = parseInt(i / 60 % 60),
                        o = parseInt(i / 3600 % 24);
                    return e = (e > 9 ? "" : "0") + e, t = (t > 9 ? "" : "0") + t, o = (o > 9 ? "" : "0") + o, o + ":" + t + ":" + e
                },
                cleanupCurlyQuotes: function(e) {
                    return e = e.replace(/\u2018/, "'"), e = e.replace(/\u2019/, "'"), e = e.replace(/\u201C/, '"'), e = e.replace(/\u201D/, '"'), i.trim(e).toLowerCase()
                },
                resetMatrix: function(e) {
                    e.each(function() {
                        var e = i(this),
                            t = e.find(".wpProQuiz_sortStringList");
                        e.find(".wpProQuiz_sortStringItem").each(function() {
                            t.append(i(this))
                        })
                    })
                },
                marker: function(i, e) {
                    m.disabledAnswerMark || (e ? i.addClass("wpProQuiz_answerCorrect") : i.addClass("wpProQuiz_answerIncorrect"))
                },
                startQuiz: function(e) {
                    if (w.loadLock) return void(w.isQuizStart = 1);
                    if (w.isQuizStart = 0, w.isLocked) return v.quizStartPage.hide(), void n.find(".wpProQuiz_lock").show();
                    if (w.isPrerequisite) return v.quizStartPage.hide(), void n.find(".wpProQuiz_prerequisite").show();
                    if (w.isUserStartLocked) return v.quizStartPage.hide(), void n.find(".wpProQuiz_startOnlyRegisteredUser").show();
                    if (m.maxShowQuestion && !e) return v.quizStartPage.hide(), n.find(".wpProQuiz_loadQuiz").show(), void s.methode.loadQuizDataAjax(!0);
                    if (!m.formActivated || r.formPos != _.START || k.checkForm()) {
                        switch (s.methode.loadQuizData(), m.randomQuestion && s.methode.random(v.questionList), m.randomAnswer && s.methode.random(n.find(Q.questionList)), m.sortCategories && s.methode.sortCategories(), s.methode.random(n.find(".wpProQuiz_sortStringList")), s.methode.random(n.find('[data-type="sort_answer"]')), n.find(".wpProQuiz_listItem").each(function(e, t) {
                            var o = i(this);
                            o.find(".wpProQuiz_question_page span:eq(0)").text(e + 1), o.find("> h5 span").text(e + 1), o.find(".wpProQuiz_questionListItem").each(function(e, t) {
                                i(this).find("> span:not(.wpProQuiz_cloze)").text(e + 1 + ". ")
                            })
                        }), v.next = n.find(Q.next), r.mode) {
                            case 3:
                                n.find('input[name="checkSingle"]').show();
                                break;
                            case 2:
                                n.find(Q.check).show(), !m.skipButton && m.reviewQustion && n.find(Q.skip).show();
                                break;
                            case 1:
                                n.find('input[name="back"]').slice(1).show();
                            case 0:
                                v.next.show()
                        }(m.hideQuestionPositionOverview || 3 == r.mode) && n.find(".wpProQuiz_question_page").hide();
                        var o = v.next.last();
                        l = o.val(), o.val(r.lbn);
                        var h = v.questionList.children();
                        if (v.listItems = n.find(".wpProQuiz_list > li"), 3 == r.mode) s.methode.showSinglePage(0);
                        else {
                            c = h.eq(0).show();
                            var f = c.find(Q.questionList).data("question_id");
                            q.questionStart(f)
                        }
                        q.startQuiz(), n.find(".wpProQuiz_sortable").parents("ul").sortable({
                            update: function(e, t) {
                                var o = i(this).parents(".wpProQuiz_listItem");
                                n.trigger({
                                    type: "questionSolved",
                                    values: {
                                        item: o,
                                        index: o.index(),
                                        solved: !0
                                    }
                                })
                            }
                        }).disableSelection(), n.find(".wpProQuiz_sortStringList, .wpProQuiz_maxtrixSortCriterion").sortable({
                            connectWith: ".wpProQuiz_maxtrixSortCriterion:not(:has(li)), .wpProQuiz_sortStringList",
                            placeholder: "wpProQuiz_placehold",
                            update: function(e, t) {
                                var o = i(this).parents(".wpProQuiz_listItem");
                                n.trigger({
                                    type: "questionSolved",
                                    values: {
                                        item: o,
                                        index: o.index(),
                                        solved: !0
                                    }
                                })
                            }
                        }).disableSelection(), p = [], P.start(), d = +new Date, a = {
                            comp: {
                                points: 0,
                                correctQuestions: 0,
                                quizTime: 0
                            }
                        }, n.find(".wpProQuiz_questionList").each(function() {
                            var e = i(this).data("question_id");
                            a[e] = {
                                time: 0,
                                solved: 0
                            }
                        }), u = {}, i.each(t.catPoints, function(i, e) {
                            u[i] = 0
                        }), v.quizStartPage.hide(), n.find(".wpProQuiz_loadQuiz").hide(), v.quiz.show(), g.show(), 3 != r.mode && n.trigger({
                            type: "changeQuestion",
                            values: {
                                item: c,
                                index: c.index()
                            }
                        })
                    }
                },
                showSingleQuestion: function(i) {
                    var e = i ? Math.ceil(i / r.qpp) : 1;
                    this.showSinglePage(e)
                },
                showSinglePage: function(i) {
                    if ($listItem = v.questionList.children().hide(), !r.qpp) return void $listItem.show();
                    i = i ? +i : 1;
                    var e = Math.ceil(n.find(".wpProQuiz_list > li").length / r.qpp);
                    if (!(i > e)) {
                        var t = n.find(Q.singlePageLeft).hide(),
                            o = n.find(Q.singlePageRight).hide(),
                            a = n.find('input[name="checkSingle"]').hide();
                        i > 1 && t.val(t.data("text").replace(/%d/, i - 1)).show(), i == e ? a.show() : o.val(o.data("text").replace(/%d/, i + 1)).show(), f = i;
                        var u = r.qpp * (i - 1);
                        $listItem.slice(u, u + r.qpp).show(), s.methode.scrollTo(v.quiz)
                    }
                },
                nextQuestion: function() {
                    this.showQuestionObject(c.next())
                },
                prevQuestion: function() {
                    this.showQuestionObject(c.prev())
                },
                showQuestion: function(i) {
                    var e = v.listItems.eq(i);
                    return 3 == r.mode || h ? (r.qpp && s.methode.showSingleQuestion(i + 1), s.methode.scrollTo(e, 1), void q.startQuiz()) : void this.showQuestionObject(e)
                },
                showQuestionObject: function(i) {
                    if (!i.length && m.forcingQuestionSolve && m.quizSummeryHide && m.reviewQustion)
                        for (var e = 0, t = n.find(".wpProQuiz_listItem").length; t > e; e++)
                            if (!p[e]) return alert(WpProQuizGlobal.questionsNotSolved), !1;
                    if (c.hide(), c = i.show(), s.methode.scrollTo(v.quiz), n.trigger({
                            type: "changeQuestion",
                            values: {
                                item: c,
                                index: c.index()
                            }
                        }), c.length) {
                        var o = c.find(Q.questionList).data("question_id");
                        q.questionStart(o)
                    } else s.methode.showQuizSummary()
                },
                skipQuestion: function() {
                    n.trigger({
                        type: "skipQuestion",
                        values: {
                            item: c,
                            index: c.index()
                        }
                    }), s.methode.nextQuestion()
                },
                reviewQuestion: function() {
                    n.trigger({
                        type: "reviewQuestion",
                        values: {
                            item: c,
                            index: c.index()
                        }
                    })
                },
                showQuizSummary: function() {
                    if (q.questionStop(), q.stopQuiz(), m.quizSummeryHide || !m.reviewQustion) return void(m.formActivated && r.formPos == _.END ? (g.hide(), v.quiz.hide(), s.methode.scrollTo(n.find(".wpProQuiz_infopage").show())) : s.methode.finishQuiz());
                    var e = n.find(".wpProQuiz_checkPage");
                    e.find("ol:eq(0)").empty().append(n.find(".wpProQuiz_reviewQuestion ol li").clone().removeClass("wpProQuiz_reviewQuestionTarget")).children().click(function(t) {
                        e.hide(), v.quiz.show(), g.show(!0), s.methode.showQuestion(i(this).index())
                    });
                    for (var t = 0, o = 0, a = p.length; a > o; o++) p[o] && t++;
                    e.find("span:eq(0)").text(t), g.hide(), v.quiz.hide(), e.show(), s.methode.scrollTo(e)
                },
                finishQuiz: function(e) {
                    q.questionStop(), q.stopQuiz(), P.stop();
                    var t = (+new Date - d) / 1e3;
                    t = r.timelimit && t > r.timelimit ? r.timelimit : t, n.find(".wpProQuiz_quiz_time span").text(s.methode.parseTime(t)), e && v.results.find(".wpProQuiz_time_limit_expired").show(), s.methode.checkQuestion(v.questionList.children(), !0), n.find(".wpProQuiz_correct_answer").text(a.comp.correctQuestions), a.comp.result = Math.round(a.comp.points / r.globalPoints * 100 * 100) / 100, a.comp.solved = 0;
                    var o = n.find(".wpProQuiz_points span");
                    o.eq(0).text(a.comp.points), o.eq(1).text(r.globalPoints), o.eq(2).text(a.comp.result + "%");
                    var u = n.find(".wpProQuiz_resultsList > li").eq(s.methode.findResultIndex(a.comp.result)),
                        c = k.getFormData();
                    u.find(".wpProQuiz_resultForm").each(function() {
                        var e = i(this),
                            t = e.data("form_id"),
                            o = c[t];
                        "object" == typeof o && (o = o.day + "-" + o.month + "-" + o.year), e.text(o).show()
                    }), u.show(), s.methode.setAverageResult(a.comp.result, !1), this.setCategoryOverview(), s.methode.sendCompletedQuiz(), m.isAddAutomatic && z.isUser && s.methode.addToplist(), g.hide(), n.find(".wpProQuiz_checkPage, .wpProQuiz_infopage").hide(), v.quiz.hide(), v.results.show(), s.methode.scrollTo(v.results)
                },
                setCategoryOverview: function() {
                    a.comp.cats = {}, n.find(".wpProQuiz_catOverview li").each(function() {
                        var e = i(this),
                            t = e.data("category_id");
                        if (void 0 === r.catPoints[t]) return e.hide(), !0;
                        var o = Math.round(u[t] / r.catPoints[t] * 100 * 100) / 100;
                        a.comp.cats[t] = o, e.find(".wpProQuiz_catPercent").text(o + "%"), e.show()
                    })
                },
                questionSolved: function(i) {
                    p[i.values.index] = i.values.solved;
                    var e = i.values.item.find(Q.questionList),
                        t = r.json[e.data("question_id")];
                    a[t.id].solved = Number(i.values.fake ? a[t.id].solved : i.values.solved)
                },
                sendCompletedQuiz: function() {
                    if (!m.preview) {
                        S(a);
                        var i = k.getFormData();
                        s.methode.ajax({
                            action: "wp_pro_quiz_admin_ajax",
                            func: "completedQuiz",
                            data: {
                                quizId: r.quizId,
                                results: a,
                                forms: i
                            }
                        })
                    }
                },
                findResultIndex: function(i) {
                    for (var e = r.resultsGrade, t = -1, o = 999999, n = 0; n < e.length; n++) {
                        var s = e[n];
                        i >= s && o > i - s && (o = i - s, t = n)
                    }
                    return t
                },
                showQustionList: function() {
                    h = !h, v.toplistShowInButton.hide(), v.quiz.toggle(), n.find(".wpProQuiz_QuestionButton").hide(), v.questionList.children().show(), g.toggle(), n.find(".wpProQuiz_question_page").hide()
                },
                random: function(e) {
                    e.each(function() {
                        var e = i(this).children().get().sort(function() {
                            return Math.round(Math.random()) - .5
                        });
                        i(e).appendTo(e[0].parentNode)
                    })
                },
                sortCategories: function() {
                    var e = i(".wpProQuiz_list").children().get().sort(function(e, t) {
                        var o = i(e).find(".wpProQuiz_questionList").data("question_id"),
                            n = i(t).find(".wpProQuiz_questionList").data("question_id");
                        return r.json[o].catId - r.json[n].catId
                    });
                    i(e).appendTo(e[0].parentNode)
                },
                restartQuiz: function() {
                    v.results.hide(), v.quizStartPage.show(), v.questionList.children().hide(), v.toplistShowInButton.hide(), g.hide(), n.find(".wpProQuiz_questionInput, .wpProQuiz_cloze input").removeAttr("disabled").removeAttr("checked").css("background-color", ""), n.find('.wpProQuiz_questionListItem input[type="text"]').val(""), n.find(".wpProQuiz_answerCorrect, .wpProQuiz_answerIncorrect").removeClass("wpProQuiz_answerCorrect wpProQuiz_answerIncorrect"), n.find(".wpProQuiz_listItem").data("check", !1), n.find(".wpProQuiz_response").hide().children().hide(), s.methode.resetMatrix(n.find(".wpProQuiz_listItem")), n.find(".wpProQuiz_sortStringItem, .wpProQuiz_sortable").removeAttr("style"), n.find(".wpProQuiz_clozeCorrect, .wpProQuiz_QuestionButton, .wpProQuiz_resultsList > li").hide(), n.find('.wpProQuiz_question_page, input[name="tip"]').show(), n.find(".wpProQuiz_resultForm").text("").hide(), v.results.find(".wpProQuiz_time_limit_expired").hide(), v.next.last().val(l), h = !1
                },
                checkQuestion: function(e, t) {
                    e = void 0 == e ? c : e, e.each(function() {
                        var e = i(this),
                            o = e.find(Q.questionList),
                            s = r.json[o.data("question_id")],
                            d = s.type;
                        if (q.questionStop(), e.data("check")) return !0;
                        ("single" == s.type || "multiple" == s.type) && (d = "singleMulti");
                        var c = x(d, s, e, o);
                        e.find(".wpProQuiz_response").show(), e.find(Q.check).hide(), e.find(Q.skip).hide(), e.find(Q.next).show(), a[s.id].points = c.p, a[s.id].correct = Number(c.c), a[s.id].data = c.s, a.comp.points += c.p, u[s.catId] += c.p, c.c ? (e.find(".wpProQuiz_correct").show(), a.comp.correctQuestions += 1) : e.find(".wpProQuiz_incorrect").show(), e.find(".wpProQuiz_responsePoints").text(c.p), e.data("check", !0), t || n.trigger({
                            type: "questionSolved",
                            values: {
                                item: e,
                                index: e.index(),
                                solved: !0,
                                fake: !0
                            }
                        })
                    })
                },
                showTip: function() {
                    var e = i(this),
                        t = e.siblings(".wpProQuiz_question").find(Q.questionList).data("question_id");
                    e.siblings(".wpProQuiz_tipp").toggle("fast"), a[t].tip = 1, i(document).bind("mouseup.tipEvent", function(e) {
                        var t = n.find(".wpProQuiz_tipp"),
                            o = n.find('input[name="tip"]');
                        t.is(e.target) || 0 != t.has(e.target).length || o.is(e.target) || (t.hide("fast"), i(document).unbind(".tipEvent"))
                    })
                },
                ajax: function(e, t, o) {
                    o = o || "json", m.cors && (jQuery.support.cors = !0), i.post(WpProQuizGlobal.ajaxurl, e, t, o), m.cors && (jQuery.support.cors = !1)
                },
                checkQuizLock: function() {
                    w.loadLock = 1, s.methode.ajax({
                        action: "wp_pro_quiz_admin_ajax",
                        func: "quizCheckLock",
                        data: {
                            quizId: r.quizId
                        }
                    }, function(i) {
                        void 0 != i.lock && (w.isLocked = i.lock.is, i.lock.pre && n.find('input[name="restartQuiz"]').hide()), void 0 != i.prerequisite && (w.isPrerequisite = 1, n.find(".wpProQuiz_prerequisite span").text(i.prerequisite)), void 0 != i.startUserLock && (w.isUserStartLocked = i.startUserLock), w.loadLock = 0, w.isQuizStart && s.methode.startQuiz()
                    })
                },
                loadQuizData: function() {
                    s.methode.ajax({
                        action: "wp_pro_quiz_admin_ajax",
                        func: "loadQuizData",
                        data: {
                            quizId: r.quizId
                        }
                    }, function(i) {
                        i.toplist && s.methode.handleToplistData(i.toplist), void 0 != i.averageResult && s.methode.setAverageResult(i.averageResult, !0)
                    })
                },
                setAverageResult: function(i, e) {
                    var t = n.find(".wpProQuiz_resultValue:eq(" + (e ? 0 : 1) + ") > * ");
                    t.eq(1).text(i + "%"), t.eq(0).css("width", 240 * i / 100 + "px")
                },
                handleToplistData: function(i) {
                    var e = n.find(".wpProQuiz_addToplist"),
                        t = e.find(".wpProQuiz_addBox").show().children("div");
                    if (i.canAdd)
                        if (e.show(), e.find(".wpProQuiz_addToplistMessage").hide(), e.find(".wpProQuiz_toplistButton").show(), z.token = i.token, z.isUser = 0, i.userId) t.hide(), z.isUser = 1, m.isAddAutomatic && e.hide();
                        else {
                            t.show();
                            var o = t.children().eq(1);
                            i.captcha ? (o.find('input[name="wpProQuiz_captchaPrefix"]').val(i.captcha.code), o.find(".wpProQuiz_captchaImg").attr("src", i.captcha.img), o.find('input[name="wpProQuiz_captcha"]').val(""), o.show()) : o.hide()
                        } else e.hide()
                },
                scrollTo: function(e, t) {
                    var o = e.offset().top - 100;
                    (t || (window.pageYOffset || document.body.scrollTop) > o) && i("html,body").animate({
                        scrollTop: o
                    }, 300)
                },
                addToplist: function() {
                    if (!m.preview) {
                        var i = n.find(".wpProQuiz_addToplistMessage").text(WpProQuizGlobal.loadData).show(),
                            e = n.find(".wpProQuiz_addBox").hide();
                        s.methode.ajax({
                            action: "wp_pro_quiz_admin_ajax",
                            func: "addInToplist",
                            data: {
                                quizId: r.quizId,
                                token: z.token,
                                name: e.find('input[name="wpProQuiz_toplistName"]').val(),
                                email: e.find('input[name="wpProQuiz_toplistEmail"]').val(),
                                captcha: e.find('input[name="wpProQuiz_captcha"]').val(),
                                prefix: e.find('input[name="wpProQuiz_captchaPrefix"]').val(),
                                points: a.comp.points,
                                totalPoints: r.globalPoints
                            }
                        }, function(t) {
                            i.text(t.text), t.clear ? (e.hide(), s.methode.updateToplist()) : e.show(), t.captcha && (e.find(".wpProQuiz_captchaImg").attr("src", t.captcha.img), e.find('input[name="wpProQuiz_captchaPrefix"]').val(t.captcha.code), e.find('input[name="wpProQuiz_captcha"]').val(""))
                        })
                    }
                },
                updateToplist: function() {
                    "function" == typeof wpProQuiz_fetchToplist && wpProQuiz_fetchToplist()
                },
                registerSolved: function() {
                    n.find('.wpProQuiz_questionInput[type="text"]').change(function(e) {
                        var t = i(this),
                            o = t.parents(".wpProQuiz_listItem"),
                            r = !1;
                        "" != t.val() && (r = !0), n.trigger({
                            type: "questionSolved",
                            values: {
                                item: o,
                                index: o.index(),
                                solved: r
                            }
                        })
                    }), n.find('.wpProQuiz_questionList[data-type="single"] .wpProQuiz_questionInput, .wpProQuiz_questionList[data-type="assessment_answer"] .wpProQuiz_questionInput').change(function(e) {
                        var t = i(this),
                            o = t.parents(".wpProQuiz_listItem"),
                            r = this.checked;
                        n.trigger({
                            type: "questionSolved",
                            values: {
                                item: o,
                                index: o.index(),
                                solved: r
                            }
                        })
                    }), n.find(".wpProQuiz_cloze input").change(function() {
                        var e = i(this),
                            t = e.parents(".wpProQuiz_listItem"),
                            o = !0;
                        t.find(".wpProQuiz_cloze input").each(function() {
                            return "" == i(this).val() ? (o = !1, !1) : void 0
                        }), n.trigger({
                            type: "questionSolved",
                            values: {
                                item: t,
                                index: t.index(),
                                solved: o
                            }
                        })
                    }), n.find('.wpProQuiz_questionList[data-type="multiple"] .wpProQuiz_questionInput').change(function(e) {
                        var t = i(this),
                            o = t.parents(".wpProQuiz_listItem"),
                            r = 0;
                        o.find('.wpProQuiz_questionList[data-type="multiple"] .wpProQuiz_questionInput').each(function(i) {
                            this.checked && r++
                        }), n.trigger({
                            type: "questionSolved",
                            values: {
                                item: o,
                                index: o.index(),
                                solved: r ? !0 : !1
                            }
                        })
                    })
                },
                loadQuizDataAjax: function(e) {
                    s.methode.ajax({
                        action: "wp_pro_quiz_admin_ajax",
                        func: "quizLoadData",
                        data: {
                            quizId: r.quizId
                        }
                    }, function(t) {
                        r.globalPoints = t.globalPoints, r.catPoints = t.catPoints, r.json = t.json, v.quiz.remove(), n.find(".wpProQuiz_quizAnker").after(t.content), v = {
                            back: n.find('input[name="back"]'),
                            next: n.find(Q.next),
                            quiz: n.find(".wpProQuiz_quiz"),
                            questionList: n.find(".wpProQuiz_list"),
                            results: n.find(".wpProQuiz_results"),
                            quizStartPage: n.find(".wpProQuiz_text"),
                            timelimit: n.find(".wpProQuiz_time_limit"),
                            toplistShowInButton: n.find(".wpProQuiz_toplistShowInButton"),
                            listItems: i()
                        }, s.methode.initQuiz(), e && s.methode.startQuiz(!0)
                    })
                },
                initQuiz: function() {
                    s.methode.setClozeStyle(), s.methode.registerSolved(), v.next.click(function() {
                        return !m.forcingQuestionSolve || p[c.index()] || !m.quizSummeryHide && m.reviewQustion ? void s.methode.nextQuestion() : (alert(WpProQuizGlobal.questionNotSolved), !1)
                    }), v.back.click(function() {
                        s.methode.prevQuestion()
                    }), n.find(Q.check).click(function() {
                        return !m.forcingQuestionSolve || p[c.index()] || !m.quizSummeryHide && m.reviewQustion ? void s.methode.checkQuestion() : (alert(WpProQuizGlobal.questionNotSolved), !1)
                    }), n.find('input[name="checkSingle"]').click(function() {
                        if (m.forcingQuestionSolve && (m.quizSummeryHide || !m.reviewQustion))
                            for (var i = 0, e = n.find(".wpProQuiz_listItem").length; e > i; i++)
                                if (!p[i]) return alert(WpProQuizGlobal.questionsNotSolved), !1;
                        s.methode.showQuizSummary()
                    }), n.find('input[name="tip"]').click(s.methode.showTip), n.find('input[name="skip"]').click(s.methode.skipQuestion), n.find('input[name="wpProQuiz_pageLeft"]').click(function() {
                        s.methode.showSinglePage(f - 1)
                    }), n.find('input[name="wpProQuiz_pageRight"]').click(function() {
                        s.methode.showSinglePage(f + 1)
                    })
                }
            }, s.preInit = function() {
                s.methode.parseBitOptions(), g.init(), n.find('input[name="startQuiz"]').click(function() {
                    return s.methode.startQuiz(), !1
                }), m.checkBeforeStart && !m.preview && s.methode.checkQuizLock(), n.find('input[name="reShowQuestion"]').click(function() {
                    s.methode.showQustionList()
                }), n.find('input[name="restartQuiz"]').click(function() {
                    s.methode.restartQuiz()
                }), n.find('input[name="review"]').click(s.methode.reviewQuestion), n.find('input[name="wpProQuiz_toplistAdd"]').click(s.methode.addToplist), n.find('input[name="quizSummary"]').click(s.methode.showQuizSummary), n.find('input[name="endQuizSummary"]').click(function() {
                    if (m.forcingQuestionSolve)
                        for (var i = 0, e = n.find(".wpProQuiz_listItem").length; e > i; i++)
                            if (!p[i]) return alert(WpProQuizGlobal.questionsNotSolved), !1;
                            (!m.formActivated || r.formPos != _.END || k.checkForm()) && s.methode.finishQuiz()
                }), n.find('input[name="endInfopage"]').click(function() {
                    k.checkForm() && s.methode.finishQuiz()
                }), n.find('input[name="showToplist"]').click(function() {
                    v.quiz.hide(), v.toplistShowInButton.toggle()
                }), n.bind("questionSolved", s.methode.questionSolved), m.maxShowQuestion || s.methode.initQuiz(), m.autoStart && s.methode.startQuiz()
            }, s.preInit()
        }, i.fn.wpProQuizFront = function(e) {
            return this.each(function() {
                void 0 == i(this).data("wpProQuizFront") && i(this).data("wpProQuizFront", new i.wpProQuizFront(this, e))
            })
        }
    }(jQuery);
! function(a) {
    function f(a, b) {
        if (!(a.originalEvent.touches.length > 1)) {
            a.preventDefault();
            var c = a.originalEvent.changedTouches[0],
                d = document.createEvent("MouseEvents");
            d.initMouseEvent(b, !0, !0, window, 1, c.screenX, c.screenY, c.clientX, c.clientY, !1, !1, !1, !1, 0, null), a.target.dispatchEvent(d)
        }
    }
    if (a.support.touch = "ontouchend" in document, a.support.touch) {
        var e, b = a.ui.mouse.prototype,
            c = b._mouseInit,
            d = b._mouseDestroy;
        b._touchStart = function(a) {
            var b = this;
            !e && b._mouseCapture(a.originalEvent.changedTouches[0]) && (e = !0, b._touchMoved = !1, f(a, "mouseover"), f(a, "mousemove"), f(a, "mousedown"))
        }, b._touchMove = function(a) {
            e && (this._touchMoved = !0, f(a, "mousemove"))
        }, b._touchEnd = function(a) {
            e && (f(a, "mouseup"), f(a, "mouseout"), this._touchMoved || f(a, "click"), e = !1)
        }, b._mouseInit = function() {
            var b = this;
            b.element.bind({
                touchstart: a.proxy(b, "_touchStart"),
                touchmove: a.proxy(b, "_touchMove"),
                touchend: a.proxy(b, "_touchEnd")
            }), c.call(b)
        }, b._mouseDestroy = function() {
            var b = this;
            b.element.unbind({
                touchstart: a.proxy(b, "_touchStart"),
                touchmove: a.proxy(b, "_touchMove"),
                touchend: a.proxy(b, "_touchEnd")
            }), d.call(b)
        }
    }
}(jQuery)