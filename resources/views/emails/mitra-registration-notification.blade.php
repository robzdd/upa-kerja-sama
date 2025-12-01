<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f9fafb; padding: 30px; border-radius: 0 0 10px 10px; }
        .info-box { background: white; padding: 20px; border-left: 4px solid #667eea; margin: 20px 0; border-radius: 5px; }
        .info-row { margin: 10px 0; }
        .label { font-weight: bold; color: #667eea; }
        .button { display: inline-block; padding: 12px 30px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .footer { text-align: center; margin-top: 20px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🤝 Request Registrasi Mitra Baru</h1>
        </div>
        <div class="content">
            <p>Halo Admin,</p>
            <p>Terdapat request registrasi mitra baru yang perlu ditinjau:</p>
            
            <div class="info-box">
                <div class="info-row">
                    <span class="label">Nama Perusahaan:</span> {{ $request->nama_perusahaan }}
                </div>
                <div class="info-row">
                    <span class="label">Email:</span> {{ $request->email }}
                </div>
                <div class="info-row">
                    <span class="label">Telepon:</span> {{ $request->telepon }}
                </div>
                <div class="info-row">
                    <span class="label">Bidang Usaha:</span> {{ $request->bidang_usaha }}
                </div>
                <div class="info-row">
                    <span class="label">Alamat:</span> {{ $request->alamat }}
                </div>
                @if($request->deskripsi)
                <div class="info-row">
                    <span class="label">Deskripsi:</span><br>
                    {{ $request->deskripsi }}
                </div>
                @endif
                <div class="info-row">
                    <span class="label">Tanggal Request:</span> {{ $request->created_at->format('d F Y, H:i') }}
                </div>
            </div>

            <p>Silakan login ke admin panel untuk meninjau dan memproses request ini:</p>
            
            <center>
                <a href="{{ route('admin.mitra-requests.show', $request->id) }}" class="button">
                    Lihat Detail Request
                </a>
            </center>

            <div class="footer">
                <p>Email ini dikirim otomatis oleh sistem Portal Kerja POLINDRA</p>
                <p>&copy; {{ date('Y') }} UPA Kerjasama POLINDRA</p>
            </div>
        </div>
    </div>
</body>
</html>
