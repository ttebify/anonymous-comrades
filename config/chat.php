<?php

// config/chat.php

return [
    /**
     * Verification code expiration time in minutes
     */
    'verification_code_expiration' => 60,
    
    'chat_styles' => [
        'elegant' => [
            'user_background_image' => 'path/to/image1.jpg',
            'color_theme' => 'blue',
        ],
        'modern' => [
            'user_background_image' => 'path/to/image2.jpg',
            'color_theme' => 'green',
        ],
        'minimal' => [
            'user_background_image' => 'path/to/image3.jpg',
            'color_theme' => 'white',
        ],
        // Add more chat styles as needed
    ],
];
