!function($,t,e){"use strict";function o(t,e){var o=$(t).outerHeight(!0);$(e.content).each(function(){o+=$(this).outerHeight(!0)}),o<$(e.frame?e.frame:t.parent()).height()?$(t).addClass(e["class"]):$(t).removeClass(e["class"])}$.fn.stickyFooter=function(e){var e=$.extend({},$.fn.stickyFooter.defaults,e),s=this;return o(s,e),$(t).resize(function(){o(s,e)}),this},$.fn.stickyFooter.defaults={"class":"sticky-footer",frame:"",content:"#page"},$(t).load(function(){$("footer.sticky").stickyFooter()})}(jQuery,window);