$('#search-btn').click( function(e){
    var name = $('#ten-sach-input').val().toString().trim();
    e.preventDefault();
    if (name !=  ''){
        $('.app-search').submit();
    }

});
