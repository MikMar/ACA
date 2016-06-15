/**
 * Created by mikayel on 5/21/16.
 */

var cToF=true;
var c = document.getElementById("input_c");
var f = document.getElementById("input_f");


var popUP = document.getElementById("popUp");

var p_0 = document.getElementById("pBar0");
var p_1 = document.getElementById("pBar1");


function Transfer () {

	
	if (cToF){
		
		if (c.value && !isNaN(c.value)){
			f.value = c.value*1.8+32;
			setTimeout(Open,1500);
			return;
	
		} else {
		
		window.alert("Invalid data");
		}
	
	} else {
		
		if (f.value && !isNaN(f.value)){
			c.value=(f.value-32)/1.8;
			setTimeout(Open,1500);
			return;
		} else {
		window.alert("Invalid data");
		}

	}
    

    

}


function Refrash() {
    window.location.reload();
}

function Retweet() {

    var f_containier = document.getElementById("input_f_container");

    var c_containier = document.getElementById("input_c_container");

    var pos=0;


    if(cToF) {

        c_containier.style.zIndex="1000";

        var id = setInterval(Animate, 7);

        function Animate() {

            if(pos==56){ clearInterval(id);}
			else {

                pos++;

                f_containier.style.bottom = pos + 'px';

                c_containier.style.top = pos + 'px'; }

        }


    }

    else {

        c_containier.style.zIndex="0";

        var id = setInterval(Animate, 7);



        function Animate() {

            if(pos == 56){ clearInterval(id);}

            else {

                pos++;

                f_containier.style.bottom = 56 - pos + 'px';

                c_containier.style.top = 56 - pos + 'px'; }

        }
    }


    cToF=!cToF;
}


function Close(){
	popUp.style.visibility = "hidden";
}

function Open(){
	
	popUp.style.visibility = "visible";
}