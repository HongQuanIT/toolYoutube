@extends('layouts.app-render', ['activePage' => 'render', 'titlePage' => __('Render Video')])

@section('styles')

<!-- Custom styles -->
<link href="./dist/css/jquery.dm-uploader.min.css" rel="stylesheet">
<link href="./styles.css" rel="stylesheet">
</script>
@endsection

@section('content')
<div class="content">
    <main role="main" class="container">
        <form method="post" action="{{route('render')}}" accept-charset="UTF-8">
            @csrf
            <div class="row">
                <div class="col-12 input-group mb-3">
                    <div class="input-group-prepend" style="border: 1px solid #00000029;">
                        <label class="input-group-text" for="inputGroupSelect01">Chọn Frame</label>
                    </div>
                    <select name="frame" class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose...</option>
                        <option value="1">Frame 1</option>
                        <option value="2">Frame 2</option>
                        <option value="3">Frame 3</option>
                    </select>
                </div>

                <div class="col-md-6 col-sm-12">
                    
                    <!-- Our markup, the important part here! -->
                    <div id="drag-and-drop-zone" class="dm-uploader p-5">
                    <h3 class="mb-5 mt-5 text-muted">Kéo &amp; thả video tại đây</h3>

                    <div class="btn btn-primary btn-block mb-5">
                        <span>Duyệt video từ máy tính</span>
                        <input type="file" name="files" multiple title='Click to add Files' />
                    </div>
                    </div><!-- /uploader -->

                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card h-100" style="margin-top:0">
                    <div class="card-header">
                        Danh sách video
                    </div>

                    <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                        <li class="text-muted text-center empty">Không có file nào được tải lên.</li>
                    </ul>
                    </div>
                </div>
            </div><!-- /file list -->
            <div style="text-align: center;">
                <button type="submit" class="btn btn-primary" style="padding: 20px 30px;">Tiến hành render</button>
            </div>
        </form>
        <div class="row">
        <div class="col-12">
            <div class="card h-100">
            <div class="card-header">
                Log Messages
            </div>

            <ul class="list-group list-group-flush" id="debug">
                <li class="list-group-item text-muted empty">Loading plugin....</li>
            </ul>
            </div>
        </div>
        </div> <!-- /debug -->

        </main> <!-- /container -->

        <footer class="text-center">
            <p>&copy; Development by &middot; <a href="https://www.facebook.com/HongQuan.ITC/">Đặng Hồng Quân</a></p>
        </footer>
</div>

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

<script src="./dist/js/jquery.dm-uploader.min.js"></script>
<script src="demo-ui.js"></script>
<script src="demo-config.js"></script>

<!-- File item template -->
<script type="text/html" id="files-template">
    <li class="media">
        <video class="mr-3 mb-2 preview-img" style="width: 64px;height: 64px;margin-right: 20px;" src=""></video>
        <div class="media-body mb-1">
            <p class="mb-2">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
            </p>
            <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
                role="progressbar"
                style="width: 0%" 
                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
            </div>
            <hr class="mt-1 mb-1" />
        </div>
    </li>
</script>

<!-- Debug item template -->
<script type="text/html" id="debug-template">
    <li class="list-group-item text-%%color%%"><strong>%%date%%</strong>: %%message%%</li>
</script>
@endsection