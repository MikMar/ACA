// dynamically activate list items when clicked
$(".navbar-nav li").on("click",function(){
    $(".navbar-nav li").removeClass("active");
    $(this).addClass("active");
});

$(document).ready(function(){
    $(".alert").hide();
    $(".alert").slideToggle(500);
});

$(".close").click(function () {
    $(".alert").slideToggle(500);
});





