<?php 
if($_GET['cat'] != "" && $_GET['img'] != "")
{
	$path = dirname(__FILE__) . '/cykler/' . $_GET['cat'] . '/' . $_GET['img'];
	if (file_exists($path))
	{
		$size = getimagesize($file);
		header('Content-Type: '.$size['mime']);
		header('Content-Length: ' . filesize($path));
		echo readfile($path);
	}
}
else
{
$out = "";
$data = array();

foreach (new DirectoryIterator('cykler/') as $fileInfo) {
    if($fileInfo->isDot()) { continue; }
	
	if($fileInfo->isDir())
	{
		$out .="    {\"".$fileInfo->getFilename()."\" : \n    [\n";
		$cat = array();
		foreach (new DirectoryIterator('cykler/'.$fileInfo->getFilename().'/') as $category) {
			if($category->isDot()) { continue; }
			
			$out .= "      {\"url\": \"http://4pi.dk/playground/testjsondata/index.php?cat=".$fileInfo->getFilename()."&img=".$category->getFilename() . "\"},\n";
			array_push($cat, "url"=> "\"http://4pi.dk/playground/testjsondata/index.php?cat=".$fileInfo->getFilename()."&img=".$category->getFilename() . "\"";
		}
		$out = trim($out,",\n")."\n";
		$out .= "    ]\n    },\n";
		array_push($data,$cat);
	}
}
$out = trim($out,",\n");
header('Content-Type: application/json');
//echo "{\n  \"info\" : \n  [\n    {\"size\" : \"128x128\"}\n  ],\n  \"categories\" : \n  [\n".$out."\n  ]\n}";

echo print_r($data);
}
?>