<?php
// Initialize the session
session_start();

require_once "authedication.php";
require_once "config.php";
 
// Check if the user is logged in, if not then redirect him to login page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $loggedin = true;
}else{
	$loggedin = false;
}

$item_name = $slot = $quality = $strength = $agility = $intellect = $critical = $haste = $mastery = $versatility = $leech = $avoidance = $speed = $sellprice = $equip = $description = "NULL";
$source_item = $image = $type = $armor = $ilvl = $lvl = $stamina = $category = $bind = $damage = $id = "NULL";
$update = false;
if(isset($_POST["change"])){
	$item_name = $_POST['itemname'];
	
	$query = "SELECT * FROM items WHERE name = '{$item_name}'";
	
	$result = mysqli_query($link, $query);
	
	if($result){//Take the result of the query and association in arrays.
			while($query_executed = mysqli_fetch_assoc($result)){
				$id = $query_executed["id"];
				$item_name = $query_executed["name"];
				$slot = $query_executed["slot"];
				$quality = $query_executed["quality"];
				$strength = $query_executed["strength"];
				$agility = $query_executed["agility"];
				$intellect = $query_executed["intellect"];
				$critical = $query_executed["critical"];
				$haste = $query_executed["haste"];
				$mastery = $query_executed["mastery"];
				$versatility = $query_executed["versatility"];
				$leech = $query_executed["leech"];
				$avoidance = $query_executed["avoidance"];
				$speed = $query_executed["speed"];
				$sellprice = $query_executed["sellprice"];
				$equip = $query_executed["equip"];
				$description = $query_executed["description"];
				$source_item = $query_executed["sourceitem"];
				$image = $query_executed["image"];
				$type = $query_executed["type"];
				$armor = $query_executed["armor"];
				$ilvl = $query_executed["ilvl"];
				$lvl = $query_executed["lvl"];
				$stamina = $query_executed["stamina"];
				$category = $query_executed["category"];
				$bind = $query_executed["bind"];
				$damage = $query_executed["damage"];
			}
		}else{
			die("Problem with query". mysqli_error());
		}
	
}

if(isset($_POST["submit"])){
	if(!empty($_POST['name'])){$item_name = $_POST['name'];}
	
	if(!empty($_POST['category'])){$category = $_POST['category']; }
	
	if(!empty($_POST['slot'])){$slot = $_POST['slot'];}
	
	if(!empty($_POST['quality'])){$quality = $_POST['quality'];}
	
	if(!empty($_POST['strength'])){$strength = $_POST['strength'];}
	
	if(!empty($_POST['agility'])){$agility = $_POST['agility'];}
	
	if(!empty($_POST['intellect'])){$intellect = $_POST['intellect'];}
	
	if(!empty($_POST['critical'])){$critical = $_POST['nacriticalme'];}
	
	if(!empty($_POST['haste'])){$haste = $_POST['haste'];}
	
	if(!empty($_POST['mastery'])){$mastery = $_POST['mastery'];}
	
	if(!empty($_POST['varsatility'])){$versatility = $_POST['versatility'];}
	
	if(!empty($_POST['leech'])){$leech = $_POST['leech'];}
	
	if(!empty($_POST['avoidance'])){$avoidance = $_POST['avoidance'];}
	
	if(!empty($_POST['speed'])){$speed = $_POST['speed'];}
	
	if(!empty($_POST['sellprice'])){$sellprice = $_POST['sellprice'];}
	
	if(!empty($_POST['equip'])){$equip = $_POST['equip'];}
	
	if(!empty($_POST['description'])){$description = $_POST['description'];}
	
	if(!empty($_POST['source'])){$source_item = $_POST['source'];}
	
	if(!empty($_POST['image'])){$image = $_POST['image'];}
	
	if(!empty($_POST['type'])){$type = $_POST['type'];}
	
	if(!empty($_POST['armor'])){$armor = $_POST['armor'];}
	
	if(!empty($_POST['ilvl'])) {$ilvl = $_POST['ilvl'];}
	
	if(!empty($_POST['lvl'])){$lvl = $_POST['lvl'];}
	
	if(!empty($_POST['stamina'])){$stamina = $_POST['stamina'];}
	
	if(!empty($_POST['bind'])){$bind = $_POST['bind'];}
	
	if(!empty($_POST['damage'])){$damage = $_POST['damage'];}
		
	$query = "UPDATE items
	SET name = '{$item_name}', slot = '{$slot}', quality = '{$quality}', strength = '{$strength}', agility = '{$agility}', intellect = '{$intellect}', critical = '{$critical}', 
	haste = '{$haste}', mastery = '{$mastery}', versatility = '{$versatility}', leech = '{$leech}', 
	avoidance = '{$avoidance}', speed = '{$speed}', sellprice = '{$sellprice}', equip = '{$equip}', description = '{$description}',
	sourceitem = '{$source_item}', image = '{$image}', type = '{$type}', armor = '{$armor}', ilvl = '{$ilvl}', lvl = '{$lvl}', stamina = '{$stamina}', category = '{$category}', bind = '{$bind}', damage = '{$damage}'
	WHERE id = '{$id}';";
	
	$result = mysqli_query($link, $query);
	
	if($result){
		$update = true;
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
	
	
	  <div class="main_conteiner" id="cont_margin"> <!--Main Conteiner of the page -->
		<?php if($update){
			echo"<div class='container-fluid'>
				<div class='row'>
					<div class='col bg-secondary'>
					<h4 style='color: white; text-align: center;'>Item Update Succesfully</h4>
					</div>
				</div>
			</div>";
		} ?>
		<h2 style="text-align: center;">Change Item Form</h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style = "margin-left: 10%; margin-right: 10%;">
			<div class="form-inline">
				<label for="Category" style="padding-right: 28px;">Category:</label>
				<select name="category" class="custom-select mb-2 " id="option">
					<option selected value ="">None</option>
					<option <?php if($category == 1){echo "selected ";} ?> value="1">Armor</option>
					<option <?php if($category == 2){echo "selected ";} ?> value="2">Weapon</option>
				  </select>
			</div>
			
			<div class="form-group">
			  <label for="name">Name:</label>
			  <input type="text" class="form-control" id="name" value="<?php echo $item_name; ?>" name="name">
			</div>
			
			<p><strong>Main Stats:</strong></p>
			
			<div class="form-group">
			  <label for="Stamina" class="mb-2 mr-sm-1" style="padding-right: 1%;">Stamina:</label>
			  <input type="number" class="form-control  mb-2" style="width: 100%;" id="stamina" value="<?php echo $stamina; ?>" name="stamina">
			  <div style ="display:none;" id="armor_in">
			  <label for="Armor" class="mb-2 mr-sm-1" style="padding-right: 1%;">Armor:</label>
			  <input type="number" class="form-control  mb-2" style="width: 100%;"  id="armor" value="<?php echo $armor; ?>" name="armor">
			  </div>
			  <div style ="display:none;" id="damage_in">
			  <label for="Damage" class="mb-2 mr-sm-1" style="padding-right: 1%;">Damage:</label>
			  <input type="text" class="form-control  mb-2" style="width: 100%;" id="damage" value="<?php echo $damage; ?>" name="damage">
			  </div>
			  <label for="Strength" class="mb-2 mr-sm-1" style="padding-right: 1%;">Strength:</label>
			  <input type="number" class="form-control  mb-2" style="width: 100%;" id="strength" value="<?php echo $strength; ?>" name="strength">
			  <label for="Agility" class="mb-2 mr-sm-1" style="padding-right: 1%;">Agility:</label>
			  <input type="number" class="form-control  mb-2" style="width: 100%;" id="agility" value="<?php echo $agility; ?>" name="agility">
			  <label for="Intellect" class="mb-2 mr-sm-1" style="padding-right: 1%;">Intellect:</label>
			  <input type="number" class="form-control  mb-2" style="width: 100%;" id="intellect" value="<?php echo $intellect; ?>" name="intellect">
			</div>
			
			<p><strong>Secontary Stats:</strong></p>
			
			<div class="form-group">
			  <label for="Critical" class="mb-2 mr-sm-1" style="padding-right: 1%;">Critical:</label>
			  <input type="number" class="form-control  mb-2" style="width: 100%;" id="critical" value="<?php echo $critical; ?>" name="critical">
			  <label for="Haste" class="mb-2 mr-sm-1" style="padding-right: 1%;">Haste:</label>
			  <input type="number" class="form-control  mb-2" style="width: 100%;" id="haste" value="<?php echo $haste; ?>" name="haste">
			  <label for="Mastery" class="mb-2 mr-sm-1" style="padding-right: 1%;">Mestery:</label>
			  <input type="number" class="form-control  mb-2" style="width: 100%;" id="mastery" value="<?php echo $mastery; ?>" name="mastery">
			  <label for="Versatility" class="mb-2 mr-sm-1" style="padding-right: 1%;">Versatility:</label>
			  <input type="number" class="form-control  mb-2" style="width: 100%;" id="versatility" value="<?php echo $versatility; ?>" name="versatility">
			  <label for="Leech" class="mb-2 mr-sm-1" style="padding-right: 1%;">Leech:</label>
			  <input type="number" class="form-control  mb-2" style="width: 100%;" id="leech" value="<?php echo $leech; ?>" name="leech">
			  <label for="Avoidance" class="mb-2 mr-sm-1" style="padding-right: 1%;">Avoidance:</label>
			  <input type="number" class="form-control  mb-2" style="width: 100%;" id="avoidance" value="<?php echo $avoidance; ?>" name="avoidance">
			  <label for="Speed" class="mb-2 mr-sm-1" style="padding-right: 1%;">Speed:</label>
			  <input type="number" class="form-control  mb-2" style="width: 100%;" id="speed" value="<?php echo $speed; ?>" name="speed">
			</div>
			
			<p><strong>Other Informations:</strong></p>
			
			<div class="form-group">
			  <label for="ItemLevel" class="mb-2 mr-sm-1" style="padding-right: 1%;">Item Level:</label>
			  <input type="number" class="form-control  mb-2" style="width: 100%;" id="itemlevel" value="<?php echo $ilvl; ?>" name="ilvl">
			  <label for="Level" class="mb-2 mr-sm-1" style="padding-right: 1%;">Level:</label>
			  <input type="number" class="form-control  mb-2" style="width: 100%;" id="level" value="<?php echo $lvl; ?>" name="lvl">
			</div>
			
			<div class="form-group">
			<label for="Equip" class="mb-2 mr-sm-1" style="padding-right: 1%;">Equip:</label>
			<textarea class="form-control  mb-2" name="equip" ><?php echo $equip; ?></textarea>
			<label for="Description" class="mb-2 mr-sm-1" style="padding-right: 1%;">Description:</label>
			<textarea class="form-control  mb-2" name="description" ><?php echo $description; ?></textarea>
			<label for="Source" class="mb-2 mr-sm-1" style="padding-right: 1%;" value="<?php echo $source_item; ?>">Source:</label>
			<textarea class="form-control  mb-2" name="source"></textarea>
			</div>
			<?php
			if($category == 1){
			echo "<div class='form-inline' style='display:none;' id='armor_slot'>
				<label for='Slot' style='padding-right: 28px;'>Slot-Armor:</label>
				<select name='slot' class='custom-select mb-2 '>
					<option selected value =''>None</option>
					<option"; if($slot == 1){echo "selected";}  echo"value='1'>Head</option>
					<option"; if($slot == 2){echo "selected";}  echo"value='2'>Chest</option>
					<option"; if($slot == 3){echo "selected";}  echo"value='3'>Shoulders</option>
					<option"; if($slot == 4){echo "selected";}  echo"value='4'>Neck</option>
					<option"; if($slot == 5){echo "selected";}  echo"value='5'>Tabard</option>
					<option"; if($slot == 6){echo "selected";}  echo"value='6'>Waist</option>
					<option"; if($slot == 7){echo "selected";}  echo"value='7'>Wrist</option>
					<option"; if($slot == 8){echo "selected";}  echo"value='8'>Hands</option>
					<option"; if($slot == 9){echo "selected";}  echo"value='9'>Legs</option>
					<option"; if($slot == 10){echo "selected";}  echo"value='10'>Feet</option>
					<option"; if($slot == 11){echo "selected";}  echo"value='11'>Ring</option>
					<option"; if($slot == 12){echo "selected";}  echo"value='12'>Trinket</option>
				  </select>
			</div>
			
			<div class='form-inline' style='display:none;' id='armor_type'>
				<label for='Type' style='padding-right: 28px;'>Type-Armor:</label>
				<select name='type' class='custom-select mb-2 '>
					<option selected value =''>None</option>
					<option"; if($type == 1){echo "selected";}  echo"value='1'>Cloth</option>
					<option"; if($type == 2){echo "selected";}  echo"value='2'>Leather</option>
					<option"; if($type == 3){echo "selected";}  echo"value='3'>Mail</option>
					<option"; if($type == 4){echo "selected";}  echo"value='4'>Plate</option>
					<option"; if($type == 5){echo "selected";}  echo"value='5'>Jewelry</option>
					<option"; if($type == 6){echo "selected";}  echo"value='6'>Miscellaneous</option>
				  </select>
			</div>";
			}else{
			echo"<div class='form-inline' style='display:none;' id='weapon_slot'>
				<label for='Slot' style='padding-right: 28px;'>Slot-Weapon:</label>
				<select name='slot' class='custom-select mb-2 '>
					<option    selected value =''>None</option>
					<option"; if($slot == 13){echo "selected";}  echo"value='13'>Main Hand</option>
					<option"; if($slot == 14){echo "selected";}  echo"value='14'>Off Hand</option>
					<option"; if($slot == 15){echo "selected";}  echo"value='15'>One Hand</option>
					<option"; if($slot == 16){echo "selected";}  echo"value='16'>Range</option>
					<option"; if($slot == 17){echo "selected";}  echo"value='17'>Thrown</option>
					<option"; if($slot == 18){echo "selected";}  echo"value='18'>Two Hand</option>
				  </select>
			</div>
			
			<div class='form-inline' style='display:none;' id='weapon_type'>
				<label for='Type' style='padding-right: 28px;'>Type-Weapon:</label>
				<select name='type class='custom-select mb-2 '>
					<option      selected value =''>None</option>
					<option"; if($type == 7){echo "selected";} echo"value='7'>1h Sword</option>
					<option"; if($type == 8){echo "selected";} echo"value='8'>2h Sword</option>
					<option"; if($type == 9){echo "selected";} echo"value='9'>1h Axe</option>
					<option"; if($type == 10){echo "selected";} echo"value='10'>2h Axe</option>
					<option"; if($type == 11){echo "selected";} echo"value='11'>1h Mace</option>
					<option"; if($type == 12){echo "selected";} echo"value='12'>2h Mace</option>
					<option"; if($type == 13){echo "selected";} echo"value='13'>Staff</option>
					<option"; if($type == 14){echo "selected";} echo"value='14'>Dagger</option>
					<option"; if($type == 15){echo "selected";} echo"value='15'>Warglaive</option>
					<option"; if($type == 16){echo "selected";} echo"value='16'>Polearm</option>
					<option"; if($type == 17){echo "selected";} echo"value='17'>Fist</option>
					<option"; if($type == 18){echo "selected";} echo"value='18'>Wand</option>
					<option"; if($type == 19){echo "selected";} echo"value='19'>Bow</option>
					<option"; if($type == 20){echo "selected";} echo"value='20'>Gun</option>
					<option"; if($type == 21){echo "selected";} echo"value='21'>Crossbow</option>
					<option"; if($type == 22){echo "selected";} echo"value='22'>Thrown</option>
					<option"; if($type == 6){echo "selected";} echo"value='6'>Miscellaneous</option>
				  </select>
			</div>";
			}
			?>
			<div class="form-inline">
				<label for="Quality" style="padding-right: 28px;">Quality:</label>
				<select name="quality" class="custom-select mb-2 ">
					<option selected value ="">None</option>
					<option <?php if($quality == 1){echo "selected";} ?> value="1">Poor</option>
					<option <?php if($quality == 2){echo "selected";} ?> value="2">Common</option>
					<option <?php if($quality == 3){echo "selected";} ?> value="3">Uncommon</option>
					<option <?php if($quality == 4){echo "selected";} ?> value="4">Rare</option>
					<option <?php if($quality == 5){echo "selected";} ?> value="5">Epic</option>
					<option <?php if($quality == 6){echo "selected";} ?> value="6">Legendary</option>
				  </select>
			</div>
			
			
			
			<div class="form-inline">
				<label for="Bind" style="padding-right: 28px;">Bind:</label>
				<select name="bind" class="custom-select mb-2 ">
					<option selected value ="">None</option>
					<option <?php if($bind == 1){echo "selected";} ?> value="1">Binds when picked up</option>
					<option <?php if($bind == 2){echo "selected";} ?> value="2">Binds when equipped</option>
				  </select>
			</div>
			
			<div class="form-group">
			  <label for="Image">Image Location:</label>
			  <input type="text" class="form-control" id="image" name="image" value="<?php echo $image; ?>">
			</div>
			
			<div class="form-group">
			  <label for="Sellprice">Sell Price:</label>
			  <input type="number" class="form-control" id="sellprice" style="width: 100%;" name="sellprice" value="<?php echo $sellprice; ?>">
			</div>
			<input type="submit" value="Submit Form" name="submit" class="btn btn-primary">
		</form>
	  
	  <div class="jumbotron text-center jumbotron-fluid" style="margin-bottom:0; width:100%; background-color: #3d3b3b;">
			<p>Copyright &copy 2018-<?php echo date("Y");?></p>
	  </div>

	</div>

</body>

</html>