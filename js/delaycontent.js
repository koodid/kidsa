$(document).ready(function () {
    $('p[data-img-name]').prepend(function(index){
        var name = $(this).attr('data-img-name')
        return '<img class="img-responsive" src="/images/' + name + '">'
    })
})