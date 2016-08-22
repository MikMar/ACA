/**
 * Created by mikayel on 8/22/16.
 */

$( document ).ready(function() {
    setInterval( function () {
        $.ajax({
            url: 'status.php', // form action url
            type: 'POST', // form submit method get/post
            dataType: 'json', // request type html/json/xml
            success: function( data ) {
                console.log(data);
                $('#_progress').html('');
                $.each( data, function( key, value ){
                    $('#_progress').append(
                    '<div class="progress" style="border: 2px solid blue;">' +
                    '<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: ' + value + '%"> ' +
                    '<span class="sr-only">' + value + '% Complete</span> ' +
                    '</div></div>'
                    );
                });
            }
        });
    } , 3000);
});