(function(a){Drupal.behaviors.shortcutDrag={attach:function(b,c){if(Drupal.tableDrag){var d=a("table#shortcuts"),e=0,f=0,g=Drupal.tableDrag.shortcuts;a("> tbody > tr, > tr",d).filter(":visible").filter(":odd").filter(".odd").removeClass("odd").addClass("even").end().end().filter(":even").filter(".even").removeClass("even").addClass("odd").end().end().end().filter(".shortcut-slot-empty").each(function(b){a(this).is(":visible")&&e++,f++}),g.row.prototype.onSwap=function(b){var c=a(d).find("tr").index(a(d).find("tr.shortcut-status-disabled"))-f-2,i=0;a(d).find("tr.shortcut-status-enabled").nextAll(":not(.shortcut-slot-empty)").each(function(a){a<c&&i++});var j=f-i;if(j==-1){var k=a(d).find("tr.shortcut-status-disabled"),l=k.prevAll(":not(.shortcut-slot-empty)").not(a(this.element)).get(0);k.after(l);if(a(l).hasClass("draggable")){var m=new g.row(l,"mouse",self.indentEnabled,self.maxDepth,!0);m.markChanged(),h(m)}}else j!=e&&(j>e?(a(".shortcut-slot-empty:hidden:last").show(),e++):(a(".shortcut-slot-empty:visible:last").hide(),e--))},g.onDrop=function(){return h(this.rowObject),!0};function h(b){var c=a(b.element).prevAll("tr.shortcut-status").get(0),d=c.className.replace(/([^ ]+[ ]+)*shortcut-status-([^ ]+)([ ]+[^ ]+)*/,"$2"),e=a("select.shortcut-status-select",b.element);e.val(d)}g.restripeTable=function(){a("> tbody > tr:visible, > tr:visible",this.table).filter(":odd").filter(".odd").removeClass("odd").addClass("even").end().end().filter(":even").filter(".even").removeClass("even").addClass("odd")}}}},Drupal.behaviors.newSet={attach:function(b,c){var d=function(){a(a(this).parents("div.form-item").get(1)).find("> label > input").attr("checked","checked")};a("div.form-item-new input").focus(d).keyup(d)}}})(jQuery);