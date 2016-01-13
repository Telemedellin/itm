/* jQuery-FontSpy.js v3.0.0
 * https://github.com/patrickmarabeas/jQuery-FontSpy.js
 *
 * Copyright 2013, Patrick Marabeas http://pulse-dev.com
 * Released under the MIT license
 * http://opensource.org/licenses/mit-license.php
 *
 * Date: 02/11/2015
 */

!function(t,s){fontSpy=function(t,e){var n=s("html"),o=s("body"),i=t;if("string"!=typeof i||""===i)throw"A valid fontName is required. fontName must be a string and must not be an empty string.";var a={font:i,fontClass:i.toLowerCase().replace(/\s/g,""),success:function(){},failure:function(){},testFont:"Courier New",testString:"QW@HhsXJ",glyphs:"",delay:50,timeOut:1e3,callback:s.noop},c=s.extend(a,e),r=s("<span>"+c.testString+c.glyphs+"</span>").css("position","absolute").css("top","-9999px").css("left","-9999px").css("visibility","hidden").css("fontFamily",c.testFont).css("fontSize","250px");o.append(r);var u=r.outerWidth();r.css("fontFamily",c.font+","+c.testFont);var l=function(){n.addClass("no-"+c.fontClass),c&&c.failure&&c.failure(),c.callback(new Error("FontSpy timeout")),r.remove()},f=function(){c.callback(),n.addClass(c.fontClass),c&&c.success&&c.success(),r.remove()},d=function(){setTimeout(p,c.delay),c.timeOut=c.timeOut-c.delay},p=function(){var t=r.outerWidth();u!==t?f():c.timeOut<0?l():d()};p()}}(this,jQuery);