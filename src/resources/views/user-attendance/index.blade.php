@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user-attendance/index.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="container">
        <h2>ユーザー勤怠情報管理</h2>

        <form action="{{ route('attendance.user') }}" method="GET" class="form-inline mb-4">
            <label for="month">月を選択:</label>
            <select name="month" id="month" class="form-control" onchange="this.form.submit()">
                <option value="">全て</option>
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ (isset($selectedMonth) && $selectedMonth == $m) ? 'selected' : '' }}>
                        {{ $m }}月
                    </option>
                @endfor
            </select>
        </form>

        <div class="table-container">
            <div class="table-wrapper">
                <div class="table-inner">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ユーザー名</th>
                                <th>日付</th>
                                <th>出勤時間</th>
                                <th>退勤時間</th>
                                <th>休憩時間</th>
                                <th>勤務時間</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $date => $attendance)
                                <tr>
                                    <td>{{ $attendance[0]->user->name }}</td>
                                    <td>{{ $date }}</td>
                                    <td>
                                        @foreach ($attendance as $record)
                                            @if ($record->type === 'check_in_time')
                                                {{ date('H:i:s', strtotime($record->timestamp)) }}
                                                @break
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($attendance as $record)
                                            @if ($record->type === 'check_out_time')
                                                {{ date('H:i:s', strtotime($record->timestamp)) }}
                                                @break
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @php
                                            $totalBreakTime = 0;
                                            $breakStart = null;
                                            foreach ($attendance as $record) {
                                                if ($record->type === 'break_start_time') {
                                                    $breakStart = strtotime($record->timestamp);
                                                } elseif ($record->type === 'break_end_time' && $breakStart) {
                                                    $breakEnd = strtotime($record->timestamp);
                                                    $totalBreakTime += $breakEnd - $breakStart;
                                                    $breakStart = null;
                                                }
                                            }
                                            echo gmdate('H:i:s', $totalBreakTime);
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                            $checkIn = null;
                                            $checkOut = null;
                                            foreach ($attendance as $record) {
                                                if ($record->type === 'check_in_time') {
                                                    $checkIn = strtotime($record->timestamp);
                                                } elseif ($record->type === 'check_out_time') {
                                                    $checkOut = strtotime($record->timestamp);
                                                }
                                            }
                                            if ($checkIn && $checkOut) {
                                                $diff = $checkOut - $checkIn - $totalBreakTime;
                                                $hours = floor($diff / 3600);
                                                $minutes = floor(($diff % 3600) / 60);
                                                $seconds = $diff % 60;
                                                echo sprintf('%02d時間 %02d分 %02d秒', $hours, $minutes, $seconds);
                                            } else {
                                                echo '-';
                                            }
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
