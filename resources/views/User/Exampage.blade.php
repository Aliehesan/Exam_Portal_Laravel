<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $activeExam->title ?? 'Exam' }} — Online Exam</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/MJ logo.jpg') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: #f0f2f5;
            color: #1a1a2e;
            min-height: 100vh;
        }

        /* ─── Top Bar ─── */
        .exam-topbar {
            background: linear-gradient(135deg, #1e293b, #334155);
            color: #fff;
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 2px 12px rgba(0,0,0,.15);
        }

        .exam-topbar-title h1 {
            font-size: 1.05rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: -.02em;
        }

        .exam-topbar-title small {
            font-size: .75rem;
            opacity: .7;
            font-weight: 400;
        }

        .exam-topbar-timer {
            background: #ef4444;
            color: #fff;
            font-weight: 700;
            font-size: .95rem;
            padding: 6px 18px;
            border-radius: 8px;
            font-variant-numeric: tabular-nums;
            letter-spacing: .03em;
            animation: pulse-timer 2s ease-in-out infinite;
        }

        @keyframes pulse-timer {
            0%, 100% { box-shadow: 0 0 0 0 rgba(239,68,68,.4); }
            50%       { box-shadow: 0 0 0 6px rgba(239,68,68,0); }
        }

        /* ─── Main Layout ─── */
        .exam-body {
            display: flex;
            max-width: 1280px;
            margin: 24px auto;
            padding: 0 20px;
            gap: 24px;
        }

        /* ─── Question Panel ─── */
        .exam-question-panel {
            flex: 1;
            min-width: 0;
        }

        .exam-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 1px 4px rgba(0,0,0,.06);
            padding: 32px;
        }

        .exam-q-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .exam-q-badge {
            background: #ede9fe;
            color: #6d28d9;
            font-size: .75rem;
            font-weight: 700;
            padding: 4px 14px;
            border-radius: 20px;
        }

        .exam-q-text {
            font-size: 1.1rem;
            line-height: 1.7;
            color: #334155;
            margin-bottom: 24px;
        }

        /* Options */
        .exam-opt {
            display: flex;
            align-items: center;
            gap: 14px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all .2s;
            background: #fff;
        }

        .exam-opt:hover {
            border-color: #818cf8;
            background: #f5f3ff;
        }

        .exam-opt.selected {
            border-color: #6366f1;
            background: #eef2ff;
        }

        .exam-opt input[type="radio"] {
            width: 18px;
            height: 18px;
            accent-color: #6366f1;
            flex-shrink: 0;
        }

        .exam-opt-key {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: .85rem;
            color: #475569;
            flex-shrink: 0;
        }

        .exam-opt.selected .exam-opt-key {
            background: #6366f1;
            color: #fff;
        }

        .exam-opt-text {
            font-size: .95rem;
            color: #334155;
        }

        /* Action Bar */
        .exam-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
        }

        .exam-btn {
            padding: 10px 24px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: .875rem;
            cursor: pointer;
            transition: all .2s;
            font-family: inherit;
        }

        .exam-btn-prev {
            background: #f1f5f9;
            color: #475569;
        }
        .exam-btn-prev:hover { background: #e2e8f0; }
        .exam-btn-prev:disabled { opacity: .4; cursor: not-allowed; }

        .exam-btn-next {
            background: #6366f1;
            color: #fff;
        }
        .exam-btn-next:hover { background: #4f46e5; }

        .exam-btn-submit {
            background: #10b981;
            color: #fff;
            margin-left: auto;
        }
        .exam-btn-submit:hover { background: #059669; }

        /* ─── Sidebar ─── */
        .exam-sidebar-panel {
            width: 300px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .exam-sidebar-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 1px 4px rgba(0,0,0,.06);
            padding: 24px;
        }

        .exam-sidebar-card h4 {
            font-size: .9rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 16px;
        }

        /* Palette */
        .exam-palette-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 8px;
        }

        .exam-palette-item {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            background: #fff;
            color: #64748b;
        }

        .exam-palette-item:hover { border-color: #94a3b8; }

        .exam-palette-item.current {
            background: #6366f1;
            border-color: #6366f1;
            color: #fff;
        }

        .exam-palette-item.answered {
            background: #d1fae5;
            border-color: #10b981;
            color: #059669;
        }

        /* Legend */
        .exam-legend {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 16px;
        }

        .exam-legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .78rem;
            color: #64748b;
        }

        .exam-legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 4px;
            flex-shrink: 0;
        }

        /* Stats */
        .exam-stat-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .exam-stat-box {
            text-align: center;
            padding: 12px;
            border-radius: 10px;
            background: #f8fafc;
        }

        .exam-stat-box .num {
            font-size: 1.3rem;
            font-weight: 800;
            color: #1e293b;
        }

        .exam-stat-box .label {
            font-size: .7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #94a3b8;
            margin-top: 2px;
        }

        /* Responsive */
        @media (max-width: 860px) {
            .exam-body {
                flex-direction: column;
            }
            .exam-sidebar-panel {
                width: 100%;
                flex-direction: row;
                flex-wrap: wrap;
            }
            .exam-sidebar-card {
                flex: 1;
                min-width: 240px;
            }
        }
    </style>
</head>

<body>

    {{-- ─── Top Bar ─── --}}
    <div class="exam-topbar">
        <div class="exam-topbar-title">
            <h1>{{ $activeExam->title ?? 'Exam' }}</h1>
            <small>{{ $activeExam->topic->name ?? 'General' }} &nbsp;•&nbsp; {{ count($questions) }} Questions &nbsp;•&nbsp; {{ $activeExam->duration_minutes ?? 30 }} Minutes</small>
        </div>
        <div class="exam-topbar-timer" id="exam-timer">⏱ --:--</div>
    </div>

    {{-- ─── Body ─── --}}
    <div class="exam-body">

        {{-- Question Panel --}}
        <div class="exam-question-panel">
            <div class="exam-card">
                <div class="exam-q-header">
                    <span class="exam-q-badge" id="exam-q-badge">Question 1 of {{ count($questions) }}</span>
                </div>
                <p class="exam-q-text" id="exam-q-text"></p>

                <div id="exam-options"></div>

                <div class="exam-actions">
                    <button class="exam-btn exam-btn-prev" id="exam-btn-prev" onclick="prevQuestion()">← Previous</button>
                    <button class="exam-btn exam-btn-next" id="exam-btn-next" onclick="nextQuestion()">Next →</button>
                    <button class="exam-btn exam-btn-submit" id="exam-btn-submit" onclick="submitExam()" style="display:none;">✓ Submit Exam</button>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="exam-sidebar-panel">

            {{-- Stats --}}
            <div class="exam-sidebar-card">
                <h4>Progress</h4>
                <div class="exam-stat-grid">
                    <div class="exam-stat-box">
                        <div class="num" id="stat-answered">0</div>
                        <div class="label">Answered</div>
                    </div>
                    <div class="exam-stat-box">
                        <div class="num" id="stat-remaining">{{ count($questions) }}</div>
                        <div class="label">Remaining</div>
                    </div>
                    <div class="exam-stat-box">
                        <div class="num">{{ count($questions) }}</div>
                        <div class="label">Total</div>
                    </div>
                    <div class="exam-stat-box">
                        <div class="num">{{ $activeExam->duration_minutes ?? 30 }}m</div>
                        <div class="label">Duration</div>
                    </div>
                </div>
            </div>

            {{-- Palette --}}
            <div class="exam-sidebar-card">
                <h4>Question Navigator</h4>
                <div class="exam-palette-grid" id="exam-palette"></div>
                <div class="exam-legend">
                    <div class="exam-legend-item">
                        <div class="exam-legend-dot" style="background:#6366f1;"></div> Current Question
                    </div>
                    <div class="exam-legend-item">
                        <div class="exam-legend-dot" style="background:#d1fae5; border:1px solid #10b981;"></div> Answered
                    </div>
                    <div class="exam-legend-item">
                        <div class="exam-legend-dot" style="background:#fff; border:1px solid #e2e8f0;"></div> Not Visited
                    </div>
                </div>
            </div>

        </div>{{-- /sidebar --}}
    </div>{{-- /body --}}

    <script>
        (function () {
            const questions = @json($questions);
            const examId = {{ $activeExam->id ?? 0 }};
            const totalQuestions = questions.length;
            let time = {{ ($activeExam->duration_minutes ?? 30) * 60 }};
            let currentIndex = 0;
            let userAnswers = {};

            // DOM refs
            const qBadge = document.getElementById('exam-q-badge');
            const qText = document.getElementById('exam-q-text');
            const optionsEl = document.getElementById('exam-options');
            const paletteEl = document.getElementById('exam-palette');
            const btnPrev = document.getElementById('exam-btn-prev');
            const btnNext = document.getElementById('exam-btn-next');
            const btnSubmit = document.getElementById('exam-btn-submit');
            const timerEl = document.getElementById('exam-timer');
            const statAnswered = document.getElementById('stat-answered');
            const statRemaining = document.getElementById('stat-remaining');

            // ─── Build palette ───
            questions.forEach(function (q, i) {
                const el = document.createElement('div');
                el.className = 'exam-palette-item';
                el.innerText = i + 1;
                el.onclick = function () { goTo(i); };
                paletteEl.appendChild(el);
            });

            // ─── Timer ───
            function tick() {
                if (time <= 0) {
                    clearInterval(timerInterval);
                    timerEl.innerText = '⏱ 00:00';
                    clearInterval(timerInterval);
                    timerEl.innerText = '⏱ 00:00';
                    Swal.fire({
                        title: 'Time is up!',
                        text: 'Your exam is being automatically submitted.',
                        icon: 'warning',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        doSubmit();
                    });
                    return;
                }
                var m = Math.floor(time / 60);
                var s = time % 60;
                timerEl.innerText = '⏱ ' + (m < 10 ? '0' : '') + m + ':' + (s < 10 ? '0' : '') + s;
                time--;
            }
            tick();
            var timerInterval = setInterval(tick, 1000);

            // ─── Load question ───
            function loadQuestion(idx) {
                currentIndex = idx;
                var q = questions[idx];

                qBadge.innerText = 'Question ' + (idx + 1) + ' of ' + totalQuestions;
                qText.innerText = q.question;

                var opts = [
                    { key: 'A', text: q.option_a },
                    { key: 'B', text: q.option_b },
                    { key: 'C', text: q.option_c },
                    { key: 'D', text: q.option_d }
                ];

                optionsEl.innerHTML = '';
                opts.forEach(function (opt) {
                    var label = document.createElement('label');
                    label.className = 'exam-opt' + (userAnswers[q.id] === opt.key ? ' selected' : '');

                    var radio = document.createElement('input');
                    radio.type = 'radio';
                    radio.name = 'answer';
                    radio.value = opt.key;
                    if (userAnswers[q.id] === opt.key) radio.checked = true;

                    radio.onchange = function () {
                        userAnswers[q.id] = opt.key;
                        // Update selection styling
                        optionsEl.querySelectorAll('.exam-opt').forEach(function (el) { el.classList.remove('selected'); });
                        label.classList.add('selected');
                        updateStats();
                        updatePalette();
                    };

                    var keyDiv = document.createElement('div');
                    keyDiv.className = 'exam-opt-key';
                    keyDiv.innerText = opt.key;

                    var textSpan = document.createElement('span');
                    textSpan.className = 'exam-opt-text';
                    textSpan.innerText = opt.text;

                    label.appendChild(radio);
                    label.appendChild(keyDiv);
                    label.appendChild(textSpan);
                    optionsEl.appendChild(label);
                });

                updatePalette();
                updateButtons();
            }

            function updatePalette() {
                var items = paletteEl.querySelectorAll('.exam-palette-item');
                items.forEach(function (el, i) {
                    el.className = 'exam-palette-item';
                    if (i === currentIndex) {
                        el.classList.add('current');
                    } else if (userAnswers[questions[i].id]) {
                        el.classList.add('answered');
                    }
                });
            }

            function updateButtons() {
                btnPrev.disabled = currentIndex === 0;
                if (currentIndex === totalQuestions - 1) {
                    btnNext.style.display = 'none';
                    btnSubmit.style.display = 'inline-block';
                } else {
                    btnNext.style.display = 'inline-block';
                    btnSubmit.style.display = 'none';
                }
            }

            function updateStats() {
                var count = Object.keys(userAnswers).length;
                statAnswered.innerText = count;
                statRemaining.innerText = totalQuestions - count;
            }

            // ─── Navigation (exposed globally for onclick) ───
            window.nextQuestion = function () {
                if (currentIndex < totalQuestions - 1) loadQuestion(currentIndex + 1);
            };
            window.prevQuestion = function () {
                if (currentIndex > 0) loadQuestion(currentIndex - 1);
            };
            window.goTo = function (i) {
                loadQuestion(i);
            };

            // ─── Submit ───
            let isSubmitting = false;

            function doSubmit() {
                if (isSubmitting) return;
                isSubmitting = true;

                window.onbeforeunload = null;

                Swal.fire({
                    title: 'Submitting Exam...',
                    text: 'Please wait while we process your results.',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });

                fetch('/submit-exam', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ exam_id: examId, answers: userAnswers })
                })
                .then(async function (response) {
                    const text = await response.text();
                    try {
                        return JSON.parse(text);
                    } catch (e) {
                        console.error('Raw Server Response:', text);
                        throw new Error('Invalid JSON response from server');
                    }
                })
                .then(function (data) {
                    if (data && data.success) {
                        Swal.fire({
                            title: 'Exam Submitted!',
                            html: `<div style="text-align:center;">
                                     <h3 style="margin-bottom:10px;">Score: ${data.score}%</h3>
                                     <p>Status: <strong style="color:${data.passed ? '#10b981' : '#ef4444'}">${data.passed ? 'PASSED ✓' : 'FAILED ✗'}</strong></p>
                                   </div>`,
                            icon: data.passed ? 'success' : 'info',
                            confirmButtonText: 'View Review',
                            allowOutsideClick: false
                        }).then(() => {
                            window.location.href = '/review/' + data.result_id;
                        });
                    } else {
                        throw new Error(data.message || 'Submission failed');
                    }
                })
                .catch(function (err) {
                    isSubmitting = false;
                    console.error('Submission Error:', err);
                    Swal.fire({
                        title: 'Notice',
                        text: 'We encountered a minor issue displaying your result, but your exam has likely been saved. Please check your results page.',
                        icon: 'info',
                        confirmButtonText: 'Go to Results'
                    }).then(() => {
                        window.location.href = '/viewresult';
                    });
                });
            }

            window.submitExam = function () {
                const answered = Object.keys(userAnswers).length;
                const unanswered = totalQuestions - answered;
                
                Swal.fire({
                    title: 'Final Submission',
                    html: `
                        <div style="text-align:left; padding: 10px;">
                            <p style="margin-bottom:8px;">• Total Questions: <strong>${totalQuestions}</strong></p>
                            <p style="margin-bottom:8px;">• Answered: <strong style="color:#10b981;">${answered}</strong></p>
                            ${unanswered > 0 ? `<p style="color:#ef4444;">• Unanswered: <strong>${unanswered}</strong></p>` : ''}
                        </div>
                        <p style="margin-top:15px; font-weight:500;">Are you sure you want to end the exam?</p>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#10b981',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Yes, Submit Exam',
                    cancelButtonText: 'Review Answers',
                    padding: '2em',
                    customClass: {
                        popup: 'premium-swal-popup',
                        confirmButton: 'premium-swal-confirm'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        doSubmit();
                    }
                });
            };

            // ─── Prevent leaving ───
            window.onbeforeunload = function () {
                return 'You have an ongoing exam. Are you sure you want to leave?';
            };

            // Init
            loadQuestion(0);
        })();
    </script>

</body>

</html>