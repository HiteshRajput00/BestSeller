@extends('Admin-layout.master')
@section('content')
    <div style="padding-left: 150px" class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-12">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                @if ($nf_data->isNotEmpty())
                                    @foreach ($nf_data as $d)
                                        @php
                                            $createdAt = \Carbon\Carbon::parse($d->created_at);
                                            $timeGap = $createdAt->diffForHumans();
                                        @endphp
                                        <p>
                                        <div class="notification-info">
                                            <div class="notification-list-user-img"><img
                                                    src="{{ url('/admin/assets/images/avatar-2.jpg') }}" alt=""
                                                    class="user-avatar-md rounded-circle"></div>
                                            <div class="notification-list-user-block"><span
                                                    class="notification-list-user-name">{{ $d->title }}</span>{{ $d->message }}
                                                <div class="notification-date">{{ $timeGap }}</div>
                                            </div>
                                        </div>
                                        </p>
                                    @endforeach
                                    <div class=""> <a
                                            href="{{ url('/admin-dashboard/clear-adminNotification') }}">Clear all
                                            notifications</a></div>
                                @else
                                    <p>You have no notification yet...</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
