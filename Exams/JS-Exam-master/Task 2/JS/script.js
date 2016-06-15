/**
 * Created by mikayel on 5/21/16.
 */
function calc () {
    var message = document.getElementById("_message");
    var v1 = document.getElementById("_v1").value;
    var v2 = document.getElementById("_v2").value;
    var answer = document.getElementById("_answer");
    var temp;

    if (v1 == "" || v2 == ""){
        message.innerHTML = "A value or values are empty";
        return;
    }
    if (isNaN(v1) || isNaN(v2)){
        message.innerHTML = "A value or values are not numbers";
        return;
    }

    var sel=document.getElementById("_sel").value;
    switch (sel) {
        case '+' : {
            temp = parseInt(v1) + parseInt(v2);
        } break;
        case '-' : {
            temp = v1 - v2;
        } break;
        case '*' : {
            temp = v1 * v2;
        } break;
        case '/' : {
            temp = v1 / v2;
        }
    }

    answer.innerHTML = temp;

}