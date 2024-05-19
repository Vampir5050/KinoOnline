$(document).ready(function() {
    $('.add-to-film').click(function(e) {
        e.preventDefault();
		let userId = $(this).data('user-id');
		let filmId = $(this).data('film-id'); 

        $.ajax({
            url: '/public/index.php?controller=favourites&action=film', 
            type: 'POST',
            data: { user_id: userId, film_id:filmId },
            success: function(response) {
				alert(response.message);
				location.reload();
            
            },
            error: function(error) {
                alert(error.message);
            }
        });
    });
});

$(document).ready(function() {
    $('.add-to-serial').click(function(e) {
        e.preventDefault();
		let userId = $(this).data('user-id');
		let serialId = $(this).data('serial-id');
        $.ajax({
            url: '/public/index.php?controller=favourites&action=serial', 
            type: 'POST',
            data: { user_id: userId, serial_id:serialId },
            success: function(response) {
				alert(response.message);
				location.reload();
            
            },
            error: function(error) {
                alert(error.message);
            }
        });
    });
});