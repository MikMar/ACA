/**
 * Created by mikayel on 5/21/16.
 */
function check () {
    var firstName = document.getElementById("_firstName")
    var lastName = document.getElementById("_lastName");
    var eMail = document.getElementById("_eMail");
    var temp = "^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$";

    if (firstName.value.length > 20 || firstName.value.length == 0){
        firstName.style.borderColor = "red";
        return;
    }
    if (lastName.value.length > 20 || lastName.value.length == 0){
        lastName.style.borderColor = "red";
        return;
    }
    if (!eMail.value.match(temp) || eMail.value.length == 0){
        eMail.style.borderColor = "red";
        return;
    }

}

function sel () {
    var select = document.getElementById("_sel");
    var selHTML, year =  2016;

    for ( var i = 0; i <= 90; i++){
        selHTML += "<option>" + (year - i) + "</option>";
    }
    select.innerHTML = selHTML;
}

function day () {
    var month = document.getElementById("_month").value;
    var array = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    var year = document.getElementById("_sel").value;
    var day = document.getElementById("_day");
    var leap = false;
    var dayHTML;
    if ((year % 100) != 0 && (year % 4) == 0 ) {
        leap = true;
    } else if( (year % 400) == 0 ){
        leap = true;
    }
    if (leap) {
        array[1] = 29;
    }
    var monthID = parseInt(month.slice(-2));;
    console.log(monthID);
    for ( var i = 1; i <= array[monthID-1]; i++){
        dayHTML += "<option>" + i + "</option>";
    }
    day.innerHTML = dayHTML;
}
