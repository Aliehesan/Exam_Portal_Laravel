@extends('User.userlayout')

@section('User-content')
    <style>
        .review-header-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            padding: 2.5rem 2rem;
            color: #fff;
        }

        .review-score-box {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 1rem 1.5rem;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .review-summary-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .review-stat-item {
            text-align: center;
            padding: 0.75rem 0;
        }

        .review-stat-label {
            font-size: 12px;
            color: #9ca3af;
            margin-bottom: 4px;
        }

        .review-stat-value {
            font-weight: 700;
            font-size: 16px;
            color: #1f2937;
        }

        .review-question-card {
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            transition: box-shadow 0.2s;
        }

        .review-question-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
        }

        .review-question-header {
            background: #f9fafb;
            border-bottom: 1px solid #f1f5f9;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .review-question-body {
            padding: 1.5rem;
        }

        .review-question-text {
            font-size: 1.05rem;
            font-weight: 600;
            color: #1f2937;
            line-height: 1.6;
            margin-bottom: 1.25rem;
        }

        .review-option {
            display: flex;
            align-items: center;
            padding: 0.85rem 1rem;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            background: #fff;
            transition: all 0.2s;
            margin-bottom: 0.5rem;
        }

        .review-option-correct {
            border: 2px solid #10b981;
            background: #ecfdf5;
            color: #065f46;
        }

        .review-option-wrong {
            border: 2px solid #ef4444;
            background: #fef2f2;
            color: #991b1b;
        }

        .review-option-letter {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 50%;
            font-size: 12px;
            font-weight: 700;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .review-option-correct .review-option-letter {
            background: rgba(16, 185, 129, 0.2);
            color: #065f46;
        }

        .review-option-wrong .review-option-letter {
            background: rgba(239, 68, 68, 0.2);
            color: #991b1b;
        }

        .review-option-text {
            font-size: 13px;
            font-weight: 500;
            flex: 1;
        }

        .review-badge-correct {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #d1fae5;
            color: #065f46;
            font-size: 12px;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 10px;
        }

        .review-badge-incorrect {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #fee2e2;
            color: #991b1b;
            font-size: 12px;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 10px;
        }

        .review-badge-pick {
            background: #1f2937;
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 4px;
            margin-left: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .review-expert-note {
            background: #fefce8;
            border-radius: 12px;
            border: 1px solid #fef08a;
            padding: 1rem;
            margin-top: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .review-expert-note-icon {
            color: #d97706;
            font-size: 16px;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .review-expert-note-title {
            font-weight: 700;
            color: #1f2937;
            font-size: 12px;
            margin-bottom: 4px;
        }

        .review-expert-note-text {
            font-size: 12px;
            color: #6b7280;
            margin: 0;
        }

        .review-back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #f3f4f6;
            color: #374151;
            padding: 0.65rem 2rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 13px;
            text-decoration: none;
            border: 1px solid #e5e7eb;
            transition: all 0.2s;
        }

        .review-back-btn:hover {
            background: #e5e7eb;
            color: #1f2937;
        }

        .review-progress-ring {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            position: relative;
        }
    </style>

    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Exam Review</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('user-dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('viewresult') }}">Results</a></li>
                <li class="breadcrumb-item">Review</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="row g-4">
            {{-- Summary Header --}}
            <div class="col-12">
                <div class="review-summary-card card">
                    <div class="review-header-gradient">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <span
                                    style="display:inline-block;background:#fff;color:#4f46e5;font-weight:700;font-size:11px;padding:5px 15px;border-radius:20px;margin-bottom:10px;">
                                    {{ $result->exam->topic ? $result->exam->topic->name : 'General' }}
                                </span>
                                <h2 style="font-weight:800;font-size:1.75rem;margin-bottom:4px;color:#fff">
                                    {{ $result->exam->title }}</h2>
                                <p style="opacity:0.75;margin:0;font-size:13px;color:#fff">Attempted on
                                    {{ $result->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                            <div class="col-md-4 text-md-end mt-4 mt-md-0">
                                <div class="review-score-box">
                                    <div
                                        style="font-size:10px;text-transform:uppercase;font-weight:700;opacity:0.75;letter-spacing:1px;margin-bottom:4px">
                                        Final Score</div>
                                    <div style="font-size:2.5rem;font-weight:800;line-height:1">{{ $result->score }}<span
                                            style="font-size:1.25rem;font-weight:400">/100</span></div>
                                    <div style="margin-top:8px">
                                        @if($result->passed)
                                            <span
                                                style="display:inline-block;background:#10b981;color:#fff;padding:4px 16px;border-radius:20px;font-size:11px;font-weight:700">PASSED</span>
                                        @else
                                            <span
                                                style="display:inline-block;background:#ef4444;color:#fff;padding:4px 16px;border-radius:20px;font-size:11px;font-weight:700">FAILED</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding:1.25rem 2rem;background:#fff">
                        <div class="row text-center g-3">
                            <div class="col-6 col-md-3">
                                <div class="review-stat-item">
                                    <div class="review-stat-label">Total Questions</div>
                                    <div class="review-stat-value">{{ $result->total_questions }}</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3" style="border-left:1px solid #f1f5f9">
                                <div class="review-stat-item">
                                    <div class="review-stat-label" style="color:#10b981">Correct</div>
                                    <div class="review-stat-value" style="color:#10b981">{{ $result->correct_answers }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3" style="border-left:1px solid #f1f5f9">
                                <div class="review-stat-item">
                                    <div class="review-stat-label" style="color:#ef4444">Wrong</div>
                                    <div class="review-stat-value" style="color:#ef4444">
                                        {{ $result->total_questions - $result->correct_answers }}</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3" style="border-left:1px solid #f1f5f9">
                                <div class="review-stat-item">
                                    <div class="review-stat-label">Accuracy</div>
                                    <div class="review-stat-value">
                                        {{ round(($result->correct_answers / max($result->total_questions, 1)) * 100) }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Questions List --}}
            <div class="col-12">
                <h5 style="margin-bottom:1rem;font-weight:700;color:#1f2937;font-size:1.1rem">
                    <i class="feather-list" style="color:#4f46e5;margin-right:8px"></i> Question Details
                </h5>
                @foreach($userAnswers as $index => $answer)
                    @php
                        $isCorrect = $answer->is_correct;
                        $q = $answer->question;
                    @endphp
                    <div class="review-question-card">
                        <div class="review-question-header">
                            <div style="font-weight:700;color:#1f2937;font-size:14px">Question {{ $index + 1 }}</div>
                            @if(!$answer->selected_option)
                                <span class="review-badge-incorrect" style="background:#f3f4f6;color:#6b7280">
                                    <i class="feather-minus-circle" style="font-size:12px"></i> Skipped
                                </span>
                            @elseif($isCorrect)
                                <span class="review-badge-correct">
                                    <i class="feather-check" style="font-size:12px"></i> Correct
                                </span>
                            @else
                                <span class="review-badge-incorrect">
                                    <i class="feather-x" style="font-size:12px"></i> Incorrect
                                </span>
                            @endif
                        </div>
                        <div class="review-question-body">
                            <div class="review-question-text">{{ $q->question }}</div>

                            <div class="row g-2">
                                @foreach(['A' => $q->option_a, 'B' => $q->option_b, 'C' => $q->option_c, 'D' => $q->option_d] as $key => $val)
                                    @php
                                        $isUserSelected = strtoupper($answer->selected_option) === $key;
                                        $isCorrectOption = strtoupper($q->correct_answer) === $key;

                                        $optionClass = 'review-option';
                                        if ($isCorrectOption) {
                                            $optionClass .= ' review-option-correct';
                                        }
                                        if ($isUserSelected && !$isCorrect) {
                                            $optionClass .= ' review-option-wrong';
                                        }
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="{{ $optionClass }}">
                                            <span class="review-option-letter">{{ $key }}</span>
                                            <span class="review-option-text">{{ $val }}</span>
                                            @if($isCorrectOption)
                                                <i class="feather-check-circle"
                                                    style="color:#10b981;font-size:16px;margin-left:auto"></i>
                                            @endif
                                            @if($isUserSelected && !$isCorrect)
                                                <i class="feather-x-circle" style="color:#ef4444;font-size:16px;margin-left:auto"></i>
                                            @endif
                                            @if($isUserSelected)
                                                <span class="review-badge-pick">YOUR PICK</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if(!$isCorrect)
                                <div class="review-expert-note">
                                    <i class="feather-info review-expert-note-icon"></i>
                                    <div>
                                        <div class="review-expert-note-title">Expert Note:</div>
                                        <p class="review-expert-note-text">
                                            @if(!$answer->selected_option)
                                                This question was <strong>skipped</strong>. The correct answer is <strong>Option {{ $q->correct_answer }}</strong>.
                                            @else
                                                The correct answer is <strong>Option {{ $q->correct_answer }}</strong>. You selected Option {{ $answer->selected_option }}.
                                            @endif
                                            Review the topic again to strengthen your understanding.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

                @if($userAnswers->count() === 0)
                    <div class="card" style="border-radius:16px;padding:3rem;text-align:center">
                        <i class="feather-alert-circle" style="font-size:48px;color:#d1d5db;margin-bottom:1rem"></i>
                        <h6 style="color:#6b7280;font-weight:600">No answer data available for this exam attempt.</h6>
                    </div>
                @endif
            </div>

            <div class="col-12 text-center" style="padding:2rem 0">
                <a href="{{ url('viewresult') }}" class="review-back-btn">
                    <i class="feather-arrow-left"></i> Back to Results
                </a>
            </div>
        </div>
    </div>
@endsection