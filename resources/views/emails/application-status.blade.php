<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f4; padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #1A365D 0%, #4E4376 100%); padding: 30px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px;">Update Lamaran Kerja</h1>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 30px;">
                            <p style="color: #333333; font-size: 16px; margin: 0 0 10px 0;">Dear {{ $applicantName }},</p>
                            
                            <p style="color: #333333; font-size: 16px; margin: 0 0 20px 0;">
                                Kami ingin menginformasikan update mengenai lamaran Anda untuk posisi:
                            </p>
                            
                            <div style="background-color: #f8f9fa; padding: 15px; border-radius: 8px; margin: 20px 0;">
                                <p style="color: #1A365D; font-size: 18px; font-weight: bold; margin: 0 0 10px 0;">{{ $jobTitle }}</p>
                                <p style="color: #666666; font-size: 14px; margin: 0;">Status: <strong style="color: #1A365D;">{{ $statusLabel }}</strong></p>
                            </div>
                            
                            <div style="margin: 30px 0;">
                                <p style="color: #333333; font-size: 16px; margin: 0 0 10px 0;">Pesan dari {{ $companyName }}:</p>
                                <div style="background-color: #ffffff; padding: 20px; border-left: 4px solid #1A365D; border-radius: 4px;">
                                    <p style="color: #555555; font-size: 15px; line-height: 1.6; margin: 0; white-space: pre-wrap;">{{ $message }}</p>
                                </div>
                            </div>
                            
                            <p style="color: #333333; font-size: 16px; margin: 20px 0 0 0;">
                                Terima kasih atas minat Anda terhadap posisi ini. Kami menghargai waktu yang Anda luangkan untuk melamar.
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 20px; text-align: center;">
                            <p style="color: #666666; font-size: 12px; margin: 0;">
                                Portal Karir POLINDRA<br>
                                Politeknik Negeri Indramayu
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

