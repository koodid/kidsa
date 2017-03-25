fallback.load({
	jQuery: [
        'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js',
        '/js/jquery-3.1.1.min.js'
    ],
    'jQuery.fn.modal': [
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
        '/bootstrap/js/bootstrap.min.js'

    ],
    bootstrapCSS: [
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
        '/bootstrap/css/bootstrap.css'
    ],

       
    'font-awesome_css': [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css',
        'css/font-awesome.css'
    ],

    'bootstrap-social_css': [
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.css',
        'css/bootstrap-social.css'
    ]

}, {
	shim: {
        'jQuery.fn.modal': ['jQuery']	
	}
});
