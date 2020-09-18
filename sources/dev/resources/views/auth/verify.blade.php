<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('HQ Tool - Tự động hóa công việc') }}</title>
    <link rel="icon" type="image/png/ico" href="/favicon.ico">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
    </head>
    <body class="{{ $class ?? '' }}">
      <div class="container" style="height: auto;">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-8">
                <div class="card card-login card-hidden mb-3">
                  <div class="card-header card-header-primary text-center">
                    <p class="card-title"><strong>{{ __('Xác nhận địa chỉ email của bạn') }}</strong></p>
                  </div>
                  <div class="card-body">
                    <p class="card-description text-center"></p>
                    <p>
                      @if (session('resent'))
                          <div class="alert alert-success" role="alert">
                              {{ __('Một link xác nhận đã được gửi vào địa chỉ email của bạn.Vui lòng kiểm tra!') }}
                          </div>
                      @endif
                      
                      {{ __('Để tiếp tục được truy cập vào Tool. Vui lòng kiểm tra email xác nhận link.') }}
                      
                      @if (Route::has('verification.resend'))
                          {{ __('Nếu bạn không nhận được email') }},  
                          <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                              @csrf
                              <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Nhấn vào đây để gửi một yêu cầu khác') }}</button>.
                          </form>
                      @endif
                    </p>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </body>
</html>
