/**
 * Created by mikayel on 5/21/16.
 */
function draw () {
    var out = false;
    var message = document.getElementById("_message");
    var array = [], arrayDiagram = [], text='_q';
    for (var i = 0; i < 4; i++){
        array.push(document.getElementById(text + (i+1)).value);
        arrayDiagram.push(document.getElementById(text + (i + 1) + 'Diagram'));
        console.log(arrayDiagram[i]);
        if (array[i] == ""){
            message.innerHTML = " Q" + (i+1) + " is empty";
            out = true;
            break;
        }
        if (isNaN(array[i])){
            message.innerHTML = " Q" + (i+1) + " is not a number";
            out = true;
            break;
        }
        if (array[i] <= 0 || array[i] > 100 ){
            message.innerHTML = " Q" + (i+1) + " is not valid";
            out = true;
            break;
        }
    }

    if (out){
        return;
    } else {
        for (var i = 0; i < 4; i++){
            var height = 300 * array[i] / 100;
            console.log(height);
            arrayDiagram[i].style.marginTop = 300 - height + "px";
            arrayDiagram[i].style.height = height + "px";
        }

    }




}