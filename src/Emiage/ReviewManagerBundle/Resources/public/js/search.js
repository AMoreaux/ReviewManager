$(document).ready(function()
{
    $("#recherche").keyup(function()
    {
    var recherche = $(this).val();
    var data = 'motclef=' + recherche;
    if (recherche.lenght>3)
    {
        $.ajax(
        {
            type :"GET",
            url : "http://localhost/ReviewManager/web/app_dev.php/note/",
            data : data,
            success: function(server_response)
            {
                $("#resultat").html(server_response).show();
            }
        });

    }

    });
});