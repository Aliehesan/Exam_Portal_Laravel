@extends('User.userlayout')

@section('User-content')

    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #3498db;
            --success-color: #27ae60;
            --bg-color: #f4f7f6;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background: var(--bg-color);
        }

        /* Header Styling */
        .exam-header {
            background: var(--primary-color);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .timer {
            font-size: 1.2rem;
            font-weight: bold;
            background: #e74c3c;
            padding: 5px 15px;
            border-radius: 5px;
        }

        /* Layout Container */
        .container {
            display: flex;
            padding: 20px;
            gap: 20px;
            max-width: 1200px;
            margin: auto;
        }

        /* Main Question Area */
        .question-card {
            flex: 3;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .options-list {
            list-style: none;
            padding: 0;
        }

        .option {
            border: 1px solid #ddd;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .option:hover {
            background: #f0f8ff;
            border-color: var(--accent-color);
        }

        .option input {
            margin-right: 15px;
        }

        /* Sidebar Navigation */
        .sidebar {
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            height: fit-content;
        }

        .question-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 15px;
        }

        .q-circle {
            width: 35px;
            height: 35px;
            border: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .q-circle.active {
            background: var(--accent-color);
            color: white;
            border: none;
        }

        /* Action Buttons */
        .btn-group {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-next {
            background: var(--accent-color);
            color: white;
        }

        .btn-submit {
            background: var(--success-color);
            color: white;
            margin-left: auto;
        }
    </style>
    </head>

    <body>

        <header class="exam-header">
            <div>
                <h2 style="margin:0">Final Term: Computer Science</h2>
                <small>Student: John Doe (ID: 4421)</small>
            </div>
            <div class="timer" id="timer">Time Left: 29:59</div>
        </header>

        <div class="container">
            <main class="question-card">
                <h3 id="q-number">Question 4 of 20</h3>
                <p id="q-text" style="font-size: 1.1rem; line-height: 1.6;">
                    Which of the following is a non-linear data structure?
                </p>

                <div class="options-list">
                    <label class="option"><input type="radio" name="ans"> Stack</label>
                    <label class="option"><input type="radio" name="ans"> Queue</label>
                    <label class="option"><input type="radio" name="ans"> Graph</label>
                    <label class="option"><input type="radio" name="ans"> Array</label>
                </div>

                <div class="btn-group">
                    <button style="background:#ddd">Previous</button>
                    <button class="btn-next">Save & Next</button>
                    <button class="btn-submit">Final Submit</button>
                </div>
            </main>

            <aside class="sidebar">
                <h4>Question Palette</h4>
                <div class="question-grid">
                    <div class="q-circle">1</div>
                    <div class="q-circle">2</div>
                    <div class="q-circle">3</div>
                    <div class="q-circle active">4</div>
                    <div class="q-circle">5</div>
                </div>
                <hr style="margin: 20px 0; border: 0.5px solid #eee;">
                <p><small>● Blue: Current</small><br>
                    <small>● Gray: Not Visited</small>
                </p>
            </aside>
        </div>

        <script>
            // Simple Timer Logic
            let time = 1800; // 30 minutes
            const timerEl = document.getElementById('timer');

            setInterval(() => {
                let minutes = Math.floor(time / 60);
                let seconds = time % 60;
                timerEl.innerHTML = `Time Left: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                if (time > 0) time--;
            }, 1000);
        </script>

@endsection