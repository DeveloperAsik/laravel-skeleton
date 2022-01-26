<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-left">
                    @if(isset($_breadcrumb) && !empty($_breadcrumb))
                        @foreach($_breadcrumb AS $keyword => $value)
                        <li class="breadcrumb-item{{isset($value['arrow']) && $value['arrow'] == false ? ' active' : '' }}"><a href="{{$value['path']}}">{{$value['title']}}</a></li>
                        @endforeach
                    @endif
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>