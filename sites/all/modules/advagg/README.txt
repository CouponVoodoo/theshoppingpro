
----------------------------------
ADVANCED CSS/JS AGGREGATION MODULE
----------------------------------


CONTENTS OF THIS FILE
---------------------

 * Features & benefits
 * Configuration
 * JavaScript Bookmarklet
 * Technical Details & Hooks
 * nginx Configuration


FEATURES & BENEFITS
-------------------

Advanced CSS/JS Aggregation Core Module:
 * On demand generation of CSS/JS Aggregates. If the file doesn't exist it will
   be generated on demand.
 * Stampede protection for CSS and JS aggregation. Uses locking so multiple
   requests for the same thing will result in only one thread doing the work.
 * Fully cached CSS/JS assets allow for zero file I/O if the Aggregated file
   already exists. Results in better page generation performance.
 * Smarter aggregate deletion. CSS/JS aggregates only get removed from the
   folder if they have not been used/accessed in the last 30 days.
 * Smarter cache flushing. Scans all CSS/JS files that have been added to any
   aggregate; if that file has changed then flush the correct caches so the
   changes go out. The new name ensures changes go out when using CDNs.
 * Footer JS gets aggregated as well.
 * One can add JS to any region of the theme & have it aggregated.
 * Url query string to turn off aggregation for that request. ?advagg=0 will
   turn off file aggregation if the user has the "bypass advanced aggregation"
   permission. ?advagg=-1 will completely bypass all of Advanced CSS/JS
   Aggregations modules and submodules.
 * Button on the admin page for dropping a cookie that will turn off file
   aggregation. Useful for theme development.
 * Gzip support. All aggregated files can be pre-compressed into a .gz file and
   served from Apache. This is faster then gzipping the file on each request.

Advanced CSS/JS Aggregation Submodules:
 * CSS/JS CDN. Uses the Google Libraries API to serve jQuery & jQuery UI from
   the google CDN.
 * CSS/JS Compress. Can compress/minifiy files and inline CSS/JS.
 * Bundler. Given a target number of CSS/JS aggregates, this will try very hard
   to meet that goal. It smartly groups files together.
 * Modifier. Has various tweaks packaged up. Force preprocessing for all CSS/JS;
   move JS to footer; add defer tag to all JS; Inline all CSS/JS for given
   paths; and the use of a shared directory for a unified multisite.


CONFIGURATION
-------------

Settings page is located at:
admin/config/development/performance/advagg
**Global Options**
 * Enable Advanced Aggregation. You can disable the module here; same effect as
   placing ?advagg=-1 in the URL.
 * Create .gz files. For every Aggregated file generated, this will create a
   gzip version of that and then serve that out if the browser accepts gzip
   compression.
 * Use Cores Grouping Logic. Will group files just like core does.
 * Use HTTPRL to generate aggregates. If HTTPRL is installed, advagg will use it
   to generate aggregates on the fly in a background parallel process.
**CSS Options**
 * Combine CSS files by using media queries. Use cores grouping logic needs to
   be unchecked in order for this to work. Also noted is that due to an issue
   with IE9, compatibility mode is forced off if this is enabled.
 * Prevent more than 4095 CSS selectors in an aggregated CSS file. Internet
   Explorer before version 10; IE9, IE8, IE7, & IE6 all have 4095 as the limit
   for the maximum number of css selectors that can be in a file. Enabling this
   will prevent CSS aggregates from being created that exceed this limit.

Operations page is located at:
admin/config/development/performance/advagg/operations
 * Smart cache flush button. Scan all files referenced in aggregated files. If
   any of them have changed, increment the counters containing that file and
   rebuild the bundle.
 * Remove all stale files. Scan all files in the advagg_css/js directories and
   remove the ones that have not been accessed in the last 30 days.
 * Clear missing files from the database. Scan for missing files and remove the
   associated entries in the database.
 * Delete Unused Aggregates from the database. Delete aggregates that have not
   been accessed in the last 6 weeks.
 * Aggregation Bypass Cookie. This will set or remove a cookie that disables
   aggregation for the remainder of the browser session. It acts almost the same
   as adding ?advagg=0 to every URL.
 * Drastic Measures.
   * Clear all caches. Remove all data stored in the advagg cache bins.
   * Remove all generated files. Remove all files in the advagg_css/js
     directories.
   * Force new aggregates. Force the creation of all new aggregates by
     incrementing a global counter

Additional information is available at:
admin/config/development/performance/advagg/info
 * Hook theme info. Displays the process_html order. Used for debugging.
 * CSS files. Displays how often a file has changed.
 * JS files. Displays how often a file has changed.
 * Modules implementing advagg hooks. Lets you know what modules are using
   advagg.
 * AdvAgg CSS/JS hooks implemented by modules. Lets you know what advagg hooks
   are in use.
 * Hooks and variables used in hash. Show what is used to calculate the 3rd hash
   of an aggregates filename.


JAVASCRIPT BOOKMARKLET
----------------------

You can use this JS code as a bookmarklet for toggling the AdvAgg URL parameter.
See http://en.wikipedia.org/wiki/Bookmarklet for more details.

    javascript:(function(){var loc = document.location.href,qs = document.location.search,regex_off = /\&?advagg=-1/,goto = loc;if(qs.match(regex_off)) {goto = loc.replace(regex_off, '');} else {qs = qs ? qs + '&advagg=-1' : '?advagg=-1';goto = document.location.pathname + qs;}window.location = goto;})();


TECHNICAL DETAILS & HOOKS
-------------------------

Technical Details:
 * There are four database tables and two cache table used by advagg.
   advagg_schema documents what they are used for.
 * Files are generated by this pattern:

    css__[BASE64_HASH]__[BASE64_HASH]__[BASE64_HASH].css

   The first base64 hash value tells us what files are included in the
   aggregate. Changing what files get included will change this value.

   The second base64 hash value is used as a sort of version control; it changes
   if any of the base files contents have changed. Changing a base files content
   (like drupal.js) will change this value.

   The third base64 hash value records what settings were used when generating
   the aggregate. Changing a setting that affects how aggregates get built
   (like toggling "Create .gz files") will change this value.

Hooks:

Modify file contents.
 * advagg_get_css_file_contents_alter. Modify the data of each file before it
   gets glued together into the bigger aggregate. Useful for minification.
 * advagg_get_js_file_contents_alter. Modify the data of each file before it
   gets glued together into the bigger aggregate. Useful for minification.
 * advagg_get_css_aggregate_contents_alter. Modify the data of the complete
   aggregate before it gets written to a file. Useful for minification.
 * advagg_get_js_aggregate_contents_alter. Modify the data of the complete
   aggregate before it gets written to a file.Useful for minification.
 * advagg_save_aggregate. Modify the data of the complete aggregate allowing one
   create multiple files from one base file. Useful for gzip compression.

Modify file names and aggregate bundles.
 * advagg_current_hooks_hash_array_alter. Add in your own settings and hooks
   allowing one to modify the 3rd base64 hash in a filename.
 * advagg_build_aggregate_plans_alter. Regroup files into different aggregates.
 * advagg_css_groups_alter. Allow other modules to modify $css_groups right
   before it is processed.
 * advagg_js_groups_alter. Allow other modules to modify $js_groups right before
   it is processed.

Others.
 * advagg_hooks_implemented_alter. Tell advagg about other hooks related to
   advagg.
 * advagg_changed_files. Let other modules know about the changed files.
 * advagg_get_root_files_dir_alter. Allow other modules to alter css and js
   paths.
 * advagg_modify_css_pre_render_alter. Allow other modules to modify $children
   & $elements before they are rendered.
 * advagg_modify_js_pre_render_alter. Allow other modules to modify $children
   & $elements before they are rendered.


NGINX CONFIGURATION
-------------------

http://drupal.org/node/1116618

    ###
    ### advagg_css and advagg_js support
    ###
    location ~* files/advagg_(?:css|js)/ {
      access_log off;
      expires    max;
      add_header ETag "";
      add_header Cache-Control "max-age=290304000, no-transform, public";
      add_header Last-Modified "Wed, 20 Jan 1988 04:20:42 GMT";
      try_files  $uri @drupal;
    }
