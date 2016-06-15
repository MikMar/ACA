/* created by mikayel 07.06.2016 */
var row = document.getElementById('_row').innerHTML; //getting vars from PHP
var col = document.getElementById('_col').innerHTML; //getting vars from PHP
//painting border
for (var i=0; i<row;i++){
	for (var j=0; j< col; j++){
		if ( i == 0 || i == row-1 || j == 0 || j == col-1 ){ //cells on border
			temp = document.getElementById('_cell' + i + '_' + j); 
			temp.style.backgroundColor = '#7fffd4';
		}
	}
}

