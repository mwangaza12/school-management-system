<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Structure</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a1a1a;
            --secondary: #f5f5f5;
            --border: #e0e0e0;
            --text: #333333;
            --text-light: #666666;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: var(--text);
            line-height: 1.5;
        }
        
        .container {
            width: 100%;
        }
        
        .card {
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .header {
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid var(--border);
        }
        
        .logo {
            width: 80px;
            height: 80px;
            background-color: var(--secondary);
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 24px;
            color: var(--primary);
        }
        
        .school-name {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--primary);
        }
        
        .motto {
            font-size: 16px;
            font-weight: 300;
            margin-bottom: 10px;
            color: var(--text-light);
        }
        
        .contact {
            font-size: 14px;
            color: var(--text-light);
        }
        
        .content {
            padding: 30px;
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 20px;
            text-align: center;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        
        th {
            background-color: var(--secondary);
            color: var(--primary);
            font-weight: 600;
            text-align: left;
            padding: 15px;
            font-size: 16px;
        }
        
        td {
            padding: 15px;
            border-bottom: 1px solid var(--border);
            font-size: 15px;
        }
        
        .total-row {
            background-color: var(--secondary);
            font-weight: 600;
        }
        
        .payment-info {
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .payment-info h3 {
            color: var(--primary);
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .payment-info p {
            margin-bottom: 10px;
            font-size: 15px;
        }
        
        .payment-note {
            font-weight: 500;
            margin-top: 15px;
        }
        
        .signature {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .signature-box {
            width: 40%;
            border-top: 2px solid var(--border);
            padding-top: 15px;
            text-align: center;
        }
        
        .signature-title {
            font-weight: 500;
            font-size: 14px;
            color: var(--text-light);
        }
        
        .footer {
            text-align: center;
            color: var(--text-light);
            font-size: 14px;
            padding: 20px;
            border-top: 1px solid var(--border);
        }
        
        @media (max-width: 600px) {
            .header {
                padding: 20px;
            }
            
            .content {
                padding: 20px;
            }
            
            th, td {
                padding: 12px 10px;
            }
            
            .signature {
                flex-direction: column;
            }
            
            .signature-box {
                width: 100%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <div class="logo">GBS</div>
                <div class="school-name">Ganze Boys Secondary School</div>
                <div class="motto">"We Trust in God"</div>
                <div class="contact">80108 | ganzeboys@gmail.com | +254792918456</div>
            </div>
            
            <div class="content">
                <h2 class="section-title">Fee Structure - {{ $fees->first()->term }}</h2>
                
                <table>
                    <thead>
                        <tr>
                            <th>Account</th>
                            <th>Amount (KSh)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fees as $fee)   
                        <tr>                            
                            <td>{{ $fee->name }}</td>
                            <td>{{ number_format($fee->amount, 2) }}</td>  
                        </tr>
                        @endforeach
                        <tr class="total-row">
                            <td>Total</td>
                            <td>KSh. {{ number_format($fees->sum('amount'), 2) }}</td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="payment-info">
                    <h3>Payment Details</h3>
                    <p><strong>Bank Name:</strong> Equity Bank</p>
                    <p><strong>Account Name:</strong> Ganze Boys Secondary School</p>
                    <p><strong>Account Number:</strong> 1234567890</p>
                    <p class="payment-note">Please ensure you use the student's admission number as the payment reference.</p>
                </div>
                
                <div class="signature">
                    <div class="signature-box">
                        <p class="signature-title">Authorized Signature</p>
                    </div>
                </div>
            </div>
            
            <div class="footer">
                <p>Thank you for being a part of Ganze Boys Secondary School.</p>
            </div>
        </div>
    </div>
</body>
</html>