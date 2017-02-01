//test hardcoded queries

var fixedUrl = 'http://whois.arin.net/rest/orgs;name=Apple*';
var local = 'http://127.0.0.1/whois/php/api.php';
var remote = 'http://who.nfshost.com/php/api.php';

var loadText = '<span id=\x22dots\x22>loading</span>';
$("#q1_form").submit(function(){
    var query = $('#q1_form').serialize();
    $.ajax({
        url         : remote,
        type        : $(this).attr('method'),
        dataType    : 'json',
        data        : $(this).serialize(),

        beforeSend: function() {
            $('#ajax-status-box').html( loadText );
            $('#ajax-url-box').removeClass("feedback-on").addClass("feedback-off").html(this.url);
            $('#ajax-query-box').removeClass("feedback-on").addClass("feedback-off").html( query );
            $('#ajax-response-box').html(" ");

        },

        success : function( url, status, jqXHR ) {
                
            $( "#ajax-status-box" ).removeClass("feedback-off").addClass("feedback-on success").html(status);
            $( "#ajax-url-box" ).removeClass("feedback-off").addClass("feedback-on").html(this.url);
            $( "#ajax-query-box" ).removeClass("feedback-off").addClass("feedback-on").html( query );
            var justJSON = jqXHR.responseText.replace(/(^\.+|\.+$)/mg, '');
            $( "#ajax-response-box" ).html(justJSON);
            $( "#ajax-response-box" ).each(function(i, block) {
                hljs.highlightBlock(block);
        });
            ScrollToResults();
                        },
        error   : function( jqXHR, textStatus, errorThrown ) {
            $( "#ajax-status-box" ).removeClass("feedback-off").addClass("feedback-on error").html("error");
            $( "#ajax-response-box" ).removeClass("feedback-off").addClass("feedback-on error").html( textStatus ).html( errorThrown );
            ScrollToResults();
        }
    });
return false;
});


//as-you-type display
$("#pr").on('keyup', function(event) {
    var data=$(this).val();
    $("#q1_pr_target").text(data);
});


function ScrollToResults()
{
    $('body').animate({scrollTop:$('#results').offset().top -30 },'fast');
}
/* dotdotdot loading animation */
var dots = 0;
$(document).ready(function()
{
    setInterval (type, 500);
});
function type()
{
    if(dots < 3)
    {
        $('#dots').append('.');
        dots++;
    }
    else
    {
        $('#dots').html('');
        dots = 0;
    }
}

