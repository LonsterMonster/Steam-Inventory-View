# csgo

[![GitHub issues](https://img.shields.io/github/issues-raw/montyanderson/csgo.svg)](https://github.com/montyanderson/csgo/issues)
![GitHub stars](https://img.shields.io/github/stars/montyanderson/csgo.svg?style=social&label=Star)

A php-powered web page that shows a Steam user's Counter Strike: Global Offensive items.

## Hacking / Changing

To use a different Steam game for the inventory, simple change the app id on line 3.

``` php
<?php
// Change
$query = "http://steamcommunity.com/id/".$id."/inventory/json/730/2/";
// to
$query = "http://steamcommunity.com/id/".$id."/inventory/json/440/2/";
```

![](https://i.imgur.com/28V8NWr.png)

## Helper Function

``` php
<?php

$id = $_SESSION['steamid']; //Steamid Goes Here
$query = "http://steamcommunity.com/profiles/".$id."/inventory/json/440/2/";
$json = file_get_contents($query);
$data = json_decode($json, true);

```

## Steam API Example

``` php
<?php
// Steam ID of user
$id = "76561198076819824";

// Get JSON Data from Steam API
$json = file_get_contents("http://steamcommunity.com/id/".$id."/inventory/json/730/2/");

// Convert JSON string to array
$data = json_decode($json, true);

// Get the array of items
$items = $data["rgDescriptions"];

// Log a list of the items
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
	$craftable = $item['descriptions'][7]['value'];
	$craftable = getCraftable($craftable);
	?>
	<a href="https://steamcommunity.com/profiles/<?PHP echo $_SESSION['steamid']?>/inventory/#440_2_<?PHP echo $classid?>"class="card <?PHP echo $quality?> <?PHP echo $flag_cannot_trade?>" style="width:100px">
			<img class="card-img-top imagery <?PHP echo $defindex?>" src="<?PHP echo $image_url?>" alt="Card image"/>
<div class="card bg-info" style="font-size:20px"></div></a> 
<?PHP
}
	function getCraftable($craftable)
    {
		if($craftable == "( Not Usable in Crafting )")
			return "Not_Craftable";
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
```

### $item

In the example, you can use any of the following attributes.

``` php
<?php

// Instead of
foreach($items as $item) {
    echo $item["name"] . "<br>";
}

// You could use
foreach($items as $item) {
    echo "<img src='http://cdn.steamcommunity.com/economy/image/" . $item["icon_url_large"] . "'><br>";
}

// Please note that images must have "http://cdn.steamcommunity.com/economy/image/" prepended before $item["icon_url_large"]
```

```
appid
classid
instanceid
icon_url
icon_url_large
icon_drag_url
name
market_hash_name
market_name
name_color
background_color
type
tradable
marketable
commodity
market_tradable_restriction
descriptions
actions
market_actions
tags
```
