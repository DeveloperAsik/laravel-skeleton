<!-- Select2 -->
<link rel="stylesheet" href="{{config('app.base_assets_uri')}}/templates/adminlte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{config('app.base_assets_uri')}}/templates/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<style>
    .select2-container {
        box-sizing: border-box;
        margin: 0px 0px 0px 6px;
        position: relative;
        width: 82% !important;
    }
</style>
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Create new menu</h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="title" class="col-sm-2 control-label">Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="title" class="form-control" id="title" placeholder="title">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="path" class="col-sm-2 control-label">Path</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="path" class="form-control" id="path" placeholder="path">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Icon</label>
                                            <select class="form-control select2 col-sm-10" id="icon" name="icon" style="width: 80%; padding-left:20px">
                                                @if(isset($icons) && !empty($icons))
                                                    @foreach($icons AS $keyword => $value)
                                                        <option value="{{$value->class}}">{{$value->class}} <i class="{{$value->class}}"></i></option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label for="level" class="col-sm-2 control-label">Level</label>
                                            <div class="col-sm-2">
                                                <input type="number" min="1" max="5" name="level" class="form-control" id="level" placeholder="level">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="is_badge" class="col-sm-2 control-label">Is Badge</label>
                                            <div class="col-sm-10">
                                                <input type="checkbox" name="is_badge" value="1"> 
                                            </div>
                                        </div>
                                        <div id="badgeID" style="display:none">
                                            <div class="form-group row">
                                                <label for="badge" class="col-sm-2 control-label">Badge</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" id="badge" name="badge">
                                                        <option value="0">-- select one --</option>
                                                        @if(isset($badges) && !empty($badges))
                                                            @foreach($badges AS $keyword => $value)
                                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="badge_text" class="col-sm-2 control-label">Badge Text</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="badge_text" class="form-control" id="badge_text" placeholder="badge_text">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="badge_value" class="col-sm-2 control-label">Badge Value</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="badge_value" class="form-control" id="badge_value" placeholder="badge_value">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="module_id" class="col-sm-2 control-label">Module</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="module_id" name="module_id">
                                                    <option value="0">-- select one --</option>
                                                    @if(isset($modules) && !empty($modules))
                                                        @foreach($modules AS $keyword => $value)
                                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div> 
                                        <div id="levelID"></div>
                                        <div id="levelChildID"></div>
                                        <div class="form-group row">
                                            <label for="level" class="col-sm-2 control-label">Is Open</label>
                                            <div class="col-sm-10">
                                                <input type="checkbox" name="is_open" value="1"> 
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="level" class="col-sm-2 control-label">Is Active</label>
                                            <div class="col-sm-10">
                                                <input type="checkbox" name="is_active" value="1"> 
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" id="submit_form_add_menu" class="btn btn-info">Submit</button>
                                    </div>
                                    <!-- /.card-footer -->
                                </form>
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- /.row -->
    </div><!--/. container-fluid -->
</section>