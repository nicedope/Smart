
<?php 
	$button_count = 500;
	$divided_container = $button_count / 100;
	$container_plus_one = $divided_container + 1;
	$existing_count = 1;
?>

<div class="tab">
	<?php 
		$per_container = 100;
		$existing_container_count = 1;
		for($tab = 1; $tab <= $divided_container; $tab++){
			if($tab == 1){ $active = "active"; }else{ $active = ""; }
			echo '<button class="tablinks '.$active.'">'.$existing_container_count.' - '.$per_container * $tab.'</button>';
			$existing_container_count += 100;
		}
	?> 

</div>

<div class="main_button">
	<?php 

	for($x = 1; $x < $container_plus_one; $x++){
		$times_hundred = 100;
		$count = $times_hundred * $x;
		?>
		<section class="button_holder tabcontent">
			<?php
			for($y = $existing_count; $y <= $count; $y++){
				echo "<button type='button'>".$y."</button>";
			}
			$existing_count = $y;
			?>
		</section>
		<?php
	}
	?>
</div>
