<?php
App::uses('AppHelper', 'View/Helper');

class SBHelper extends AppHelper {

	public function parseImages($content = null) {
		preg_match_all('/src="cid:(.*)"/Uims', $content['html'], $matches);

        if(count($matches)) {
            $search = array();
            $replace = array();

            foreach($matches[1] as $match) {
                $search[] = "src=\"cid:$match\"";
                
                foreach($content['attachments'] as $attachments) {
                    $cid = $attachments['cid'];
                    $origPhoto = $attachments['url']['original'];
                }
                
                if($cid==$match) {
                    $replace[] = "src=\"{$origPhoto}\"";
                }
            }

            echo str_replace($search, $replace, $content['html']);
        }
	}

}