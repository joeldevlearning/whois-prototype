//test hardcoded queries

var fixedUrl = 'http://whois.arin.net/rest/orgs;name=Apple*';
var localPhpApiUrl = 'http://127.0.0.1/whois/php/api.php';
var remotePhpApiUrl = 'http://who.nfshost.com/php/api.php';

$("#q1_form").submit(function(){
        var query = $('#q1_form').serialize();
        $.ajax({
            url         : remotePhpApiUrl,    
            type        : $(this).attr('method'),
            dataType    : 'json',
            data        : $(this).serialize(),

            beforeSend: function() {
                    $('#ajax-status-box').html('loading...');
                    $('#ajax-url-box').removeClass("feedback-on").addClass("feedback-off").html(" ");
                    $('#ajax-query-box').removeClass("feedback-on").addClass("feedback-off").html(" ");
                    $('#ajax-response-box').html(" ");
            },

            success     : function( url, status, jqXHR ) {
                
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
            error       : function() {
                        $( "#ajax-status-box" ).removeClass("feedback-off").addClass("feedback-on error").html("error");
                        ScrollToResults();
                        }
        });
return false;
});

$("#pr").on('keyup', function(event) {
       var data=$(this).val();
       $("#q1_pr_target").text(data);
});

function ScrollToResults() {
    $('body').animate({scrollTop:$('#results').offset().top -30 },'fast');
}


