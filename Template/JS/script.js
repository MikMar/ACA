/**
 * Created by mikayel on 5/21/16.
 */
function Transfer () {
    var c=document.getElementById("input_c");
    var f=document.getElementById("input_f");

    var p_2=document.getElementById("p_Bar-2");


    if (c.value && !isNaN(c.value)){
        f.value=c.value*1.8000+32;
        var temp=100-f.value%212;
        p_2.style.width=temp+"%";
        return;

    }

    if (c.value && !isNaN(c.value)){
        f.value=c.value*1.8000+32;
        p_2.width;
        return;

    }




}