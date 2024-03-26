jQuery.noConflict();
(function ($) {
    $(function () {
        var url = 'https://getequity.co.uk/thank-you/?merch=01&qref=MSM-1432&seq=11470&age=60&propertyvalue=70000';
        if (window.location.href.indexOf("thankyou-1") > -1) {
            var getUrlParameter = function getUrlParameter(sParam) {
                var sPageURL = window.location.search.substring(1),
                    sURLVariables = sPageURL.split('&'),
                    sParameterName,
                    i;

                for (i = 0; i < sURLVariables.length; i++) {
                    sParameterName = sURLVariables[i].split('=');
                    if (sParameterName[0] === sParam) {
                        return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                    }
                }
                return false;
            };
            var seq = getUrlParameter('seq');
            var qref = getUrlParameter('qref');
            console.log('seq - ' + seq + ' qref - ' + qref);
            setTimeout(
                function () {
                    console.log('time completed');
                    console.log(my_ajax_object.ajax_url);
                    jQuery.ajax({
                        type: "POST",
                        url: my_ajax_object.ajax_url,
                        dataType: 'json',
                        data: {
                            'action': 'get_data',
                            'seq': seq
                        },
                        success: function (msg) {
                            var retriveArray = msg;
                            console.log('success message');
                            // 				
                            if (msg === null) {
                                window.location = "/thank-you-2/?qref=" + qref + "&vmbc=" + dynamicString;
                            } else {
                                console.log(msg);
                                console.log(msg.redirect_url);
                                var dynamicString = msg.redirect_url.replace(/(.*)?vmbc=/, "");
                                console.log('?vmbc=' + dynamicString);
                                window.location = "/thank-you-3/?qref=" + qref + "&vmbc=" + dynamicString;
                            }

                        }
                    });
                }, 8000);
        }
    });
})(jQuery);