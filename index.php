<?php
/**
 * Get all the currency options
 * 
 * @param $default
 * Selected currency
 * 
 * @return
 * Echo the select options
 */
function getCurrencyOptions($default){
	
	$currencies = getOpenExchangeRates('currencies.json');
	
	foreach($currencies as $k => $v){
		$selected = '';
		if($k == $default){
			$selected = "selected='selected'";
		}	
		echo '<option '.$selected.' value="'.$k.'">'.$v.'</option>';	
	}
}

/**
 * Make a call to the open exchange API
 * 
 * @param $filename
 * What data to collect
 * 
 * @return
 * JSON Data
 */
function getOpenExchangeRates($filename){
	
	if($filename == ""){ return false; }
	
	// Open CURL session:
	$ch = curl_init('http://openexchangerates.org/' . $filename);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	// Get the data:
	$json = curl_exec($ch);
	curl_close($ch);
	
	return json_decode($json);
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/core.css">
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>

<title>Convert Your Money</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="./js/money.js"></script>

<?php $exchangeRates = getOpenExchangeRates('latest.json'); ?>
<script type="text/javascript">
	fx.rates = <?php echo json_encode($exchangeRates->rates); ?>;
	fx.base = "<?php echo $exchangeRates->base; ?>";
</script>
<script src="./js/core.js"></script>

</head>
<body>

<section class="ad_container clearfix">
	<div id="influads_block" class="influads_block"> </div>
				<script type="text/javascript">(function(){ var acc =   "acc_523d560_pub";var st ="css";var or= "h";var e=document.getElementsByTagName("script")[0];var d=document.createElement("script");d.src=('https:' == document.location.protocol ?'https://' : 'http://') +"engine.influads.com/show/"+or+"/"+st+"/"+acc;d.type="text/javascript"; d.async=true; d.defer=true; e.parentNode.insertBefore(d,e);})();</script>
</section>

<section class="container">

<div class="form">
	<h3>Exchange Currency</h3> 
	
	<p>From</p>
	<p><input type="text" name="money" id="money" value="100" /><select id="country_from">
			<?php getCurrencyOptions("USD"); ?>
	</select></p>
	<p>To</p>
	<p> <input type="text" name="exchange_total" id="exchange_total" /><select id="country_to">
			<?php getCurrencyOptions("GBP"); ?>
	</select></p>
	<p> <input type="button" name="exchange" id="exchange" value="Exchange" /></p>
</div>

<p style="text-align: center;"><a href="https://twitter.com/paulund_" class="twitter-follow-button" data-show-count="true" data-lang="en">Follow @paulund_</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p>

<hr />

<p>Learn how to create this application @ <a href="http://www.paulund.co.uk/how-to-create-an-exchange-rate-money-converter-with-money-js">Money Converter Tutorial</a>.</p>

</section>

<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-8196211-5']);
_gaq.push(['_trackPageview']);
		
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
		
</script>

</body>
</html>