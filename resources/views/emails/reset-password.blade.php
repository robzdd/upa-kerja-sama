<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f3f4f6;">
    <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #f3f4f6;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table role="presentation" style="width: 600px; border-collapse: collapse; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <!-- Header with Logo -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); padding: 40px 30px; text-align: center;">
                            <table role="presentation" style="width: 100%; border-collapse: collapse;">
                                <tr>
                                    <td align="center">
                                        <!-- Logo Placeholder - Replace with actual POLINDRA logo -->
                                        <div style="width: 80px; height: 80px; background-color: #ffffff; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                            <img src="{{ asset('images/logo/polindra_logo.png') }}" alt="POLINDRA" style="width: 60px; height: 60px; object-fit: contain;">
                                        </div>
                                        <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 700; letter-spacing: -0.5px;">UPA Kerjasama</h1>
                                        <p style="margin: 8px 0 0; color: #e0e7ff; font-size: 14px; font-weight: 500;">Politeknik Negeri Indramayu</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <h2 style="margin: 0 0 16px; color: #1f2937; font-size: 24px; font-weight: 700;">Reset Password {{ $userType }}</h2>
                            
                            <p style="margin: 0 0 16px; color: #4b5563; font-size: 16px; line-height: 1.6;">
                                Halo <strong>{{ $userName }}</strong>,
                            </p>

                            <p style="margin: 0 0 24px; color: #4b5563; font-size: 16px; line-height: 1.6;">
                                Kami menerima permintaan untuk mereset password akun <strong>{{ $userType }}</strong> Anda di sistem UPA Kerjasama POLINDRA. Klik tombol di bawah ini untuk membuat password baru:
                            </p>

                            <!-- Button -->
                            <table role="presentation" style="width: 100%; border-collapse: collapse; margin: 0 0 24px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $url }}" style="display: inline-block; padding: 16px 40px; background: linear-gradient(135deg, #3b82f6 0%, #1e3a8a 100%); color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 16px; box-shadow: 0 4px 6px rgba(59, 130, 246, 0.3); transition: all 0.3s;">
                                            Reset Password
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Info Box -->
                            <div style="background-color: #fef3c7; border-left: 4px solid #f59e0b; padding: 16px; border-radius: 8px; margin: 0 0 24px;">
                                <p style="margin: 0; color: #92400e; font-size: 14px; line-height: 1.6;">
                                    <strong>⏰ Penting:</strong> Link reset password ini akan kadaluarsa dalam <strong>60 menit</strong>. Segera lakukan reset password Anda.
                                </p>
                            </div>

                            <p style="margin: 0 0 16px; color: #6b7280; font-size: 14px; line-height: 1.6;">
                                Jika tombol di atas tidak berfungsi, salin dan tempel URL berikut ke browser Anda:
                            </p>

                            <div style="background-color: #f9fafb; padding: 12px; border-radius: 6px; margin: 0 0 24px; word-break: break-all;">
                                <a href="{{ $url }}" style="color: #3b82f6; text-decoration: none; font-size: 13px;">{{ $url }}</a>
                            </div>

                            <!-- Security Notice -->
                            <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; padding: 16px; border-radius: 8px; margin: 0 0 24px;">
                                <p style="margin: 0; color: #991b1b; font-size: 14px; line-height: 1.6;">
                                    <strong>🔒 Keamanan:</strong> Jika Anda tidak meminta reset password, abaikan email ini. Akun Anda tetap aman dan tidak ada perubahan yang dilakukan.
                                </p>
                            </div>

                            <p style="margin: 0; color: #6b7280; font-size: 14px; line-height: 1.6;">
                                Terima kasih,<br>
                                <strong style="color: #1f2937;">Tim UPA Kerjasama POLINDRA</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 30px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0 0 8px; color: #6b7280; font-size: 13px;">
                                Email ini dikirim secara otomatis, mohon tidak membalas email ini.
                            </p>
                            <p style="margin: 0 0 16px; color: #6b7280; font-size: 13px;">
                                © {{ date('Y') }} UPA Kerjasama - Politeknik Negeri Indramayu
                            </p>
                            <div style="margin-top: 16px;">
                                <a href="https://polindra.ac.id" style="color: #3b82f6; text-decoration: none; font-size: 13px; margin: 0 8px;">Website</a>
                                <span style="color: #d1d5db;">|</span>
                                <a href="mailto:upa@polindra.ac.id" style="color: #3b82f6; text-decoration: none; font-size: 13px; margin: 0 8px;">Kontak</a>
                            </div>
                        </td>
                    </tr>
                </table>

                <!-- Additional Footer Text -->
                <table role="presentation" style="width: 600px; border-collapse: collapse; margin-top: 20px;">
                    <tr>
                        <td align="center">
                            <p style="margin: 0; color: #9ca3af; font-size: 12px; line-height: 1.5;">
                                Jl. Lohbener Lama No.08, Indramayu, Jawa Barat 45252<br>
                                Telp: (0234) 5746464 | Email: info@polindra.ac.id
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
