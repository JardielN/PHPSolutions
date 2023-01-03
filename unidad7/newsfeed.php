<?php

$url = 'https://www.reforma.com/rss/portada.xml';
$feed = simplexml_load_file($url,'SimpleXMLIterator');

$filtered = new LimitIterator($feed->channel->item, 0, 4);

/*
foreach($filtered as $item){
    echo htmlentities($item->title) . '<br>';
}
*/

foreach($filtered as $item) { ?>
<h2><a href="<?=htmlentities($item->link)?>">
<?=htmlentities($item->title)?></a></h2>
<p class="datetime"><?php $date = new DateTime($item->pubDate);
echo $date->format('M j, Y, g:ia');?></p>
<p><?=htmlentities($item->description)?></p>
<?php } ?>