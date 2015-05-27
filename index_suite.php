<?php

$population->evolve();

?>

<h3>Population finale : (fitting = how far the colour is from the goal)</</h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Red</th>
			<th>Blue</th>
			<th>Green</th>
			<th>Alpha</th>
			<th>Fitting total</th>
			<th>Colour</th>
		</tr>
	</thead>
	<tbody>
<?php
$individuals = $population->getIndividuals();
foreach ($individuals as $individual)
{
?>
		<tr>
			<td>
				<?php echo sprintf('%d',$individual->getRed()->getColour()); ?>
				(<?php echo sprintf('%d',$individual->getRed()->getFitting()); ?>)
			</td>
			<td>
				<?php echo sprintf('%d',$individual->getGreen()->getColour()); ?>
				(<?php echo sprintf('%d',$individual->getGreen()->getFitting()); ?>)
			</td>
			<td>
				<?php echo sprintf('%d',$individual->getBlue()->getColour()); ?>
				(<?php echo sprintf('%d',$individual->getBlue()->getFitting()); ?>)
			</td>
			<td>
				<?php echo sprintf('%.2f',$individual->getAlpha()->getOpacity()); ?>
				(<?php echo sprintf('%d',$individual->getAlpha()->getFitting()); ?>)
			</td>
			<td>
				<?php echo sprintf('%.2f',$individual->getFitting()); ?>
			</td>
			<td>
				<div class="main_colour_rectangle" 
					style="background-color: rgb(<?php echo $individual->getRGBStringCSS(); ?>);">
				</div>
			</td>
		</tr>
<?php
}
?>
	</tbody>
</table>