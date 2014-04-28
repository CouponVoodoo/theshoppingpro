<?php
echo "\n\n UPDATE LOCATION FOR BRAND \n\n".time();
db_query ("UPDATE coupon_finder.predictorCompiledResultTable SET coupon_finder.predictorCompiledResultTable.Brand_Loc = concat('taxonomy/term/',CAST(coupon_finder.predictorCompiledResultTable.BrandId as CHAR(50))) ");
echo "\n\n UPDATE LOCATION FOR CATEGORY \n\n".time();
db_query ("UPDATE coupon_finder.predictorCompiledResultTable SET coupon_finder.predictorCompiledResultTable.Category_Loc = concat('taxonomy/term/',CAST(coupon_finder.predictorCompiledResultTable.Category as CHAR(50))) ");
// brand sitemap update
echo "\n\n XML SITEMAP - LAST MODIFIED \n\n".time();
db_query ("UPDATE coupon_finder.xmlsitemap INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.Brand_Loc = coupon_finder.xmlsitemap.loc SET coupon_finder.xmlsitemap.lastmod = ".(time()+(4.5*3600)));
echo "\n\n XML SITEMAP - CHANGE FREQUENCY \n\n".time();
db_query ("UPDATE coupon_finder.xmlsitemap INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.Brand_Loc = coupon_finder.xmlsitemap.loc SET coupon_finder.xmlsitemap.changefreq = 86400 ");
// category sitemap update
echo "\n\n XML SITEMAP - LAST MODIFIED \n\n".time();
db_query ("UPDATE coupon_finder.xmlsitemap INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.Category_Loc = coupon_finder.xmlsitemap.loc SET coupon_finder.xmlsitemap.lastmod = ".(time()+(4.5*3600)));
echo "\n\n XML SITEMAP - CHANGE FREQUENCY \n\n".time();
db_query ("UPDATE coupon_finder.xmlsitemap INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.Category_Loc = coupon_finder.xmlsitemap.loc SET coupon_finder.xmlsitemap.changefreq = 86400 ");
?>