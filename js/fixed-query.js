//test hardcoded queries

$("#q1_form").submit(function(){
        $.ajax({
            url         : 'http://whois.arin.net/rest/orgs;name=Apple*',    
            type        : $(this).attr('method'),
            dataType    : 'json',
            //headers     : { 'Accept': 'application/json' },
            //data    : $(this).serialize(),
            success     : function( url, status, jqXHR ) {
                        $( "#ajax-url-box" ).html(this.url);
                        $( "#ajax-status-box" ).html(status);
                        var justJSON = jqXHR.responseText.replace(/(^\.+|\.+$)/mg, '');
                        $( "#ajax-response-box" ).html(justJSON);
                        $( "#ajax-response-box" ).each(function(i, block) {
                            hljs.highlightBlock(block);
                        });
                        }           
        });
return false;
});


