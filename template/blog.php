<?php 
  function process_date($date){
    $unix_timestamp = strtotime($date);
    $day_week = date('D', $unix_timestamp);
    $date_serbian = date('d.m.Y H:i', $unix_timestamp);

    return 
      sprintf(
        '%s %s',
        $day_week,
        $date_serbian
      ); 
 }
 $rss_news_length = 5;
 $rss_update_frequency = 18000000;
 $rss_feed_local_filename = 'blog.xml';
 $current_time = time();
 $rss_last_update_time = @filemtime($rss_feed_local_filename);
 $time_elapsed = $current_time - $rss_last_update_time;

 if (file_exists($rss_feed_local_filename) && $time_elapsed < $rss_update_frequency){
   $rss = file_get_contents($rss_feed_local_filename);
 }
 else {
   $rss = file_get_contents('https://www.fastfoodmenuprices.com/feed/');
   file_put_contents($rss_feed_local_filename,$rss);
  }
    $xml = new SimpleXMLElement($rss);
?>

  <rss>
    <?php $i = 1; ?>
    <?php foreach ($xml->channel->item AS $article) : ?>
    <article>
      <naslov>
        <a href="<?= $article->link ?>" target="_blank">
            <?= $article->title ?>
        </a>
      </naslov>
      <datum><?= process_date($article->pubDate) ?></datum>
      <opis><?= $article->description ?></opis>
  </article>
     <?php $i++; ?>
    <?php if ($i > $rss_news_length) break;?>
   <?php endforeach; ?>    
  </rss>

