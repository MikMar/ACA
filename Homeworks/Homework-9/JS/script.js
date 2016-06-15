/**
 * Created by mikayel on 5/21/16.
 */
var count = 0;

function Main() {
    var number = document.getElementById("number");
    var valid = document.getElementById("validText");
    var temp = number.value;
    if (count == 0){
        var matrix = [
        [3, "img/Diners_Club.png" ,"Diners Club"],
        [4, "img/Visa.png" , "Visa"],
        [5, "img/Master_Card.png", "Master card"],
        [6, "img/Discover.png", "Dicover card"]
        ];

        var i,j = 0;

        for (i = 0;i < matrix.length;i++)

            if (temp == matrix[i][j]){
                    console.log(i);
                    break;
                }

        console.log(i);

        document.getElementById("image").setAttribute("src", matrix[i][1]);
    }
    temp=temp + " ";
    count++;
    if(valid_credit_card(temp.replace(/\s/g,''))&& temp.replace(/\s/g,'').length>=12){
        valid.innerHTML="valid card";
        valid.style.color="white";
        number.style.border="none";
        number.setAttribute("disabled", "disabled");

    } else valid.innerHTML="invalid card";

    if (count!=0&&count%4==0) {
       number.value = temp;
    }


}


function valid_credit_card(value) {
    // accept only digits, dashes or spaces
    if (/[^0-9-\s]+/.test(value)) return false;

    // The Luhn Algorithm. It's so pretty.
    var nCheck = 0, nDigit = 0, bEven = false;
    value = value.replace(/\D/g, "");

    for (var n = value.length - 1; n >= 0; n--) {
        var cDigit = value.charAt(n),
            nDigit = parseInt(cDigit, 10);

        if (bEven) {
            if ((nDigit *= 2) > 9) nDigit -= 9;
        }

        nCheck += nDigit;
        bEven = !bEven;
    }

    return (nCheck % 10) == 0;
} //from internet
