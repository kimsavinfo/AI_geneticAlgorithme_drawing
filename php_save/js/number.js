/* ================================================================================
Auteur : Kim SAVAROCHE
Date : 28/11/2014

Subject : 
	CLASS Number 
	a number label is associated to a matrix of 0 and 1
================================================================================ */

function Number(p_label, p_matrix)
{
	this.label = p_label;
	this.matrix = p_matrix;
}

function getInitialMatrix(p_ligne, p_column)
{
	var matrix = [];
	for(var iLigne = 0; iLigne < p_ligne; iLigne++) 
	{
		matrix[iLigne] = [];
		for(var iColumn = 0; iColumn < p_column; iColumn++) 
		{						
			matrix[iLigne][iColumn] = 0;
		}
	}

	return matrix;
}