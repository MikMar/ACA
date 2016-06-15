/**
 * Created by mikayel on 5/21/16.
 */
var navArray = [
    {

        "Label" : "Home",
        "Url" : "https://www.google.com"
    },
    {

        "Label" : "Blog",
        "Url" : "https://www.google.com"
    },
    {

        "Label" : "Home",
        "Url" : "https://www.google.com"
    },
    {

        "Label" : "Home",
        "Url" : "https://www.google.com"
    }
]

var deg = 0, i = 0, j = 0, bombID, cellID, bombStep;

function drawNavigation() {
    var navigationHTML="";
    var navigation = document.getElementById("_navigation");
    navigation.innerHTML = "<ul id='_nav'></ul>";
    for (var i=0;i<navArray.length;i++){
        var item = '<li><a href="' + navArray[i].Url + '">' + navArray[i].Label +'</a></li>';
        navigationHTML+=item;
    }
    document.getElementById("_nav").innerHTML=navigationHTML;
}

function drawMatrix() {
    var matrixHTML="";
    var  col = 12;
    var row = 12;
	var bombCell;
	var random = [];
	
    for (var i=0;i<row;i++){
        matrixHTML += '<div class="row">';
        for (var j=0;j<col; j++){
            matrixHTML += '<div class="col-xs-1 ">';
            matrixHTML += '<div class="cell" id="_cell' + i + "_" + j + '">';
            matrixHTML += "";
            matrixHTML += '</div></div>';
        }
        
        matrixHTML += '</div>';
        
    }
	
    document.getElementById("_matrix_Container").innerHTML=matrixHTML;
    var firstCell=document.getElementById("_cell0_0");
    firstCell.style.background = "url(img/turtle.png) no-repeat left top";
    firstCell.style.backgroundSize = "50px 50px";
    firstCell.style.webkitTransform = "rotate(" + deg + "deg)";
    firstCell.style.transform = "rotate(" + deg + "deg)";
	
	for(var k = 1; k<12 ; k++ ){
		row = Math.floor(Math.random() * 11);
		random.push(row);
		
		col = k;
		bombID = "_cell" + row + "_" + col;
		bombCell = document.getElementById(bombID);
		bombCell.style.background = "url(img/bomb.png) no-repeat left top";
		bombCell.style.backgroundSize = "50px 50px";
	}
	
	bombStep=setInterval(step, 100);
	
	function step(){
		for(var k = 1; k<12 ; k++ ){
			row = random[k-1];
			console.log(row);
			col = k;
			bombID = "_cell" + row + "_" + col;
			console.log(bombID);
			bombCell = document.getElementById(bombID);
			bombCell.style.backgroundImage = "none";
			row++;
			if (row == 12){
				row = 0;
			}
			bombID = "_cell" + row + "_" + col;
			console.log(row);
			bombCell = document.getElementById(bombID);
			bombCell.style.background = "url(img/bomb.png) no-repeat left top";
			bombCell.style.backgroundSize = "50px 50px";
			random[k-1] = row;
			if (bombID == cellID){
				bombCell.style.backgroundImage = "none";
				clearInterval(bombStep);
				alert("GAME OVER");
			}
		}
	}
}


function go() {
    var cell;
    var event = window.event;
	cellID = '_cell' + i + "_" + j;
	cell=document.getElementById(cellID);
	cell.style.backgroundImage = "none";

    switch (event.keyCode) {
        case 56 : {
            i--; deg=0;
        } break;
        case 53 : {
            i++; deg=180;
        } break;
        case 54 : {
            j++; deg=90;
        } break;
        case 52 : {
            j--; deg=270;
        }
    }
	
	if (i>=0 &&  i<=11 && j>=0 && j<=11){
		cellID = '_cell' + i + "_" + j;
		cell=document.getElementById(cellID);
		cell.style.background = "url(img/turtle.png) no-repeat left top";
		cell.style.backgroundSize = "50px 50px";
		cell.style.webkitTransform = "rotate(" + deg + "deg)";
		cell.style.transform = "rotate(" + deg + "deg)";
    } else {
        alert("GAME OVER");
        return;
    }
	
	if ( cellID.slice(-2) == "11" ){
		clearInterval(bombStep);
		alert("YOU WON!");
	
}
	

    


}
