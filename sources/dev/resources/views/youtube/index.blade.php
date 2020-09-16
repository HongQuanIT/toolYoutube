@extends('layouts.app-youtube', ['activePage' => 'youtube', 'titlePage' => __('Youtube')])

@section('styles')
<link rel="stylesheet" href="{{ mix('css/pages/youtube.css') }}">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous"> -->

<!-- Custom styles -->
<link href="./dist/css/jquery.dm-uploader.min.css" rel="stylesheet">
<link href="./styles.css" rel="stylesheet">
</script>
@endsection

@section('content')
<div class="content">
    <!-- <button class='demo-youtube' id='demo-youtube'>api generate youtube</button>

    <form class="md-form" action="#">
        <div class="file-field">
            <div class="btn blue-gradient btn-sm float-left">
                <span><i class="fas fa-cloud-upload-alt mr-2" aria-hidden="true"></i>Choose files</span>
                <input type="file" multiple>
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Upload one or more files">
                <button class='btn' id='submit-file'>Submit</button>
            </div>
        </div>
    </form> -->
    <main role="main" class="container">
        <form method="post" action="{{route('render')}}" accept-charset="UTF-8">
            @csrf
            <div class="row">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Options</label>
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