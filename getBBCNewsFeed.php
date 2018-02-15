<?php
	function getFeed($feed_url) {
	     
	    $content = file_get_contents($feed_url);
	    $x = new SimpleXmlElement($content);
	    foreach($x->channel->item as $entry) {
	        $title = $entry->title;
	        $description = $entry->description;
			$media = $entry->children('media', 'http://search.yahoo.com/mrss/');
			foreach($media->thumbnail as $thumb) {
				$img = $thumb->attributes()->url;
			}
	        break;
	    }
	    return array("title"=>$title, "description"=>$description, "img"=>$img);
	}
?>