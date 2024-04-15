
/**
 * Data request for tdPanelVueComponents.js
 * @param options
 */
function tdPanelVueAjax(options) {

    if (typeof options.post === 'undefined') {
        options.post = {};
    }

    options.post['action'] = 'td_panel_vue_get_data';
    options.post['td_magic_token'] = tdWpAdminPanelBoxNonce;

    jQuery.ajax({
        timeout: 20000,
        type: 'POST',
        url: td_ajax_url,
        data: options.post,
        statusCode: {
            404 : function() {
                console.log('ERROR: 404 not found');
            },
            500 : function() {
                console.log('ERROR: 500 server error');
            }
        },
        dataType: 'json',
        success: function(apiReply, textStatus, XMLHttpRequest){
            console.log('Post: ', options.post);
            console.log('Reply: ', apiReply);

            if (apiReply === null) {
                //empty reply
                options.error('Received an invalid reply from server, please reload the page.');
            }

            if (apiReply.error !== undefined) {
                //error reply
                options.error(apiReply.error);
            }

            options.success(apiReply);

        },
        error: function(MLHttpRequest, textStatus, errorThrown){
            //console.log(errorThrown);
            options.error('An error occurred while trying to access the server:' +  textStatus);
        }
    });
}