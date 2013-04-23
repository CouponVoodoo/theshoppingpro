<?php 
/**
 * @file
 * Alpha's theme implementation to display the basic html structure of a single
 * Drupal page.
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>

<head profile="<?php print $grddl_profile; ?>">
<?php if(arg(0)!='retailers-list' || arg(0)!='retailers-partners-list') { ?>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>

<body<?php print $attributes;?>>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
    <?php } else {?>
<body<?php //print $attributes;?>>


    <div style="padding-bottom:10px;width:100%;text-align:center">
            <span>
                <img style="" src="http://ec2-75-101-226-70.compute-1.amazonaws.com/images/The_Shopping_Pro_Logo-130px.png" />
                Beta
            </span>
            <div style=" text-align:center;  font-size:13px; background:#96CA4B; color:white; padding:5px;">
                <b>Best Price Index</b>
            </div>
            <div style="cursor:pointer;padding-left: 4px;padding-top: 2px;">
                <span style="float:left; padding-top: 6px;color:#00B7FF;">
                    <span href="#" onClick="feedback_widget.show()">Feedback Appreciated</span>
                </span>
                <span style="vertical-align:middle">
                    <img src="http://ec2-75-101-226-70.compute-1.amazonaws.com/images/smiley.png">
                </span>
            </div>
        </div>
        <div style=" height:530px; overflow:scroll;overflow-x:hidden;float:left;width:145px">
            <span style='width:100%; border-bottom:1px solid #CCCCCC; float:left; padding:2px '
                  onclick="javascript:window.open('<%# (((TSPLibrary.SOLRProduct)Container.DataItem).Link)%>&tspTitle=<%=title %>&tspPrice=<%=price %>')"
                  onmouseover="this.style.background='#E4e4e4'; this.style.cursor='pointer'" onmouseout="this.style.background='';  this.style.cursor='normal'">
                <table style="border-collapse:collapse">
                    <tr>
                        <td width='20%' style='vertical-align:middle'>

                            <img style='width:30px;height:30px;padding-right:2px; border:2px solid #CCCCCC' src="http://ec2-75-101-226-70.compute-1.amazonaws.com/images/no-image.png"/>
                        </td>
                        <td>
                            <table style="border-collapse:collapse">
                                <tbody >
                                    <tr>
                                        <td>
                                            <b style='background:#00B7FF;color:White; font-size:12px; padding:1px'>$100</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color:#00B7FF; font-size: 8px;">$500</td>
                                    </tr>
                                    <tr>
                                        <td style="color:#00B7FF; font-weight:bold; font-size:10px" >Author name</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr  style='' title='123'>
                        <td colspan="2"> <a style="cursor:pointer; font-size:10px">Product Title</a> </td>
                    </tr>

                </table>
            </span>

        </div>

    <?php print $page; ?>
<?php }?>
</body>
</body>
</html>