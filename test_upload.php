<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Testing document upload...\n";

try {
    // Test the updateOrCreate with all required fields
    $alumniId = '591e3123-a0b5-48ac-98bc-093c2afedbd7';
    $jenisDokumen = 'cv';
    $filePath = 'dokumen_pendukung/test.pdf';
    $fileName = 'test.pdf';
    $fileSize = 1000;
    
    echo "Testing with alumni_id: {$alumniId}\n";
    echo "Testing with jenis_dokumen: {$jenisDokumen}\n";
    
    // Test insert
    $result = DB::insert("
        INSERT INTO dokumen_pendukungs 
        (id, alumni_id, tipe_dokumen, nama_dokumen, path_file, ukuran_file, jenis_dokumen, file_path, file_name, file_size, created_at, updated_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
    ", [
        'test-id-' . time(),
        $alumniId,
        $jenisDokumen,
        $fileName,
        $filePath,
        $fileSize,
        $jenisDokumen,
        $filePath,
        $fileName,
        $fileSize
    ]);
    
    echo "Insert SUCCESS!\n";
    
    // Check if record was created
    $record = DB::select("SELECT * FROM dokumen_pendukungs WHERE jenis_dokumen = ? AND alumni_id = ?", [$jenisDokumen, $alumniId]);
    
    if (count($record) > 0) {
        echo "Record found in database:\n";
        $record = $record[0];
        echo "  - ID: {$record->id}\n";
        echo "  - Alumni ID: {$record->alumni_id}\n";
        echo "  - Jenis Dokumen: {$record->jenis_dokumen}\n";
        echo "  - Tipe Dokumen: {$record->tipe_dokumen}\n";
        echo "  - File Name: {$record->file_name}\n";
        echo "  - File Path: {$record->file_path}\n";
    }
    
    // Clean up test record
    DB::delete("DELETE FROM dokumen_pendukungs WHERE jenis_dokumen = ? AND alumni_id = ?", [$jenisDokumen, $alumniId]);
    echo "Test record cleaned up\n";
    
} catch (Exception $e) {
    echo "Test FAILED: " . $e->getMessage() . "\n";
}
