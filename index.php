<?php
$id = "";//Your steamidgoes here
$query = "http://steamcommunity.com/profiles/".$id."/inventory/json/440/2/";
$json = file_get_contents($query);
$data = json_decode($json, true);

if(!$data) {
	$id = false;
	exit();
}

$items = $data["rgDescriptions"];
?>
<!DOCTYPE html>
<html>
	<head>

		<meta charset="utf-8">

		<style>
		@import url(http://fonts.googleapis.com/css?family=Open+Sans);

		body {
			background-color: #1b2838;
			color: white;
			font-family: "Open Sans";
			text-align: center;
		}

		a {
			color: inherit !important;
		}

		h1 {
			text-align: center;
			font-size: 4em;
		}

		strong {
			font-size: 1.5em;
		}

		section#items {
			width: 80%;
			margin-left: 10%;
			text-align: center;
			background-color: rgba(0, 0, 0, 0.4);
			box-shadow: 0 0 14px #030303 inset;
		}

		.item {
			width: 18%;
			margin: 5px;
			transition: 0.2s opacity;
		}

		.item:hover {
			opacity: 0.5;
		}

		.item.stattrack {
			border: 5px solid orange;
			border-radius: 5px;
		}
		</style>

	</head>
	<body>
<?php
foreach($items as $item) {
	$image_url = "http://cdn.steamcommunity.com/economy/image/";

	if($item["icon_url"]) {
		$image_url = "http://cdn.steamcommunity.com/economy/image/".$item["icon_url"];
	}
	$classid = $item['classid'];
	$defindex = $item['app_data']['def_index'];
	$flag_cannot_trade = $item['tradable'];
	$flag_cannot_trade = getTradable($flag_cannot_trade);
	$quality = $item['app_data']['quality'];
	$quality = getQuality($quality);
	?>
	<a href="https://steamcommunity.com/profiles/<?PHP echo $_SESSION['steamid']?>/inventory/#440_2_<?PHP echo $classid?>"class="card <?PHP echo $quality?> <?PHP echo $flag_cannot_trade?>" style="width:100px">
			<img class="card-img-top imagery <?PHP echo $defindex?>" src="<?PHP echo $image_url?>" alt="Card image"/>
<div class="card bg-info" style="font-size:20px"></div></a> 
<?PHP
}
	function getTradable($flag_cannot_trade)
   	{
		if ($flag_cannot_trade == 0)
            return "Not_Tradable";
		}
    function getQuality($quality)
    {
        if ($quality == 1)
            return "Genuine";
        if ($quality == 3)
            return "Vintage";
        if ($quality == 5)
            return "Unusual";
        if ($quality == 6)
            return "Unique";
        if ($quality == 7)
            return "Community";
        if ($quality == 9)
            return "Self-Made";
        if ($quality == 11)
            return "Strange";
        if ($quality == 13)
            return "Haunted";
		if ($quality == 13)
			return "Normal";		
		if ($quality == 13)
			return "Collectors";
		if ($quality == 13)
			return "Decorated";
		if ($quality == 13)
			return "Valve";
    }
?>
		</section>
	</body>
</html>
