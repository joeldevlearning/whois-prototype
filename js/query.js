//test hardcoded queries

var fixedUrl = 'http://whois.arin.net/rest/orgs;name=Apple*';
var PhpApiUrl = 'http://127.0.0.1/whois/php/api.php';

$("#q1_form").submit(function(){
        var query = $('#q1_form').serialize();
        $.ajax({
            url         : PhpApiUrl,    
            type        : $(this).attr('method'),
            dataType    : 'json',
            data        : $(this).serialize(),
            success     : function( url, status, jqXHR ) {
                        $( "#ajax-url-box" ).html(this.url);
                        $( "#ajax-status-box" ).html(status);
                        $( "#ajax-query-box" ).html( query );
                        var justJSON = jqXHR.responseText.replace(/(^\.+|\.+$)/mg, '');
                        $( "#ajax-response-box" ).html(justJSON);
                        $( "#ajax-response-box" ).each(function(i, block) {
                            hljs.highlightBlock(block);
                        });
                        }           
        });
return false;
});
