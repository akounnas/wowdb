<?php
// Initialize the session
session_start();

require_once "authedication.php";
 
// Check if the user is logged in, if not then redirect him to login page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $loggedin = true;
}else{
	$loggedin = false;
}

// Include config file
require_once "config.php";


	//Here initialize the variables and arrays for the query system.
	$name = $ilvlMin = $ilvlMax = $lvlMin = $lvlMax = $slot = $type = $quality = "NULL";
	$cnt = 0;
	$res_name = $iLvl = $lvl = $res_slot = $res_type = $img = $res_quality = $res_stam = $res_str = $res_agi = $res_intel = $res_crit = $res_has = $res_mas = $res_ves = $res_sp = $res_eq = $res_damage = $res_desc = $res_bind = [];
	
	if(isset($_POST["apply"]) or isset($_POST["nav_apply"])  or isset($_POST["nav_apply_type"])){//This trigger if the apply buttons are pressed.
		//This choice operation checks the input informations if they are empty or not.
		if(empty($_POST['name'])){
			$name = "NULL";
		}else{
			$name = $_POST['name'];
		}
		
		if(empty($_POST['ilvlmin'])){
			$ilvlMin = "NULL";
		}else{
			$ilvlMin = $_POST['ilvlmin'];
		}
		
		if(empty($_POST['ilvlmax'])){
			$ilvlMax = "NULL";
		}else{
			$ilvlMax = $_POST['ilvlmax'];
		}
		
		if(empty($_POST['lvlmin'])){
			$lvlMin = "NULL";
		}else{
			$lvlMin = $_POST['lvlmin'];
		}
		
		if(empty($_POST['lvlmax'])){
			$lvlMax = "NULL";
		}else{
			$lvlMax = $_POST['lvlmax'];
		}
		
		if(empty($_POST['quality'])){
			$quality = "NULL";
		}else{
			$quality = $_POST['quality'];
		}
		
		if(empty($_POST['slot'])){
			$slot = "NULL";
		}
		else{
			$slot = $_POST['slot'];
		}
		
		if(empty($_POST['type'])){
			$type = "NULL";
		}else{
			$type = $_POST['type'];
		}

		if(!empty($_POST['nav_apply'])){
			$slot = $_POST['nav_apply'];
		}
		
		if(!empty($_POST['nav_apply_type'])){
			$type = $_POST['nav_apply_type'];
		}
			//This choice operation is to trigger the right query if the choices of the form are more than one.
			if($slot != "NULL" && $quality != "NULL" && $type != "NULL"){ //This trigger if the slot, quality and type are selected.
				if($name == "NULL"){
					$name = "";
				}
				$query = "SELECT items.name, slots.name as 'slot', items.ilvl, items.lvl, type.name as 'type' , items.image, quality.name as 'quality', items.stamina, items.strength, items.agility, 
					items.intellect, items.critical, items.haste, items.mastery, items.versatility, items.sellprice, items.equip, items.damage, items.description, binds.name as bind FROM items
					LEFT JOIN slots ON items.slot = slots.id
					LEFT JOIN type ON items.type = type.id
					LEFT JOIN quality ON items.quality = quality.id
					LEFT JOIN binds ON items.bind = binds.id
					LEFT JOIN category ON items.category = category.id
					WHERE  (items.name LIKE '%{$name}%') AND 
					(slots.name = '{$slot}') 
					AND (quality.name = '{$quality}') AND (type.name = '{$type}') AND items.category = 'Weapon'
					ORDER BY items.name;";
			}elseif($slot != "NULL" && $quality != "NULL"){//This trigger if slot and quality are selected.
				if($name == "NULL"){
					$name = "";
				}
				$query = "SELECT items.name, slots.name as 'slot', items.ilvl, items.lvl, type.name as 'type' , items.image, quality.name as 'quality', items.stamina, items.strength, items.agility, 
					items.intellect, items.critical, items.haste, items.mastery, items.versatility, items.sellprice, items.equip, items.damage, items.description, binds.name as bind FROM items
					LEFT JOIN slots ON items.slot = slots.id
					LEFT JOIN type ON items.type = type.id
					LEFT JOIN quality ON items.quality = quality.id
					LEFT JOIN binds ON items.bind = binds.id
					LEFT JOIN category ON items.category = category.id
					WHERE  (items.name LIKE '%{$name}%') AND 
					(slots.name = '{$slot}') 
					AND (quality.name = '{$quality}') AND items.category = 'Weapon'
					ORDER BY items.name;";
			}elseif($slot != "NULL" && $type != "NULL"){//This trigger if slot and type are selected.
				if($name == "NULL"){
					$name = "";
				}
				$query = "SELECT items.name, slots.name as 'slot', items.ilvl, items.lvl, type.name as 'type' , items.image, quality.name as 'quality', items.stamina, items.strength, items.agility, 
					items.intellect, items.critical, items.haste, items.mastery, items.versatility, items.sellprice, items.equip, items.damage, items.description, binds.name as bind FROM items
					LEFT JOIN slots ON items.slot = slots.id
					LEFT JOIN type ON items.type = type.id
					LEFT JOIN quality ON items.quality = quality.id
					LEFT JOIN binds ON items.bind = binds.id
					LEFT JOIN category ON items.category = category.id
					WHERE  (items.name LIKE '%{$name}%') AND 
					(slots.name = '{$slot}') 
					AND (type.name = '{$type}') AND items.category = 'Weapon'
					ORDER BY items.name;";
			}elseif($quality != "NULL" && $type != "NULL"){//This trigger if quality and type are selected.
				if($name == "NULL"){
					$name = "";
				}
				$query = "SELECT items.name, slots.name as 'slot', items.ilvl, items.lvl, type.name as 'type' , items.image, quality.name as 'quality', items.stamina, items.strength, items.agility, 
					items.intellect, items.critical, items.haste, items.mastery, items.versatility, items.sellprice, items.equip, items.damage, items.description, binds.name as bind FROM items
					LEFT JOIN slots ON items.slot = slots.id
					LEFT JOIN type ON items.type = type.id
					LEFT JOIN quality ON items.quality = quality.id
					LEFT JOIN binds ON items.bind = binds.id
					LEFT JOIN category ON items.category = category.id
					WHERE  (items.name LIKE '%{$name}%') AND 
					(quality.name = '{$quality}') 
					AND (type.name = '{$type}') AND items.category = 'Weapon'
					ORDER BY items.name;";
			}
			else{//And finally if has one choice has selected and we don't know which is.
		
					$query = "SELECT items.name, slots.name as 'slot', items.ilvl, items.lvl, type.name as 'type' , items.image, quality.name as 'quality', items.stamina, items.strength, items.agility, 
					items.intellect, items.critical, items.haste, items.mastery, items.versatility, items.sellprice, items.equip, items.damage, items.description, binds.name as bind FROM items
					LEFT JOIN slots ON items.slot = slots.id
					LEFT JOIN type ON items.type = type.id
					LEFT JOIN quality ON items.quality = quality.id
					LEFT JOIN binds ON items.bind = binds.id
					LEFT JOIN category ON items.category = category.id
					WHERE  (items.name LIKE '%{$name}%') OR 
					((items.ilvl >= '{$ilvlMin}') AND (items.ilvl <= '{$ilvlMax}')) OR ((items.lvl >= '{$lvlMin}') AND (items.lvl <= '{$lvlMax}')) OR (slots.name = '{$slot}') OR (type.name = '{$type}')
					OR (quality.name = '{$quality}') AND items.category = 'Weapon'
					ORDER BY items.name;";
			}
		
		$result = mysqli_query($link, $query);//Run the query in database
		
		if($result){//Take the result of the query and association in arrays.
			while($query_executed = mysqli_fetch_assoc($result)){
				$res_name[$cnt] = $query_executed["name"];
				$iLvl[$cnt] = $query_executed["ilvl"];
				$lvl[$cnt] = $query_executed["lvl"];
				$res_slot[$cnt] = $query_executed["slot"];
				$res_type[$cnt] = $query_executed["type"];
				$img[$cnt] = $query_executed["image"];
				$res_quality[$cnt] = $query_executed["quality"];
				$res_stam[$cnt]  = $query_executed["stamina"];
				$res_str[$cnt]  = $query_executed["strength"];
				$res_agi[$cnt]  = $query_executed["agility"];
				$res_intel[$cnt]  = $query_executed["intellect"];
				$res_crit[$cnt]  = $query_executed["critical"];
				$res_has[$cnt]  = $query_executed["haste"];
				$res_mas[$cnt]  = $query_executed["mastery"];
				$res_ves[$cnt]  = $query_executed["versatility"];
				$res_sp[$cnt]  = $query_executed["sellprice"];
				$res_eq[$cnt]  = $query_executed["equip"];
				$res_damage[$cnt]  = $query_executed["damage"];
				$res_desc[$cnt] = $query_executed["description"];
				$res_bind[$cnt] = $query_executed["bind"];
				$cnt++;
			}
		}else{
			die("Problem with query". mysqli_error());
		}
		
		mysqli_close($link);//Close connection with database.
		
	}
	
	if(isset($_POST["reset"])){//On form reset empty variables and refresh site.
		$name = $ilvlMin = $ilvlMax = $lvlMin = $lvlMax = $slot = $type = $quality = "NULL";
	}
 
?>

<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
	
	<script src="assets/jquery-3.3.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="assets/jquery-ui.css">
	<script src="assets/jquery-ui.min.js"></script>
	<script src="assets/popper.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<link rel="icon" href="IMG/icon.ico">
<!--	<link rel="stylesheet" type="text/css" href="style.css?version=51"/> -->
	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );   //This JS script allow to clear the saved data and block submit data in database after Refresh.
    }
</script>
<title>WoW Database Armory</title>
</head>

<body>
	
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-between" >
		<ul class="navbar-nav">
			<li>
				<a class="navbar-brand" href="index.php">
					<img src="IMG/system.png" alt="" style="width: 50px;">
				</a>
			</li>
			<li class="nav-item dropdown">
			<form class="mb-1 mr-sm-1" method="post" action="Classes.php">
			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Classes</a>
			<div class="dropdown-menu">
				<div class='form-inline'>
					<img src="IMG/Death Knight.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Death Knight" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Demon Hunter.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Demon Hunter" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Druid.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Druid" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Hunter.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Hunter" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Mage.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Mage" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Monk.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Monk" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Paladin.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Paladin" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Priest.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Priest" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Rogue.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Rogue" style="margin-top: -24px; cursor: pointer;" >
				</div>
				<div class='form-inline'>
					<img src="IMG/Shaman.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Shaman" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Warlock.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Warlock" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Warrior.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Warrior" style="margin-top: -24px; cursor: pointer;">
				</div>
			</form>
			</li>
			<li class="nav-item dropdown">
			<form class="mb-1 mr-sm-1" method="post" action="Races.php">
			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Races</a>
			<div class="dropdown-menu">
						<p class="dropdown-item mb-1" style="color: blue;"><strong>Alliance</strong></p>
						<div class='form-inline'>
							<img src="IMG/darkirondwarf_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Dark Iron Dwarf" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/draenei_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Draenei" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/dwarf_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Dwarf" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/gnome_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Gnome" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/human_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Human" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/default.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Kul Tiran" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/lightforgeddraenei_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="LightForged Draenei" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/nightelf_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Night Elf" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/voidelf_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Void Elf" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/worgen_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Worgen" style="margin-top: -24px; cursor: pointer;">
						</div>
	
						<p class="dropdown-item mb-1" style="color: red;"><strong>Horde</strong></p>
						<div class='form-inline'>
							<img src="IMG/bloodelf_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Blood Elf" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/goblin_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Goblin" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/highmountaintauren_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Highmountain Tauren" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/magharorc_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Maghar Orc" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/nightborne_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Nightborne" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/orc_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Orc" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/tauren_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Tauren" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/troll_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Troll" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/scourge_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Undead" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/default.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Zandalari Troll" style="margin-top: -24px; cursor: pointer;">
						</div>
					
						<p class="dropdown-item mb-1" style="color: green;"><strong>Neutral</strong></p>
						<div class='form-inline'>
							<img src="IMG/pandaren_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Pandaren" style="margin-top: -24px; cursor: pointer;">
						</div>
				
						
			</div>
			</form>
			</li>
			<li class="nav-item dropdown">
			<form class="mb-1 mr-sm-1" method="post" action="Armor.php">
			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
				Armor Slot
			</a>
			
			<div class="dropdown-menu">
			
			
			<input type="submit" class="dropdown-item" name="nav_apply" value="Head"  style="cursor: pointer;"/>
				<input type="submit" class="dropdown-item" name="nav_apply" value="Shoulders" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Chest" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Tabard" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Waist" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Wrist" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Hands" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Legs" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Feet" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Ring" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Trinket" style="cursor: pointer;">
			</div>
			
			
			
			</form>
			</li>
			<li class="nav-item dropdown">
			<form class="mb-1 mr-sm-1" method="post" action="Armor.php">
			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
				Armor Class
			</a>
			<div class="dropdown-menu">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Cloth"  style="cursor: pointer;"/>
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Leather" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Mail" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Plate" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Jewelry" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Miscellaneous" style="cursor: pointer;">
			</div>
			</form>
			</li>
			<li class="nav-item dropdown">
			
			<form class="mb-1 mr-sm-1" method="post" action="Weapon.php">
			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
				Weapons Slot
			</a>
			<div class="dropdown-menu">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Main Hand" style="cursor: pointer;"/>
				<input type="submit" class="dropdown-item" name="nav_apply" value="Off Hand" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="One Hand" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Range" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Thrown" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Two Hand" style="cursor: pointer;">
			</div>
			</form>
			</li>
			
			<li class="nav-item dropdown">
			<form class="mb-1 mr-sm-1" method="post" action="Weapon.php">
			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
				Weapons Class
			</a>
			
			<div class="dropdown-menu">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="1h Sword" style="cursor: pointer;"/>
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="2h Sword" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="1h Axe" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="2h Axe" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="1h Mace" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="2h Mace" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Staff" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Dagger" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Warglaive" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Fist" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Wand" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Bow" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Crossbow" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Thrown" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Gun" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Miscellaneous" style="cursor: pointer;">
			</div>
			</form>
			</li>
			
			
			<li class="nav-item dropdown">
			<form class="mb-1 mr-sm-1" method="post" action="Raids.php">
			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
				Raids
			</a>
			<div class="dropdown-menu">
				<p class="dropdown-item mb-1"><strong>Battle For Azeroth</strong></p>
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Crucible Of Storms" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Battle Of Dazaralor" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Uldir" style="cursor: pointer;">
			</div>
			</form>
			</li>
			<li class="nav-item ">
			<a class="nav-link " href="World.php">The World</a>
			</li>
			<?php
			if($loggedin){
				echo"<li class='nav-item '>
				<a class='nav-link ' href='Profile.php'> <img src='".$_SESSION["image"] ."' style='width: 10%;' class='rounded-circle'> "; echo htmlspecialchars($_SESSION["username"]); echo"</a>
				</li>";
			}else{
			echo "<li class='nav-item dropdown'>
			
			<a class='nav-link dropdown-toggle' href='#' id='navbardrop' data-toggle='dropdown'>Log In</a>
			<div class='dropdown-menu' style='min-width: 450px; padding: 15px 25px;'>
				
						<form class='form-horizontal' method='post' action='Login.php'  >
							<h4>Sign In</h4>
							<div class='form-group'>
								<label for='username'>Username:</label>
								<input type='text' class='form-control ' name='username' id='username' >
							</div>
							<div class='form-group'>
								<label for='pwd'>Username:</label>
								<input type='password' class='form-control' name='password' id='pwd'>
							</div>
							<div class='form-group form-check'>
								<label class='form-check-label'>
								<input class='form-check-input ' name='remember' type='checkbox'> Remember me
								</label>
							</div>
							<input type='submit' name='submit' class='btn btn-primary'>
						</form>
				<p>If you don't have an account <a href='Register.php'>Register</a></p>
				<p>If you forget your password <a href='Reset-Password.php'>Resset Password</a></p>
		</div>
			
			</li>";
			}
			?>
		</ul>
		<form class="form-inline mb-1 mr-sm-1">
			<input class="form-control mr-sm-2" type="search" placeholder="Search by item name" aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
		</form>
	</nav>
	
	<div class="container-fluid" id="cont_margin">
	<div class="container-fluid">
    <div class="row">
      <div class="col-sm-4 bg-secondary">
       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div class="form-inline" style="padding-top: 10px;">
				<label for="name" style="padding-right: 35px;">Name:</label>
				<input type="text" class="form-control mb-2 mr-sm-2" id="name" placeholder="" name="name">
			</div>
			<div class="form-inline">
				<label for="range" style="padding-right: 10px;">Item level:</label>
				<input type="text" class="form-control mb-2 mr-sm-3" id="range" placeholder="" name="ilvlmin" size="2" maxlength="3">
				<p class="mb-2 mr-sm-3">-</p>
				<input type="text" class="form-control mb-2 mr-sm-2" id="range" placeholder="" name="ilvlmax" size="2" maxlength="3">
			</div>
			<div class="form-inline">
				<label for="range" style="padding-right: 45px;">level:</label>
				<input type="text" class="form-control mb-2 mr-sm-3" id="range" placeholder="" name="lvlmin" size="2" maxlength="3">
				<p class="mb-2 mr-sm-3">-</p>
				<input type="text" class="form-control mb-2 mr-sm-2" id="range" placeholder="" name="lvlmax" size="2" maxlength="3">
			</div>
			<div class="form-inline">
				<label for="Types" style="padding-right: 45px;">Type:</label>
				<select name="type" class="custom-select mb-2 mr-sm-4"  >
					<option <?php if($type == "NULL"){ echo "selected ";} ?> value ="">None</option>
					<option <?php if($type == "1h Sword"){ echo "selected ";} ?> value="1h Sword">1h Sword</option>
					<option <?php if($type == "2h Sword"){ echo "selected ";} ?> value="2h Sword">2h Sword</option>
					<option <?php if($type == "1h Axe"){ echo "selected ";} ?> value="1h Axe">1h Axe</option>
					<option <?php if($type == "2h Axe"){ echo "selected ";} ?> value="2h Axe">2h Axe</option>
					<option <?php if($type == "1h Mace"){ echo "selected ";} ?> value="1h Mace">1h Mace</option>
					<option <?php if($type == "2h Mace"){ echo "selected ";} ?> value="2h Mace">2h Mace</option>
					<option <?php if($type == "Staff"){ echo "selected ";} ?> value="Staff">Staff</option>
					<option <?php if($type == "Dagger"){ echo "selected ";} ?> value="Dagger">Dagger</option>
					<option <?php if($type == "Warglaive"){ echo "selected ";} ?> value="Warglaive">Warglaive</option>
					<option <?php if($type == "Polearm"){ echo "selected ";} ?> value="Polearm">Polearm</option>
					<option <?php if($type == "Fist"){ echo "selected ";} ?> value="Fist">Fist</option>
					<option <?php if($type == "Wand"){ echo "selected ";} ?> value="Wand">Wand</option>
					<option <?php if($type == "Bow"){ echo "selected ";} ?> value="Bow">Bow</option>
					<option <?php if($type == "Crossbow"){ echo "selected ";} ?> value="Crossbow">Crossbow</option>
					<option <?php if($type == "Thrown"){ echo "selected ";} ?> value="Thrown">Thrown</option>
					<option <?php if($type == "Gun"){ echo "selected ";} ?> value="Gun">Gun</option>
					<option <?php if($type == "Miscellaneous"){ echo "selected ";} ?> value="Miscellaneous">Miscellaneous</option>
				  </select>
			</div>
			<div class="form-inline">
				<label for="Slot" style="padding-right: 45px;">Slots:</label>
				<select name="slot" class="custom-select mb-2 mr-sm-4" >
					<option <?php if($slot == "NULL"){ echo "selected ";} ?> value ="">None</option>
					<option <?php if($slot == "Main Hand"){ echo "selected ";}?> value="Main Hand">Main Hand</option>
					<option <?php if($slot == "Off Hand"){ echo "selected ";}?> value="Off Hand">Off Hand</option>
					<option <?php if($slot == "One Hand"){ echo "selected ";}?> value="One Hand">One Hand</option>
					<option <?php if($slot == "Range"){ echo "selected ";}?> value="Range">Range</option>
					<option <?php if($slot == "Thrown"){ echo "selected ";}?> value="Thrown">Thrown</option>
					<option <?php if($slot == "Two Hand"){ echo "selected ";}?> value="Two Hand">Two Hand</option>
				  </select>
			</div>
			<div class="form-inline">
				<label for="Quality" style="padding-right: 28px;">Quality:</label>
				<select name="quality" class="custom-select mb-2 mr-sm-4 bg-dark  ">
					<option <?php if($quality == "NULL"){ echo "selected ";}?> value ="">None</option>
					<option <?php if($quality == "Poor"){ echo "selected ";}?> value="Poor" >Poor</option>
					<option <?php if($quality == "Common"){ echo "selected ";}?> value="Common" class="white-color">Common</option>
					<option <?php if($quality == "Uncommon"){ echo "selected ";}?> value="Uncommon" class="green-color">Uncommon</option>
					<option <?php if($quality == "Rare"){ echo "selected ";}?> value="Rare" class="blue-color">Rare</option>
					<option <?php if($quality == "Epic"){ echo "selected ";}?> value="Epic" class="purple-color">Epic</option>
					<option <?php if($quality == "Legendary"){ echo "selected ";}?> value="Legendary" class="orange-color">Legendary</option>
				  </select>
			</div>
	
				<button type="submit" name="apply" class="btn btn-danger">Apply</button>
				<button type="submit" class="btn btn-light" name="reset">Reset</button>
		</form>
      </div>
	  <div class="col-xl bg-secondary">
	  </div>
	  
	  <div class="main_conteiner"> <!--Main Conteiner of the page -->
		<div class="container-fluid">
			<div class="row">
					<div class="col-sm-3 bg-dark"><p class="white-color">Name</p></div>
					<div class="col  bg-dark"><p class="white-color">iLvl</p></div>
					<div class="col  bg-dark"><p class="white-color">Req.</p></div>
					<div class="col  bg-dark"><p class="white-color">Slot</p></div>	
					<div class="col  bg-dark"><p class="white-color">Type</p></div>	
			</div>
		</div>
		<?php
		//Here take the count of the items that return from base and start to print the result in the site.
		$length = count($res_name);
		$color_name = "";
		for($i = 0; $i < $length; $i++){
			
			//This choice operation select the correct text color depend from quality of the items.
			if($res_quality[$i] == "Epic"){
				$color_name = "purple-color";
			}elseif($res_quality[$i] === "Rare"){
				$color_name = "blue-color ";
		}elseif($res_quality[$i] === "Legendary"){
				$color_name = "orange-color ";
		}elseif($res_quality[$i] === "Common"){
				$color_name = "white-color ";
		}elseif($res_quality[$i] === "Uncommon"){
				$color_name = "green-color";
		}
		
		//Here initialize the if the main stat is Strength, Agility or Intellect.
		$main_stat = "";
			if(!empty($res_str[$i])){
				$main_stat = "+" . $res_str[$i] . " " . "Strength";
			}elseif(!empty($res_agi[$i])){
				$main_stat = "+" . $res_agi[$i] . " " . "Agility";
			}elseif(!empty($res_intel[$i])){
				$main_stat = "+" . $res_intel[$i] . " " . "Intellect";
			}
			
			//And finally here print the results.
		echo "<div class='container-fluid'>
			<div class='row'>
					<div class='col-sm-3 item-list '><p>
					<img style='float: left;' src='$img[$i]'/> <p data-toggle='collapse' data-target='#demo[$i]'class=$color_name style='cursor: pointer;'>$res_name[$i]</p>
					</p></div>
					<div class='col  item-list'><p class='white-color'>
						$iLvl[$i]
					</p></div>
					<div class='col  item-list'><p class='white-color'>
						$lvl[$i]
					</p></div>
					<div class='col  item-list'><p class='white-color'>
						$res_slot[$i]
					</p></div>
					<div class='col  item-list'><p class='white-color'>
						$res_type[$i]
					</p></div>					
			</div>
			</div>
			
	<div id='demo[$i]' class='collapse'>
    <div class='container-fluid'>
    <div class='row'>
      <div class='col-xl bg-dark'>
         <div class='fakeimg' >
		 <img src='$img[$i]'/>
		 </div> 
		 <div class = 'item_bg'>
	  <p class='mb-1 mr-sm-2 $color_name' style='padding-left: 10px; padding-top: 5px; font-size: 18px;'>$res_name[$i]</p>
	  
      <p class='mb-2 mr-sm-2 yellow-color' style='padding-left: 10px;'>Item Level $iLvl[$i]</p>";
	  if(!empty($res_bind[$i])){
	  echo "<p class='mb-2 mr-sm-2 white-color' style='padding-left: 10px;'>$res_bind[$i]</p>";
	  }
	  if($res_type[$i] == "1h Sword" or $res_type[$i] == "2h Sword"){
		  $res_type[$i] = "Sword";
	  }elseif($res_type[$i] == "1h Axe" or $res_type[$i] == "2h Axe"){
		  $res_type[$i] = "Axe";
	  }elseif($res_type[$i] == "1h Mace" or $res_type[$i] == "2h Mace"){
		  $res_type[$i] = "Mace";
	  }
	  echo "<p class='mb-2 mr-sm-2 white-color' style='padding-right: 30%; float: right;'>$res_type[$i]</p>";
	  
	  echo "<p class='mb-2 mr-sm-2 white-color' style='padding-left: 10px;'>$res_slot[$i]</p>
	  <p class='mb-2 mr-sm-2 white-color' style='padding-left: 10px;'>$res_damage[$i] Damage</p>
	  <p class='mb-2 mr-sm-2 white-color' style='padding-left: 10px;'>$main_stat</p>";
	  
	  //This choice operation select what secondary stat is not empty and print it.
	  if(!empty($res_stam[$i])){
	      echo "<p class='mb-2 mr-sm-2 white-color' style='padding-left: 10px;'>+$res_stam[$i] Stamina</p>";
	  }
	  
	  if(!empty($res_crit[$i])){
		  echo "<p class='mb-2 mr-sm-2 green-color' style='padding-left: 10px;'>+$res_crit[$i] Critical Strike</p>";
	  }
	  
	  if(!empty($res_has[$i])){
		  echo "<p class='mb-2 mr-sm-2 green-color' style='padding-left: 10px;'>+$res_has[$i] Haste</p>";
	  }
	  
	  if(!empty($res_mas[$i])){
		  echo "<p class='mb-2 mr-sm-2 green-color' style='padding-left: 10px;'>+$res_mas[$i] Mastery</p>";
	  }
	  
	  if(!empty($res_ves[$i])){
		  echo "<p class='mb-2 mr-sm-2 green-color' style='padding-left: 10px;'>+$res_ves[$i] Versatility</p>";
	  }
	  
	  if(!empty($res_eq[$i])){
		  echo "<p class='mb-1 mr-sm-2 green-color' style='padding-left: 10px; padding-right: 30%; '>Equip: <br> $res_eq[$i]</p>";
	  }
	  
	  
	  echo "
	  <p class='mb-1 mr-sm-2 white-color' style='padding-left: 10px;'>Requires level 120</p>";
	 
	if(!empty($res_desc[$i])){
		echo "<p class='mb-1 mr-sm-2 yellow-color' style='padding-left: 10px; padding-right: 30%;'>$res_desc[$i]</p>";
	}
	  $sp = $res_sp[$i];
	  echo "<p class='mb-2 mr-sm-2 white-color' style='padding-left: 10px; padding-bottom: 5px;'> Sell Price: $sp[0]$sp[1]<img src='IMG/Gold.png'> $sp[2]$sp[3]<img src='IMG/Silver.png'> $sp[4]$sp[5]<img src='IMG/Copper.png'> </p>
	  </div>
      </div>
	  <div class='col-sm-6 ' style='text-align: center; '>";
		if(isset($_SESSION["admin"]) == 1){
		echo"<form method='post' action='Form.php'>
		<input type='hidden' name='itemname' value='$res_name[$i]'>
		<input type='submit' name='change' value='change' class='btn btn-primary' style='float: right; margin-top: 2%;'>
		</form>";
		}
		echo"<p style='float: left;'><strong>Source item:</strong></p>
	  </div>

</div>
</div>";
		}
		//Here take the count of items that return from the database and print then in the site.
			if($length == 0){
				echo "<div class='container-fluid'>
						<div class='row'>
							<div class='col bg-secondary' ><p class='white-color' style='text-align: center;'>No result</p></div>
							</div>
						</div>";
			}
		?>
		
		<div class="container-fluid">
			<div class="row">
					<div class="col bg-dark" ><p class="white-color" style="float: right;"><?php echo $length."/".$length; ?></p></div>
			</div>
		</div>
	  </div>
	  
	  
	  <div class="jumbotron text-center jumbotron-fluid" style="margin-bottom:0; width:100%; background-color: #3d3b3b;">
			<p>Copyright &copy 2018-<?php echo date("Y");?></p>
	  </div>



</body>

</html>