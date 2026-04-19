<!DOCTYPE html>
<html>
<head>
    <title>My Exam Results Report</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #333; margin: 0; padding: 0; }
        .header { background: #4f46e5; color: #fff; padding: 40px 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; }
        .header p { margin: 5px 0 0; opacity: 0.8; font-size: 14px; }
        
        .summary { padding: 30px; background: #f9fafb; border-bottom: 1px solid #e5e7eb; }
        .summary-grid { width: 100%; border-collapse: collapse; }
        .summary-box { padding: 15px; text-align: center; border: 1px solid #e5e7eb; background: #fff; width: 25%; }
        .summary-box .label { font-size: 10px; color: #9ca3af; text-transform: uppercase; margin-bottom: 5px; }
        .summary-box .value { font-size: 18px; font-weight: bold; color: #1f2937; }

        .content { padding: 30px; }
        .content h2 { font-size: 18px; margin-bottom: 20px; color: #1f2937; border-bottom: 2px solid #4f46e5; display: inline-block; padding-bottom: 5px; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th { background: #f3f4f6; text-align: left; padding: 12px 10px; font-size: 12px; font-weight: bold; color: #4b5563; border-bottom: 1px solid #e5e7eb; }
        td { padding: 12px 10px; font-size: 12px; color: #374151; border-bottom: 1px solid #f3f4f6; }
        
        .badge { padding: 4px 10px; border-radius: 20px; font-size: 10px; font-weight: bold; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-danger { background: #fee2e2; color: #991b1b; }

        .footer { position: fixed; bottom: 30px; width: 100%; text-align: center; font-size: 10px; color: #9ca3af; }

        @media print {
            .header { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .badge-success { -webkit-print-color-adjust: exact; print-color-adjust: exact; background-color: #d1fae5 !important; }
            .badge-danger { -webkit-print-color-adjust: exact; print-color-adjust: exact; background-color: #fee2e2 !important; }
            .summary { -webkit-print-color-adjust: exact; print-color-adjust: exact; background-color: #f9fafb !important; }
        }
    </style>
</head>
<body>
    <div class="header" style="background: linear-gradient(135deg, #1e1b4b 0%, #4338ca 100%);">
        <div style="display: flex; align-items: center; justify-content: center; gap: 20px; margin-bottom: 10px;">
            <img src="{{ asset('assets/images/MJ logo.jpg') }}" style="width: 60px; height: 60px; border-radius: 10px; border: 2px solid rgba(255,255,255,0.2);">
            <div style="text-align: left;">
                <h1 style="margin: 0; font-size: 28px; letter-spacing: 1px;">MAKTABAH JAFARIYAH</h1>
                <p style="margin: 0; font-size: 12px; text-transform: uppercase; letter-spacing: 2px; opacity: 0.8;">College of Excellence & Learning</p>
            </div>
        </div>
        <div style="height: 1px; background: rgba(255,255,255,0.1); margin: 15px 0;"></div>
        <p>Official Academic Performance Report | Student: {{ $user->name }}</p>
    </div>

    <div class="summary">
        <table class="summary-grid">
            <tr>
                <td class="summary-box">
                    <div class="label">Exams Taken</div>
                    <div class="value">{{ $results->count() }}</div>
                </td>
                <td class="summary-box">
                    <div class="label">Passes</div>
                    <div class="value">{{ $results->where('passed', true)->count() }}</div>
                </td>
                <td class="summary-box">
                    <div class="label">Avg Score</div>
                    <div class="value">{{ round($results->avg('score')) }}%</div>
                </td>
                <td class="summary-box">
                    <div class="label">Status</div>
                    <div class="value" style="color: {{ $results->where('passed', true)->count() >= $results->count() / 2 ? '#10b981' : '#ef4444' }}">
                        {{ $results->where('passed', true)->count() >= $results->count() / 2 ? 'EXCELLENT' : 'PROBATION' }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="content">
        <h2>Detailed Academic Logs</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Exam Title</th>
                    <th>Subject</th>
                    <th>Score</th>
                    <th>Result</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $i => $r)
                <tr>
                    <td>{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</td>
                    <td><strong>{{ $r->exam->title }}</strong></td>
                    <td>{{ $r->exam->topic ? $r->exam->topic->name : 'N/A' }}</td>
                    <td>{{ $r->score }}%</td>
                    <td>
                        @if($r->passed)
                            <span class="badge badge-success">PASSED</span>
                        @else
                            <span class="badge badge-danger">FAILED</span>
                        @endif
                    </td>
                    <td>{{ $r->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer" style="padding-bottom: 20px;">
        This document is a certified digital record of academic achievement from Maktabah Jafariyah Online Exam Portal.
    </div>

    <!-- PDF Generation Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        window.onload = function() {
            const element = document.body;
            const opt = {
                margin:       0,
                filename:     'Maktabah_Jafariyah_Result_{{ $user->name }}.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(element).save().then(() => {
                // Optional: redirect back after download
                setTimeout(() => {
                    window.location.href = '/viewresult';
                }, 2000);
            });
        };
    </script>
</body>
</html>
