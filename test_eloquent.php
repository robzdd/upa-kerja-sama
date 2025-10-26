<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Alumni;
use App\Models\DokumenPendukung;

echo "Testing with Eloquent models...\n";

try {
    $alumniId = '591e3123-a0b5-48ac-98bc-093c2afedbd7';
    
    // Find alumni using Eloquent
    $alumni = Alumni::find($alumniId);
    
    if ($alumni) {
        echo "Alumni found via Eloquent:\n";
        echo "  - ID: {$alumni->id}\n";
        echo "  - User ID: {$alumni->user_id}\n";
        echo "  - Created: {$alumni->created_at}\n";
        
        // Try to create dokumen using Eloquent
        echo "\nCreating dokumen using Eloquent...\n";
        
        try {
            $dokumen = DokumenPendukung::create([
                'alumni_id' => $alumni->id,
                'tipe_dokumen' => 'cv',
                'nama_dokumen' => 'test.pdf',
                'path_file' => 'dokumen_pendukung/test.pdf',
                'ukuran_file' => 1000,
                'jenis_dokumen' => 'cv',
                'file_path' => 'dokumen_pendukung/test.pdf',
                'file_name' => 'test.pdf',
                'file_size' => 1000,
            ]);
            
            echo "Dokumen created successfully via Eloquent!\n";
            echo "  - ID: {$dokumen->id}\n";
            echo "  - Alumni ID: {$dokumen->alumni_id}\n";
            
            // Clean up
            $dokumen->delete();
            echo "Test record cleaned up\n";
            
        } catch (Exception $e) {
            echo "Dokumen creation via Eloquent FAILED: " . $e->getMessage() . "\n";
        }
        
    } else {
        echo "Alumni not found via Eloquent!\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
