<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requisition Slip - Email Outlook</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #eaeaea;
            color: #030303;
        }
        
        .email-container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: rgb(242, 242, 242);
            border: 1px solid #f2f2f2;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .email-header {
            background-color: #d5ad09;
            color: rgb(0, 0, 0);
            padding: 15px 20px;
            border-bottom: 3px solid #e1c00a;
        }
        
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        
        .email-body {
            padding: 25px;
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #d4bb00;
        }
        
        .company-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }
        
        .logo-circle {
            width: 40px;
            height: 40px;
            background-color: #d4aa2a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 20px;
            margin-right: 10px;
        }
        
        .company-name {
            font-size: 18px;
            font-weight: bold;
            color: #2a2a2a;
        }
        
        .form-title {
            font-size: 22px;
            font-weight: bold;
            margin: 10px 0 5px 0;
            color: #ddba07;
        }
        
        .form-subtitle {
            font-size: 14px;
            color: #070707;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .form-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #e0c40b;
        }
        
        .form-number {
            text-align: right;
            font-size: 15px;
            
            color: #090909;
            margin-bottom: 10px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            font-weight: bold;
            color: #d4b800;
            font-size: 12px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        
        .info-value {
            color: #202020;
            font-size: 14px;
            padding: 8px 12px;
            background-color: #f4f4f4;
            border-radius: 4px;
            border: 1px solid #0d0d0d;
        }
        
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
            
        }
        
        .product-table th {
            background-color: #fddf4c;
            color: rgb(0, 0, 0);
            padding: 12px 8px;
            text-align : center;
            font-weight: 900;
            border: 1px solid #000000;
        }
        
        .product-table td {
            padding: 10px 8px;
            border: 1px solid #000000;
            text-align: center;
            background-color: #fdfdfd;
        }
        
        .product-table tr:nth-child(even) td {
            background-color: #f8f9fa;
        }
        
        .product-table tr:hover td {
            background-color: #e3f2fd;
        }
        
        .signature-section {
            margin-top: 30px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        
        .signature-box {
            text-align: center;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #fafafa;
        }
        
        .signature-title {
            font-weight: bold;
            font-size: 12px;
            color: #141414;
            margin-bottom: 40px;
        }
        
        .signature-line {
            border-top: 1px solid #333;
            margin-top: 10px;
            padding-top: 5px;
            font-size: 11px;
            color: #000000;
        }
        
        .email-footer {
            background-color: #f8f9fa;
            padding: 15px 25px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #000000;
            text-align: center;
        }
                .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            font-size: 12px;
        }
        
        .signature-table th {
            background-color: #dbc60e;
            color: rgb(0, 0, 0);
            padding: 12px 8px;
            text-align: center;
            font-weight: 600;
            border: 1px solid #000000;
        }
        
        .signature-table td {
            padding: 15px 8px;
            border: 1px solid #1d1d1d;
            text-align: left;
            
            background-color: #fdfdfd;
            vertical-align: middle;
        }
        
        .signature-table tr:nth-child(even) td {
            background-color: #f8f9fa;
        }
        
        .signature-table tr:hover td {
            background-color: #e3f2fd;
        }
        
        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .signature-section {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .product-table {
                font-size: 10px;
            }
            
            .product-table th,
            .product-table td {
                padding: 6px 4px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>📧 Requisition Slip</h1>
        </div>
        
        <div class="email-body">
            <div class="form-header">
                <div class="company-logo">
                    <img src="logo.png" alt="Company Logo" style="width: 25%; height: 100px; padding: 10px; ">
                    
                </div>
                <div class="form-title">REQUISITION SLIP</div>
                <div class="form-subtitle">SALES & MARKETING<br>SAMPLE PRODUCT</div>
            </div>
            
            
            <div class="form-info">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                    <div class="email-description">
                        <p style="margin: 0; font-size: 16px; color: #050505; line-height: 1.5;">
                            <!-- <strong>Subject:</strong> Requisition Slip - Permintaan Barang Sales & Marketing<br>
                            <strong>From:</strong> system@sinarmeadow.com<br>
                            <strong>To:</strong> warehouse@sinarmeadow.com<br> -->
                            <strong>Dear All:</strong> Form Requesition has been<br>

                        </p>
                    </div>
                    <div class="form-number">
                        <strong>FORM NO:</strong> RS200112012<br>
                    </div>
                </div>
                
                
                <div class="info-grid">                     
                    <div class="info-item">
                        <div class="info-label">Customer Name</div>
                        <div class="info-value">Ny Liem/PT Citra Bhoga Jaya</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Address</div>
                        <div class="info-value">Bandung</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Tanggal</div>
                        <div class="info-value">9 Januari 2025</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Cost Center</div>
                        <div class="info-value">225</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Account</div>
                        <div class="info-value">5300</div>
                    </div>
                </div>
            </div>
            
            <table class="product-table">
                <thead>
                    <tr>
                        <th>PRODUCT CODE</th>
                        <th>PRODUCT NAME</th>
                        <th>UNIT</th>
                        <th>QTY REQUIRED</th>
                        <th>QTY ISSUED</th>
                        <th>OBJECTIVES</th>
                        <th>ESTIMASI POTENSI<br>(Remarks in Carton)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-weight: 600; color: #000000;">IGC531</td>
                        <td style="font-weight: 600; color: #000000;">GB Grand 15kg</td>
                        <td style="font-weight: 600; color: #000000;">15 kg</td>
                        <td style="font-weight: 600; color: #000000;">14</td>
                        <td style="font-weight: 600; color: #000000;">-</td>
                        <td style="font-weight: 600; color: #000000;">Sponsorship</td>
                        <td style="font-weight: 600; color: #000000;">-</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #000000;">IUC205</td>
                        <td style="font-weight: 600; color: #000000;">Moremade Saffire</td>
                        <td style="font-weight: 600; color: #000000;">17 kg</td>
                        <td style="font-weight: 600; color: #000000;">5</td>
                        <td style="font-weight: 600; color: #000000;">-</td>
                        <td style="font-weight: 600; color: #000000;">Product Testing</td>
                        <td style="font-weight: 600; color: #000000;">High Potential</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #000000;">IGC532</td>
                        <td style="font-weight: 600; color: #000000;">GB Grand 25kg</td>
                        <td style="font-weight: 600; color: #000000;">25 kg</td>
                        <td style="font-weight: 600; color: #000000;">3</td>
                        <td style="font-weight: 600; color: #000000;">-</td>
                        <td style="font-weight: 600; color: #000000;">Product Testing</td>
                        <td style="font-weight: 600; color: #000000;">Medium Potential</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #000000;">IGC533</td>
                        <td style="font-weight: 600; color: #000000;">GB Grand 50kg</td>
                        <td style="font-weight: 600; color: #000000;">50 kg</td>
                        <td style="font-weight: 600; color: #000000;">2</td>
                        <td style="font-weight: 600; color: #000000;">-</td>
                        <td style="font-weight: 600; color: #000000;">Product Testing</td>
                        <td style="font-weight: 600; color: #000000;">Low Potential</td>
                </tbody>
            </table>
            
            <table class="signature-table">
                <thead>
                    <tr>
                        
                        <th>NAME/SIGNATURE</th>
                        <th>APPROVE NOT REVIEW</th>
                        <th>APPROVE WITH REVIEW</th>
                        <th>NOT APPROVED</th>
                        <th>NOTES</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                        <td style="font-weight: 600;">Sales</td>
                        <td style="font-weight: 600; text-align: center;color:  rgb(4, 129, 25);">Approved not Review</td>
                        <td style="font-weight: 600; text-align: center;color:  rgb(226, 210, 30);"></td>
                        <td style="font-weight: 600; text-align: center;color:  rgb(244, 50, 33);"></td>
                        <td style="font-weight: 600;"></td>
                    </tr>
                    <tr>
                        
                        <td style="font-weight: 600;">Sales Manager</td>
                        <td style="font-weight: 600; text-align: center;color:  rgb(4, 129, 25);">Approved not Review</td>
                        <td style="font-weight: 600; text-align: center;color:  rgb(226, 210, 30);"></td>
                        <td style="font-weight: 600; text-align: center;color:  rgb(244, 50, 33);"></td>
                        <td style="font-weight: 600;"></td>
                    </tr>
                    <tr>
                        
                        <td style="font-weight: 600;">Warehouse Supervisor</td>
                        <td style="font-weight: 600; text-align: center;color:  rgb(4, 129, 25);"></td>
                        <td style="font-weight: 600; text-align: center;color:  rgb(226, 210, 30);">Approved not Review</td>
                        <td style="font-weight: 600; text-align: center;color:  rgb(244, 50, 33);"></td>
                        <td style="font-weight: 600;">lorem ipsum</td>
                    </tr>
                    <tr>
                        
                        <td style="font-weight: 600;">Dept. Head</td>
                        <td style="font-weight: 600; text-align: center;color:  rgb(4, 129, 25);"></td>
                        <td style="font-weight: 600; text-align: center;color:  rgb(226, 210, 30);">Approved not Review</td>
                        <td style="font-weight: 600; text-align: center;color:  rgb(244, 50, 33);"></td>
                        <td style="font-weight: 600;">BABABABANAAAANA</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="email-footer">
            <p><strong>Email ini dikirim secara otomatis dari sistem Requisition Management.</strong></p>
            <p>Jika ada pertanyaan, silakan hubungi tim Sales & Marketing di ext. 225</p>
            <p>© 2025 Sinar Meadow. All rights reserved.</p>
        </div>
    </div>
</body>
</html>