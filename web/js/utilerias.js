'use strict';

function ajaxJim(urldoc,parametros,success,_type ='POST')
{
    ajax({url:urldoc, type:_type, data:parametros, success:success});
}

function ajax(property)
{
    var prop = jQuery.extend
            ({dataType: 'JSON',
              async: false
            }, property);

    jQuery.ajax({
        url: prop.url,
        type: prop.type,
        data: prop.data,
        async: prop.async,
        dataType: prop.dataType,
        success: function (data, textStatus, transport)
        {
            prop.success(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            prop.success(null);
        }
    });
}