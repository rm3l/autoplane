<?
	$data = file_get_contents('./FullyAutonomousPlane.php');
	//$data = '<h4><a name="h.q1bruwdzuxdj"></a><span>RPI</span></h4>';
	file_put_contents('docs.php',
		preg_replace('/<h(.)><a name="h.([a-zA-z0-9]*)"><\/a><span>(.{0,60})<\/span><\/h(.)>/',
				PHP_EOL.'<h$1><a href="#h.$2" name="h.$2">$3</a></h$1>',$data
			)
		);
?>
