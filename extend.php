<?php

/*
 * A Flarum extension created by Mark Cutting.
 * Opens images in a Fancybox style lightbox
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * For instructions, please view the README file.
 */

 // Version 0.1.12

use Flarum\Extend;
use Flarum\Frontend\Document;

return [
    (new Extend\Frontend('forum'))
        ->content(function (Document $document) {
            $document->head[] = '<script defer type="text/javascript" src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>';
            $document->head[] = '<link rel="preload" as="style" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" onload="this.onload=null;this.rel=\'stylesheet\'">';
            $document->foot[] = <<<HTML
<script>
 flarum.core.compat.extend.extend(flarum.core.compat['components/CommentPost'].prototype, 'oncreate', function(output, vnode) {
  const self = this;
    $('.PostMeta-ip a img').addClass('geoip-flag');
    $('body img').not('.emoji').not(".Avatar").not(".geoip-flag").each(function ()
  {
   var currentImage = $(this);
   var checksrc = currentImage.attr("data-src");
if(checksrc) {
     $(this).wrap("<a class=\"fancybox\" href='" + currentImage.attr("data-src") + "'></a>");
	 }
else {
     $(this).wrap("<a class=\"fancybox\" href='" + currentImage.attr("src") + "'></a>");
}
$().fancybox({
    selector : '.fancybox'
});
  });
});
</script>
HTML;
        })
];
