<?

$sitemap =  '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

$files = scandir('.');

foreach ($files as $key => $file) {
	global $sitemap;
 	if ($file != '.' && $file != '..' && $file != 'sitemap.xml' && strpos($file, 'sitemap') === 0) {
 		// echo($file)."\n\r";
 		// continue;
		$content = file_get_contents( $file);
		if(empty($content)) continue;
		// if(empty(preg_grep('/<urlset xmlns="http:\/\/www.sitemaps.org\/schemas\/sitemap\/0.9">/', [$content]))) continue;
		$content = str_replace('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', '', $content);
		$content = str_replace('</urlset>', '', $content);
		$sitemap .= $content;
		unlink($file);
 	}
 } 

$sitemap .= '</urlset>';

echo file_put_contents('sitemap.xml', $sitemap);