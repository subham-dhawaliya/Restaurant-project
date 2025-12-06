<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        // Header
        'site_name',
        'logo',
        'header_phone',
        'header_email',
        'book_table_link',
        
        // Footer
        'footer_about',
        'footer_address',
        'footer_phone',
        'footer_email',
        'footer_timing',
        
        // Social Links
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'youtube_url',
        
        // Copyright
        'copyright_text',
        
        'is_active',
    ];

    // Get active settings (singleton pattern)
    public static function getSettings()
    {
        $settings = self::where('is_active', true)->first();
        
        if (!$settings) {
            // Create default settings if none exist
            $settings = self::create([
                'site_name' => 'Yummy',
                'footer_about' => 'Delicious food delivered to your doorstep. We serve the best quality food with love.',
                'footer_address' => '123 Main Street, City, Country',
                'footer_phone' => '+1 234 567 890',
                'footer_email' => 'info@yummy.com',
                'footer_timing' => 'Mon-Sun: 10:00 AM - 11:00 PM',
                'copyright_text' => '© ' . date('Y') . ' Yummy Restaurant. All Rights Reserved.',
                'is_active' => true,
            ]);
        }
        
        return $settings;
    }
}
