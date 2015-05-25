/* ================================================================================
Auteur : Kim SAVAROCHE
Date : 26/11/2014

Subject : 
	CLASS DigitalNumbers
	Collections of Number.js
	When created, this push the usual digital numbers and link them to a matrix : [0,9]
================================================================================ */

function DigitalNumbers()
{
	this.numbers = [];

	this.numbers.push(new Number("0", [
			[1, 1, 1],
			[1, 0, 1],
			[1, 0, 1],
			[1, 0, 1],
			[1, 1, 1]
		]));

	this.numbers.push(new Number("1", [
			[0, 0, 1],
			[0, 0, 1],
			[0, 0, 1],
			[0, 0, 1],
			[0, 0, 1]
		]));

	this.numbers.push(new Number("2", [
			[1, 1, 1],
			[0, 0, 1],
			[1, 1, 1],
			[1, 0, 0],
			[1, 1, 1]
		]));

	this.numbers.push(new Number("3", [
			[1, 1, 1],
			[0, 0, 1],
			[1, 1, 1],
			[0, 0, 1],
			[1, 1, 1]
		]));

	this.numbers.push(new Number("4", [
			[1, 0, 1],
			[1, 0, 1],
			[1, 1, 1],
			[0, 0, 1],
			[0, 0, 1]
		]));

	this.numbers.push(new Number("5", [
			[1, 1, 1],
			[1, 0, 0],
			[1, 1, 1],
			[0, 0, 1],
			[1, 1, 1]
		]));

	this.numbers.push(new Number("6", [
			[1, 0, 0],
			[1, 0, 0],
			[1, 1, 1],
			[1, 0, 1],
			[1, 1, 1]
		]));

	this.numbers.push(new Number("7", [
			[1, 1, 1],
			[0, 0, 1],
			[0, 0, 1],
			[0, 0, 1],
			[0, 0, 1]
		]));

	this.numbers.push(new Number("8", [
			[1, 1, 1],
			[1, 0, 1],
			[1, 1, 1],
			[1, 0, 1],
			[1, 1, 1]
		]));

	this.numbers.push(new Number("9", [
			[1, 1, 1],
			[1, 0, 1],
			[1, 1, 1],
			[0, 0, 1],
			[1, 1, 1]
		]));

	this.getDigitalNumber = function(p_numberToFind)
	{
		var foundNumber = new Number("None", getInitialMatrix(DIGITAL_GRID_HEIGHT, DIGITAL_GRID_WIDTH));

		for (var iNumber = 0;  iNumber < this.numbers.length; iNumber++) 
		{
			if(this.numbers[iNumber].label == p_numberToFind) foundNumber = this.numbers[iNumber];
		}

		return foundNumber;
	}
}
