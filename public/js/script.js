$(document).ready(function () {

    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');
    $('.btn-favorite').css('cursor', 'pointer');
    $('.btn-unfavorite').css('cursor', 'pointer');

    var url = "http://127.0.0.1:8000"

    /**
     * Gestiona les classes del botó de like de cadascuna de les
     * publicacions i fa una petició ajax al controlador de like
     * per crear un nou like per l'usuari.
     * 
     * @return void
     */
    function like() {
        $('.btn-like').unbind('click').click(function () {
            console.log('like')

            $(this).addClass('btn-dislike').removeClass('btn-like');

            $(this).attr('src', "/images/heart/heart.png");

            $.ajax({
                url: url + '/post/like/' + $(this).data('id'),

                type: 'GET',

                succes: function (response) {
                    if (response.like) {
                        console.log('Has fet like')
                    } else {
                        console.log("Error en la petició ajjax")
                    }
                }

            })
            dislike();
        });
    }
    like();

    /**
     * Gestiona les classes del botó de like de cadascuna de les
     * publicacions i fa una petició ajax al controlador de like
     * per eliminar el like de l'usuari
     * .
     * @returns void
     */
    function dislike() {
        $('.btn-dislike').unbind('click').click(function () {
            console.log('dislike')

            $(this).addClass('btn-like').removeClass('btn-dislike');

            $(this).attr('src', "/images/heart/heart-v.png");

            $.ajax({
                url: url + '/post/dislike/' + $(this).data('id'),

                type: 'GET',

                succes: function (response) {
                    if (response.like) {
                        console.log('Has fet dislike')
                    } else {
                        console.log("Error en la petició ajax")
                    }
                }

            })
            like();
            dislike();
        });
    }
    dislike();

    /**
     * 
     */
    function favorite() {
        $('.btn-favorite').unbind('click').click(function () {
            console.log('favorite')

            $(this).addClass('btn-unfavorite').removeClass('btn-favorite');

            $(this).attr('src', "/images/favorite/favorite.png");
            console.log(url + '/post/favorite/' + $(this).data('id'))

            $.ajax({
                url: url + '/post/favorite/' + $(this).data('id'),

                type: 'GET',

                succes: function (response) {
                    if (response.like) {
                        console.log('Has fet dislike')
                    } else {
                        console.log("Error en la petició ajax")
                    }
                }

            })
        });
    }
    favorite();
})
