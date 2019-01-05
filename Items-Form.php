<?php

session_start();

require_once "authedication.php";

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $loggedin = true;
}else{
	$loggedin = false;
}

// Include config file
require_once "config.php";
	
	
	$id = 0;
	$input_arr = [[]];
	$data = "";
	$complete = false;
	$success = [];
	
	if(isset($_POST["num_in"])){
		$id = $_POST['num'];
		$_SESSION["inputs"] = $id;
	}
	
	if(isset($_POST["submit"])){
		$cnt = $_SESSION["inputs"];
		for($i = 1; $i <= $cnt; $i++){
			if(empty($_POST['category' .$i.''])){
				$input_arr[$i][0] = "NULL";
			}else{
				$input_arr[$i][0] = $_POST['category' .$i.''];
			}
			
			if(empty($_POST['name' .$i.''])){
				$input_arr[$i][1] = "NULL";
				$success[$i] = false;
			}else{
				$input_arr[$i][1] = "'" .  $_POST['name' .$i.''] . "'";
				$success[$i] = true;
			}
			
			if(empty($_POST['stamina' .$i.''])){
				$input_arr[$i][2] = "NULL";
			}else{
				$input_arr[$i][2] = "'" .  $_POST['stamina' .$i.''] . "'";
			}
			
			if(empty($_POST['armor' .$i.''])){
				$input_arr[$i][3] = "NULL";
			}else{
				$input_arr[$i][3] = "'" .  $_POST['armor' .$i.''] . "'";
			}
			
			if(empty($_POST['strength' .$i.''])){
				$input_arr[$i][4] = "NULL";
			}else{
				$input_arr[$i][4] = "'" .  $_POST['strength' .$i.''] . "'";
			}
			
			if(empty($_POST['agility' .$i.''])){
				$input_arr[$i][5] = "NULL";
			}else{
				$input_arr[$i][5] = "'" .  $_POST['agility' .$i.''] . "'";
			}
			
			if(empty($_POST['intellect' .$i.''])){
				$input_arr[$i][6] = "NULL";
			}else{
				$input_arr[$i][6] = "'" . $_POST['intellect' .$i.''] . "'";
			}
			
			if(empty($_POST['critical' .$i.''])){
				$input_arr[$i][7] = "NULL";
			}else{
				$input_arr[$i][7] = "'" . $_POST['critical' .$i.''] . "'";
			}
			
			if(empty($_POST['haste' .$i.''])){
				$input_arr[$i][8] = "NULL";
			}else{
				$input_arr[$i][8] = "'" . $_POST['haste' .$i.''] . "'";
			}
			
			if(empty($_POST['mastery' .$i.''])){
				$input_arr[$i][9] = "NULL";
			}else{
				$input_arr[$i][9] = "'" . $_POST['mastery' .$i.''] . "'";
			}
			
			if(empty($_POST['versatility' .$i.''])){
				$input_arr[$i][10] = "NULL";
			}else{
				$input_arr[$i][10] = "'" . $_POST['versatility' .$i.''] . "'";
			}
			
			if(empty($_POST['leech' .$i.''])){
				$input_arr[$i][11] = "NULL";
			}else{
				$input_arr[$i][11] = "'" . $_POST['leech' .$i.''] . "'";
			}
			
			if(empty($_POST['avoidance' .$i.''])){
				$input_arr[$i][12] = "NULL";
			}else{
				$input_arr[$i][12] = "'" . $_POST['avoidance' .$i.''] . "'";
			}
			
			if(empty($_POST['speed' .$i.''])){
				$input_arr[$i][13] = "NULL";
			}else{
				$input_arr[$i][13] = "'" . $_POST['speed' .$i.''] . "'";
			}
			
			if(empty($_POST['ilvl' .$i.''])){
				$input_arr[$i][14] = "NULL";
			}else{
				$input_arr[$i][14] = $_POST['ilvl' .$i.''];
			}
			
			if(empty($_POST['lvl' .$i.''])){
				$input_arr[$i][15] = "NULL";
			}else{
				$input_arr[$i][15] = $_POST['lvl' .$i.''];
			}
			
			if(empty($_POST['equip' .$i.''])){
				$input_arr[$i][16] = "NULL";
			}else{
				$input_arr[$i][16] = "'" . $_POST['equip' .$i.''] . "'";
			}
			
			if(empty($_POST['description' .$i.''])){
				$input_arr[$i][17] = "NULL";
			}else{
				$input_arr[$i][17] = "'" . $_POST['description' .$i.''] . "'";
			}
			
			if(empty($_POST['source' .$i.''])){
				$input_arr[$i][18] = "NULL";
			}else{
				$input_arr[$i][18] = "'" . $_POST['source' .$i.''] . "'";
			}
			
			if(empty($_POST['slot_ar' .$i.''])and empty($_POST['slot_wp' .$i.''])){
				$input_arr[$i][19] = "NULL";
			}elseif(empty($_POST['slot_wp' .$i.''])){
				$input_arr[$i][19] = $_POST['slot_ar' .$i.''];
			}else{
				$input_arr[$i][19] = $_POST['slot_wp' .$i.''];
			}
			
			
			if(empty($_POST['type_ar' .$i.'']) and empty($_POST['type_wp' .$i.''])){
				$input_arr[$i][20] = "NULL";
			}elseif(empty($_POST['type_wp' .$i.''])){
				$input_arr[$i][20] = $_POST['type_ar' .$i.''];
			}else{
				$input_arr[$i][20] = $_POST['type_wp' .$i.''];
			}
			
			
			if(empty($_POST['quality' .$i.''])){
				$input_arr[$i][21] = "NULL";
			}else{
				$input_arr[$i][21] = $_POST['quality' .$i.''];
			}
			
			if(empty($_POST['bind' .$i.''])){
				$input_arr[$i][22] = "NULL";
			}else{
				$input_arr[$i][22] = $_POST['bind' .$i.''];
			}
			
			if(empty($_POST['image' .$i.''])){
				$input_arr[$i][23] = "'" ."IMG/default.jpg". "'";
			}else{
				$input_arr[$i][23] = "'" . "IMG/". $_POST['image' .$i.''] . ".jpg" . "'";
			}
			
			if(empty($_POST['sellprice' .$i.''])){
				$input_arr[$i][24] = "NULL";
			}else{
				$input_arr[$i][24] = "'" . $_POST['sellprice' .$i.''] . "'";
			}
			
			if(empty($_POST['damage' .$i.''])){
				$input_arr[$i][25] = "NULL";
			}else{
				$input_arr[$i][25] = "'" . $_POST['damage' .$i.''] . "'";
			}
		}
		
		for($i = 1; $i <= $cnt; $i++){
			
			if(($i+1 == $cnt) and ($success[$i+1] == false)){
				$data .= "(" . $input_arr[$i][0] . "," .$input_arr[$i][1] . ", " . $input_arr[$i][2] . "," .$input_arr[$i][3] . ", " .$input_arr[$i][4] . ", " .$input_arr[$i][5] . ",
					" .$input_arr[$i][6] . ", " .$input_arr[$i][7] . ", " .$input_arr[$i][8] . ", " .$input_arr[$i][9] . ", " .$input_arr[$i][10] . ", " .$input_arr[$i][11] . ",
					" .$input_arr[$i][12] . ", " .$input_arr[$i][13] . ", " .$input_arr[$i][14] . ", " .$input_arr[$i][15] . ", " .$input_arr[$i][16] . ", " .$input_arr[$i][17] . ",
					" .$input_arr[$i][18] . ", " .$input_arr[$i][19] . ", " .$input_arr[$i][20] . ", " .$input_arr[$i][21] . ", " .$input_arr[$i][22] . ", " .$input_arr[$i][23] . ", " .$input_arr[$i][24] . ", " . $input_arr[$i][25] . ");";
			}elseif(($i == $cnt) and ($success[$i] == true)){
				$data .= "(" . $input_arr[$i][0] . "," .$input_arr[$i][1] . ", " . $input_arr[$i][2] . "," .$input_arr[$i][3] . ", " .$input_arr[$i][4] . ", " .$input_arr[$i][5] . ",
					" .$input_arr[$i][6] . ", " .$input_arr[$i][7] . ", " .$input_arr[$i][8] . ", " .$input_arr[$i][9] . ", " .$input_arr[$i][10] . ", " .$input_arr[$i][11] . ",
					" .$input_arr[$i][12] . ", " .$input_arr[$i][13] . ", " .$input_arr[$i][14] . ", " .$input_arr[$i][15] . ", " .$input_arr[$i][16] . ", " .$input_arr[$i][17] . ",
					" .$input_arr[$i][18] . ", " .$input_arr[$i][19] . ", " .$input_arr[$i][20] . ", " .$input_arr[$i][21] . ", " .$input_arr[$i][22] . ", " .$input_arr[$i][23] . ", " .$input_arr[$i][24] . ", " . $input_arr[$i][25] . ");";
			}else{
				$data .= "(" . $input_arr[$i][0] . "," .$input_arr[$i][1] . ", " . $input_arr[$i][2] . "," .$input_arr[$i][3] . ", " .$input_arr[$i][4] . ", " .$input_arr[$i][5] . ",
					" .$input_arr[$i][6] . ", " .$input_arr[$i][7] . ", " .$input_arr[$i][8] . ", " .$input_arr[$i][9] . ", " .$input_arr[$i][10] . ", " .$input_arr[$i][11] . ",
					" .$input_arr[$i][12] . ", " .$input_arr[$i][13] . ", " .$input_arr[$i][14] . ", " .$input_arr[$i][15] . ", " .$input_arr[$i][16] . ", " .$input_arr[$i][17] . ",
					" .$input_arr[$i][18] . ", " .$input_arr[$i][19] . ", " .$input_arr[$i][20] . ", " .$input_arr[$i][21] . ", " .$input_arr[$i][22] . ", " .$input_arr[$i][23] . ", " .$input_arr[$i][24] . ", " . $input_arr[$i][25] . "),";
			}
		}
		
		$query = "INSERT INTO items (category, name, stamina, armor, strength, agility, intellect, critical, haste, mastery, versatility, leech, avoidance, speed, ilvl, lvl, equip, description, 
		sourceitem, slot, type, quality, bind, image, sellprice, damage) VALUES " . $data;
		
		
		if(mysqli_query($link, $query)){
			$complete = true;
		}else{
			die("Error in query".mysqli_error());
		}
		
	mysqli_close($link);//Close connection with database.
	
	
	}

?>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script src="assets/jquery-3.3.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="assets/jquery-ui.css">
	<script src="assets/jquery-ui.min.js"></script>
	<script src="assets/popper.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<link rel="icon" href="IMG/icon.ico">
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

<div class="container bg-secondary" style="margin-top: 5%; width:100%;">
			<h2 style="text-align: center;">Insert Items Form</h2>
		  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style = "margin-left: 30%;">
		  <div class="form-inline">
			  <label for="num"  style="padding-right: 1%;">Number of Inputs:</label>
			  <input type="number" class="form-control  mb-2 mr-sm-2" id="str" placeholder="0" name="num">
			  <input type="submit" class="btn btn-primary" name="num_in" value="Apply Form" >
			</div>
		  </form>
		  <?php
		  if($id > 0){
		  echo "<form action="; echo htmlspecialchars($_SERVER["PHP_SELF"]); echo " method = 'post'>
		  <div class='container-fluid'>
			<div class='row'>";
		  }
		  for($i=1; $i <= $id; $i++){
		 echo "<div class='col-md-4 bg-secondary  mb-3 ' style='border-style: groove groove groove groove;'>
			<h2>Item Form" . " " . $i . "</h2>
			
			<div class='form-inline'>
				<label for='Category' style='padding-right: 28px;'>Category:</label>
				<select name='category$i' class='custom-select mb-2 ' id='option$i' onchange='category($i)'>
					<option selected value =''>None</option>
					<option value='1'>Armor</option>
					<option value='2'>Weapon</option>
				  </select>
			</div>
			
			<div class='form-group'>
			  <label for='name'>Name:</label>
			  <input type='text' class='form-control' id='name' placeholder='Enter a name' name='name$i'>
			</div>
			
			<p><strong>Main Stats:</strong></p>
			
			<div class='form-group'>
			  <label for='Stamina' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Stamina:</label>
			  <input type='number' class='form-control  mb-2' style='width: 100%;' id='stamina' placeholder='0' name='stamina$i'>
			  <div style ='display:none;' id='armor_in$i'>
			  <label for='Armor' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Armor:</label>
			  <input type='number' class='form-control  mb-2' style='width: 100%;'  id='armor' placeholder='0' name='armor$i'>
			  </div>
			  <div style ='display:none;' id='damage_in$i'>
			  <label for='Damage' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Damage:</label>
			  <input type='text' class='form-control  mb-2' style='width: 100%;' id='damage' placeholder='0' name='damage$i'>
			  </div>
			  <label for='Strength' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Strength:</label>
			  <input type='number' class='form-control  mb-2' style='width: 100%;' id='strength' placeholder='0' name='strength$i'>
			  <label for='Agility' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Agility:</label>
			  <input type='number' class='form-control  mb-2' style='width: 100%;' id='agility' placeholder='0' name='agility$i'>
			  <label for='Intellect' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Intellect:</label>
			  <input type='number' class='form-control  mb-2' style='width: 100%;' id='intellect' placeholder='0' name='intellect$i'>
			</div>
			
			<p><strong>Secontary Stats:</strong></p>
			
			<div class='form-group'>
			  <label for='Critical' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Critical:</label>
			  <input type='number' class='form-control  mb-2' style='width: 100%;' id='critical' placeholder='0' name='critical$i'>
			  <label for='Haste' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Haste:</label>
			  <input type='number' class='form-control  mb-2' style='width: 100%;' id='haste' placeholder='0' name='haste$i'>
			  <label for='Mastery' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Mestery:</label>
			  <input type='number' class='form-control  mb-2' style='width: 100%;' id='mastery' placeholder='0' name='mastery$i'>
			  <label for='Versatility' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Versatility:</label>
			  <input type='number' class='form-control  mb-2' style='width: 100%;' id='versatility' placeholder='0' name='versatility$i'>
			  <label for='Leech' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Leech:</label>
			  <input type='number' class='form-control  mb-2' style='width: 100%;' id='leech' placeholder='0' name='leech$i'>
			  <label for='Avoidance' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Avoidance:</label>
			  <input type='number' class='form-control  mb-2' style='width: 100%;' id='avoidance' placeholder='0' name='avoidance$i'>
			  <label for='Speed' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Speed:</label>
			  <input type='number' class='form-control  mb-2' style='width: 100%;' id='speed' placeholder='0' name='speed$i'>
			</div>
			
			<p><strong>Other Informations:</strong></p>
			
			<div class='form-group'>
			  <label for='ItemLevel' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Item Level:</label>
			  <input type='number' class='form-control  mb-2' style='width: 100%;' id='itemlevel' placeholder='0' name='ilvl$i'>
			  <label for='Level' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Level:</label>
			  <input type='number' class='form-control  mb-2' style='width: 100%;' id='level' placeholder='0' name='lvl$i'>
			</div>
			
			<div class='form-group'>
			<label for='Equip' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Equip:</label>
			<textarea class='form-control  mb-2' name='equip$i'></textarea>
			<label for='Description' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Description:</label>
			<textarea class='form-control  mb-2' name='description$i'></textarea>
			<label for='Source' class='mb-2 mr-sm-1' style='padding-right: 1%;'>Source:</label>
			<textarea class='form-control  mb-2' name='source$i'></textarea>
			</div>
			
			<div class='form-inline' style='display:none;' id='armor_slot$i'>
				<label for='Slot' style='padding-right: 28px;'>Slot-Armor:</label>
				<select name='slot_ar$i' class='custom-select mb-2 '>
					<option selected value =''>None</option>
					<option value='1'>Head</option>
					<option value='2'>Chest</option>
					<option value='3'>Shoulders</option>
					<option value='4'>Neck</option>
					<option value='5'>Tabard</option>
					<option value='6'>Waist</option>
					<option value='7'>Wrist</option>
					<option value='8'>Hands</option>
					<option value='9'>Legs</option>
					<option value='10'>Feet</option>
					<option value='11'>Ring</option>
					<option value='12'>Trinket</option>
				  </select>
			</div>
			
			<div class='form-inline' style='display:none;' id='armor_type$i'>
				<label for='Type' style='padding-right: 28px;'>Type-Armor:</label>
				<select name='type_ar$i' class='custom-select mb-2 '>
					<option selected value =''>None</option>
					<option value='1'>Cloth</option>
					<option value='2'>Leather</option>
					<option value='3'>Mail</option>
					<option value='4'>Plate</option>
					<option value='5'>Jewelry</option>
					<option value='6'>Miscellaneous</option>
				  </select>
			</div>
			
			<div class='form-inline' style='display:none;' id='weapon_slot$i'>
				<label for='Slot' style='padding-right: 28px;'>Slot-Weapon:</label>
				<select name='slot_wp$i' class='custom-select mb-2 '>
					<option selected value =''>None</option>
					<option value='13'>Main Hand</option>
					<option value='14'>Off Hand</option>
					<option value='15'>One Hand</option>
					<option value='16'>Range</option>
					<option value='17'>Thrown</option>
					<option value='18'>Two Hand</option>
				  </select>
			</div>
			
			<div class='form-inline' style='display:none;' id='weapon_type$i'>
				<label for='Type' style='padding-right: 28px;'>Type-Weapon:</label>
				<select name='type_wp$i' class='custom-select mb-2 '>
					<option selected value =''>None</option>
					<option value='7'>1h Sword</option>
					<option value='8'>2h Sword</option>
					<option value='9'>1h Axe</option>
					<option value='10'>2h Axe</option>
					<option value='11'>1h Mace</option>
					<option value='12'>2h Mace</option>
					<option value='13'>Staff</option>
					<option value='14'>Dagger</option>
					<option value='15'>Warglaive</option>
					<option value='16'>Polearm</option>
					<option value='17'>Fist</option>
					<option value='18'>Wand</option>
					<option value='19'>Bow</option>
					<option value='20'>Gun</option>
					<option value='21'>Crossbow</option>
					<option value='22'>Thrown</option>
					<option value='6'>Miscellaneous</option>
				  </select>
			</div>
			
			<div class='form-inline'>
				<label for='Quality' style='padding-right: 28px;'>Quality:</label>
				<select name='quality$i' class='custom-select mb-2 '>
					<option selected value =''>None</option>
					<option value='1'>Poor</option>
					<option value='2'>Common</option>
					<option value='3'>Uncommon</option>
					<option value='4'>Rare</option>
					<option value='5'>Epic</option>
					<option value='6'>Legendary</option>
				  </select>
			</div>
			
			
			
			<div class='form-inline'>
				<label for='Bind' style='padding-right: 28px;'>Bind:</label>
				<select name='bind$i' class='custom-select mb-2 '>
					<option selected value =''>None</option>
					<option value='1'>Binds when picked up</option>
					<option value='2'>Binds when equipped</option>
				  </select>
			</div>
			
			<div class='form-group'>
			  <label for='Image'>Image Location:</label>
			  <input type='text' class='form-control' id='image' name='image$i'>
			</div>
			
			<div class='form-group'>
			  <label for='Sellprice'>Sell Price:</label>
			  <input type='number' class='form-control' id='sellprice' style='width: 100%;' name='sellprice$i'>
			</div>
			
		</div>";
			}
			
	if($id > 0){		
		echo "</div>
	<div>
			
	<input type='submit' class='btn btn-primary' style ='margin-left: 40%; margin-bottom: 2%;' name='submit' value='Apply Form' >
	<input type='reset' class='btn btn-light' style= 'margin-bottom: 2%;'>
	
		  </form>
		  
		 </div>
	</div>

</div>";
}
	
	if($complete == true){
		echo "Data insert succesfull in database";
		$cnt_result = "";
		$length = count($success);
		for($i = 1; $i<=$length; $i++){
			if($success[$i] == true){
				$cnt_result++;
			}
		}
		echo "Inserted " . $cnt_result . "/" . $length . " records"; 
	}
?>
</div>

<script>
function category(num){
	var option = document.getElementById("option"+num).value;
	
	if(option == "1"){
		document.getElementById("armor_slot"+num).style.display="flex";
		document.getElementById("armor_type"+num).style.display="flex";
		document.getElementById("armor_in"+num).style.display="inline";
		document.getElementById("weapon_slot"+num).style.display="none";
		document.getElementById("weapon_type"+num).style.display="none";
		document.getElementById("damage_in"+num).style.display="none";
	}
	
	if(option == "2"){
		document.getElementById("armor_slot"+num).style.display="none";
		document.getElementById("armor_type"+num).style.display="none";
		document.getElementById("armor_in"+num).style.display="none";
		document.getElementById("weapon_slot"+num).style.display="flex";
		document.getElementById("weapon_type"+num).style.display="flex";
		document.getElementById("damage_in"+num).style.display="inline";
	}
}
</script>

<div class="jumbotron text-center jumbotron-fluid" style="margin-bottom:0; width:100%; background-color: #3d3b3b;">
			<p>Copyright &copy 2018-<?php echo date("Y");?></p>
	  </div>
</body>

</html>