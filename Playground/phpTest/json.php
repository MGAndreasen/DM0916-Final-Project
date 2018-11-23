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
foreach (new DirectoryIterator('../data/cykler/') as $fileInfo) {
    if($fileInfo->isDot()) { continue; }
	
	if($fileInfo->isDir())
	{
		$out .="\"".$fileInfo->getFilename()."\" : {\n";
		foreach (new DirectoryIterator('../data/cykler/'.$fileInfo->getFilename().'/') as $category) {
			if($category->isDot()) { continue; }
			
			$out .= "\"url\": \"http://4pi.dk/tests/data/json.php?cat=".$fileInfo->getFilename()."&img=".$category->getFilename() . "\",\n";
		}
		$out = trim($out,",\n")."\n";
		$out .= "},\n";
	}
}
$out = trim($out,",\n");
echo "{\n".$out."\n}";
}
?>