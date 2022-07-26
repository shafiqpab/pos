<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Highcharts lib examples</title>
	<style type="text/css">
		a, a:link, a:visited {
			color: #444;
			text-decoration: none;
		}
		a:hover {
			color: #000;
		}
		.left {
			float: left;
		}
		#menu {
			width: 20%;
		}
		#g_render {
			width: 80%;
		}
		li {
			margin-bottom: 1em;
		}
	</style>
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
	<script type="text/javascript">
		google.load("jquery", "1.4.4");
	</script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/chart/highcharts.js"></script>
</head>
<body>
	<div id="menu" class="left">
		<ol>
			<li><?php echo anchor($home, 'basic example')?></li>
			<li><?php echo anchor($home.'categories', 'Advanced example')?></li>
			<li><?php echo anchor($home.'template', 'Options from template file')?></li>
			<li><?php echo anchor($home.'active_record', 'multiples chart and Database result')?></li>
			<li><?php echo anchor($home.'pie', 'Pie grah with callback functions')?></li>
			<li><?php echo anchor($home.'data_get', 'outputing json or array')?></li>
		</ol>
	</div>

	<div id="g_render"  class="left">
		<?php if (isset($charts)) echo $charts; ?>
		<?php if (isset($json)): ?>
			<h3>Json string output: associative array with global options and 'local options' (for each graph)</h3>
			<pre><?php echo print_r($json); ?></pre>
		<?php endif; if (isset($array)): ?>
			<h3>Array output: associative array with global options and 'local options' (for each graph)</h3>
			<pre><?php echo print_r($array); ?></pre>
		<?php endif; ?>
	</div>
	<div id="my_div"></div>
</body>
</html>