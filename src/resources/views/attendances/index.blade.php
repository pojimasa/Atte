@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance/index.css') }}">
@endsection

@section('content')
<div class="container" id="attendance-content">
    <h2>勤怠記録</h2>

    <form action="{{ route('attendance.index') }}" method="GET" class="form-inline mb-4">
        <div class="form-group">
            <label for="date">日付:</label>
            <input type="date" name="date" id="date" class="form-control mx-sm-2" value="{{ $date }}">
        </div>
        <button type="submit" class="btn btn-primary">検索</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>名前</th>
                <th>勤務開始</th>
                <th>勤務終了</th>
                <th>休憩時間</th>
                <th>勤務時間</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $userId => $userAttendances)
                @php
                    $totalBreakTime = 0;
                    $checkInTime = null;
                    $checkOutTime = null;
                @endphp
                <tr>
                    <td>
                        @if(!empty($userAttendances) && isset($userAttendances[0]->user))
                            {{ $userAttendances[0]->user->name }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @foreach($userAttendances as $attendance)
                            @if($attendance->type === 'check_in_time')
                                {{ date('H:i:s', strtotime($attendance->timestamp)) }}<br>
                                @php $checkInTime = strtotime($attendance->timestamp); @endphp
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($userAttendances as $attendance)
                            @if($attendance->type === 'check_out_time')
                                {{ date('H:i:s', strtotime($attendance->timestamp)) }}<br>
                                @php $checkOutTime = strtotime($attendance->timestamp); @endphp
                                @break
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @php
                            $breakStartTimes = $userAttendances->where('type', 'break_start_time')->pluck('timestamp')->toArray();
                            $breakEndTimes = $userAttendances->where('type', 'break_end_time')->pluck('timestamp')->toArray();

                            foreach ($breakStartTimes as $index => $breakStartTime) {
                                $breakEndTime = $breakEndTimes[$index] ?? null;
                                if ($breakEndTime) {
                                    $breakTime = strtotime($breakEndTime) - strtotime($breakStartTime);
                                    $totalBreakTime += $breakTime;
                                }
                            }
                        @endphp
                        {{ gmdate('H:i:s', $totalBreakTime) }}
                    </td>
                    <td>
                        @php
                            $totalWorkTime = ($checkOutTime - $checkInTime) - $totalBreakTime;
                            if ($totalWorkTime < 0) {
                                $totalWorkTime = 0;
                            }
                        @endphp
                        {{ gmdate('H:i:s', $totalWorkTime) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $attendances->links('vendor.pagination.simple') }}
    </div>
</div>
@endsection
